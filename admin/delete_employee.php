
<?php

include("../config/db.php");

$id = $_GET['id'];

/* delete tasks assigned to employee */

mysqli_query($conn,"DELETE FROM tasks WHERE employee_id='$id'");

/* delete employee */

mysqli_query($conn,"DELETE FROM employees WHERE id='$id'");

/* delete login account */

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location:view_employees.php");

?>
