<?php
session_start();
?>

<!DOCTYPE html lang="en">
<html>
	<head>
		<meta charset="UTF-8" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" type="text/css" href="box_museum.css"> -->
		<link rel="stylesheet" type="text/css" href="./includes/box_museum_2.css">
		<title>welcome</title>
	</head>
	<body>
		<?php
		include_once 'includes/box_museum_functions.php';
		require_once 'includes/box_connect.php';

		index_header();

		collection_explore_options('devotion','images/pomander_simple_small.jpg', 'text/devotion_short.txt', 'social status','images/saddle_image.jpg', 'text/social status_short.txt', 'death', 'images/death.jpg', 'text/death_short.txt');
		// echo"<div class=\"gallery_head\"><h3>EXPLORE THE COLLECTION</h3></div>";
		// echo"<div class=\"gallery_display\">";
		// 	display_item('devotion','pomander_simple_small.jpg', 'devotion_short.txt');
		// 	display_item('social status','saddle_image.jpg', 'social status_short.txt');
		// 	display_item('death', 'death.jpg', 'death_short.txt');
		// echo"</div>";
		echo"<div class=\"gallery_long_text2\">";
			gallery_long_text('text/intro_text.txt');
		echo"</div>";

		
		page_footer();
		
		?>
	</body>

</html>