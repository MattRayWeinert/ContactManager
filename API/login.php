<?php
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
if (!empty($username)){
if (!empty($password)){
$host = "localhost";
$dbusername = "unit_conman";
$dbpassword = "qwerty101";
$dbname = "unit_database";

// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
} else {
    // $query = mysqli_query($conn, "SELECT id FROM users WHERE Username='$username' and Password='$password'");

    $sql = "SELECT ID FROM users WHERE  Username='$username' and Password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $conn->close();
        header("Location: http://www.ucfconman.com/home.php");
        returnWithInfo($id);
    } else {
        echo "Invalid Username or Password.";
    }
}
}
else{
    echo "Password should not be empty";
    die();
}
}
else{
    echo "Username should not be empty";
    die();
}

function getRequestInfo()
{
    return json_decode(file_get_contents('php://input'), true);
}
function sendResultInfoAsJson( $obj )
{
    header('Content-type: application/json');
    echo $obj;
}
function returnWithError( $err )
{
    $retValue = '{"error":"' . $err . '"}';
    sendResultInfoAsJson( $retValue );
}
function returnWithInfo($id )
{
    $retValue = '{"id":' . $id . '}';
    sendResultInfoAsJson( $retValue );
}
?>
