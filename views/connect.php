 <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "subscription_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $database) or die($conn->connect_error);

?> 