<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <title>VoteVista</title>
  <link rel="stylesheet" href="votingPage1.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

</head>

<body>
  <!-- Button to add a new entry -->
  <a href="/vote_Listings/create.php"> <button class="create">Add New</button></a>
  <!-- Table to display show listings -->
  <table>
    <thead>
      <tr>
        <th>Show Name</th>
        <th>Published Date</th>
      </tr>
    </thead>
    <tbody>

    <?php

// PHP code to interact with the database
$serverName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dName = "show_details"; 

// Create connection to the database
$connection = new mysqli($serverName, $dbUser, $dbPassword, $dName);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SQL query to select all rows from the 'show_listings' table
$sql = "SELECT * FROM show_listings";
$result = $connection->query($sql);

// Check if the query was successful
if (!$result) {
    die("Invalid query: " . $connection->error);
}

// Loop through each row in the result and display data in table rows
while ($row = $result->fetch_assoc()) {
  // Display the show name

  echo "
  <tr>
        <td><a><button class='tableButton'>" . $row['show_Name'] . "</button></a></td>
        <td>" . $row['published_Date'] . "<a class='icon del' href='/vote_Listings/delete.php?listing_ID=" . 
        $row['listing_ID'] . "'><img src='delete.png' class='icon' id='del' onclick=event></a><a class='icon' href='/vote_Listings/edit1.php?listing_ID=" . $row['listing_ID'] . "'><img src='edit.png' class='icon'></a></td>
    </tr>
    ";
}
?>
    </tbody>
  </table>
    <!-- Include external JavaScript file -->

  <script src="scriptform.js"></script>
</body>

</html>