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
if($das==0 && isset($_POST['tid'])){
    
    $tid=intval($_POST['tid']);

    $query="SELECT parent,pos sch_topics FROM sch_topics WHERE id={$tid}";  
    $result_set=mysqli_query($con,$query) or die($con);
    $res=mysqli_fetch_array($result_set);
    $pos=intval($res[1]);
    $parent=intval($res[0]);


    $query="DELETE FROM sch_topics WHERE id={$tid}";
    $result_set3=mysqli_query($con,$query) or die($con);

    $query="UPDATE sch_topics set pos=pos-1 WHERE pos>{$pos}";
    $res_set=mysqli_query($con,$query) or die(mysqli_error($con));

    $query="UPDATE sch_topics set parent={$parent}, pos=0 WHERE parent={$tid}";
    $res_set=mysqli_query($con,$query) or die(mysqli_error($con));
    $das=-1;
}
else $das="error";
echo $das;
//echo $das;
?>