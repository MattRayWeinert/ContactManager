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
    $query = mysqli_query($conn, "SELECT * FROM users WHERE Username='$username'");

    if(mysqli_num_rows($query)) {
        echo "You have been logged in.";
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

?>