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
if($das==0 && isset($_POST['subj'])){
    $subj=intval($_POST['subj']);

	$query="SELECT questions.id,questions.class,shenishvnebi.seen FROM shenishvnebi INNER JOIN questions ON questions.id=shenishvnebi.qid WHERE subject={$subj} AND author={$id} ORDER BY shenishvnebi.seen ASC, shenishvnebi.id DESC";
	$results=mysqli_query($con,$query) or die(mysqli_error($con));
	$das=[];
	while($res=mysqli_fetch_array($results,MYSQLI_ASSOC)){
		$das[]=$res;
	}
}
else $das="error";
echo json_encode($das);
//echo $das;
?>