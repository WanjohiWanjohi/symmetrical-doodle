<?php
error_reporting(1);
require '../connect.php';
$query = "SELECT st.description ,ssh.start_date , ssh.end_date , sst.ststate   
FROM
 service_status_histories ssh 
JOIN service_status sst
 on
ssh.sst_id = sst.sst_id
JOIN service_type st
ON
ssh.sty_id = st.sty_id ";
$history = $conn->query($query);
$result = $history->fetch_all();
echo json_encode($result);