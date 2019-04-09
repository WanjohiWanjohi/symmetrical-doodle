<?php

require_once "connect.php";
    $sql="SELECT firstname,lastname FROM people";
    $result = mysqli_query($conn, $sql);
    $result = $result->fetch_all();
    echo json_encode($result);



?>