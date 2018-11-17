<?php
	// start session
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS425 Quiz Game</title>
    <meta name="keywords" content="HW3, CS425, Fall2018, PHP, Home Page">
    <meta name="author" content="Antonia Antoniou">
    <meta name="description" content="Homework 3 for CS425 Fall2018, University of Cyprus - Home Page">
    <link rel="shortcut icon" href="favicon/question_block">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script>
		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
	    	document.body.scrollTop = 0;
	    	document.documentElement.scrollTop = 0;
		}
    </script>
</head>
<body>
    <nav id="navbar">
        <ul>
            <li><a href="index.php">Home Page</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="scores.php">Scores Board</a></li>
        </ul>
    </nav>
	<?php
		$xml = simplexml_load_file("questions.xml") or die("Error: Cannot create object");
	?>
    <div class="container">
		<h1>CS 425: Internet Technologies</h1>
		<form id="welcome" action="index.php" method="post">
			<div class="start" 
				<?php if (isset($_POST['start'])) echo 'style="display: none;"';
					elseif (isset($_POST['next'])) echo 'style="display: none;"';
					elseif (isset($_POST['finish'])) echo 'style="display: none;"';
					elseif (isset($_POST['yes'])) echo 'style="display: none;"';
					elseif (isset($_POST['no'])) echo 'style="display: block;"';
					elseif (isset($_POST['end'])) echo 'style="display: block;"';
				?>>
				<h3>Welcome to the CS 425 Question Game!</h3>
				<input type="submit" name="start" value="Start">
			</div>
		</form>
		<form id="quiz" action="index.php" method="post">
			<div class="question" 
				<?php if (isset($_POST['start'])) echo 'style="display: block;"';
					elseif (isset($_POST['next'])) echo 'style="display: block;"';
					else echo 'style="display: none;"';
				?>>
				<?php
					if(isset($_POST['start'])){
						$table = array();
						session_destroy();
						session_start();
						$_SESSION['table'] = $table;
						echo "First question<br>";
						$questionNum = rand(0,24);
						echo "Number of Question = $questionNum<br>";
						$question = $xml->medium->questions->Question[$questionNum]["Text"];
						$answer1 = $xml->medium->questions->Question[$questionNum]->answer[0];
						$answer2 = $xml->medium->questions->Question[$questionNum]->answer[1];
						$answer3 = $xml->medium->questions->Question[$questionNum]->answer[2];
						if($xml->medium->questions->Question[$questionNum]->answer[0]["Correct"] == "true")
							$correctAnswer = 1;
						elseif($xml->medium->questions->Question[$questionNum]->answer[1]["Correct"] == "true")
							$correctAnswer = 2;
						else
							$correctAnswer = 3;
						$table1 = array();
						$table1[0]="medium";
						$table1[1]=$correctAnswer;
						$_SESSION['table'][0] = $table1;
					}
					if(isset($_POST['next'])){
						$givenAnswer = $_POST['answer'];  
						if ($givenAnswer === "A")
							$ans = 1;
						elseif ($givenAnswer === "B")
							$ans = 2;
						elseif ($givenAnswer === "C")
							$ans = 3;
						$_SESSION['table'][sizeof($_SESSION['table'])-1][2] = $ans;
						print_r ($_SESSION['table'][sizeof($_SESSION['table'])-1]);
						if($_SESSION['table'][sizeof($_SESSION['table'])-1][1] === $_SESSION['table'][sizeof($_SESSION['table'])-1][2]){
							if($_SESSION['table'][sizeof($_SESSION['table'])-1][0] === "medium")
								$difficulty = "hard";
							elseif($_SESSION['table'][sizeof($_SESSION['table'])-1][0] === "easy")
								$difficulty = "medium";
							else
								$difficulty = "hard";
						}else{
							if($_SESSION['table'][sizeof($_SESSION['table'])-1][0] === "medium")
								$difficulty = "easy";
							elseif($_SESSION['table'][sizeof($_SESSION['table'])-1][0] === "easy")
								$difficulty = "easy";
							else
								$difficulty = "medium";
						}
						echo "Inside $difficulty<br>";
						$questionNum = rand(0,24);
						echo "Number of Question = $questionNum<br>";
						$question = $xml->$difficulty->questions->Question[$questionNum]["Text"];
						$answer1 = $xml->$difficulty->questions->Question[$questionNum]->answer[0];
						$answer2 = $xml->$difficulty->questions->Question[$questionNum]->answer[1];
						$answer3 = $xml->$difficulty->questions->Question[$questionNum]->answer[2];
						if($xml->$difficulty->questions->Question[$questionNum]->answer[0]["Correct"] == "true")
							$correctAnswer = 1;
						elseif($xml->$difficulty->questions->Question[$questionNum]->answer[1]["Correct"] == "true")
							$correctAnswer = 2;
						else
							$correctAnswer = 3;	
						$table1 = array();
						$table1[0]=$difficulty;
						$table1[1]=$correctAnswer;
						$_SESSION['table'][sizeof($_SESSION['table'])] = $table1;
					}
					if(isset($_POST['finish'])){
						$givenAnswer = $_POST['answer'];  
						if ($givenAnswer === "A")
							$ans = 1;
						elseif ($givenAnswer === "B")
							$ans = 2;
						elseif ($givenAnswer === "C")
							$ans = 3;
						$_SESSION['table'][sizeof($_SESSION['table'])-1][2] = $ans;
						print_r ($_SESSION['table'][sizeof($_SESSION['table'])-1]);
					}
				?>
				<h4>Question: <?php echo htmlspecialchars($question); ?></h4>
				<input type="radio" name="answer" value="A" autocomplete="off"> <?php echo htmlspecialchars($answer1); ?></input><br>
		  		<input type="radio" name="answer" value="B" autocomplete="off"> <?php echo htmlspecialchars($answer2); ?></input><br>
		  		<input type="radio" name="answer" value="C" autocomplete="off"> <?php echo htmlspecialchars($answer3); ?></input><br>
				<?php
					if(sizeof($_SESSION['table']) < 10)
						echo "<input type=\"submit\" name=\"next\" value=\"Next Question\">";
					else
						echo "<input type=\"submit\" name=\"finish\" value=\"Finish Game\">";
				?>	
				<input type="submit" name="end" value="End Game">
			</div>
		</form>
		<form id="score" action="index.php" method="post">
			<div class="results" 
				<?php if (isset($_POST['finish'])) echo 'style="display: block"';
					else echo 'style="display: none;"'; 
				?>>
				<?php
					$score = 0;
					for($i = 0; $i < sizeof($_SESSION['table']); $i++){
						if ($_SESSION['table'][$i][1] === $_SESSION['table'][$i][2]){
							if($_SESSION['table'][$i][0] === "medium")
								$score = $score + 2;
							elseif($_SESSION['table'][$i][0] === "easy")
								$score = $score + 1;
							else
								$score = $score + 3;
						}
						else{
							$score = $score + 0;
						}
					}
				?>
				<table id="quizScores">
					<tr>
						<th>Number of Question</th>
						<th>Difficulty</th>
						<th>You answered</th>
						<th>Points Earned</th>
					</tr>
					<?php
						for($i = 1; $i <= sizeof($_SESSION['table']); $i++){
					?>
						<tr>
							<th><?php echo "$i"; ?></th>
							<th><?php echo $_SESSION['table'][$i-1][0]; ?></th>
							<th><?php 
									if ($_SESSION['table'][$i-1][1] === $_SESSION['table'][$i-1][2])
										echo "Correct";
									else
										echo "Wrong"; 
							?></th>
							<th><?php 
									if ($_SESSION['table'][$i-1][1] === $_SESSION['table'][$i-1][2]){
										if($_SESSION['table'][$i-1][0] === "medium")
											echo "2"; 
										elseif($_SESSION['table'][$i-1][0] === "easy")
											echo "1"; 
										else
											echo "3"; 
									}else{
										echo "0"; 
									}
							?></th>
						</tr>
					<?php
						}
					?>
				</table>
				<p>Your overall score is <?php echo "$score"; ?></p>
				<p>Would you like to save your score?</p>
				<input type="submit" name="yes" value="Yes">
				<input type="submit" name="no" value="No">
			</div>
		</form>
		<form id="enterName" action="index.php" method="post">
			<div class="name"
			<?php if (isset($_POST['yes'])) echo 'style="display: block;"';
				else echo 'style="display: none;"'; 
			?>>
				<h4>Please enter your nickname:</h4>
				<input type="text" name="nickname" id="nickname" placeholder="Nickname..." maxlength="8" required><br>
				<input type="submit" name="save" value="Save">
				<?php
					if(isset($_POST['save'])){
						$total_score = 0;
						for($i = 0; $i < sizeof($_SESSION['table']); $i++){
							if ($_SESSION['table'][$i][1] === $_SESSION['table'][$i][2]){
								if($_SESSION['table'][$i][0] === "medium")
									$total_score = $total_score + 2;
								elseif($_SESSION['table'][$i][0] === "easy")
									$total_score = $total_score + 1;
								else
									$total_score = $total_score + 3;
							}
							else{
								$total_score = $total_score + 0;
							}
						}
						$filename = "scores.txt";
						// Open the file to get existing content 
						$open = file_get_contents($filename);
						$val = $_POST['nickname'];
						// Append a new person to the file 
						$open = $open . $val . "," . $total_score . "\n"; 
						// Write the contents back to the file 
						file_put_contents($filename, $open); 	
					}
				?>
			</div>
		</form>
    </div>
    <footer>
		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    </footer>
</body>
</html>
