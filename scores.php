<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS425 Quiz Game - Scores</title>
    <meta name="keywords" content="HW3, CS425, Fall2018, PHP, Scores Page">
    <meta name="author" content="Antonia Antoniou">
    <meta name="description" content="Homework 3 for CS425 Fall2018, University of Cyprus - Scores Page">
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
		<h3 id="highScores">High Scores - Top 20</h3>
		<?php 
			$i = 0;
			if($fp = fopen('scores.txt','r')){
				while(!feof($fp)){
					$line = fgets($fp);
					$lineArray = split (",", $line);
					$nicknameTable[$i] = $lineArray[0];
					$temp = split("\n", $lineArray[1]);
					$scoreTable[$i] = (int)$temp[0];
					$i++;
				}
				fclose($fp);
			}
			array_multisort($scoreTable,SORT_DESC,$nicknameTable);
		?>
		<table id="scoreList">
			<tr>
				<th>#</th>
				<th>Nickname</th>
				<th>Score</th>
			</tr>
			<?php
				if(sizeof($scoreTable) <= 20){
					for($i=1;$i<=sizeof($scoreTable);$i++){
			?>
			<tr>
				<th><?php echo $i?></th>
				<th><?php echo $nicknameTable[$i-1]?></th>
				<th><?php echo $scoreTable[$i-1]?></th>
			</tr>
			<?php
					}
				}
				else{
					for($i=1;$i<=20;$i++){
			?>
			<tr>
				<th><?php echo $i?></th>
				<th><?php echo $nicknameTable[$i-1]?></th>
				<th><?php echo $scoreTable[$i-1]?></th>
			</tr>
			<?php
					}
				}
			?>
		</table>
	</div>    
    <footer>
		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    </footer>
</body>
</html>
