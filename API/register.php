<?php
session_regenerate_id( true );\
session_set_cookie_params(0); 
session_start();
 $registerUser = filter_input(INPUT_POST, 'registerUser');
 $confirmUser = filter_input(INPUT_POST, 'confirmUser');
 $registerPassword = filter_input(INPUT_POST, 'registerPassword');
 $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
if (!empty($registerUser) && ($registerUser == $confirmUser)){
    echo "1";
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
        mysqli_query($conn, "INSERT INTO users (Username, Password) VALUES ('$registerUser', '$registerPassword')");
        $_SESSION['isLoggedIn']="true";
        if($_SESSION['isLoggedIn'] == "true")
        {
            header("Location: http://www.ucfconman.com/home.php");
        }
        else{
            echo "Please log in.";
        }
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