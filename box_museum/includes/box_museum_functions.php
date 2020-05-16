<?php 
require_once 'includes/box_connect.php';

//set date to Eastern
date_default_timezone_set("America/New_York");	
$current_date= date("l, M. j");

//header for main landing page
function index_header(){
	echo"<div class=\"col-container\">";
		echo"<div class=\"head\"><p class=\"time\">" .date("l, M. j") ."</p></div>";
		echo"<div class=\"head2\"><p class=\"banner\"><h3>About</h3></p><div class=\"overlay\"><div class=\"text\">";
			about_text('text/about.txt');
		echo"</div></div></div>";
		echo"<div class=\"headmain\"><h1 class=\"banner\">Box Museum</h2></div>";
		echo"<div class=\"head4\">";
			user_login_portal();
		echo"</div>";
	echo"</div>";
}

//takes in text file, reads it, and ouputs it into the About box in the index header
function about_text($filename){
	$about_text = fopen("$filename", "r") or die("Unable to open file!");
	echo "<p class=\"info\">";
		echo fread($about_text,filesize("$filename"));
	echo "</p>";
	fclose($about_text);
}

//header for user page, looks like landing page with greeting
function user_header(){
	echo"<div class=\"col-container\">";
		echo"<div class=\"head\"><p class=\"time\">" .date("l, M. j") ."</p></div>";
		echo"<div class=\"head2\"><p class=\"banner\"><a href=\"specifications.php\">Tech Specs</a></div>";
		echo"<div class=\"headmain\"><h1 class=\"banner\">Box Museum</h2></div>";
		echo"<div class=\"head4\">";
			user_greeting_portal();
		echo"</div>";
	echo"</div>";
}

function admin_header(){
	echo"<div class=\"col-container\">";
		echo"<div class=\"head\"><p class=\"time\">" .date("l, M. j") ."</p></div>";
		echo"<div class=\"head2\"><p class=\"banner\">Administration Page</div>";
		echo"<div class=\"headmain\"><h1 class=\"banner\">Box Museum</h2></div>";
		echo"<div class=\"head4\">";
			admin_user_portal();
		echo"</div>";
	echo"</div>";
}

//header for incrrect login page
function incorrect_login_header(){
	echo"<div class=\"col-container\">";
		echo"<div class=\"head\"><p class=\"time\">" .date("l, M. j") ."</p></div>";
		echo"<div class=\"head2\"><p class=\"banner\"><h3>About</h3></p><div class=\"overlay\"><div class=\"text\">";
			about_text('text/about.txt');
		echo"</div></div></div>";
		echo"<div class=\"headmain\"><h1 class=\"banner\">Box Museum</h2></div>";
		echo"<div class=\"head4\">INCORRECT LOGIN</div>";
	echo"</div>";
}


//foot information for all pages
function page_footer(){
		$contact_address = fopen("text/contact.txt", "r") or die("Unable to open file!");
		$random_list = explode(",", file_get_contents('text/random_links.txt'));
		$random_link = rand(0, count($random_list)-1);
		$lucky = $random_list[$random_link];
		echo "<div class=\"col-container\">";
			echo "<div class=\"foot3\"></div>";
			echo "<div class=\"foot1\"><a href=\"mailto:'$contact_address'\">contact</a></div>";
				fclose($contact_address);
			echo "<div class=\"foot2\">";
				hover_info('license info', 'text/license.txt');
			echo "</div>";
			echo "<div class=\"foot1\"><a href=\"$lucky\" target=\"blank\">Surprise Me!</a></div>";
			echo "<div class=\"foot3\"></div>";
		echo "</div>";
}

//creates hover box for footer, takes in text file to display
function hover_info($name, $textfile){
	$info_text = fopen("$textfile", "r") or die("Unable to open file!");
	echo"<span>$name</span>";
	echo"<div class=\"foot_info\"><p class=\"info\">";
		echo fread($info_text,filesize("$textfile"));
	echo"<p></div>";
	fclose($info_text);
}


//provides login portal for users validation is done in guest_login_2.php
function user_login_portal(){
	echo <<<_END
		<form method="POST" action="guest_login_2.php">
			user name
			<input type="text" name="username" min-width="10"><br />
			password
			<input type="password" name="userpassword" min-width="10"><br />
			<input type="submit" name="submit">
		</form>

		<small>Not yet a member? Create a new account: <a href='add_user.php'><button>New Account</button></a></small>
	_END;
}

