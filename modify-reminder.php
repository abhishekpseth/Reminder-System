<?php 
	session_start();
	require("config.php");
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	    header("location: login.php");
	    exit;
	}
	
	// Check if reminder id is provided in the query string
	if(!isset($_GET["id"]) || empty(trim($_GET["id"]))){
		header("location: view-reminder.php");
		exit;
	}

	// Initialize variables
	$subject = $description = $email = $contact = $sms = "";
	$recur1 = $recur2 = $recur3 = $recur4 = false;
	
	// Get the reminder details
	$id = trim($_GET["id"]);
	$sql = "SELECT * FROM reminder WHERE id = :id";
	if($stmt = $pdo->prepare($sql)){
		$stmt->bindParam(":id", $param_id);
		$param_id = $id;
		if($stmt->execute()){
			if($stmt->rowCount() == 1){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$subject = $row["subject"];
				$description = $row["description"];
				$email = $row["email"];
				$contact = $row["contact"];
				$sms = $row["sms"];
				//$recur = $row["recur"];
			}else{
				// Reminder not found, redirect to view reminders page
				header("location: view-reminder.php");
				exit;
			}
		}else{
			// Database error, redirect to view reminders page
			header("location: view-reminder.php");
			exit;
		}
		unset($stmt);
	}
	
	// Handle form submission
	if(isset($_POST["reg"])){
	      $sql= "UPDATE reminder SET date = :date, subject = :subject, description = :description, email = :email, contact = :contact, sms = :sms WHERE id = :id";		
	      $date = date('Y-m-d', strtotime($_POST['date']));
		if($stmt = $pdo->prepare($sql)){
			$stmt->bindParam(':id', $_GET["id"]);
			$stmt->bindParam(':date',$date);
			$stmt->bindParam(':subject', $_POST['subject']);
			$stmt->bindParam(':description', $_POST['description']);
			$stmt->bindParam(':email', $_POST['email']);
			$stmt->bindParam(':contact', $_POST['contact']);
			$stmt->bindParam(':sms', $_POST['sms']);
			

			if($stmt->execute()){
				echo"<div class='alert alert-success'>Modified Success</div>";
				echo $_GET["id"];
			}else{
				echo"<div class='alert alert-danger'>Failed Try Again</div>";
			}
			unset($stmt);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<?php include "header.php";?>
	<body>
		<div class='container mt-4'>
			<div class='row'>
				<div class='col-md-4'>
					<h3 class='text-muted text-center'>Modify Reminder</h3>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>" method='post' autocomplete='off'>
						<div class="form-group">
							<label>Date</label>
							<input type="text" class="form-control datepicker" name='date' placeholder="dd-mm-yyyy">
						</div>
						<div class="form-group">
							<label>Subject</label>
							<input type="text" class="form-control"  name='subject' value="<?php echo $subject; ?>" >
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control"><?php echo $description; ?></textarea>
						</div>

						<div class="form-group">
							<label>Email Address</label>
							<input type="email" class="form-control" name='email' value="<?php echo $email; ?>">
						</div>

						<div class="form-group">
							<label>Contact No.</label>
							<input type="tel" class="form-control" name='contact' value="<?php echo $contact; ?>">
						</div>

						<div class="form-group">
							<label>SMS No.</label>
							<input type="tel" class="form-control" name='sms' value="<?php echo $sms; ?>">
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
	</body>
</html>

