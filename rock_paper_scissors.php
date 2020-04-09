<!DOCTYPE html lang="en">
<html>
	<head>
		<meta charset="UTF-8">
		<title>Rock, Paper, Scissors</title>
		<style>
			div.radio_form{
				padding: 20px;
				border-style: groove;
				background-color: #c5d5c5;
				max-width: 300px;
			}
			div.user_choice{
				padding: 20px;
				border-style: groove;
				background-color: #e3e0cc;
				max-width: 300px;
			}
			div.computer_choice{
				padding: 20px;
				border-style: groove;
				background-color: #f0f0f0;
				max-width: 300px;
			}
			div.outcome{
				padding: 20px;
				border-style: groove;
				background-color: #9fa9a3;
				max-width: 300px;
			}
		</style>
	</head>
	<body>
	<?php
	//name is set to choice for all to ensure only one button can be selected at a time
	echo<<<_END
		<div class="radio_form">
		<form method="POST" action="rock_paper_scissors.php">
			<h3>Rock, Paper, Scissors</h3>
			<p>Click a button and press "submit" to make your choice</p>

			<input type="radio" name="choice" value="rock">
			<label for="rock">rock</label><br />

			<input type="radio" name="choice" value="paper">
			<label for="paper">paper</label><br />

			<input type="radio" name="choice" value="scissors">
			<label for="scissors">scissors</label><br /><br />

			<input type="submit" name="try" value="submit">

		</form>
		</div>
	_END;
	if(isset($_POST['choice'])){
		$user_choice=$_POST['choice'];
		echo "<div class=\"user_choice\">";
		echo "You chose <strong>$user_choice</strong> ...";
		echo "</div>";

		$computer_choice = rochambeaux();
		echo "<div class=\"computer_choice\">";
		echo "The computer chose ";
		sleep(1); 
		echo "... <strong>" . $computer_choice . "</strong>";
		echo "</div>";

		echo "<div class=\"outcome\">";
		echo who_wins($user_choice, $computer_choice);
		echo "</div>";

		unset($computer_choice);
		unset($user_choice);
		unset($_POST['choice']);
	}

	else{
		$user_choice="Please make a choice.";
		echo "<div class=\"user_choice\">";
		echo $user_choice;
		echo "</div>";
	}

	// unset($computer_choice);
	// unset($user_choice);


	//function section
	function rochambeaux(){
		$result = "";
		$throw = mt_rand(0,2);
		if($throw == 0){
			$result = "rock";
		}

		else if($throw == 1){
			$result = "paper";
		}

		else{
			$result="scissors";
		}

		return $result;
	}


	function who_wins($user_choice, $computer_choice){
		$outcome = "";

		if($user_choice == $computer_choice){
			$outcome = "It's a tie!";
		}

		else if ($user_choice == "rock" && $computer_choice == "scissors"){
			$outcome = "You win!";
		}

		else if ($user_choice == "paper" && $computer_choice == "rock"){
			$outcome = "You win!";
		}

		else if ($user_choice == "scissors" && $computer_choice == "paper"){
			$outcome = "You win!";
		}

		else{
			$outcome = "Computer Wins!";
		}

		return $outcome;
	}
	
	?>
	</body>
</html>