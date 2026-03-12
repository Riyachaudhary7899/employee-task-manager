
<?php
session_start();
include("config/db.php");

$error="";

if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$role=$_POST['role'];

if($role=="admin")
{

$query=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password' AND role='admin'");

if(mysqli_num_rows($query)==1)
{
$row=mysqli_fetch_assoc($query);

$_SESSION['user']=$row['name'];
$_SESSION['role']="admin";

header("Location:admin/dashboard.php");
exit();
}
else
{
$error="Invalid Admin Login!";
}

}

elseif($role=="employee")
{

$query=mysqli_query($conn,"SELECT * FROM employees WHERE email='$email' AND password='$password'");

if(mysqli_num_rows($query)==1)
{
$row=mysqli_fetch_assoc($query);

$_SESSION['user']=$row['name'];
$_SESSION['employee_id']=$row['id'];
$_SESSION['role']="employee";

header("Location:employee/dashboard.php");
exit();
}
else
{
$error="Invalid Employee Login!";
}

}

else
{
$error="Please select role!";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Task Manager Login</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

body{
height:100vh;
display:flex;
align-items:center;
justify-content:center;
background:linear-gradient(135deg,#36a2ff,#00c6ff);
font-family:Arial;
}

.login-box{
width:380px;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.login-box h3{
text-align:center;
margin-bottom:20px;
}

.input-group-text{
background:#007bff;
color:white;
}

</style>

</head>

<body>

<div class="login-box">

<h3>Task Manager Login</h3>

<?php if($error!=""){ ?>

<div class="alert alert-danger"><?php echo $error; ?></div>

<?php } ?>

<form method="post">

<div class="input-group mb-3">

<span class="input-group-text">
<i class="fa fa-envelope"></i>
</span>

<input type="email" name="email" class="form-control" placeholder="Enter Email" required>

</div>

<div class="input-group mb-3">

<span class="input-group-text">
<i class="fa fa-lock"></i>
</span>

<input type="password" name="password" class="form-control" placeholder="Enter Password" required>

</div>

<select name="role" class="form-control mb-3" required>

<option value="">Choose Role</option>
<option value="admin">Admin</option>
<option value="employee">Employee</option>

</select>

<button type="submit" name="login" class="btn btn-primary w-100">
Login
</button>

</form>

</div>

</body>
</html>

