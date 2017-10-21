<?php
session_start();
$loc="../";
require('functions.php');
load();
global $connection;
$das=0;
if(!is_user($id,$username,$hashed)) {$das="error"; return;}
if($das==0  && isset($_POST['subj'])  && isset($_POST['ch']) && isset($_POST['name'])  && isset($_POST['cls'])){
    $subj=intval($_POST['subj']);
    $name=strval($_POST['name']);
     if(preg_match('/[^A-Za-zა-ჰ0-9\\-.+_?!\s]/', $name)) {$das="error"; return;}
    $cls=max(2,min(10,intval($_POST['cls'])));
    $ch=json_decode($_POST['ch']);
    $chc=$ch;
    if(count($chc)<2) exit;
    
    if($das==0){
        for($i=0; $i<count($chc); $i++) {
            $chc[$i]=intval($chc[$i]);
        }

        $date=date("Y-m-d");
        $chc=serialize($chc);//type 0 ბანკი და 1 სკოლა
        $query="INSERT INTO tst (subj,class,questions,name,type,author,datee) VALUES({$subj},{$cls},'{$chc}','{$name}',0,'{$id}','{$date}')";
        $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
        $das=-1;
    }
       // $_SESSION['last_date']=$dtt;S
}
else $das="error";
echo $das;
?>