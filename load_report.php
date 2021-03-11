<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');


    $index = (isset($_GET['index'])) ? $_GET['index'] : "40";

    $sql = "select  bt.bid,bt.fname,bt.lname,bt.citizen,bt.b_desc,bt.product_name,bt.balance,bt.social_contact
    ,bt.date_pay,bt.avatar,bt.create_datetime,btsub.sum_balance,btsub.count_ev,ut.uid,ut.fname as u_fname,ut.lname as u_lname,ut.display_name,ut.avatar as u_avatar from blacklist_tb bt
    left join  users_tb ut on ut.uid = bt.create_user
    left join (select  bts.fname,bts.lname ,sum(bts.balance) as sum_balance ,count(*) as count_ev from blacklist_tb bts where bts.status = 0 GROUP BY bts.fname,bts.lname ) btsub
       on btsub.fname = bt.fname and btsub.lname = bt.lname  
       where bt.status = 0
       ORDER BY bt.create_datetime DESC limit $index,20
    "; 

        $result=mysqli_query($conn,$sql);
        $data = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {
            $user = array(
                "uid" => $row['uid'],
                "fname" => $row['u_fname'],
                "lname" => $row['u_lname'],
                "display_name" => $row['display_name'],
                "avatar" => $row['u_avatar']
            );
            $row['balance'] = $row['balance']+0.0;
            $row['sum_balance'] = $row['sum_balance']+0.0;
            $row['count_ev'] = $row['count_ev']+0;
            $row['user'] =   $user;
          


            $data[] =   $row ;
        }

        $resultCount= mysqli_query($conn,"SELECT count(*) as total from blacklist_tb bt   where bt.status = 0");
        $dataCount=mysqli_fetch_assoc($resultCount);
        //  $dataCount['total'];

        // $data = array_values($data); 
        $data = array("total"=>$dataCount['total']+0, "count"=>40 ,"data" => $data);
        echo json_encode($data);
    
    
    ?>