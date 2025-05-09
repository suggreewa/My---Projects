<?php

// Database connection parameters
$serverName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dName = "show_details"; 

// Create connection
$connection = new mysqli($serverName, $dbUser, $dbPassword, $dName);

// Initialize variables to store form data
$name="";
$pdate="";

// Initialize error and success messages
$errorMessage = "";
$successMessage = "";

// Check if form is submitted
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $name = $_POST['show-name'];
  $pdate = $_POST['PublishedDate'];

// Validate form data
  do {
    if ( empty($name) || empty($pdate) ) {
    $errorMessage = "All the fields are required";
    break;
    }

// Insert data into database
  $sql = "INSERT INTO show_listings (show_Name, published_Date)" . 
    "VALUES ('$name', '$pdate')";

$result = $connection->query($sql);

if (!$result) {
$errorMessage = "Invalid query: ". $connection->error;
break;
}


// Reset form fields

    $name="";
    $pdate="";

// Set success message and redirect to another page
    $successMessage = "Show added correctly";
    header("location: /vote_Listings/votingPage1.php");
    exit;

    } while (false);


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

<!-- Display error message if any -->
<?php
    if ( !empty($errorMessage) ) {
      echo "<p>$errorMessage</p>";
    }

    ?>
  <div class="container">

 
    <form method="post">
      <label for="show-name">Show Name:</label><br>
      <input type="text" id="show-name" name="show-name"  value="<?php echo $name; ?>" ><br>
      <label for="PublishedDate">PublishedDate:</label><br>
      <input type="date" id="PublishedDate" name="PublishedDate" value="<?php echo $name; ?>" ><br>
      
      <?php
        echo"<p><strong>$errorMessage</strong></p>";
      ?>
      <!-- Submit button -->

       <input type="submit" value="Submit" id="submitButton"> 
      <br>
      <br>
     
      <a href="/vote_Listings/votingPage1.php" class="submit" id="submitButton"><button>Go Back</button></a>

      <script src="scriptform.js"></script>

    </form>
  </div>

</body>

</html>