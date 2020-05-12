<?php
session_start();

?>
<!DOCTYPE html lang='en'>
<html>
	<head>
		<meta charset="UTF-8" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="./includes/box_museum_2.css">
		<title>box_museum_administration</title>

	</head>

	<body>
		<?php
		include_once './includes/box_museum_functions.php';
		require_once './includes/box_connect.php';

		if(!isset($_SESSION['fname'])){
			echo"<div class=\"wrong_id1\">";
				echo"<p class=\"wrong_id\"><h3>You are not currently logged in.<br />Please return to the homepage and try again.<br /><br /><a href='box_museum.php'><button>Try Again</button></a></h></p>";
			echo"</div>";
		}
		
		else{
			admin_header();
			echo"<div class=\"gallery_head\"><h3>Administrative Access: " . ucfirst($_SESSION['fname']) . " " . ucfirst($_SESSION['lname']) . "</h3><a href=\"box_museum_user_page.php\"><button>Leave Admin Page</button></a></div>";

			echo"<div class=\"admin_left\">";
				echo"<h3>Administrative Forms</h3>";
				$conn = new mysqli($hn,$un,$pw,$db);
				$conn2 = new mysqli($hn,$un,$pw,$db);
				$conn3 = new mysqli($hn,$un,$pw,$db);
				$conn4 = new mysqli($hn,$un,$pw,$db);

				$query = "SELECT * FROM original_material";
				$query2 = "SELECT subj_matter_id, subj_matter_desc FROM subject_matter";
				$query3 = "SELECT geog_reg_id, geog_reg_name FROM geographical_region";
				$query4 = "SELECT orig_repos_id, orig_repos_name FROM original_repository";
				$query5 = "SELECT creator_id, creator_Lname FROM creator ORDER BY creator_id DESC";
				$query6 = "SELECT object_id, title FROM object ORDER BY object_id DESC LIMIT 200 ROWS EXAMINED 1000";
					admin_creator_form();
					admin_object_form($conn, $query3, $query4);
					admin_theme_form($conn2, $query2, $query6);
					// admin_material_form($conn3, $query, $query6);
					// admin_attib_form($conn4, $query5, $query6);
			echo"</div>";

			echo"<div class=\"admin_right\">";
			echo"<div class=\"pseudo_terminal\">";
				//creator information
				if(isset($_POST['creator_submit'])){
					$creator_1 = $_POST['creator_ulan'];
					$creator_2 = sanitize_string(strtolower($_POST['creator_lname']));
					$creator_2 = ucwords($creator_2);
					$creator_3 = sanitize_string(strtolower($_POST['creator_fname']));
					$creator_3 = ucwords($creator_3);
					$creator_4 = $_POST['creator_dob'];
					$creator_5 = $_POST['creator_dod'];
					
					$creator_query = "INSERT INTO creator VALUES(NULL, '$creator_1', '$creator_2', '$creator_3', '$creator_4', '$creator_5')";
					// insert_from_admin($conn_obj_ins, $creator_query);
					echo$creator_query;
				}

				//object information
				if(isset($_POST['object_submit'])){
					$object_1 = sanitize_string(strtolower($_POST['title']));
					$object_1 = ucwords($object_1);
					$object_2 = $_POST['date_start'];
					$object_3 = $_POST['date_end'];
					$object_4 = $_POST['height'];
					$object_5 = $_POST['width_cm'];
					$object_6 = $_POST['depth_cm'];
					$object_7 = $_POST['date_ranges'];
					$object_8 = $_POST['geo_region'];
					$object_9 = $_POST['original_repo'];
					$object_10 = sanitize_string($_POST['orig_cat']);
					$object_11 = $_POST['url'];

					$object_query = "INSERT INTO object VALUES(NULL, '$object_1', '$object_2', '$object_3', '$object_4', '$object_5', '$object_6', '$object_7', '$object_8', '$object_9', '$object_10', '$object_11')";
					$conn_obj_ins = new mysqli($hn, $un, $pw, $db);
					// insert_from_admin($conn_obj_ins, $object_query);
					echo$object_query;
				}

				//materials variables
				if(isset($_POST['material_submit'])){
					if(isset($_POST['orig_material']) && $_POST['object_id'] != 0){
						//seems to handle the default seting, apply it across the board
						if($_POST['orig_material'][0] != 0){
							$material = $_POST['orig_material'];
							$object_id = $_POST['object_id'];
						}
						else{
							unset($_POST['orig_material']);
							unset($_POST['object_id']);
						}
					}
				}

				//theme variables
				if(isset($_POST['theme_submit'])){
					if(isset($_POST['subj_matter'])){
						if($_POST['subj_matter'][0] != 0 && $_POST['object_id'] != 0){
							$subject_matter = $_POST['subj_matter'];
							$object_id = $_POST['object_id'];
						}
						else{
							unset($_POST['subj_matter']);
							unset($_POST['object_id']);
						}
					}
				}

				//materials queries
				if(isset($_POST['material_submit'])){ 
					if(isset($_POST['orig_material']) && $_POST['orig_material'][0] !='0'){
						$materials_info = array();
						foreach($material as $item){
							$material_query ="INSERT INTO orig_material_to_object VALUES(NULL, '$object_id', '$item')";
							array_push($materials_info, $material_query);
							$conn_mat_ins = new mysqli($hn, $un, $pw, $db);
							insert_from_admin($conn_mat_ins, $material_query);

						}
					}

					else{
						$materials_info = array();
					}
				}


				//theme queries
				if(isset($_POST['theme_submit'])){
					if(isset($_POST['subj_matter']) && $_POST['subj_matter'][0]!='0'){
						$subj_info = array();
						foreach($subject_matter as $item){
							$subj_query ="INSERT INTO theme VALUES('$object_id', '$item')";
							array_push($subj_info, $subj_query);
							$conn_subj_ins = new mysqli($hn, $un, $pw, $db);
							insert_from_admin($conn_subj_ins, $subj_query);
						}
					}
					else{
						$subj_info = array();
					}


				}

				//attribution
				if(isset($_POST['attrib_submit'])){
					$attrib_1 = $_POST['creator_id'];
					$attrib_2 = $_POST['object_id'];
					
					$attribution_query="INSERT INTO attribution VALUES('$attrib_1', '$attrib_2')";
					$conn_attrib_ins = new mysqli($hn, $un, $pw, $db);
					
				}

					echo"</div>";
						admin_material_form($conn3, $query, $query6);
						admin_attib_form($conn4, $query5, $query6);
					echo"</div>";
				
			echo"</div>";
			}

		page_footer();
		?>
	
	</body>
</html>

