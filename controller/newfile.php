<?php
//function to check current date 
require 'validate.php';
require 'mail.php';
public static function diff_time($date, $timezone = null,$now=null)
{
    if($now == null)
    {
        $now =  date_create(date('Y-m-d'));
        //set current date
        $query = "SELECT end_date, rem_type FROM mailing_list WHERE end_date LIKE $now ";
       $duemails=  $conn->query($query);
        $duemails = mysqli_fetch_array($duemails);
        if (count($duemails)= 0){
            die ();
        }else{
            
        }
        
    }
    if(is_int($date)){
        $time = $date;
        $date = date('Y-m-d',$date);
    }
    else{
        $time = strtotime($date);
    }
    $date=new \DateTime($date);
    $diff=$date->diff($now);
    return $diff;
}
