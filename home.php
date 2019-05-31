<?php
session_regenerate_id( true );
session_set_cookie_params(0);
session_start();
$id = $_SESSION["userid"];
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
function addContact()
{
  const xhr = new XMLHttpRequest();

  var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
  var email = document.getElementById("email").value;

  var json = { "firstName": firstName, "lastName": lastName, "phoneNumber": phoneNumber, "email": email };

  var myJSON = JSON.stringify(json);

  xhr.open("POST", "http://www.ucfconman.com/API/addContact.php", true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.send(myJSON);

  document.getElementById('firstName').value='';
  document.getElementById('lastName').value='';
  document.getElementById('phoneNumber').value='';
  document.getElementById('email').value='';
  location.reload();
}
//function deleteContact()

//function searchContact()

//function logout() [logs user out upon closing browser window]

window.onunload = function ()
{
  <?php session_unset(); session_destroy();?>
}
</script>

 <title>Home</title>
 <link rel="stylesheet" href="./css/style.css">
 <style>
    table
    {
    border-collapse: collapse;
    width: 70%;
    color: #030405;
    font-family: monospace;
    font-size: 25px;
    text-align: left;
    margin: 0px auto;
    } 
    
    th
    {
    background-color: #4CAF50;
    color: white;
    }
    
    tr:nth-child(even) {background-color: #ffffff}
    tr:nth-child(odd) {background-color: #E0E0E0}

    .header
    {
    text-align: center;
    }
</style>
</head>
<body>
 <h1 class="header" style="color: #4CAF50">Contact Manager</h1>
 <table>
 <tr>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Phone Number</th>
  <th>Email</th>
  <th></th>
 </tr>
 <?php
  $conn = mysqli_connect("localhost", "unit_conman", "qwerty101", "unit_database");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT id, firstName, lastName, phoneNumber, email FROM contacts";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    if($id == $row["id"]) {
        echo "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>"
        . $row["phoneNumber"]. "</td><td>" . $row["email"]. "</td><td><a href=\"API\deleteContact.php?id=".$row['id']."&firstName=".$row['firstName']."&lastName=".$row['lastName']."\">Delete</a></td></tr>";
      }
}

echo "</table>";
} else { echo "0 results"; }
$conn->close();

function getRequestInfo()
{
  return json_decode(file_get_contents('php://input'), true);
}
?>
</table>
<br>
<div style="text-align:center;">
    <input type="text" id="firstName" placeholder="First Name">
    <input type="text" id="lastName" placeholder="Last Name">
    <input type="text" id="phoneNumber" placeholder="Phone Number">
    <input type="text" id="email" placeholder="Email">
    <button type="button" id="addContactButton" onclick="addContact();"> Add Contact </button>
</div>
</body>
</html>