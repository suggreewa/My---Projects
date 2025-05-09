<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "show_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$id = "";
$name = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    // GET METHOD : shows the data of event..
    if (!isset($_GET["listing_ID"]))
    {
        header("location: votingPage1.php");
        exit;
    }

        $id = $_GET["listing_ID"];

        // read the row of the selected event from the database file..
        $sql = "SELECT * FROM show_listings WHERE listing_ID = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) 
        {
            // redirect to user to main form after enter data..
            header("location: votingPage1.php");
            exit;
        }
 $pdate = $row["published_date"];
        

}
else
{
    // POST METHOD : update the data of the event..

    $id = $_POST["listing_ID"];
    $name = $_POST["show_name"]; // Use the correct input name attribute
    $pdate = $_POST["published_date"]; 

    do{
        // check for empty row..
        if( empty($name) || empty($pdate) )
        {
            $errorMessage = "All Field's are required..";
            break;
        }
        

        // update event to the database..
        $sql = "UPDATE show_listings " . 
                "SET show_name = '$name', published_date = '$pdate' " .
                "WHERE listing_ID = $id";


        $result = $conn->query($sql);

        if (!$result) 
        {
            $errorMessage = "Invalid Query :   " . $conn->error;
            break;
        }

        $successMessage = "Event updated correctly..";

        // redirect to user to main form after enter data..
        header("location: votingPage1.php");
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
 
<form method="post">
  <input type="hidden" name="listing_ID" value=" <?php echo $id; ?>">
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
      <div>
      <a href="votingPage1.php"><Button class="cancel">Cancel</Button></a>
       <div>     
        </form>
    </div>
</body>
</html>