<?php

require_once 'connect.php';
$sql = "SELECT rmd_id,description,days_to from reminder";
$query = $conn->query($sql);
$result = $query->fetch_all();
echo json_encode($result);
?>