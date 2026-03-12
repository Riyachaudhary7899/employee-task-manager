
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['employee_id']))
{
header("Location:../login.php");
exit();
}

$employee_id = $_SESSION['employee_id'];
$employee_name = $_SESSION['user'];

/* Task statistics */

$total_tasks = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM tasks WHERE employee_id='$employee_id'"));

$completed_tasks = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM tasks WHERE employee_id='$employee_id' AND status='Completed'"));

$pending_tasks = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM tasks WHERE employee_id='$employee_id' AND status!='Completed'"));

/* Recent tasks */

$recent_tasks = mysqli_query($conn,
"SELECT * FROM tasks WHERE employee_id='$employee_id' ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>

<title>Employee Dashboard</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#f4f6f9;
font-family:Arial;
}

.sidebar{
height:100vh;
background:#2c3e50;
color:white;
position:fixed;
width:220px;
padding-top:20px;
}

.sidebar a{
display:block;
padding:12px 20px;
color:white;
text-decoration:none;
}

.sidebar a:hover{
background:#34495e;
}

.main{
margin-left:230px;
padding:30px;
}

.card-box{
border-radius:12px;
padding:25px;
color:white;
text-align:center;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.bg-blue{
background:#007bff;
}

.bg-green{
background:#28a745;
}

.bg-red{
background:#dc3545;
}

</style>

</head>

<body>

<div class="sidebar">

<h4 class="text-center">Employee Panel</h4>

<a href="dashboard.php">Dashboard</a>
<a href="my_tasks.php">My Tasks</a>
<a href="../logout.php">Logout</a>

</div>

<div class="main">

<h2>Employee Dashboard</h2>

<p>Welcome <b><?php echo $employee_name; ?></b></p>

<div class="row">

<div class="col-md-4">

<div class="card-box bg-blue">

<h4>Total Tasks</h4>

<h2><?php echo $total_tasks['total']; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg-green">

<h4>Completed</h4>

<h2><?php echo $completed_tasks['total']; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg-red">

<h4>Pending</h4>

<h2><?php echo $pending_tasks['total']; ?></h2>

</div>

</div>

</div>

<div class="card mt-5">

<div class="card-header">
Recent Tasks
</div>

<div class="card-body">

<table class="table">

<tr>
<th>Task</th>
<th>Deadline</th>
<th>Status</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($recent_tasks))
{

$task_name = "";

if(isset($row['task_title']))
{
$task_name = $row['task_title'];
}
elseif(isset($row['task']))
{
$task_name = $row['task'];
}

echo "<tr>
<td>".$task_name."</td>
<td>".$row['deadline']."</td>
<td>".$row['status']."</td>
</tr>";

}

?>

</table>

</div>

</div>

</div>

</body>
</html>

