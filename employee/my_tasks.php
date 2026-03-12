
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user']))
{
header("Location:../login.php");
exit();
}

$user_id = $_SESSION['user_id'];

/* Fetch tasks only for logged-in employee */

$query = "SELECT * FROM tasks WHERE employee_id='$user_id'";
$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
<head>

<title>My Tasks</title>

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
padding-top:20px;
position:fixed;
width:220px;
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

<h2>My Tasks</h2>

<div class="card">

<div class="card-body">

<?php if(mysqli_num_rows($result) > 0){ ?>

<table class="table table-bordered">

<tr>
<th>Task</th>
<th>Description</th>
<th>Deadline</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['description']; ?></td>

<td><?php echo $row['deadline']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="update_status.php?id=<?php echo $row['id']; ?>"
class="btn btn-success btn-sm">
Update
</a>

</td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<div class="alert alert-info text-center">

No tasks assigned

</div>

<?php } ?>

</div>

</div>

</div>

</body>
</html>