//greets user by first name and user handle, provides place to log out
function user_greeting_portal(){
		$user_name = ucfirst($_SESSION['fname']);
		$user_handle = $_SESSION['username'];
		$admin_user = $_SESSION['admin'];
		//provides special admin login button for admin users
		if($admin_user==1){
			echo "Hello $user_name.<br />You are logged in as $user_handle<br /><br />";
			echo "<small>You have administrative privileges:</small>";
			echo "<a href='admin.php'><button>Admin Access</button></a><br /><br />";
			echo "<small>To end your session, press the 'Log Out' button</small>";
			echo "<a href='log_out.php'><button>Log Out</button></a>";
		}

		else{
			echo "<br />Hello $user_name.<br />You are logged in as $user_handle.<br /><br />";
			echo "<a href='log_out.php'><button>Log Out</button></a>";
		}
}

//greets user by first name and user handle, provides place to log out
function admin_user_portal(){
		$user_name = ucfirst($_SESSION['fname']);
		$user_handle = $_SESSION['username'];
		$admin_user = $_SESSION['admin'];
		//provides special admin login button for admin users
		if($admin_user==1){
			echo "Hello $user_name.<br />You are logged in as $user_handle<br /><br />";
			echo "<small>To end your session, press the 'Log Out' button</small>";
			echo "<a href='log_out.php'><button>Log Out</button></a>";
		}

		else{
			echo "<br />Hello $user_name.<br />You are logged in as $user_handle.<br /><br />";
			echo "<a href='log_out.php'><button>Log Out</button></a>";
		}
}

//outputs images with text as clickable links
function display_item($category, $filename, $textfilename){
	$image_text = fopen("$textfilename", "r") or die("Unable to open file!");
	echo"<div class=\"category_gallery\"><a href=\"explore_category.php?category_id=$category\"><img class=\"catgory_image\" src=\"$filename\" ></a><p class =\"gallery_text\">";
		echo fread($image_text,filesize("$textfilename"));
	echo"</p></div>";
	fclose($image_text);

}


//outputs image, caption, and link for db output on explore_category page
function explore_display($filename, $caption, $linktext){
	echo"<div class=\"cat_gallery_large\"><img class=\"catgory_image\" src=\"$filename\" ><p class =\"gallery_text\">$caption<br /><br /><button class=\"info\"><a class=\"info\" href = https://www.google.com/search?q=" . $linktext ." target=\"_blank\">More Information</a></button></p></div>";	

}

//outputs longer text below gallery section of page
function gallery_long_text($filename){
	$gallery_text = fopen("$filename", "r") or die("Unable to open file!");
	echo "<p>";
		echo fread($gallery_text,filesize("$filename"));
	echo "</p>";
	fclose($gallery_text);
}

//sets category, image, and text options for exploration links
function collection_explore_options($cat1, $image1, $text1, $cat2, $image2, $text2, $cat3, $image3, $text3){		
		echo"<div class=\"gallery_head\"><h3>EXPLORE THE COLLECTION</h3></div>";
		echo"<div class=\"gallery_display\">";
			display_item($cat1, $image1, $text1);
			display_item($cat2, $image2, $text2);
			display_item($cat3, $image3, $text3);
		echo"</div>";
}

//creates book biblio list
function book_list($connection, $query){
	$books = array();
	$result = $connection->query($query);
	if (!$result) die($connection->error);
		$rows = $result->num_rows;
		for($i=0; $i<$rows; ++$i){
			$entry = $result->fetch_array(MYSQLI_NUM);
			$authorfirst = $entry[0];
			$authorlast = $entry[1];
			$booktitle = $entry[2];
			$pub_year = $entry[3];
			$bib_ref = $authorfirst . " " . $authorlast . ", <em>" . $booktitle . "</em>, " . $pub_year . ".";
			array_push($books, $bib_ref);
		}
		$result->close();
		$connection->close();
	return $books;
}

