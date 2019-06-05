<?php
	session_start();

    $inData = getRequestInfo();
	$id = $_SESSION["userid"];
    $firstName = $inData["firstName"];
    $lastName = $inData["lastName"];
	$phoneNumber = $inData["phoneNumber"];
	$email = $inData["email"];
	$conn = new mysqli("localhost", "unit_conman", "qwerty101", "unit_database");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$sql = "INSERT INTO contacts (id, firstName, lastName, phoneNumber, email) VALUES ('$id', '$firstName', '$lastName', '$phoneNumber', '$email')";
		if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError( $conn->error );
		}
		$conn->close();
    }
    
    function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}
?>