
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user']))
{
header("Location:../login.php");
exit();
}

$message="";

if(isset($_POST['submit']))
{
$name = $_POST['name'];
$email = $_POST['email'];
$department = $_POST['department'];
$password = $_POST['password'];

/* insert into employees table */

mysqli_query($conn,"
INSERT INTO employees(name,email,department,password)
VALUES('$name','$email','$department','$password')
");

/* create login account in users table */

mysqli_query($conn,"
INSERT INTO users(name,email,password,role)
VALUES('$name','$email','$password','employee')
");

$message="Employee Added Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Employee</title>

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

.card{
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="sidebar">

<h4>Task Manager</h4>

<a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
<a href="add_employee.php"><i class="fa fa-user-plus"></i> Add Employee</a>
<a href="assign_task.php"><i class="fa fa-tasks"></i> Assign Task</a>
<a href="view_tasks.php"><i class="fa fa-list"></i> View Tasks</a>
<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>

</div>

<div class="main">

<h2 class="mb-4">Add Employee</h2>

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card">

<div class="card-header bg-primary text-white text-center">
Add New Employee
</div>

<div class="card-body">

<?php if($message!=""){ ?>

<div class="alert alert-success">
<?php echo $message; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">
<label>Employee Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Department</label>
<input type="text" name="department" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-success w-100" name="submit">
<i class="fa fa-user-plus"></i> Add Employee
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>