//creates article biblio list
function article_list($connection, $query){
	$articles = array();
	$result = $connection->query($query);
	if (!$result) die($connection->error);
		$rows = $result->num_rows;
		for($i=0; $i<$rows; ++$i){
			$entry = $result->fetch_array(MYSQLI_NUM);
			$authorfirst = $entry[0];
			$authorlast = $entry[1];
			$articletitle = $entry[2];
			$journal = $entry[3];
			$pub_year = $entry[4];
			$page_start = $entry[5];
			$page_end = $entry[6];
			$bib_ref = $authorfirst . " " . $authorlast . ", \"". $articletitle . "\", " . "in <em>" . $journal . "</em>, " . $pub_year . ": " . $page_start . "-" . $page_end . ".";
			array_push($articles, $bib_ref);
		}
		$result->close();
		$connection->close();
	return $articles;
}

//outputs bibliographic information from db
function bibliography($title, $array, $iterations){
	echo"<h4 class=\"side_bar_h\">Select Bibliography: $title</h4>";
	echo"<ul>";
		for($l=0; $l<$iterations; ++$l){
			shuffle($array);
			$biblio_entry = array_pop($array);
			echo "<li>$biblio_entry</li>";
		}
	echo"</ul>";
}

//creates search form for user page
function search_form($connection, $query, $query2){
	$result = $connection->query($query);
	if (!$result) die($connection->error);
	$rows = $result->num_rows;

	echo"<form method=\"POST\" action= \"box_museum_user_page.php\">";
	// echo"<form method=\"POST\" action= \"user_page_backup.php\">";
		// echo"<input type=\"text\" name=\"creator_first\" placeholder=\"artist first name\">";
		// echo"<input type=\"text\" name=\"creator_last\" placeholder=\"artist last name\">";
		echo"<select id=\"creator_id\" name=\"creator_id\">";
			echo "<option value=\"0\" selected>artist name</option>";
				for($i=0; $i<$rows; ++$i){
					$entry = $result->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry[1] . "\">" . $entry[1] . "</option>";
				}
			$result->close();
		echo"</select>";
		echo"<input type=\"text\" name=\"title\" placeholder=\"title\">";
		echo"<select id=\"text\" name=\"date_ranges\">";
			echo"<option value=\"date_prompt\">Select Period</option>";
			echo"<option value=\"Late Middle Ages\">Late Middle Ages: 1306-150</option>";
			echo"<option value=\"Renaissance\">Renaissance: 1500-1650</option>";
		echo"</select>";
		echo"<select id=\"material\" name=\"original_materials\">";
			echo"<option value=\"material_prompt\">Select Material</option>";
			$result2 = $connection->query($query2);
			if (!$result2) die($connection->error);
			$rows2 = $result2->num_rows;
			for($i=0; $i<$rows2; ++$i){
				$entry2 = $result2->fetch_array(MYSQLI_NUM);
				echo "<option value=\"". $entry2[1] . "\">" . $entry2[1] . "</option>";
			}
		echo"</select>";
		$result2->close();
		$connection->close();
		echo"<input type=\"submit\" name=\"search_submit\">";
	echo"</form>";
}

//used to deduplicate the results of the search bar
function dedupe_db_output($output_array){
	$output_array2 = array();
	if(COUNT($output_array)==0){
		echo"<p class=\"gallery_text\">Sorry, no results ...</p>";
		$output_array2 = array();
	}
	elseif(COUNT($output_array)==1){
		array_push($output_array2, $output_array[0]);

	}
	//catches array of size 2
	elseif(COUNT($output_array)==2){
		if($output_array[1][0]==$output_array[0][0]){
			$output_array[0][5] = $output_array[0][5] . ", " . $output_array[1][5];
			array_push($output_array2, $output_array[0]);
		}
		else{
			array_push($output_array2, $output_array[0]);
			array_push($output_array2, $output_array[1]);
		}
	}

	else{
		$i = 1;
		while($i<COUNT($output_array)){
			//tries to catch duplicates while preserving material info
			if($output_array[$i][0]==$output_array[$i-1][0]){
				$output_array[$i][5] = $output_array[$i][5] . ", " . $output_array[$i-1][5];
				
			}

			else{
				array_push($output_array2, $output_array[$i-1]);
			}					
			$i++;
		}
		//prevents last item in array from dropping off if duplicate
		array_push($output_array2, $output_array[$i-1]);
		
	}

	return $output_array2;
}

