<?php 

$current_date= date("l, M. j");


//header for main landing page
function index_header(){
	echo"<div class=\"col-container\">";
		echo"<div class=\"head\"><p class=\"time\">" .date("l, M. j") ."</p></div>";
		echo"<div class=\"head2\"><p class=\"banner\"><h3>About</h3></p><div class=\"overlay\"><div class=\"text\">";
			about_text('about.txt');
		echo"</div></div></div>";
		echo"<div class=\"headmain\"><h1 class=\"banner\">Box Museum</h2></div>";
		echo"<div class=\"head4\">";
			user_login_portal();
		echo"</div>";
	echo"</div>";
}

//header for user page, looks like landing page with greeting
function user_header(){
	echo"<div class=\"col-container\">";
		echo"<div class=\"head\"><p class=\"time\">" .date("l, M. j") ."</p></div>";
		echo"<div class=\"head2\"><p class=\"banner\"><h3>About</h3></p><div class=\"overlay\"><div class=\"text\">";
			about_text('about.txt');
		echo"</div></div></div>";
		echo"<div class=\"headmain\"><h1 class=\"banner\">Box Museum</h2></div>";
		echo"<div class=\"head4\">";
			user_greeting_portal();
		echo"</div>";
	echo"</div>";
}

function bibliography(){
	echo"<div class=\"bibliography\">";
	echo"<h4 class=\"side_bar_h\">Select Bibliography</h4>";
	echo"<ul>";
		echo"<li>BOOK TITLE 1</li>";
		echo"<li>BOOK TITLE 2</li>";
		echo"<li>BOOK TITLE 3</li>";
		echo"<li>BOOK TITLE 4</li>";
	echo"</ul>";
	echo"</div>";
}

function tech_specs(){
	echo"<div class=\"tech_specs\">";
		echo"<h4 class=\"side_bar_h\">Making a Boxed Museum</h4>";
			echo"<ul>";
			echo"<li>Wiring Diagram</li>";
			echo"<li>Hardware Spedifications</li>";
			echo"<li>Python Code</li>";
			echo"<li>Tips</li>";
	echo"</ul>";
	echo"</div>";
}

function incorrect_login_header(){
	echo"<div class=\"col-container\">";
		echo"<div class=\"head\"><p class=\"time\">" .date("l, M. j") ."</p></div>";
		echo"<div class=\"head2\"><p class=\"banner\"><h3>About</h3></p><div class=\"overlay\"><div class=\"text\">";
			about_text('about.txt');
		echo"</div></div></div>";
		echo"<div class=\"headmain\"><h1 class=\"banner\">Box Museum</h2></div>";
		echo"<div class=\"head4\">INCORRECT LOGIN</div>";
	echo"</div>";
}


function page_footer(){
		$contact_address = fopen("contact.txt", "r") or die("Unable to open file!");
		$random_list = explode(",", file_get_contents('random_links.txt'));
		$random_link = rand(0, count($random_list)-1);
		$lucky = $random_list[$random_link];
		echo "<div class=\"col-container\">";
			echo "<div class=\"foot3\"></div>";
			echo "<div class=\"foot1\"><a href=\"mailto:$contact_address\">contact</a></div>";
				fclose($contact_address);
			echo "<div class=\"foot2\">";
				hover_info('license info', 'license.txt');
			echo "</div>";
			echo "<div class=\"foot1\"><a href=\"$lucky\" target=\"blank\">Surprise Me!</a></div>";
			echo "<div class=\"foot3\"></div>";
		echo "</div>";
}

function hover_info($name, $textfile){
	$info_text = fopen("$textfile", "r") or die("Unable to open file!");
	echo"<span>$name</span>";
	echo"<div class=\"foot_info\"><p class=\"info\">";
		echo fread($info_text,filesize("$textfile"));
	echo"<p></div>";
	fclose($info_text);
}

function about_text($filename){
	$about_text = fopen("$filename", "r") or die("Unable to open file!");
	echo "<p class=\"info\">";
		echo fread($about_text,filesize("$filename"));
	echo "</p>";
	fclose($about_text);
}

//outputs images with text as clickable links
function display_item($category, $filename, $textfilename){
	$image_text = fopen("$textfilename", "r") or die("Unable to open file!");
	echo"<div class=\"category_gallery\"><a href=\"explore_category.php?category_id=$category\"><img class=\"catgory_image\" src=\"$filename\" ></a><p class =\"gallery_text\">";
		echo fread($image_text,filesize("$textfilename"));
	echo"</p></div>";
	fclose($image_text);

}

function large_display($filename, $textfilename){
	$image_text = fopen("$textfilename", "r") or die("Unable to open file!");
	echo"<div class=\"cat_gallery_large\"><img class=\"catgory_image\" src=\"$filename\" ><p class =\"gallery_text\">";
		echo fread($image_text,filesize("$textfilename"));
	echo"</p></div>";
	fclose($image_text);
}

function explore_display($filename, $caption, $linktext){
	echo"<div class=\"cat_gallery_large\"><img class=\"catgory_image\" src=\"$filename\" ><p class =\"gallery_text\">$caption<br /><br /><button class=\"info\"><a class=\"info\" href = https://www.google.com/search?q=" . $linktext ." target=\"_blank\">More Information</a></button></p></div>";	

}

function gallery_long_text($filename){
	$gallery_text = fopen("$filename", "r") or die("Unable to open file!");
	echo "<p>";
		echo fread($gallery_text,filesize("$filename"));
	echo "</p>";
	fclose($gallery_text);
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

		<small>Not yet a member? Create a new account: <a href='create_new_user.php'><button>New Account</button></a></small>
	_END;
}

//greets user by first name and user handle, provides place to log out
function user_greeting_portal(){
		$user_name = ucfirst($_SESSION['fname']);
		$user_handle = $_SESSION['username'];
		//$admin_user = $_SESSION['admin'];
		//use if/then logic to accommodate admin users by stating they are admin and providing admin link button
		echo "<br />Hello $user_name.<br />You are logged in as $user_handle.<br /><br />";
		echo "<a href='log_out.php'><button>Log Out</button></a>";
}


function sanitize_string($string){
	if(get_magic_quotes_gpc())
		$string = stripslashes($string);
		$string = strip_tags($string);
		$string = htmlentities($string);
	return $string;
}

function sanitize_SQL($connection, $user_input){
	$user_input = $connection->real_escape_string($user_input);
	$user_input = sanitize_string($user_input);
	return $user_input;
}

function add_guest_user($connection, $userid, $userfname, $userlname, $userhandle, $userhash, $isadmin){
	$stmt = $connection->prepare('INSERT INTO guest_user VALUES(?,?,?,?,?,?)');
	$stmt->bind_param('issssi', $userid, $userfname, $userlname, $userhandle, $userhash, $isadmin);
	$stmt->execute();
	$stmt->close();
}

?>

