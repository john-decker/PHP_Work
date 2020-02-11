<!DOCTYPE = html>
<html>
<!--php script for the Bottles of Beer song with variable starting number-->
	<head>
		<meta charset=UTF-8>
		<title>HW 1 Bottles of Beer Song</title>
		<style>
			body {
				background-color: #000000;

			}

			h2 {
				color: #85adad;
			}
			
			div.first_part {
				width: 570px;
				background-color: #85adad;
				padding: 10px;
			}
			div.second_part {
				width: 570px;
				background-color: #a3c2c2;
				padding: 10px;
				text-align: center;
			}

			strong {
				color: #1f2e2e;
			}
		</style>
	</head>
	<body>
		<?php 
		$number=99; #eventually make this a user input
		echo"<h2>$number Bottles of Beer, Lyrics</h2>";

		#loop through number until it reaches 0
		for($number; $number>=0; --$number){
			#test for 1 to change from plural to singular
			if($number==1){
			echo"<div class= 'first_part'><strong>$number</strong> bottle of beer on the wall, <strong>$number</strong> bottle of beer ...</div>";
			}
			else{
			echo"<div class= 'first_part'><strong>$number</strong> bottles of beer on the wall, <strong>$number</strong> bottles of beer ...</div>";
			}
			# check for zero for final verse of song
			if($number==0){
			echo"<div class= 'second_part'>you took 'em all down, you passed 'em around, no more bottles of beer on the wall ...</div>";
			}
			else{
			echo "<div class= 'second_part'>take one down, pass it around <strong>" . ($number-1) . "</strong> bottles of beer on the wall!</div>";
			}
		}
		?>
	</body>
</html>