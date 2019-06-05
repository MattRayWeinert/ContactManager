<?php
session_regenerate_id( true );
session_set_cookie_params(0); 
session_start();
 $registerUser = filter_input(INPUT_POST, 'registerUser');
 $confirmUser = filter_input(INPUT_POST, 'confirmUser');
 $registerPassword = filter_input(INPUT_POST, 'registerPassword');
 $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
 $hashPassword = crypt($registerPassword, 'salt');

if (!empty($registerUser) && ($registerUser == $confirmUser)){
if (!empty($registerPassword) && $registerPassword == $confirmPassword){
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
    $query = mysqli_query($conn, "SELECT * FROM users WHERE Username='$registerUser'");

    if(mysqli_num_rows($query)) {
        echo "Username is already taken";
    } else {
        mysqli_query($conn, "INSERT INTO users (Username, Password) VALUES ('$registerUser', '$hashPassword')");
        header("Location: http://www.ucfconman.com/#");
    }
}
}
else{
    echo "The Passwords must match and/or not be empty.";
    die();
}
}
else{
    echo "The Usernames must match and/or not be empty.";
    die();
}

?>