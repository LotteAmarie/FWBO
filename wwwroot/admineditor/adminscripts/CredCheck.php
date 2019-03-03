<?php
//Extract username and password input and process for user database, using read-only connection
require('adminscripts/dbConnect.php');

//convert password input into a md5 hashing process that must result in a 32-length string; how to implement this requires some planning. Refer to PHP hash functions. Salting optional

//IMPORTANT: $Pass must be a pre-processed hash string once security measures are implemented.
$sql = "select Username, Auth from TriviaQuestionsExplanation where Username = '?' and Password = '?';";
	$stmt = sqlsrv_prepare( $conn, $sql , array( &$User, &$Pass) );
	sqlsrv_execute($stmt);

	//check for query errors; if there is no found 
	if ($stmt === false)
{
$resp->message = print_r( sqlsrv_errors(), true);
}
//extract the only expected Username and Auth value result and store as a session value
else {
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true) 
	{
			
			$row = sqlsrv_fetch_array($stmt);
			
	}
}

//check for the Auth session value

//connection no longer needed. Close connection
	sqlsrv_close($conn);
?>