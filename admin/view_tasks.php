
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user']))
{
header("Location:../login.php");
exit();
}

/* SEARCH */

if(isset($_GET['search']))
{
$search=$_GET['search'];

$query="SELECT tasks.*, employees.name
FROM tasks
JOIN employees ON tasks.employee_id=employees.id
WHERE tasks.title LIKE '%$search%'";
}
else
{
$query="SELECT tasks.*, employees.name
FROM tasks
JOIN employees ON tasks.employee_id=employees.id";
}

$result=mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>

<title>All Tasks</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

body{
background:#f4f6f9;
font-family:Arial;
}

/* SIDEBAR */

.sidebar{
height:100vh;
background:#2c3e50;
color:white;
padding-top:20px;
position:fixed;
width:220px;
}

.sidebar h4{
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
padding:12px 20px;
color:white;
text-decoration:none;
transition:0.3s;
}

.sidebar a:hover{
background:#34495e;
}

/* MAIN CONTENT */

.main{
margin-left:230px;
padding:30px;
}

/* CARD */

.card{
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h4>Task Manager</h4>

<a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
<a href="add_employee.php"><i class="fa fa-user-plus"></i> Add Employee</a>
<a href="assign_task.php"><i class="fa fa-tasks"></i> Assign Task</a>
<a href="view_tasks.php"><i class="fa fa-list"></i> View Tasks</a>
<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>

</div>

<!-- MAIN CONTENT -->

<div class="main">

<h2 class="mb-4">All Tasks</h2>

<div class="card">

<div class="card-header bg-warning text-dark text-center">
<h4>Task List</h4>
</div>

<div class="card-body">

<form method="GET" class="mb-3">

<div class="row">

<div class="col-md-10">
<input type="text" name="search"
class="form-control"
placeholder="Search task">
</div>

<div class="col-md-2">
<button class="btn btn-primary w-100">
Search
</button>
</div>

</div>

</form>

<div class="table-responsive">

<table class="table table-striped table-bordered text-center">

<thead class="table-dark">

<tr>
<th>Task</th>
<th>Employee</th>
<th>Deadline</th>
<th>Priority</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['deadline']; ?></td>

<td>

<?php
if($row['priority']=="High")
{
echo "<span class='badge bg-danger'>High</span>";
}
elseif($row['priority']=="Medium")
{
echo "<span class='badge bg-warning text-dark'>Medium</span>";
}
else
{
echo "<span class='badge bg-success'>Low</span>";
}
?>

</td>

<td>

<?php
if($row['status']=="Completed")
{
echo "<span class='badge bg-success'>Completed</span>";
}
elseif($row['status']=="Pending")
{
echo "<span class='badge bg-danger'>Pending</span>";
}
else
{
echo "<span class='badge bg-warning text-dark'>In Progress</span>";
}
?>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>
</html>

