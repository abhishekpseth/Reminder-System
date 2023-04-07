<?php 
	session_start();
	require("config.php");
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	    header("location: login.php");
	    exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<?php include "header.php";?>
	<body>
		<div class='container mt-4'>
			<div class='row'>
				<div class='col-md-4'>
					<h3 class='text-muted text-center'>ADD DETAILS</h3>
					<?php
						if(isset($_POST["reg"])){
							$sql= "INSERT INTO reminder ( username, date, subject, description, email, contact, sms) VALUES (:username, :date, :subject, :description, :email, :contact, :sms)";
							$date = date('Y-m-d', strtotime($_POST['date']));
							if($stmt = $pdo->prepare($sql)){
								$stmt->bindParam(':date',$date);
								$stmt->bindParam(':username',$_SESSION["username"]);
								$stmt->bindParam(':subject', $_POST['subject']);
								$stmt->bindParam(':description', $_POST['description']);
								$stmt->bindParam(':email', $_POST['email']);
								$stmt->bindParam(':contact', $_POST['contact']);
								$stmt->bindParam(':sms', $_POST['sms']);


								if($stmt->execute()){
									echo"<div class='alert alert-success'>Added Success</div>";
								}else{
									echo"<div class='alert alert-danger'>Failed Try Again</div>";
								}
								unset($stmt);
							}
						}
					?> 
					<form action='set-reminder.php' method='post' autocomplete='off'>
						<div class="form-group">
							<label>Date</label>
							<input type="text" class="form-control datepicker" name='date' placeholder="dd-mm-yyyy">
						</div>
						<div class="form-group">
							<label>Subject</label>
							<input type="text" class="form-control"  name='subject' placeholder="Subject" >
						</div>

						<div class="form-group">
							<label>Description</label>
							<input type="text" class="form-control"  name='description' placeholder="Description">
						</div>

						<div class="form-group">
							<label>Email Address</label>
							<input type="email" class="form-control" name='email' placeholder="Email">
						</div>

						<div class="form-group">
							<label>Contact No.</label>
							<input type="tel" class="form-control" name='contact' placeholder="Contact No.">
						</div>

						<div class="form-group">
							<label>SMS No.</label>
							<input type="tel" class="form-control" name='sms' placeholder="SMS No.">
						</div>
						
						<div class="form-group">
							<input type='submit' name='reg' value='Confirm' class='btn btn-primary'>
						</div>
						<a href="welcome.php" class="btn btn-primary">Home</a>
        				<a href="view-reminder.php" class="btn btn-primary">View Your Reminders</a>
					</form>
				</div>
			</div>
		</div>

		<script>

		</script>
	</body>
</html>

