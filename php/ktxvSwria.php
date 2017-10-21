<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$loc="../";
require('functions.php');
load();
global $connection;
$das=0;
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) $das=1;
if($das==0 && isset($_POST['qid']) && isset($_POST['rml'])){
    $qid=intval($_POST['qid']);
    $rml=intval($_POST['rml']);
    //if($rml>=0) $rml=-2;
    $query="UPDATE questions set gdxdl={$rml} WHERE id={$qid} AND gdxdl<=0";
    $result_set=mysqli_query($con,$query);
    $das=-1;
}
else $das="error";
echo $das;
//echo $das;
?>