<?php
require './connect.php';
$tabclicked = json_decode($_GET["x"],false);
$query = "SELECT 
         sp.description ,
         sp.srvccharge ,
        c.last_digits , 
        st.description,
        su.srvusrdesc,
        cons.description,
        p.firstname , 
        p.lastname , 
        p.email, 
        p.phone 
        FROM
            service_provider sp 
            JOIN 
            credit_cards  c
            ON
              sp.srvp_id = sp.srvp_id 
            JOIN 
            service_type st 
             ON 
            c.ccr_id = st.ccr_id 
            JOIN 
            service_user su
            ON 
            st.sty_id = su.sty_id
            JOIN 
            consequence cons
            ON 
            su.srvusrid = cons.srvusr_id
            JOIN
             people p
             ON cons.cns_id = p.cns_id 
            
        WHERE st.description LIKE '%$tabclicked'";
$tabcontent = $conn->query($query);
$tabcontent = mysqli_fetch_all($tabcontent);
echo json_encode($tabcontent);