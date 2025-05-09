<?php

$serverName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dName = "show_details"; 

// Create database connection
$connection = new mysqli($serverName, $dbUser, $dbPassword, $dName);

$id="";
$name="";
$pdate="";


$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
  //get the data of the client

  if ( !isset($_GET["listing_ID"]) ) {
    header("location: /vote_Listings/votingPage1.php");
    exit;
  } 
    $id = $_GET["listing_ID"]; 

// read the row of the selected client from database table
$sql = "SELECT * FROM show_listings WHERE listing_ID=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
header("location: /vote_Listings/votingPage1.php");
exit;
}

$name= $row["show_Name"];
$pdate=$row["published_Date"];

} else {
  //post method: update the data of the client

  $name= $row["show_Name"];
  $pdate=$row["published_Date"];
  

  do {
    if ( empty($name) || empty($pdate) ) {
    $errorMessage = "All the fields are required";
    break;
    }

    $sql = "UPDATE show_listings " .
    "SET show_Name = '$name', published_Date = '$pdate'" .
    "WHERE listing_ID = $id"; 

    $result =$connection->query($sql);

    if (!$result) {

      $errorMessage = "Invalid query: " . $connection->error;
      break;
    }  
      $successMessage = "Client updated correctly";
      
      header("location: /vote_Listings/votingPage1.php");
      exit;

  } while(false);
}
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta content="width=device-width">
  <title>VoteVista</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="Form.css">

</head>

<body>
<?php
    if ( !empty($errorMessage) ) {
      echo "<p>$errorMessage</p>";
    }

    ?>
  <div class="container">

 
    <form method="post">
      <input type="hidden" name="listing_ID" value=" <?php echo $listing_ID; ?>">
      <label for="show-name">Show Name:</label><br>
      <input type="text" id="show-name" name="show-name"  value="<?php echo $name; ?>" ><br>
      <label for="PublishedDate">PublishedDate:</label><br>
      <input type="date" id="PublishedDate" name="PublishedDate" value="<?php echo $name; ?>" ><br>
      
      <?php
        echo"<p><strong>$successMessage</strong></p>";
      ?>
      
      <input type="submit" value="Submit">
      <br>
      <br>
      <a href="/vote_Listings/votingPage1.php">
      <input type="submit" value="Cancel" href="/vote_Listings/votingPage1.php"></a>


    </form>
  </div>

</body>

</html>