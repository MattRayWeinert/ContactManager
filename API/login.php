<?php
session_start();
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$hash = crypt($password, 'salt');

if (!empty($username)){
if (!empty($password)){
$host = "localhost";
$dbusername = "unit_conman";
$dbpassword = "qwerty101";
$dbname = "unit_database";

// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error())
{
    die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
} else {
    $sql = "SELECT ID FROM users WHERE  Username='$username' and Password='$hash'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $id = $row["ID"];
        $_SESSION['userid']=$id;
        header("Location: home.php");
        exit;
    } else {
        echo "Invalid Username or Password.";
    }
}
}
else{
    echo "Password should not be empty.";
    die();
}
}
else{
    echo "Username should not be empty.";
    die();
}
?>
