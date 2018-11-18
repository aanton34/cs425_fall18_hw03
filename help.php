<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS425 Quiz Game - Help</title>
    <meta name="keywords" content="HW3, CS425, Fall2018, PHP, Help Page">
    <meta name="author" content="Antonia Antoniou">
    <meta name="description" content="Homework 3 for CS425 Fall2018, University of Cyprus - Help Page">
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
		<h3 id="instructions">Game Instructions</h3>
		<p id="instructionsPar">The game is consisted of questions designed to help you evaluate
		your knowledge of the information presented on the topics covered in the course of
		"CS 425: Internet Technologies" at University of Cyprus.</p>
		<p id="instructionsPar">This quiz has 10 multiple-choice questions. Read each question carefully,
		and click on the button next to your response. Each question has easy, medium or hard
		difficulty level and depending on your answer the next question might change difficulty.</p>
		<p id="instructionsPar">After responding to a question, click on the "Next Question" button at the bottom 
		in order to move on to the next question. At any moment you have a choice to end the game,
		and that will take you to the start page without calculating your score. Each time you
		start a new game, the questions will be randomized.</p>
		<p id="instructionsPar">The total score for the game is based on your responses to all questions. If you answer
		incorrectly to a question or you choose to move on without answering you get 0 points for that
		question. For each easy question that you answer correctly you get 1 point, for each medium
		you get 2 point and for each hard question you get 3 points. </p>
		<p id="goodLuck">Good Luck!</p>
	</div>
    <footer>
		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    </footer>
</body>
</html>
