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
if($das==0 && isset($_POST['idd'],$_POST['type'],$_POST['subj'],$_POST['ristvis'],$_POST['class'],$_POST['topic'],$_POST['q'],$_POST['ch'],$_POST['qrnk'],$_POST['axsn'],$_POST['subtopic'],$_POST['checkedValue'],$_POST['shenishvna'])){
    $subj=intval($_POST['subj']);
    $idd=intval($_POST['idd']);
    $qrnk=intval($_POST['qrnk']);
    $type=intval($_POST['type']);
    $class=intval($_POST['class']);
    $topic=intval($_POST['topic']);
    $subtopic=intval($_POST['subtopic']);
    $ristvis=intval($_POST['ristvis']);
    $q=strval($_POST['q']);
    $axsn=strval($_POST['axsn']);
    $q = preg_replace("/\r\n|\r|\n/",'<br/>',$q);
    $axsn=preg_replace("/\r\n|\r|\n/",'<br/>',$axsn);
    $q=htmlspecialchars($q, ENT_QUOTES, 'UTF-8');
    $axsn=htmlspecialchars($axsn, ENT_QUOTES, 'UTF-8');

    $ch=json_decode($_POST['ch']);
    $quest=$q;
    $chc=$ch;
    if(count($chc)<2 && $type!=2) exit;
    $n=count($chc);
    //if($type==1) $n=count($chc)-1;
    for($i=0; $i<$n; $i++) {
        $chc[$i]=strval($chc[$i]);
        $chc[$i] = preg_replace("/\r\n|\r|\n/",'<br/>',$chc[$i]);
        $chc[$i]=htmlspecialchars($chc[$i], ENT_QUOTES, 'UTF-8');
    }
    $chc=serialize($chc);

    $dmt='';
    $gdxdl=0;
    if($rnk==6){
        $gdxdl=intval($_POST['checkedValue']);
        if($gdxdl>0) $dmt=',gdxdl='.$gdxdl;
        $shenishvna=htmlspecialchars(strval($_POST['shenishvna']), ENT_QUOTES, 'UTF-8');
        if($shenishvna!='') {
            $timee=time();
            $result_sett=mysqli_query($con,"INSERT INTO shenishvnebi (qid,text,timee) VALUES({$idd},'{$shenishvna}',{$timee})") or die(mysqli_error($con));
        }
    }
    $query="UPDATE questions set subject='{$subj}', type='{$type}', ristvis='{$ristvis}',class='{$class}',topic='{$topic}', subtopic='{$subtopic}', statement='{$quest}',choices='{$chc}',qrnk={$qrnk},axsna='{$axsn}'{$dmt} WHERE id={$idd}";

    $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
    $das=-1;
}
else $das="error";
echo $das;
//echo $das;
?>