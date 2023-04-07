<?php
	session_start();
	require("config.php");
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	    header("location: login.php");
	    exit;
	}
	// Get the IDs of the checked checkboxes from the URL
	$Ids = $_GET['id'];
	$checkedIds= explode(',', $Ids);
	// Loop through all the checked IDs
	foreach ($checkedIds as $id) {
	  // Perform the update query for the current ID
	  $sql = "UPDATE reminder SET status = 'DISABLED' WHERE ID = '$id'";

	  // Check if the query was successful
	  if ($pdo->query($sql)) {
	    // If it was, print a success message
	    echo "Record updated successfully for ID: $id<br>";
	    header("location:view-reminder.php");
	  } else {
	    // If it wasn't, print an error message
	    echo "Error updating record for ID: $id<br>";
	  }
	}
?>
