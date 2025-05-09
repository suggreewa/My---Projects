<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "show_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$id = "";
$name = "";
$pdate = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET METHOD: shows the data of event.
    if (!isset($_GET["listing_ID"])) {
        header("location: ../vote_Listings/votingPage1.php");
        exit;
    }

    $id = $_GET["listing_ID"];

    // read the row of the selected event from the database.
    $sql = "SELECT * FROM show_listings WHERE listing_ID = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        // redirect user to main form after entering data.
        header("location:../vote_Listings/votingPage1.php");
        exit;
    }

    $id = $row["listing_ID"];
    $name = $row["show_name"]; // Use the correct column name from the database
    $pdate = $row["published_date"]; // Use the correct column name from the database
} 
else 
{
    // POST METHOD: update the data of the event.
    $id = $_POST["listing_ID"];
    $name = $_POST["show_name"]; // Use the correct input name attribute
    $pdate = $_POST["published_date"]; // Use the correct input name attribute

    // Check for empty fields.
do
{
    if (empty($name) || empty($pdate)) 
    {
        $errorMessage = "All fields are required.";
        break;
    }

        // Update event in the database.
        $sql = "UPDATE show_listings SET name = '$name', published_date = '$pdate' WHERE listing_ID = $id";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $conn->error;
            break;
        }

            $successMessage = "Event updated correctly.";
            // Redirect user to main form after entering data.
            header("location: ../vote_Listings/votingPage1.php");
            exit;
        
    
}while(false);
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
    <!-- Content Section Start Here..-->

        <?php
        if(!empty($errorMessage))
        {
           echo "
            
                <strong>$errorMessage</strong>
              
            ";
        }
        ?>

<div class="container">
 
<form method="post" action="../vote_Listings/edit1.php">
  <input type="hidden" name="listing_ID" value=" <?php echo $listing_ID; ?>">
  <label for="show-name">Show Name:</label><br>
  <input type="text" id="show-name" name="show-name"  value="<?php echo $name; ?>" ><br>
  <label for="PublishedDate">PublishedDate:</label><br>
  <input type="date" id="PublishedDate" name="PublishedDate" value="<?php echo $pdate; ?>" >
  <br>
            <?php
            if(!empty($successMessage)){
                echo "
                
                        <strong>$successMessage</strong>
                
                ";
            }
            ?>
    
    <input type="submit" value="Submit">
      <br>
      <br>
      <a href="/vote_Listings/votingPage1.php"><Button class="cancel">Cancel</Button></a>

        </form>
    </div>
    <!-- Content Section End Here..-->
</body>
</html>
