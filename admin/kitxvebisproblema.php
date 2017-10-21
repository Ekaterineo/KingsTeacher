<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
//ini_set('max_execution_time', 60*30);
$query="SELECT id, choices FROM questions";
$results=mysqli_query($con,$query) or die(mysqli_error($con));
$choices=[];
while($res=mysqli_fetch_array($results)){
	$newchoices=[];
	$choices=unserialize($res['choices']);
	$p=1;
	if(count($choices)>1){
		$newchoices[0]=$choices[0];
		for($i=1; $i<count($choices); $i++){
			if(!isset($choices[$i])) continue;
			if($choices[$i]==$choices[0]) print_r($choices);
			if($choices[$i]!=$choices[0]){ 
				$p=-1;
				$newchoices[]=$choices[$i];
			}

		}
	}
	if($p==-1){
	$newchoices=serialize($newchoices);
	$query2="UPDATE questions SET choices='{$newchoices}' WHERE id={$res['id']}";
	$results2=mysqli_query($con,$query2) or die(mysqli_error($con));
	}
	//echo $query2;
	//

}
?>

