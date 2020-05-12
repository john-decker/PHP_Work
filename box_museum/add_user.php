<!DOCTYPE html lang="en">
<html>
	<head>
		<meta charset="UTF-8" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" type="text/css" href="box_museum.css"> -->
		<link rel="stylesheet" type="text/css" href="./includes/box_museum_2.css">
		<title>new account</title>
	</head>
	<body>
	<?php
	include_once 'includes/box_museum_functions.php';
	require_once 'includes/box_connect.php';

	echo<<<_END
		<div class="col-container">
			<div class="head5"><p>Please provide the requested information and press 'submit'.</p></div>
			<div class="head4">
				<form method=POST action="">
					First Name:
					<input type="text" name="firstname"><br />
					Last Name:
					<input type="text" name="lastname"><br />
					User Name:
					<input type="text" name="username"><br />
					Password:
					<input type="password" name="password"><br /><br />
					<input type="submit" name="submituser">
				</form>
				<a href='./box_museum.php'><button>Or, Return to Welcome Page</button></a></h></p>
			</div>
		</div>

	_END;


	if(isset($_POST['submituser'])){
		$user_id = NULL;
		$is_admin=0;

		//input user info into variables
		$user_fname = sanitize_string(strtolower($_POST['firstname']));
		$user_lname = sanitize_string(strtolower($_POST['lastname']));
		$user_handle = strtolower($_POST['username']);
		$user_pass = $_POST['password'];
		$user_hash = password_hash($user_pass, PASSWORD_DEFAULT);

		//open connection and create user from information provided
		$connection = new mysqli($hn,$un,$pw,$db);
		if($connection->connect_error) die($connection->connect_error);
			add_guest_user($connection, $user_id, $user_fname, $user_lname, $user_handle, $user_hash, $is_admin);
		$connection->close();
		header("Location: ./box_museum.php");
	}

	else{
		echo "<div class=\"alert\"><p class=\"login_error_msg2\">No information entered ...</p></div>";
	}


	// $connection = new mysqli($hn,$un,$pw,$db);

	// if($connection->connect_error) die($connection->connect_error);

// $user_id = NULL;
// $user_fname = strtolower('John');
// $user_lname = strtolower('Decker');
// $user_handle = strtolower('jdeckerphd');
// $user_pass = 'OshiBagoshi1';
// $user_hash = password_hash($user_pass, PASSWORD_DEFAULT);
// $is_admin=1;

// $query  = "INSERT INTO guest_user VALUES(NULL,'$user_fname', '$user_lname', '$user_handle', '$user_hash', '$is_admin')";    
// $result = $connection->query($query);
// print_r($result);    
// if (!$result) die($connection->error);

// link this to form input
// $user_id = NULL;
// $user_fname = strtolower('oshi');
// $user_lname = strtolower('bagoshi');
// $user_handle = strtolower('obago');
// $user_pass = 'snakeisgreat';
// $user_hash = password_hash($user_pass, PASSWORD_DEFAULT);
// $is_admin=0;

// echo"$user_handle added";


// add_guest_user($connection, $user_id, $user_fname, $user_lname, $user_handle, $user_hash, $is_admin);

// $result->close();
	// $connection->close();


	?>
	</body>

</html>