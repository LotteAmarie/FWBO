<?php
//connect to database with read permission
require('adminscripts/dbConnect.php');

//check total entry count
$sql = "select count(*) as numQuestions from TriviaQuestionsExplanation;";
	$stmt = sqlsrv_prepare( $conn, $sql );
	sqlsrv_execute($stmt);

//Error detection and handling. If statement fails, find means to notify
if ($stmt === false)
{
$resp->message = print_r( sqlsrv_errors(), true);
}
/*
Note: Table is large enough to warrant pagination or
separation into table pages up to 20 entries are shown.

A value from multiples of 20 + 1 is to be taken into consideration.
*/
else {
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true) 
	{
			
			$row = sqlsrv_fetch_array($stmt);
			$numQuestions = $row["numQuestions"];
			//Calculate maximum table pages as limit.
			$tableMaxCount = ($numQuestions / 20) + 1
	}
}
/*
Statement to list ID, Pool Number, Question Number, and Questions,
sorted by Pool and Question numbers. Maximum list limited by 20 entries, offset every 20 entries.
*/
$sql = "select ID as EntryID, QuestionPool as PoolID, QuestionNum as NumID, Question 
from TriviaQuestionsExplanation order by PoolID asc, NumID asc limit 20 offset ?;";
/*
Use current table page minus 1 to determine entry read offset at multiples of 20.
*/
$offset = ($lblPage - 1) * 20;
$stmt = sqlsrv_prepare( $conn, $sql, array( &$offset) );
sqlsrv_execute($stmt);

//connection no longer needed, and will be closed
sqlsrv_close($conn);

//check for query error response
if ($stmt === false)
{
$resp->message = print_r( sqlsrv_errors(), true);
}
//extract data and process into a table with 4 columns, 21 rows; 1 header row, 20 entry rows.
else {
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true) 
	{
			
			$row = sqlsrv_fetch_array($stmt);
			
	}
}

//connection no longer needed, and will be closed
sqlsrv_close($conn);
?>