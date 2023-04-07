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

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>View All Reminders</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<h2>All Reminders</h2>
			<table class="table table-hover">
				<thead>
					<tr>
						<th></th>
						<th>Sno.</th>
						<th>Date</th>
						<th>Subject</th>
						<th>Email</th>
						<th>contact</th>
						<th>status</th>
					</tr>
				</thead>

				<tbody>
					<?php
						include_once('config.php');
						//$username= $_SESSION["username"]
						$stmt = $pdo->prepare(
								"SELECT * FROM reminder where username= '".$_SESSION["username"]."'");
						$stmt->execute();
						$reminders = $stmt->fetchAll();
						foreach($reminders as $reminder)
						{ 
					?>
					<tr>
						<td>
							<form action="view-reminder.php" method="post">
							    <input type="checkbox" id="<?php echo $reminder['id']; ?>" />
							</form>
						</td>

						<td>
							<?php 
								echo $reminder['id'];
							?>
						</td>
						<td>
							<?php 
								echo $reminder['date'];
							?>
						</td>
						<td>
							<?php echo $reminder['subject']; ?>
						</td>
						<td>
							<?php echo $reminder['email']; ?>
						</td>
						<td>
							<?php echo $reminder['contact']; ?>
						</td>
						<td>
							<?php echo $reminder['status']; ?>
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6">
				<input type='submit' value= "Modify" id="modify-reminder-btn" class='btn btn-primary'>
				<input type='submit' value= "Delete" id="delete-reminder-btn" class='btn btn-primary'>
				<input type='submit' value= "Enable" id="enable-reminder-btn" class='btn btn-primary'>
				<input type='submit' value= "Disable" id="disable-reminder-btn" class='btn btn-primary'>
			</div>
				<a href="welcome.php" class="btn btn-primary">Home</a>
				<a href="set-reminder.php" class="btn btn-primary">Set Reminder</a>
		</div>
	</div>
	
	<script>
			// Get all the checkboxes
			const checkboxes = document.querySelectorAll('input[type="checkbox"]');

			// Get the button that triggers the action
			const modify_button = document.querySelector('#modify-reminder-btn');
			const delete_button = document.querySelector('#delete-reminder-btn');
			const enable_button = document.querySelector('#enable-reminder-btn');
			const disable_button = document.querySelector('#disable-reminder-btn');

			// Add a click event listener to all the button

			// #1:
			modify_button.addEventListener('click', () => {
			  // Create an empty array to store the IDs of the checked checkboxes
			  const checkedIds = [];

			  // Loop through all the checkboxes
			  checkboxes.forEach((checkbox) => {
			    // Check if the checkbox is checked
			    if (checkbox.checked) {
			      // If it is, add its ID to the array
			      checkedIds.push(checkbox.id);
			    }
			  });

			  // If there are no checked checkboxes, alert the user and return
			  if (checkedIds.length === 0) {
			    alert('Please select at least one checkbox');
			    return;
			  }

			  // If there are checked checkboxes, create the URL for the anchor link

			  const url = `modify-reminder.php?id=${checkedIds.join(',')}`;
			  	// Navigate to the URL
			  window.location.href = url;
			});

			// #2:
			delete_button.addEventListener('click', () => {
			  // Create an empty array to store the IDs of the checked checkboxes
			  const checkedIds = [];

			  // Loop through all the checkboxes
			  checkboxes.forEach((checkbox) => {
			    // Check if the checkbox is checked
			    if (checkbox.checked) {
			      // If it is, add its ID to the array
			      checkedIds.push(checkbox.id);
			    }
			  });

			  // If there are no checked checkboxes, alert the user and return
			  if (checkedIds.length === 0) {
			    alert('Please select at least one checkbox');
			    return;
			  }

			  // If there are checked checkboxes, create the URL for the anchor link

			  const url = `delete-reminder.php?id=${checkedIds.join(',')}`;
			  	// Navigate to the URL
			  window.location.href = url;
			});

			// #4:
			enable_button.addEventListener('click', () => {
			  // Create an empty array to store the IDs of the checked checkboxes
			  const checkedIds = [];

			  // Loop through all the checkboxes
			  checkboxes.forEach((checkbox) => {
			    // Check if the checkbox is checked
			    if (checkbox.checked) {
			      // If it is, add its ID to the array
			      checkedIds.push(checkbox.id);
			    }
			  });

			  // If there are no checked checkboxes, alert the user and return
			  if (checkedIds.length === 0) {
			    alert('Please select at least one checkbox');
			    return;
			  }

			  // If there are checked checkboxes, create the URL for the anchor link

			  const url = `enable-reminder.php?id=${checkedIds.join(',')}`;
			  	// Navigate to the URL
			  window.location.href = url;
			});

			// #4:
			disable_button.addEventListener('click', () => {
			  // Create an empty array to store the IDs of the checked checkboxes
			  const checkedIds = [];

			  // Loop through all the checkboxes
			  checkboxes.forEach((checkbox) => {
			    // Check if the checkbox is checked
			    if (checkbox.checked) {
			      // If it is, add its ID to the array
			      checkedIds.push(checkbox.id);
			    }
			  });

			  // If there are no checked checkboxes, alert the user and return
			  if (checkedIds.length === 0) {
			    alert('Please select at least one checkbox');
			    return;
			  }

			  // If there are checked checkboxes, create the URL for the anchor link

			  const url = `disable-reminder.php?id=${checkedIds.join(',')}`;
			  	// Navigate to the URL
			  window.location.href = url;
			});
</script>

</body>
</html>