//creates admin form to add creator information
function admin_creator_form(){
	echo"<form method=\"POST\" action= \"admin.php\" id=\"creator\">";
		echo"<small>Creator Information</small><br />";
		echo"<input type=\"text\" name=\"creator_ulan\" placeholder=\"ULAN\" maxlength=\"14\"><br />";
		echo"<input type=\"text\" name=\"creator_lname\" placeholder=\"creator last name\">";
		echo"<input type=\"text\" name=\"creator_fname\" placeholder=\"creator first name\">";
		echo"<input type=\"text\" name=\"creator_dob\" placeholder=\"creator date of birth\">";
		echo"<input type=\"text\" name=\"creator_dod\" placeholder=\"creator date of death\"><br />";
		echo"<input type=\"submit\" name=\"creator_submit\"><br />";
	echo"</form>";
}

//creates admin form to add object information
function admin_object_form($connection, $query, $query2){
	echo"<form method=\"POST\" action= \"admin.php\" id=\"object\">";
		echo"<small>Object Information</small><br />";
		echo"<input type=\"text\" name=\"title\" placeholder=\"title\" style=\"\width: 50%\"><br />";
		echo"<input type=\"text\" name=\"date_start\" placeholder=\"date range start\" maxlength=\"6\">";
		echo"<input type=\"text\" name=\"date_end\" placeholder=\"date range end\" maxlength=\"6\"><br />";
		echo"<input type=\"text\" name=\"height\" placeholder=\"height cm\">";
		echo"<input type=\"text\" name=\"width_cm\" placeholder=\"width cm\">";
		echo"<input type=\"text\" name=\"depth_cm\" placeholder=\"depth cm\"><br />";

		echo"<select id=\"date\" name=\"date_ranges\">";
		echo"<option value=\"date_prompt\">Select Period</option>";
			echo"<option value=\"1\">early middle ages: 700-1000</option>";
  			echo"<option value=\"2\">middle ages: 1001-1305</option>";
  			echo"<option value=\"3\">late middle ages: 1306-1500</option>";
 			echo"<option value=\"4\">renaissance: 1501-1700</option>";
		echo"</select>";

		echo"<select id=\"region\" name=\"geo_region\">";
			echo"<option value=\"region_prompt\">Select Region</option>";
			$result = $connection->query($query);
			if (!$result) die($connection->error);
			$rows = $result->num_rows;
				for($k=0; $k<$rows; ++$k){
					$entry = $result->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry[0] . "\">" . $entry[1] . "</option>";
				}
			$result->close();
		echo"</select>";
		
		echo"<select id=\"original_repo\" name=\"original_repo\">";
			echo"<option value=\"repo_prompt\">Select Repository</option>";
			$result2 = $connection->query($query2);
			if (!$result2) die($connection->error);
			$rows2 = $result2->num_rows;
				for($l=0; $l<$rows2; ++$l){
					$entry2 = $result2->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry2[0] . "\">" . $entry2[1] . "</option>";
				}
			$result2->close();
			$connection->close();
		echo"</select><br />";

		echo"<input type=\"text\" name=\"orig_cat\" placeholder=\"original cat num\">";
		echo"<input type=\"text\" name=\"url\" placeholder=\"original url\" style=\"\width: 50%\"><br />";
		echo"<input type=\"submit\" name=\"object_submit\"><br />";
	echo"</form>";
}

//creates admin form to add theme information
function admin_theme_form($connection, $query, $query2){
	$result = $connection->query($query);
	if (!$result) die($connection->error);
	$rows = $result->num_rows;
	echo"<form method=\"POST\" action= \"admin.php\" id=\"theme\">";
		echo"<small>Subject Information</small><br />";
		echo"<select id=\"material\" name=\"subj_matter[]\" multiple>";
			echo "<option value=\"0\" selected>select material</option>";
				for($i=0; $i<$rows; ++$i){
					$entry = $result->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry[0] . "\">" . $entry[1] . "</option>";
				}
			$result->close();
				
		echo"</select>";

		echo"<select id=\"object_id\" name=\"object_id\">";
			echo "<option value=\"0\" selected>select object</option>";
			$result2 = $connection->query($query2);
			if (!$result2) die($connection->error);
			$rows2 = $result2->num_rows;
				for($j=0; $j<$rows2; ++$j){
					$entry2 = $result2->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry2[0] . "\">" . $entry2[1] . "</option>";
				}
			$result2->close();
			$connection->close();
		echo"</select><br />";		
	echo"<input type=\"submit\" name=\"theme_submit\">";
	echo"</form>";
}

