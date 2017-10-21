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
if($das==0 && isset($_POST['type'],$_POST['subj'],$_POST['class'],$_POST['topic'],$_POST['q'],$_POST['ch'],$_POST['qrnk'],$_POST['axsn'],$_POST['subtopic'])){
    $subj=intval($_POST['subj']);
    $qrnk=intval($_POST['qrnk']);
    $type=intval($_POST['type']);
    $class=intval($_POST['class']);
    $topic=intval($_POST['topic']);
    $subtopic=intval($_POST['subtopic']);
    $sch_topic=0;
    
    $q=strval($_POST['q']);
    $axsn=strval($_POST['axsn']);
    $q = preg_replace("/\r\n|\r|\n/",'<br/>',$q);
    $axsn=preg_replace("/\r\n|\r|\n/",'<br/>',$axsn);
    $q=htmlspecialchars($q, ENT_QUOTES, 'UTF-8');
    $axsn=htmlspecialchars($axsn, ENT_QUOTES, 'UTF-8');

    $ch=json_decode($_POST['ch']);

    $quest=$q;
    //$quest=serialize($quest);

    $chc=$ch;
    if(count($chc)<2 && $type==1) exit;
    else
    if(count($chc)<1 && $type==2) exit;
    $n=count($chc);
    if($type==1) $n=count($chc)-1;
    for($i=0; $i<$n; $i++) {
        $chc[$i]=strval($chc[$i]);
        $chc[$i] = preg_replace("/\r\n|\r|\n/",'<br/>',$chc[$i]);
        $chc[$i]=htmlspecialchars($chc[$i], ENT_QUOTES, 'UTF-8');
    }

    $dmtvrb='';
    $dmtvls='';
    if(isset($_POST['textid'])){
        $dmtvrb.=',textid';
        $dmtvls.=','.intval($_POST['textid']);
    }

    $timee=time();
    
    $chc=serialize($chc);
    $_SESSION['last_subj']=$subj;
    $_SESSION['last_class']=$class;
    $_SESSION['last_topic']=$topic;
    $_SESSION['last_subtopic']=$subtopic;
    $_SESSION['last_sch_topic']=$sch_topic;
    $query="INSERT INTO questions (type,subject,class,topic,subtopic,sch_topic,statement,choices,qrnk,axsna,author,addedTime{$dmtvrb}) VALUES('{$type}','{$subj}',{$class},{$topic},{$subtopic},{$sch_topic},'{$quest}','{$chc}',{$qrnk},'{$axsn}',{$id},{$timee}{$dmtvls})";
    $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
    $query="SELECT id FROM questions WHERE subject='{$subj}' AND author='{$id}' ORDER BY id DESC LIMIT 1";
    $result_set2=mysqli_query($con,$query);
    $res2=mysqli_fetch_array($result_set2);
    $das=$res2[0];
}
else $das="error";
echo $das;
//echo $das;
?>