
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
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $employee = $_POST['employee'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];

$query="INSERT INTO tasks(title,description,employee_id,deadline,priority,status)
VALUES('$title','$description','$employee','$deadline','$priority','Pending')";

if(mysqli_query($conn,$query))
{
$message="Task Assigned Successfully!";
}
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Assign Task</title>

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

<h2 class="mb-4">Assign Task</h2>

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card">

<div class="card-header bg-success text-white text-center">
Assign New Task
</div>

<div class="card-body">

<?php if($message!=""){ ?>

<div class="alert alert-success">
<?php echo $message; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">
<label>Task Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control"></textarea>
</div>

<div class="mb-3">
<label>Select Employee</label>

<select name="employee" class="form-control">

<?php
$result=mysqli_query($conn,"SELECT * FROM employees");

while($row=mysqli_fetch_assoc($result))
{
?>

<option value="<?php echo $row['id']; ?>">
<?php echo $row['name']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">
<label>Deadline</label>
<input type="date" name="deadline" class="form-control">
</div>

<div class="mb-3">
<label>Priority</label>

<select name="priority" class="form-control">
<option>High</option>
<option>Medium</option>
<option>Low</option>
</select>

</div>

<button class="btn btn-success w-100" name="submit">
<i class="fa fa-tasks"></i> Assign Task
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>

