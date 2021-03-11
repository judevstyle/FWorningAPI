<?php
date_default_timezone_set("Asia/Bangkok");
include_once('conn.php');



    $sql = "select  wt.wid,wt.w_topic,wt.w_desc,wt.lat,wt.lng,date_create,ut.u_avatar,ut.fname,ut.lname,ut.uid,ut.display_name
    ,  wi.seq,wi.img_path,wi.img_del
    from worning_tb wt
    left join  user_tb ut on ut.uid = wt.user_create
    left join worning_img_tb wi on wi.wid = wt.wid and wi.img_del = 0 
    where wt.status = 1
    "; 

        $result=mysqli_query($conn,$sql);
        $data = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {


            if (!isset($data[$row['wid']]) && $row['wid'] != null) {

                $user = array(
                    "uid" => $row['uid'],
                    "fname" => $row['fname'],
                    "lname" => $row['lname'],
                    "display_name" => $row['display_name'],
                    "avatar" => $row['u_avatar']
                );
        
                $data[$row['wid']] =  array(
                    'w_topic' => $row['w_topic'],
                    'w_desc' => $row['w_desc'],
                    'lat' => $row['lat']+0,
                    'lng' => $row['lng']+0,
                    'date_create' => $row['date_create'],
                    'user' => $user,
                    'img' => array()
                );

            }

            if (!isset($data[$row['wid']]['seq']) && $row['seq'] != null){

                $data[$row['wid']]['img'][] = array(
                    'seq' => $row['seq'],
                    'img' => $row['img_path'],
                    'status' => $row['img_del'],
                );
        
            }

            // $data[] =   $row ;
        }


        $data = array_values($data); 

        echo json_encode($data);
    
    
    ?>