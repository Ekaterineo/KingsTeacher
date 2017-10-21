 <?php
session_start();
$loc="../";
$lang=0;
require_once("functions.php");
load();
if(is_user($id,$username,$hashed)) $das=0;
else return;
if(isset($_POST['uName']) && isset($_POST['uSurname']) && isset($_POST['uMob']) && isset($_POST['uCity']) && isset($_POST['uSubject']) && isset($_POST['uSchool'])&& isset($_POST['ariss'])){

	$uName=strval($_POST['uName']);
	$uSurname=strval($_POST['uSurname']);
	$uMob=intval($_POST['uMob']);
	$uCity=intval($_POST['uCity']);
	$uSchool=intval($_POST['uSchool']);
    $uSubject=intval($_POST['uSubject']);
    $uCity=max(1,$uCity);
    $ariss=intval($_POST['ariss']);
    if($ariss!=2) return;
    if(preg_match('/[^ა-ჰ\\-]/', $uName)) { $das=1;}
    if(preg_match('/[^ა-ჰ\\-]/', $uSurname)) { $das=2;}
    $nmbstr=strval($uMob);
    $results3=mysqli_query($con,"SELECT COUNT(*) FROM usert WHERE mobile={$uMob} AND registered=1 AND id!='{$id}'") or die(mysqli_error($con));
    $res3=mysqli_fetch_array($results3);
    if($res3[0]>0) {$das=22;}
    else{
        if($nmbstr[0]!='5' || strlen($nmbstr)!=9) $uMob=0;

        $damatebiti='';
        $tmm=time();
        $dtt=date('Y-m-d H:i:s',$tmm);
        if($ariss==2){
            $query3="UPDATE usert set name='{$uName}',surname='{$uSurname}',school='{$uSchool}',subject='${uSubject}',city='{$uCity}', mobile='{$uMob}',lastlogin='{$dtt}'{$damatebiti} WHERE id='{$id}' AND username='{$username}'";//mail
            $results3=mysqli_query($con,$query3) or die(mysqli_error($con));
        	$das=-1;
        }
    }
}
echo($das);