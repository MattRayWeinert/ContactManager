<?php
// session_regenerate_id( true );
// session_set_cookie_params(0); 
// session_start();

// Create connection
$conn = new mysqli("localhost", "unit_conman", "qwerty101", "unit_database");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    $id = $_GET['id']; // $id is now defined
    $firstName = $_GET['firstName']; // $id is now defined
    $lastName = $_GET['lastName']; // $id is now defined

    // or assuming your column is indeed an int
    // $id = (int)$_GET['id'];

    mysqli_query($conn, "DELETE FROM contacts WHERE id='".$id."' and firstName='".$firstName."' and lastName='".$lastName."'");
    mysqli_close($conn);
    header("Location: ../home.php");
?>