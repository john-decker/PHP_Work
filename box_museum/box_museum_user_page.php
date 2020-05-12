<?php
session_start();
?>

<!DOCTYPE html lang="en">
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./includes/box_museum_2.css">
		<title>box_museum_user_portal</title>
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
			user_header();

			echo"<div class=\"right\">";
			//query to create list of book entries for bibliography
			$conn_book = new mysqli($hn,$un,$pw,$db);
			$query_book = "SELECT author_Fname, author_Lname, book_title, YEAR(publication_date) FROM author NATURAL JOIN authorship NATURAL JOIN publication_book";

			//query to create list of article entries for bibliography
			$conn_article = new mysqli($hn,$un,$pw,$db);
			$query_article = "SELECT author_Fname, author_Lname, article_title, journal_title, YEAR(`date`), page_start, page_end FROM author NATURAL JOIN authorship NATURAL JOIN publication_article;";
			
				//fetch book list
				bibliography("Books",book_list($conn_book, $query_book), 5);
				//fetch article list
				bibliography("Articles",article_list($conn_article, $query_article), 5);
		
			echo"</div>";

			
			echo"<div class=\"left\">";
				// explore collection area
				collection_explore_options('devotion','images/pomander_simple_small.jpg', 'text/devotion_short.txt', 'social status','images/saddle_image.jpg', 'text/social status_short.txt', 'death', 'images/death.jpg', 'text/death_short.txt');
				
				// search collection area
				echo"<div class=\"gallery_head\"><h3>SEARCH THE COLLECTION</h3>";
					$conn = new mysqli($hn,$un,$pw,$db);
					$query = "SELECT creator_id, creator_Lname FROM creator";
					$query2 = "SELECT * FROM original_material";
						search_form($conn, $query, $query2);
				echo"</div>";

				echo"<div>";
					echo"<small>";
					echo"<ul class=\"tips\">Search Tips:";
						echo"<li>To see all the items in the collection enter nothing in the search fields, just press submit.</li>";
						echo"<li>If searching for Anonymsou or for Master of ... use the Artist Last Name field.</li>";
						echo"<li>(Note: there are more options available in some menus than currently represented in the collection in anticipation of future growth.)</li>";
					echo"</ul>";
					echo"</small>";
				echo"</div>";

				echo"<div class=\"user_gallery_display\">";
					if(isset($_POST['search_submit'])){
						// $input1 = $_POST['creator_first'];
						$input2 = $_POST['creator_id'];
						$input3 = $_POST['title'];
						$input4 = $_POST['date_ranges'];
						$input5 = $_POST['original_materials'];
						$test_query = "SELECT object_id, creator_Fname, creator_Lname, title, period_description, orig_mat_name, orig_catalog_number, orig_url FROM creator NATURAL JOIN attribution NATURAL JOIN object NATURAL JOIN period NATURAL JOIN orig_material_to_object NATURAL JOIN original_material WHERE(object_id ";

						if(isset($_POST['creator_id']) && $_POST['creator_id'] != "0"){
							$test_query = $test_query ."&& creator_Lname LIKE '%$input2%'";
					
						}

						if(isset($_POST['title']) && $_POST['title'] != ""){
							$test_query = $test_query ."&& title LIKE '%$input3%'";
						}

						if(isset($_POST['date_ranges']) && $_POST['date_ranges'] != 'date_prompt'){
							$test_query = $test_query ."&& period_description LIKE '%$input4%'";
						}

						if(isset($_POST['original_materials']) && $_POST['original_materials'] != 'material_prompt'){
							$test_query = $test_query ."&& orig_mat_name = '$input5'";
						}


						$test_query = $test_query .")";
					

						$output_array = array();
						$conn2 = new mysqli($hn,$un,$pw,$db);
						$result = $conn2->query($test_query);
						if(!$result) die ($conn->error);
						$rows = $result->num_rows;
						for($k=0; $k<$rows; ++$k){
							$entry = $result->fetch_array(MYSQLI_NUM);
							array_push($output_array, $entry);
						}

						$result->close();
						$conn2->close();

						$final_array = dedupe_db_output($output_array);
						
						
						for($i=0; $i<COUNT($final_array); ++$i){
							$object_id = $final_array[$i][0];
							$creator_first = $final_array[$i][1];
							$creator_last = $final_array[$i][2];
							$title = $final_array[$i][3];
							$period = $final_array[$i][4];
							$material = $final_array[$i][5];
							$image_link_stub = "images/" . $final_array[$i][6] . ".jpg";
							$caption = $object_id . ": " . $creator_first . " " . $creator_last . ", " . $title . ", " . $period . ", " . $material . ".";
							$search_text = urlencode($final_array[$i][3]);
							// echo "<a href = https://www.google.com/search?q=" . $search_text ." target=\"_blank\">$title</a><br />";
								explore_display($image_link_stub, $caption, $search_text);

						}

					}

				echo"</div>";

			echo"</div>";

			page_footer();

		}

		?>
	</body>

</html>

