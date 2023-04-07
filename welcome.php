<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        .page-header{ background-color: #f8f8f8; padding: 30px; }
        h1{ margin-top: 0; }
        .btn{ margin: 10px; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Reminders application</h1>
        <h2>Today is <?php echo date('jS F', strtotime(date("Y/m/d")));?></h2>
    </div>        
        <a href="set-reminder.php" class="btn btn-primary">Set Reminder</a>
        <a href="view-reminder.php" class="btn btn-primary">View Your Reminders</a>
        <a href="logout.php" class="btn btn-primary">Sign Out of Your Account</a>
        <a href="reset-password.php" class="btn btn-primary">Reset Your Password</a>
</body>
</html>