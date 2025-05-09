<?php

// Check if "listing_ID" parameter is set in the URL
if (isset($_GET["listing_ID"]))
{
// Initialize variable to store listing ID
    $id="";

    $id = $_GET["listing_ID"];

        // Database connection parameters

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "show_details";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM show_listings WHERE listing_ID = $id";
    $conn->query($sql);
}

// redirect to user to main form after enter data..
header("location: votingPage1.php");
exit;
?>