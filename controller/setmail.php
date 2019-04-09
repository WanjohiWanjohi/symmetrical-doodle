<?php
require 'connect.php';

$servicetype = $_POST['servicetype'];
$person = $_POST['personresponsible'];
$group = $_POST['group'];
//fetch sty_id
$query = "SELECT sty_id FROM service_type WHERE description LIKE '%$servicetype%'";
$sty_id = $conn->query($query);
$sty_id = $sty_id->fetch_row();
//sty_id[0] is the sty id 
//break the people string
//print_r($group);
$name = (explode(",",$person));

    //fetch people id 
$query = "SELECT ppl_id FROM people WHERE firstname like '%$name[0]%' AND lastname like '%$name[1]%' ";
$ppl_id = $conn->query($query);
$ppl_id = $ppl_id->fetch_row();
$personid = $ppl_id[0];
//ppl_id [0] is the person id 
    //fetch reminder id 
//set todays date as the beginning of the count

foreach($group as $daysto=>$type){
    $query = "SELECT rmd_id FROM reminder WHERE days_to = $daysto";
    $rmdid = $conn->query($query);
    $rmdid = $rmdid->fetch_row();
    foreach ($rmdid as $key => $value) {
        //$value = reminder id 
        //set the start and end dates
        $today = date("Y-m-d");
        $enddate = date('Y-m-d', strtotime("+$daysto days"));
        $query = "Insert into mailing_list (ppl_id , rmd_id, start_date , end_date , remtype )values('$ppl_id[0]','$value','$today','$enddate','$type') ";
        $conn->query($query);
    }
}
die();



?>