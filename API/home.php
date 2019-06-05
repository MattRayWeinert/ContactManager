<?php
  session_start();
  $id = $_SESSION["userid"];
?>

<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="../js/code.js"></script>
  <title>Home</title>
  <link rel="stylesheet" href="../css/style2.css">
  <style>
      table
      {
      border-collapse: collapse;
      width: 90%;
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

      .topright
      {
      margin-top: 5px;
      margin-right: 8px;
      position:absolute;
      top:0;
      right:0;
      }

      a:link
      {
      text-decoration: none;
      }

      a:visited
      {
      text-decoration: none;
      }

      #searchInput
      {
      background-position: 10px 12px; /* Position the search icon */
      background-repeat: no-repeat; /* Do not repeat the icon image */
      width: 80%; /* Full-width */
      font-size: 14px; /* Increase font-size */
      padding: 12px 20px 12px 40px; /* Add some padding */
      border: 1px solid #ddd; /* Add a grey border */
      margin-bottom: 12px; /* Add some space below the input */
      align: center;
      }

      .search
      {
      max-width: 500px;
      margin: auto;
      }
  </style>
</head>

<body>
  <header>
    <div class="container">
      <div id="signature">
        <h1>Contact Manager</h1>
      </div>
      <ul class="a">
        <li><a href='/API/logout.php'>Logout</a></li>
      </ul>
    </div>
  </header>

  <br>
  <div class="search">
    <input type="text" id="searchInput" onkeyup="search()" placeholder="Search by First Name..">
  </div>

  <div style="text-align:center;">
      <input type="text" id="firstName" placeholder="First Name">
      <input type="text" id="lastName" placeholder="Last Name">
      <input type="text" id="phoneNumber" placeholder="Phone Number">
      <input type="text" id="email" placeholder="Email">
      <button type="button" id="addContactButton" onclick="addContact();"> Add Contact </button>
  </div>
  <br>

  <table id="myTable">
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
  if ($conn->connect_error)
  {
  die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT id, firstName, lastName, phoneNumber, email FROM contacts";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
    {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
        if($id == $row["id"]) {
            echo "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>"
            . $row["phoneNumber"]. "</td><td>" . $row["email"]. "</td><td><a href=\"deleteContact.php?id=".$row['id']."&firstName=".$row['firstName']."&lastName=".$row['lastName']."\">Delete</a></td></tr>";
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

</body>
</html>