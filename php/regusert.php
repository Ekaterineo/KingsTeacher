 <?php
session_start();
$loc="../";
$lang=0;
$das=[];
require_once("functions.php");
load();
//echo "aa"; echo $_POST['uSchool']; echo $_POST['uSubject'];
if(is_user($id,$username,$hashed)) $das=[];
else if(isset($_POST['uName']) && isset($_POST['uSurname']) && isset($_POST['uPass']) && isset($_POST['uMob']) && isset($_POST['uCity']) && isset($_POST['uSubject']) && /*isset($_POST['uMail'])*/ isset($_POST['uSchool'])&& isset($_POST['ariss'])){
	$uName=strval($_POST['uName']);
	$uSurname=strval($_POST['uSurname']);
    $uPass=strval($_POST['uPass']);
	$uMob=intval($_POST['uMob']);
	$uCity=intval($_POST['uCity']);
	$uSchool=intval($_POST['uSchool']);
    $uSubject=intval($_POST['uSubject']);
   // $uMail=strval($_POST['uMail']);
    $uCity=max(1,$uCity);
    $ariss=intval($_POST['ariss']);
    if(preg_match('/[^A-Za-z0-9\\-.+_]/', $uPass)) {$das=[4,4,4,4];}
    if(preg_match('/[^ა-ჰ\\-]/', $uName)) { $das=[5,5,5,5,5];}
    if(preg_match('/[^ა-ჰ\\-]/', $uSurname)) { $das=[2,2];}
    $nmbstr=strval($uMob);
    if($nmbstr[0]!='5' || strlen($nmbstr)!=9) $uMob=0;
    //if($uName!='' && $uSurname!='') $fullname=$uName.' '.$uSurname; else $fullname='';
    $hashed=hash('sha512',$uPass);

    $results3=mysqli_query($con,"SELECT COUNT(*) FROM usert WHERE /*name='{$uName}' AND surname='{$uSurname}' AND*/ mobile={$uMob} AND registered=1") or die(mysqli_error($con));
    $res3=mysqli_fetch_array($results3);
    if($res3[0]>0) $das=[3,3,3];

    if(count($das)==0){
        $damatebiti='';
        //if($stsidan==6)  $damatebiti=',zafx=1';
        $tmm=time();
        $dtt=date('Y-m-d H:i:s',$tmm);
        if($uPass!='') $pp="hashed_password='{$hashed}', password='{$uPass}', "; else $pp="";
        if($ariss==0){
            $query3="UPDATE usert set name='{$uName}',surname='{$uSurname}',school='{$uSchool}', {$pp} subject='${uSubject}',city='{$uCity}',registered=1, mobile='{$uMob}',lastlogin='{$dtt}'{$damatebiti} WHERE id='{$id}' AND username='{$username}'";//mail
            $results3=mysqli_query($con,$query3) or die(mysqli_error($con));
        	$das[0]=$username;
        }
        else if($ariss==1){
            $query="SELECT username FROM usert ORDER BY id DESC LIMIT 1";
            $results=mysqli_query($con,$query) or die(mysqli_error($con));
            $res=mysqli_fetch_array($results);
            $firstnm=$uName." ".$uSurname;
            $username=$res[0]+1;
            $query2="INSERT INTO usert (username, first_password, password, hashed_password, registered, name, surname, first_name_and_surname, subject, school,city, mobile) VALUES('{$username}', '{$uPass}', '{$uPass}', '{$hashed}', 1, '{$uName}','{$uSurname}', '{$firstnm}','${uSubject}', '{$uSchool}', '{$uCity}', '{$uMob}')";//mail
            $results2=mysqli_query($con,$query2) or die(mysqli_error($con));
            $query3="SELECT id FROM usert WHERE username='{$username}' AND name='{$uName}' ORDER BY id DESC LIMIT 1";
            $results3=mysqli_query($con,$query3) or die(mysqli_error($con));
            $res3=mysqli_fetch_array($results3);
            $id=$res3[0];
            $das[0]=$username;

        }
        if($das[0]!=$username) return;
        $_SESSION["username"]=$username;
    	$_SESSION["id"]=$id;
       /* $resultss=mysqli_query($con,"INSERT INTO u_login (uid,timee) VALUES({$id},{$tmm})") or die(mysqli_error($con));
        //conf_query();
        
        $_SESSION["hashed"]=$hashed;
        $_SESSION["registered"]=1;*/

        
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
}
echo json_encode($das);