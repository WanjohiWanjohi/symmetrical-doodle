<?php
ERROR_REPORTING(1);
$today = date("Y/m/d");
$endate = "";
require 'connect.php';
$onlineservice = $kost = $serviceprov = $freqwency = $alternativeservices = $risk = $serviceuser = $credcardnumber = $fname = $lname = $fone = $mail = "";

function fetchID($conn, $query)
{
    $conn->query($query);
    $last_id = $conn->insert_id;
    return $last_id;
}
    // get values then sanitize
    $onlineservice = $_POST['onlineservice'];
    //$onlineservice = $onlineservice;
    
    $kost = $_POST['kost'];
    //$kost = $kost;
    
    $serviceprov = $_POST['serviceprov'];
   // $serviceprov = $serviceprov;
    
    $freqwency = $_POST['freqwency'];
   // $freqwency = $freqwency;
    
    $alternativeservices = $_POST['alternativeservices'];
   // $alternativeservices = $alternativeservices;
    
    $risk = $_POST['risk'];
  //  $risk = $risk;
    
    $serviceuser = $_POST['serviceuser'];
    //$serviceuser = $serviceuser;
    
    $credcardnumber = $_POST['credcardnumber'];
   // $credcardnumber = $credcardnumber;
    
    $fname = $_POST['fname'];
   // $fname = $fname;
    
    $lname = $_POST['lname'];
   // $lname = $lname;
    
    $fone = $_POST['fone'];
  //  $fone = $fone;
    
    $mail = $_POST['mail'];
  //  $mail = $mail;
    // parse reminder table
    // begin transaction to insert all the data sequentially;
    $queries = "INSERT INTO service_provider(description,srvccharge) VALUES ('$serviceprov','$kost')";
    $futureid = fetchID($conn, $queries);
   
    $queries = "INSERT INTO service_provider(description,parent_id) VALUES ('$alternativeservices','$futureid')";
    $nextid = fetchID($conn, $queries);
    $queries = "INSERT INTO credit_cards (srvp_id , last_digits) VALUES ( '$futureid','$credcardnumber')";
    $nextid = fetchID($conn, $queries);    
     $query = "INSERT INTO service_type (ccr_id , description) VALUES ('$nextid','$onlineservice')";
   $nextid = fetchID($conn, $query);
   
   $queries = "INSERT INTO service_user(sty_id,srvusrdesc) VALUES ('$nextid','$serviceuser')";
    $nextid = fetchID($conn, $queries);
    
    $queries = "INSERT INTO consequence (srvusr_id,description) VALUES('$nextid','$risk')";
    $nextid = fetchID($conn, $queries);
    
    $queries = "INSERT INTO people (cns_id ,firstname , lastname ,email, phone ) VALUES ('$nextid','$fname','$lname', '$mail', '$fone')";
    $nextid = fetchID($conn, $queries);
    $subscrenddate=  date('Y-m-d',strtotime($today.'+'.$freqwency.'days'));
    
   

