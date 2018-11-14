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
    <div class="container">
	<h1>CS 425: Internet Technologies</h1>
	<form id="quiz" action="index.php" method="post">
		<?php
		    $xml = simplexml_load_file("questions.xml") or die("Error: Cannot create object");
		    $questionNum = rand(0,24);
		    echo "Number of Question = $questionNum<br>";
		    $question = $xml->easy->questions->Question[$questionNum]["Text"];
		    $answer1 = $xml->easy->questions->Question[$questionNum]->answer[0];
		    $answer2 = $xml->easy->questions->Question[$questionNum]->answer[1];
		    $answer3 = $xml->easy->questions->Question[$questionNum]->answer[2];
		?>
		<h4><?php echo $question; ?></h4>
		<input type="radio" name="answer" value="A" autocomplete="off"> <?php echo $answer1; ?></input><br>
  		<input type="radio" name="answer" value="B" autocomplete="off"> <?php echo $answer2; ?></input><br>
  		<input type="radio" name="answer" value="C" autocomplete="off"> <?php echo $answer3; ?></input><br>
		<input type="submit" name="next" value="Next Question">
		<input type="submit" name="end" value="End Game">
	</form>
    </div>
    <footer>
	<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    </footer>
</body>
</html>
