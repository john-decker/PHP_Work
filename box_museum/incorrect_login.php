<!DOCTYPE html lan="en">
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./includes/box_museum_2.css">
		<title>unsuccessful login</title>
	</head>
	<body>
	<?php
	include_once 'includes/box_museum_functions.php';

	incorrect_login_header();

	echo<<<_END
		<div class="wrong_id1">
			<p class="wrong_id"><h3>Invalid username/password combination!<br /><a href='./box_museum.php'><button>Try Again</button></a></h></p>
		</div>
		<div class="wrong_id2">
			<p class="wrong_id"><h3>Not yet a member? Create a new account:<br /><a href='./add_user.php'><button>New Account</button></a></h></p>
		</div>
	_END;

	page_footer();
	?>
	</body>
</html>