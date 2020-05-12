<?php
session_start();

include_once 'includes/box_museum_functions.php';
require_once 'includes/box_connect.php';

if (isset($_POST['submit'])){ 
	if (empty($_POST['username']) || empty($_POST['userpassword'])) {
		echo "<p class=\"login_error_msg\">Data missing or incomplete. Please fill in all fields.<br />Please press back button.</p>";
	} else {
		$connection = new mysqli($hn, $un, $pw, $db);
		if ($connection->connect_error) die($connection->connect_error);
		$username = sanitize_SQL($connection, $_POST['username']);
		$password = sanitize_SQL($connection, $_POST['userpassword']);			
		
		$query = "SELECT * FROM guest_user WHERE guest_handle='$username'"; 
		$result = $connection->query($query);    

		if ($result->num_rows) {
			$row = $result->fetch_assoc();
			if(password_verify($password, $row['guest_hash'])){
				$_SESSION['fname'] = $row['guest_Fname'];
				$_SESSION['lname'] = $row['guest_Lname'];
				$_SESSION['username'] = $row['guest_handle'];
				$_SESSION['admin']= $row['is_admin'];
				
				header("Location: ./box_museum_user_page.php");			
			}
		} 
		else {
			header("Location: ./incorrect_login.php");
		}
	}
}


?>
