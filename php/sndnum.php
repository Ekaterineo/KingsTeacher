<?php
session_start();
$loc="../";
$lang=0;
$das=[];
require_once("functions.php");
load();
if(isset($_POST['number']) ){
	$uMob=intval($_POST['number']);
	   $query="SELECT username, password FROM usert WHERE id='{$id}'";
       $result=mysqli_query($con,$query) or die(mysqli_error($con));
       $res=mysqli_fetch_array($result);

        $username=$res[0];
        $uPass=$res[1];
        $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );
        if($uMob!=0){ $response = file_get_contents("https://api.smsreklama.ge/sms/send/?username=kingsge&password=kings34%40%40p&brand=1&numbers={$uMob}&text=Kingsis%20maswavlebelta%20programashi%20shesvlistvis%20amieridan%20gamoiyenebt%20shemdeg%20monacemebs:%0AKodi:%20{$username}%0AParoli:%20{$uPass}", false, stream_context_create($arrContextOptions));
      //  print_r($response);
        }
}