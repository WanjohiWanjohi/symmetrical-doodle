<?php

require_once 'connect.php';
$query = 'SELECT description FROM service_type';
$tabs = $conn->query($query);
$tabs= $tabs->fetch_all();
echo json_encode($tabs);
// $tabmenu = "";
// $count= 0;
// // count number of rows ie number of servicetypes if nothing end after first if
// while($tablist = $tabs->fetch_assoc()){
//     if ($count == 0){
//         $tabmenu .='<li class = "active nav-item"><a href ="#'.$tablist["description"].'"onclick=" 
// sendTabs(this);" data-toggle = "tab" id = "'.$tablist["description"].'" >'.$tablist["description"].'</a></li>
// ';  
//     }else{
//         $tabmenu .='<li ><a href ="#'.$tablist["description"].'" onclick="
// sendTabs(this);" data-toggle = "tab" id = "'.$tablist["description"].'" >'.$tablist["description"].'</a></li>';
        
//     }
//     $count++;
// }
    // if service_type rows are found then feth an array and add each as a list item
   /* $remindee_details = array();
    $service_type_id = array();
    // check for $i is
    for ($i = 0; $i < $tabnumber; $i ++) {
        $service_types = ($tabs->fetch_assoc());
        $service_type_id = [
            $service_types['sty_id']
        ];
             
        foreach ($service_type_id as $index => $key) {
            // since we have service types (service_type_id) we proceed to fetch the tabs and tab-content for each
            // $key = the servicetype id
            // select service user
            $query = "SELECT srvusrdescr FROM service_user where sty_id like '%{$key}%'";
            $service_user = $conn->query($query);
            // fetch the service provider for each $key
            $query = "SELECT srvccharge , ppl_id, description, sty_id from service_providers where sty_id = '{$key}'";
            $remindee = $conn->query($query);
            $remindee_details = 
                $remindee->fetch_row();
            
        };
    }*/
    
?>