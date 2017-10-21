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
if($das==0 && isset($_POST['subj'],$_POST['class'],$_POST['namee'],$_POST['parent'])){
    $subj=intval($_POST['subj']);
    $class=intval($_POST['class']);
    $parent=intval($_POST['parent']);
    
    $namee=strval($_POST['namee']);
    $namee = preg_replace("/\r\n|\r|\n/",'<br/>',$namee);
    $namee=htmlspecialchars($namee, ENT_QUOTES, 'UTF-8');

    $timee=time();
            
    $_SESSION['last_subj']=$subj;
    $_SESSION['last_class']=$class;
    $_SESSION['last_sch_topic']=$parent;
    $query="SELECT MAX(pos) FROM sch_topics WHERE parent={$parent}";
    $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
    $res=mysqli_fetch_array($result_set);
    $pos=intval($res[0])+1;
    $query="INSERT INTO sch_topics (subj,class,name,parent,pos) VALUES('{$subj}',{$class},'{$namee}',{$parent},{$pos})";
    $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
    $das=-1;
}
else $das="error";
echo $das;
//echo $das;
?>