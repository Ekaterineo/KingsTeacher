<?php
session_start();
$loc="../";
require_once('functions.php');
load();
if(is_user($id,$username,$hashed)) $das=0;
else return;
if(isset($_POST['city']) && isset($_POST['school'])){
	$city=intval($_POST['city']);
	$school=intval($_POST['school']);
	
   		$query="UPDATE usert SET city='{$city}', school='{$school}' WHERE id='{$id}' AND username='{$username}' AND hashed_password='{$hashed}'";
   		$result=mysqli_query($con,$query) or die(mysqli_error($con));
   		$das=-1;
}
echo $das;
?>