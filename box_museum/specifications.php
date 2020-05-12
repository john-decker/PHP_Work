<?php
session_start();

?>

<!DOCTYPE html lang = 'en'>
<html>
 <head>
		<meta charset="UTF-8" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./includes/box_museum_2.css">
		<title>technical_specifications</title>
	</head>

	<body>
		<?php
		include_once 'includes/box_museum_functions.php';
		require_once 'includes/box_connect.php';
		if(!isset($_SESSION['fname'])){
			echo"<div class=\"wrong_id1\">";
				echo"<p class=\"wrong_id\"><h3>You are not currently logged in.<br />Please return to the homepage and try again.<br /><br /><a href='box_museum.php'><button>Try Again</button></a></h></p>";
			echo"</div>";
		}
		else{
			echo"<div class=\"gallery_head\"><h3>TECHNICAL SPECIFICATIONS: BOX MUSEUM</h3><br /><a href=\"box_museum_user_page.php\"><button>Leave Specifications Page</button></a></div>";
				// echo"<div class=\"col-container\">";
				echo"<div class=\"admin_left\">";
					echo"<div class=\"simple_display\">";
					echo"</div class=\"user_gallery_display\">";
						echo"<img class=\"center\" src=\"images/box_museum_phys.png\" alt=\"picture of a box museum\">";
						echo"<br /><br /><br /><br /><br />";
						echo"<img class=\"center\" src=\"images/wiring_diag.jpg\" alt=\"a wiring diagram\">";
						echo"<br /><br /><br /><br /><br />";
					echo"</div>";
					echo"</div class=\"user_gallery_display\">";
				echo"</div>";
				echo"<div class=\"admin_right\">";
					about_text('text/tech_specs.txt');
				echo"</div>";
			// echo"</div>";
		}
		?>

	</body>

</html>