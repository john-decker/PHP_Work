<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset="UTF-8">
		<title>Book List</title>
		<style>
			body{
				background-color: #221a11;
			}

			td{
				outline-style: solid;
				padding: 10px;
			}
			td.head{
				background-color: #b9936c;
				color: #221a11;
				outline-style: none;
				border-style: outset;
				border-color: #453321;
			}
			td.even{
				background-color: #c4b7a6;
				color: #2e271f;
			}
			td.odd{
				background-color: #e6e2d3;
				color: #2e271f;
			}
			td.cost {
				background-color: #dac292;
				color: #261e0d;
				outline-style: none;
				border-style: outset;
				border-color: #be9441;
				border-radius: 25px;
			}
			td.subtle {
				outline-style: none;
			}
			
		</style>
	</head>

	<body>
		
		<?php 

		$list_of_books2 = array(
			array(
				"HP and MySQL Web Development",
				"Luke Welling",
				144,
				"paperback",
				31.63
				),
			array(
				"Web Design with HTML, CSS, JavaScript and jQuery",
				"John Duckett",
				135,
				"paperback",
				41.23
				),
			array(
				"PHP Cookbook: Solutions & Examples for PHP Programmers",
				"David Sklar",
				14,
				"paperback",
				40.88
				),
			array(
				"JavaScript and JQuery: Interactive Front-End Web Development",
				"John Duckett",
				251,
				"paperback",
				22.09
				),
			array(
				"Modern PHP: New Features and Good Practices",
				"Josh Lockhart",
				7,
				"paperback",
				28.49
				),
			array(
				"Programming PHP",
				"Kevin Tatroe",
				26,
				"paperback",
				28.96
				),
		);

		# check to ensure that book array can be altered and still output correctly
		# array_push($list_of_books2, array("Persepolis Rising", "James S.A. Corey", 512, "paperback", 18.95));
		
		$column_heads = array("Title", "Author", "Number Pages", "Type", "Price");
			# write out headers for table
			echo"<table>";
				echo"<tr>";
					foreach($column_heads as $head){
						echo write_td($head, "head");
				}
				echo"</tr>";


				# traverse book array and output results
				# eventually make this user-input to output a subset of books
				$total = 0;
				$row_increment = 0;
				$odd_even = "";
				for($i=0; $i<count($list_of_books2); $i++){
					if($row_increment%2==0){
						$odd_even = 'even';
					}
					else{
						$odd_even = 'odd';
					}
					echo"<tr>";
					for($j=0; $j<count(($list_of_books2[$i])); $j++){
						if($j == 0){
							echo write_td_linked(($list_of_books2[$i][$j]), $odd_even);
						}
						else{
							echo write_td(($list_of_books2[$i][$j]), $odd_even);
						}
					}

					# use end of array function to capture price for total
					$total += end($list_of_books2[$i]);
					$row_increment ++;
					echo "<tr>";
				}

				# wrtie out total
				# eventually make cost a link to a check-out function for shopping cart
				echo"<tr>";
				echo write_td("", 'subtle');
				echo write_td("", 'subtle');
				echo write_td("", 'subtle');
				echo write_td("", 'subtle');
				echo write_td(("Total Price: $" . $total), 'cost');
				echo"</tr>";

		echo"</table>";


		# function to write td with href link
		function write_td_linked($data, $class){
			$ready_data = urlencode($data);
			$link_formatted = "<td class=". $class . "><a href = https://www.google.com/search?q=" . $ready_data ." target=\"_blank\">$data</a></td>";
			return $link_formatted;
		}

		# function to write table data html
		function write_td($data, $class){
			$formatted = "<td class=" . $class . ">" . $data ."</td>";
			return $formatted;
		}

		?>
	</body>


</html>