//creates admin form to add material information		
function admin_material_form($connection, $query, $query2){
	$result = $connection->query($query);
	if (!$result) die($connection->error);
	$rows = $result->num_rows;
	echo"<form method=\"POST\" action= \"admin.php\" id=\"material\">";
		echo"<small>Material Information</small><br />";
		echo"<select id=\"subject\" name=\"orig_material[]\" multiple=\"multiple\">";
			echo "<option value=\"0\" selected>select subject</option>";
			if (!$result) die($connection->error);
			$rows = $result->num_rows;
				for($j=0; $j<$rows; ++$j){
					$entry = $result->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry[0] . "\">" . $entry[1] . "</option>";
				}
			$result->close();
				
		echo"</select>";

		echo"<select id=\"object_id\" name=\"object_id\">";
			echo "<option value=\"0\" selected>select object</option>";
			$result2 = $connection->query($query2);
			if (!$result2) die($connection->error);
			$rows2 = $result2->num_rows;
				for($j=0; $j<$rows2; ++$j){
					$entry2 = $result2->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry2[0] . "\">" . $entry2[1] . "</option>";
				}
			$result2->close();
			$connection->close();
		echo"</select><br />";		
	echo"<input type=\"submit\" name=\"material_submit\">";
	echo"</form>";
}

//creates admin form to add attribution information
function admin_attib_form($connection, $query, $query2){
	$result = $connection->query($query);
	if (!$result) die($connection->error);
	$rows = $result->num_rows;
	echo"<form method=\"POST\" action= \"admin.php\" id=\"attibution\">";
		echo"<small>Attribution Information</small><br />";
		echo"<select id=\"creator_id\" name=\"creator_id\">";
			echo "<option value=\"0\" selected>select creator</option>";
				for($i=0; $i<$rows; ++$i){
					$entry = $result->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry[0] . "\">" . $entry[1] . "</option>";
				}
			$result->close();
		echo"</select>";
		
		echo"<select id=\"object_id\" name=\"object_id\">";
			echo "<option value=\"0\" selected>select object</option>";
			$result2 = $connection->query($query2);
			if (!$result2) die($connection->error);
			$rows2 = $result2->num_rows;
				for($j=0; $j<$rows2; ++$j){
					$entry2 = $result2->fetch_array(MYSQLI_NUM);
					echo "<option value=\"". $entry2[0] . "\">" . $entry2[1] . "</option>";
				}
			$result2->close();
			$connection->close();
		echo"</select><br />";		
	echo"<input type=\"submit\" name=\"attrib_submit\">";
	echo"</form>";
}

//takes insert queries from admin portal and submits them to the db
function insert_from_admin($connection, $query){
	$result = $connection->query($query);
	if(!$result) die($connection->error);
	$id_num = mysqli_insert_id($connection); 
		echo"Insert Successful for query: " . $query . "<br />";
		echo"Auto Increment ID: " . $id_num . "<br />";
	return $id_num;
	$connection->close();
}


//sanitize any user input
function sanitize_string($string){
	if(get_magic_quotes_gpc())
		$string = stripslashes($string);
		$string = strip_tags($string);
		$string = htmlentities($string);
	return $string;
}

//sanitize connection linked to non-admin user input
function sanitize_SQL($connection, $user_input){
	$user_input = $connection->real_escape_string($user_input);
	$user_input = sanitize_string($user_input);
	return $user_input;
}

//for adding guest accounts 
function add_guest_user($connection, $userid, $userfname, $userlname, $userhandle, $userhash, $isadmin){
	$stmt = $connection->prepare('INSERT INTO guest_user VALUES(?,?,?,?,?,?)');
	$stmt->bind_param('issssi', $userid, $userfname, $userlname, $userhandle, $userhash, $isadmin);
	$stmt->execute();
	$stmt->close();
}

?>

