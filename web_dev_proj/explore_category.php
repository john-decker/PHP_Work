<?php
session_start();

//doesn't work - goes straight to "oops"

if(isset($_GET['category_id'])){
	$category = $_GET['category_id'];
	$heading = strtoupper($_GET['category_id']); 
}

else{
	$category = "oops";
}

//perhaps final statement in case page was opened somehow without going through landing page?
//would need to use isset for the daily category

?>

<!DOCTYPE html lang="en">
<html>
	<head>
		<meta charset="UTF-8">
		<!-- <link rel="stylesheet" type="text/css" href="box_museum.css"> -->
		<link rel="stylesheet" type="text/css" href="box_museum_2.css">
		<title>explore</title>
	</head>
	<body>
		<?php
		include_once 'box_museum_functions.php';
		require_once 'box_connect.php';

		index_header();

		$conn = new mysqli($hn,$un,$pw,$db);
		$query = "SELECT creator_Lname, title, period_description, orig_catalog_number FROM object NATURAL JOIN creator NATURAL JOIN attribution NATURAL JOIN period NATURAL JOIN subject_matter NATURAL JOIN theme WHERE subj_matter_desc LIKE '%$heading%';";

		$result = $conn->query($query);
		if (!$result) die($conn->error);
		
		$rows = $result->num_rows;

		echo"<div class=\"right\">";
			echo"<div class=\"side-bar\">";
			echo"<h3 class=\"side_bar_h\">$heading</h4>";
				echo"<div class=\"bibliography\">";
				about_text('about.txt');
				echo"</div>";
			echo"</div>";
		echo"</div>";

		echo"<div class=\"left\">";
		echo"<div class=\"gallery_head\"><h3>EXPLORE THE COLLECTION</h3></div>";
			echo"<div class=\"user_gallery_display\">";
			for($i=0; $i<$rows; ++$i){
				$entry = $result->fetch_array(MYSQLI_NUM);
				$creator_last = $entry[0];
				$title = $entry[1];
				$period = $entry[2];
				$image_link_stub = "images/" . $entry[3] . ".jpg";
				$caption = $creator_last . ", " . $title . ", " . $period . ".";
				$search_text = urlencode($entry[1]);
				// echo "<a href = https://www.google.com/search?q=" . $search_text ." target=\"_blank\">$title</a><br />";
					explore_display($image_link_stub, $caption, $search_text);

			}
			echo"</div>";
		echo "</div>";
		echo "</div>";

		$result->close();
		$conn->close();

		page_footer();

		?>
	</body>


</html>