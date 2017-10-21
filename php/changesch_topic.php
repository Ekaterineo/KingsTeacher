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
if($das==0 && isset($_POST['idd'],$_POST['subj'],$_POST['class'],$_POST['namee'],$_POST['parent'])){
    $idd=intval($_POST['idd']);
    $subj=intval($_POST['subj']);
    $class=intval($_POST['class']);
    $parent=intval($_POST['parent']);
    if($parent==$idd) $parent=0;
    
    $namee=strval($_POST['namee']);
    $namee = preg_replace("/\r\n|\r|\n/",'<br/>',$namee);
    $namee=htmlspecialchars($namee, ENT_QUOTES, 'UTF-8');

    $timee=time();
            
    $query="UPDATE sch_topics SET subj='{$subj}',class={$class},name='{$namee}',parent={$parent} WHERE id={$idd}";
    $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
    $das=-1;
}
else $das="error";
echo $das;
//echo $das;
?>