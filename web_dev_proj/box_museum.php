<?php
session_start();
?>

<!DOCTYPE html lang="en">
<html>
	<head>
		<meta charset="UTF-8" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" type="text/css" href="box_museum.css"> -->
		<link rel="stylesheet" type="text/css" href="box_museum_2.css">
		<title>box_museum_home</title>
	</head>
	<body>
		<?php
		include_once 'box_museum_functions.php';
		require_once 'box_connect.php';

		index_header();

		echo"<div class=\"gallery_head\"><h3>EXPLORE THE COLLECTION</h3></div>";
		echo"<div class=\"gallery_display\">";
			display_item('devotion','pomander_simple_small.jpg', 'devotion.txt');
			display_item('social status','saddle_image.jpg', 'power.txt');
			display_item('death', 'death.jpg', 'death.txt');
		echo"</div>";
		echo"<div class=\"gallery_long_text\">";
			gallery_long_text('intro_text.txt');
		echo"</div>";

		
		page_footer();
		
		?>
	</body>

</html>