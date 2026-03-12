
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user']))
{
header("Location:../login.php");
exit();
}

$result=mysqli_query($conn,"SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>

<title>View Employees</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

.sidebar h4{
text-align:center;
margin-bottom:30px;
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

<h4>Task Manager</h4>

<a href="dashboard.php">Dashboard</a>
<a href="add_employee.php">Add Employee</a>
<a href="assign_task.php">Assign Task</a>
<a href="view_tasks.php">View Tasks</a>
<a href="view_employees.php">View Employees</a>
<a href="../logout.php">Logout</a>

</div>

<div class="main">

<h2 class="mb-4">Employees List</h2>

<div class="card">

<div class="card-body">

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Actions</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['department']; ?></td>

<td>

<a href="assign_task.php?employee_id=<?php echo $row['id']; ?>"
class="btn btn-primary btn-sm">

Assign Task

</a>

<a href="delete_employee.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>

