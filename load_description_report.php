<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');


    $bid = (isset($_GET['bid'])) ? $_GET['bid'] : "";
    $uid = (isset($_GET['uid'])) ? $_GET['uid'] : "";


    $resultName= mysqli_query($conn,"SELECT bt.fname,bt.lname from blacklist_tb bt   where bt.bid = $bid");
    $dataCount=mysqli_fetch_assoc($resultName);
    $fname = $dataCount['fname'];
    $lname = $dataCount['lname'];

    $sql = "select  bt.bid,bt.fname,bt.lname,bt.b_desc,bt.citizen,bt.product_name,bt.balance,bt.social_contact
    ,bt.date_pay,bt.avatar,bt.create_datetime,btsub.sum_balance,btsub.count_ev,ut.uid,ut.fname as u_fname,ut.lname as u_lname,ut.display_name,ut.avatar  from blacklist_tb bt
    left join  users_tb ut on ut.uid = bt.create_user
    left join (select  bts.fname,bts.lname ,sum(bts.balance) as sum_balance ,count(*) as count_ev from blacklist_tb bts where bts.status = 0 GROUP BY bts.fname,bts.lname ) btsub
       on btsub.fname = bt.fname and btsub.lname = bt.lname  
       where bt.status = 0  and bt.bid != $bid and ( bt.fname = '$fname' and bt.lname = '$lname ')
       ORDER BY bt.create_datetime DESC 
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
                "avatar" => $row['avatar']
            );
            $row['balance'] = $row['balance']+0.0;
            $row['sum_balance'] = $row['sum_balance']+0.0;
            $row['count_ev'] = $row['count_ev']+0;
            $row['user'] =   $user;
          


            $data[] =   $row ;
        }

      

        $sqlBank = "select rbt.m_id,rbt.bank_id,rbt.bank_number,rbt.bank_del,bm.bank_name,bm.bank_logo from report_bank_tb rbt 
        left join bank_master bm on bm.bank_id = rbt.bank_id
        where rbt.bank_del = 0  and rbt.bid = $bid
        ";

    
        $resultBank=mysqli_query($conn,$sqlBank);
        $dataBank = array();
        while($row = mysqli_fetch_assoc($resultBank)) {
           
            $row['m_id'] = $row['m_id']+0;
            $row['bank_id'] = $row['bank_id']+0;
            $row['bank_del'] = $row['bank_del']+0;
            $dataBank[] =   $row ;
        }

        $sqlImg = "select eid,path_img,img_del from evidence_img_tb ei 
        where img_del = 0 and bid = $bid
        ";

    
        $resultImg=mysqli_query($conn,$sqlImg);
        $dataImg = array();
        while($row = mysqli_fetch_assoc($resultImg)) {
           
            $row['eid'] = $row['eid']+0;
            $row['img_del'] = $row['img_del']+0;
            $dataImg[] =   $row ;
        }


        $sqlNotify = "select ut.tel,nr.create_datetime,nr.nid,nr.bid,nr.msg,ut.uid,ut.fname as u_fname,ut.lname as u_lname,ut.display_name,ut.avatar  from notify_report_blacklist_tb nr 
        left join  users_tb ut on ut.uid = nr.create_user
        where  bid = $bid";

    
        $resultNotify=mysqli_query($conn,$sqlNotify);
        $dataNotify = array();
        while($row = mysqli_fetch_assoc($resultNotify)) {
            $user = array(
                "uid" => $row['uid'],
                "fname" => $row['u_fname'],
                "lname" => $row['u_lname'],
                "display_name" => $row['display_name'],
                "avatar" => $row['avatar'],
                "tel" => $row['tel']

            );
            $row['user'] =   $user;
            $dataNotify[] =   $row ;
        }

        $sqlCk = "select count(*) as total from notify_report_blacklist_tb where create_user = '$uid' and bid = $bid";
        $resultCk = mysqli_query($conn,$sqlCk);
        $dataCk=mysqli_fetch_assoc($resultCk);
        $reportState = false;
        if($dataCk['total'] > 0){
            $reportState = true;
        }else{
            $reportState = false;
        }


        // $data = array_values($data); 
        $dataMap = array("img"=> $dataImg, "bank"=> $dataBank ,"blacklist" => $data,"notify" => $dataNotify,"report_state"=>$reportState);
        echo json_encode($dataMap);
    
    
    ?>