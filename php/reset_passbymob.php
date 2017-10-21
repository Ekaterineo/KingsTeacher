<?php
session_start();
require('functions.php');
global $con;
load();
if(is_admin($id,$username,$hashed)) $das=0;
else if(isset($_POST["mob"])){
    $das=-1;
    $mob=intval($_POST["mob"]);
    $query="SELECT id,username,password FROM usert WHERE mobile='{$mob}' AND registered=1 LIMIT 1";
    $results=mysqli_query($con,$query);
    if(!mysqli_num_rows($results)) $das=3;
    if($das==-1){
            $res=mysqli_fetch_array($results);


            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            /*$response = file_get_contents("https://api.smsreklama.ge/sms/send/?username=Smartcomp&password=s2017p&brand=1&numbers={$mob}&text=Code:{$res['username']}%20Password:{$res['password']}", false, stream_context_create($arrContextOptions));
*/
            $response = file_get_contents("https://api.smsreklama.ge/sms/send/?username=kingsge&password=kings34%40%40p&brand=1&numbers={$mob}&text=Kingsis%20maswavlebelta%20programashi%20shesvlistvis%20gamoiyenet%20shemdegi%20monacemebi:%0AKodi:%20{$res['username']}%0AParoli:%20{$res['password']}", false, stream_context_create($arrContextOptions));


            $timee=time();
            $resultss=mysqli_query($con,"INSERT INTO frgt_psw (uid,timee) VALUES({$res['id']},{$timee}) ");
            //return json_decode($response);
    }
}
else $das=0;
echo $das;
?>