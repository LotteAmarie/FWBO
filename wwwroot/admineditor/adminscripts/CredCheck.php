<?php
//Extract username and password input and process for user database, using read-only connection
require('./../scripts/triviascriptsproject/dbConnect.php');

$sql = "select Auth from TriviaQuestionsExplanation where Username = ? and Password = ?;";
	$stmt = sqlsrv_prepare( $conn, $sql , array( &$User, &$Pass) );
	sqlsrv_execute($stmt);

	//check for query errors
	if ($stmt === false)
{
$resp->message = print_r( sqlsrv_errors(), true);
}
//extract the only expected Auth value result and store as a session value
else {
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true) 
	{
			
			$row = sqlsrv_fetch_array($stmt);
			
	}
}
?>