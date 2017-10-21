<?php
session_start();
$loc="../";
require_once('functions.php');
load();
if(is_user($id,$username,$hashed)) $das=0;
else return;
if(isset($_POST['passold']) && isset($_POST['pass'])){
	$passold=strval($_POST['passold']);
	$pass=strval($_POST['pass']);
	$hashedold=hash('sha512', $passold);
	if($hashedold!=$hashed) {$das=-2;}
	else{

   		if(preg_match('/[^A-Za-z0-9\\-.+_]/', $pass)) {$das=-3;}
   		$hashednew=hash('sha512',$pass);
   		$query="UPDATE usert SET password='{$pass}', hashed_password='{$hashednew}' WHERE id='{$id}' AND username='{$username}' AND hashed_password='{$hashedold}'";
   		$result=mysqli_query($con,$query) or die(mysqli_error($con));
   		$das=-1;

	}
}
echo $das;
?>