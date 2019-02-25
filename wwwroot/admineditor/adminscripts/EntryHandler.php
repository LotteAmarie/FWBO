<?php
//connect to database as read-only
require('adminscripts/dbConnect.php');

$sql = "select * from TriviaQuestionsExplanation where ID = ?;";
	$stmt = sqlsrv_prepare( $conn, $sql , array( &$ID) );
	sqlsrv_execute($stmt);

if ($stmt === false)
{
$resp->message = print_r( sqlsrv_errors(), true);
}
else {
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true) 
	{
			
			$row = sqlsrv_fetch_array($stmt);
			
	}
}

//connection no longer needed. Close connection
	sqlsrv_close($conn);
?>