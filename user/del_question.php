<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$loc="../";
require('functions.php');
load();
global $connection;
$das=0;
$rnk=is_admin($id,$username,$hashed);
if(!$rnk) $das=1;
if($das==0 && isset($_POST['qid'])){
    
    $qid=intval($_POST['qid']);

    $query="SELECT * FROM questions WHERE id={$qid}";
    $result_set2=mysqli_query($con,$query) or die('კითხვა არ მოიძებნა');
    if(!mysqli_num_rows($result_set2)) {echo -1; exit;}
    $res=mysqli_fetch_array($result_set2, MYSQLI_ASSOC);
    $auth=intval($res['author']);
    if(!can_delete_question($rnk,$auth)) {echo -1; exit;}

    $ks=''; $vls='';
    $prvl=1;
    foreach($res as $key=>$value){
        if(!$prvl) {$ks.=','; $vls.=',';}
        $prvl=0;
        $ks.=$key;
        $vls.="'{$value}'";
    }
    $qvr="INSERT INTO questions_deleted ({$ks}) VALUES({$vls})";
    $result_setqvr=mysqli_query($con,$qvr) or die(mysqli_error($con));
    $query="DELETE FROM questions WHERE id={$qid}";
    $result_set3=mysqli_query($con,$query) or die(mysqli_error($con));
    $das=-1;
}
else $das="error";
echo $das;
//echo $das;
?>