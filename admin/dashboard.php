
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user']))
{
header("Location:../login.php");
exit();
}

/* Task Statistics */

$total_tasks = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM tasks"));

$completed_tasks = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM tasks WHERE status='Completed'"));

$pending_tasks = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM tasks WHERE status!='Completed'"));

/* Tasks per employee chart */

$chart_query = mysqli_query($conn,"
SELECT employees.name, COUNT(tasks.id) as total_tasks
FROM employees
LEFT JOIN tasks ON employees.id = tasks.employee_id
GROUP BY employees.id
");

$employee_names = [];
$task_counts = [];

while($row = mysqli_fetch_assoc($chart_query))
{
$employee_names[] = $row['name'];
$task_counts[] = $row['total_tasks'];
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

.card-box{
border-radius:12px;
padding:25px;
color:white;
text-align:center;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
transition:0.3s;
}

.card-box:hover{
transform:translateY(-8px);
}

.bg-blue{
background:linear-gradient(135deg,#36a2ff,#007bff);
}

.bg-green{
background:linear-gradient(135deg,#28a745,#1e7e34);
}

.bg-red{
background:linear-gradient(135deg,#ff4d4d,#cc0000);
}

.action-btn{
border-radius:8px;
font-weight:500;
}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h4>Task Manager</h4>

<a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
<a href="add_employee.php"><i class="fa fa-user-plus"></i> Add Employee</a>
<a href="assign_task.php"><i class="fa fa-tasks"></i> Assign Task</a>
<a href="view_tasks.php"><i class="fa fa-list"></i> View Tasks</a>
<a href="view_employees.php"><i class="fa fa-users"></i> Employees</a>
<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>

</div>

<!-- Main Content -->

<div class="main">

<h2>Admin Dashboard</h2>

<p>Welcome <b><?php echo $_SESSION['user']; ?></b></p>

<!-- Action Buttons -->

<div class="row mb-4">

<div class="col-md-3">
<a href="add_employee.php" class="btn btn-primary w-100 action-btn">
<i class="fa fa-user-plus"></i> Add Employee
</a>
</div>

<div class="col-md-3">
<a href="assign_task.php" class="btn btn-success w-100 action-btn">
<i class="fa fa-tasks"></i> Assign Task
</a>
</div>

<div class="col-md-3">
<a href="view_tasks.php" class="btn btn-warning w-100 action-btn">
<i class="fa fa-list"></i> View Tasks
</a>
</div>

<div class="col-md-3">
<a href="view_employees.php" class="btn btn-info w-100 action-btn">
<i class="fa fa-users"></i> Employees
</a>
</div>

</div>

<!-- Statistics -->

<div class="row">

<div class="col-md-4">

<div class="card-box bg-blue">

<i class="fa fa-tasks fa-2x mb-2"></i>

<h4>Total Tasks</h4>

<h2><?php echo $total_tasks['total']; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg-green">

<i class="fa fa-check-circle fa-2x mb-2"></i>

<h4>Completed Tasks</h4>

<h2><?php echo $completed_tasks['total']; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg-red">

<i class="fa fa-clock fa-2x mb-2"></i>

<h4>Pending Tasks</h4>

<h2><?php echo $pending_tasks['total']; ?></h2>

</div>

</div>

</div>

<!-- Chart -->

<div class="row mt-5">

<div class="col-md-8 offset-md-2">

<div class="card">

<div class="card-header">
Task Distribution Per Employee
</div>

<div class="card-body">

<canvas id="taskChart"></canvas>

</div>

</div>

</div>

</div>

</div>

<script>

const ctx = document.getElementById('taskChart');

new Chart(ctx, {

type: 'bar',

data: {

labels: <?php echo json_encode($employee_names); ?>,

datasets: [{
label: 'Tasks Assigned',
data: <?php echo json_encode($task_counts); ?>,

backgroundColor: [
'#36A2EB',
'#4BC0C0',
'#FFCE56',
'#FF6384',
'#9966FF'
],

borderRadius: 10,
barThickness: 50

}]

},

options: {

responsive: true,

plugins: {

legend: {
display: false
},

title: {
display: true,
text: 'Tasks Assigned Per Employee',
font: {
size: 18
}
}

},

scales: {

y: {
beginAtZero: true,
ticks: {
stepSize: 1
}
}

}

}

});

</script>

</body>
</html>

