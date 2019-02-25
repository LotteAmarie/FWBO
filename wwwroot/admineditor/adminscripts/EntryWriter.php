<?php
//connect to database with write permission
require('adminscripts/dbConnect.php');

//determine entry input to be new or edited
switch (variable) 
case '':
{
//Prepare and execute statement for new entries; matching data types required
$sql = "insert into TriviaQuestionsExplanation values (?, ?, '?', '?', '?', '?', '?', '?', '?', ?, '?')";
$stmt = sqlsrv_prepare( $conn, $sql, array( &$pool, &$num, &$Question, &$Option1, &$Option2, &$Option3, &$Option4, &$Option5, &$Option6, &$Answer, &$Explain) );
	sqlsrv_execute($stmt);

	//Error detection and handling. If statement fails, find means to notify
	if ($stmt === false)
		{
		$resp->message = print_r( sqlsrv_errors(), true);
		}

	//If statement execute succeeds, find means to notify
	else {
	
		}
}

}

case '':
{
//Prepare and execute statement for edited entries; matching data types required
$sql = "update TriviaQuestionsExplanation set QuestionPool = ?, QuestionNum = ?, Question = '?',
Option1 = '?', Option2 = '?', Option3 = '?', Option4 = '?', Option5 = '?', Option6 = '?', QuestionAnswer = ?, QuestionExplanation = '?' where ID = ?";
$stmt = sqlsrv_prepare( $conn, $sql, array( &$pool, &$num, &$Question, &$Option1, &$Option2, &$Option3, &$Option4, &$Option5, &$Option6, &$Answer, &$Explain, &$id) );
	sqlsrv_execute($stmt);

	//Error detection and handling. If statement fails, find means to notify
	if ($stmt === false)
		{
		$resp->message = print_r( sqlsrv_errors(), true);
		}

	//If statement execute succeeds, find means to notify
	else {
	
		}
}

default:
{
	//Develop error detection means for invalid entry input
}


?>