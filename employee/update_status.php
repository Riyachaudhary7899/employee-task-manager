
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user']))
{
header("Location:../login.php");
exit();
}

$id=$_GET['id'];

if(isset($_POST['update']))
{
$status=$_POST['status'];

$query="UPDATE tasks SET status='$status' WHERE id='$id'";
mysqli_query($conn,$query);

header("Location:my_tasks.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Update Task Status</title>

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
transition:0.3s;
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

<h4>Employee Panel</h4>

<a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
<a href="my_tasks.php"><i class="fa fa-tasks"></i> My Tasks</a>
<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>

</div>

<div class="main">

<h2 class="mb-4">Update Task Status</h2>

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card">

<div class="card-header bg-primary text-white text-center">
Update Status
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option>Pending</option>
<option>In Progress</option>
<option>Completed</option>

</select>

</div>

<button class="btn btn-success w-100" name="update">
<i class="fa fa-save"></i> Update Status
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>

