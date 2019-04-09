<?php
require 'connect.php';
require 'mail.php';
$today = ("Y-m-d");
//check if there exists a column with a reminder for present day
$query = "SELECT ppl_id , end_date, rem_type from mailing_list WHERE end_date like '%$today%'";
$rows = $con->query($query);
$rowcount=mysqli_num_rows($result);
if($rowcount <1 ){
    $rowdata = $rows->fetch_row();
    print_r($rowdata);die();
    //fetch the data for person
    print_r($rowdata)
    //send mail from the mail file
    sendMail($sender , $sendername ,$recipient ,$cc= null,$recipientname , $servicename , $servicecharge)
}else{
    die();
}