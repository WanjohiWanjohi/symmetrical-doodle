<?php
require_once "connect.php";
$sql="SELECT description FROM service_type";
$result = mysqli_query($conn, $sql);
$result = $result->fetch_all();
echo json_encode($result);

?>