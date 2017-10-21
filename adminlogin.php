<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
if(is_admin($id,$username,$hashed)) redirect_to('admin/home.php');
//$cities=get_cities();
/*$tlfn=array();
$tlfn[]=0;
foreach($cities as $i => $cit) if($cit[3]==0) $tlfn[$i]='0322 30 62 93'; else $tlfn[$i]='0322 30 62 93';*/
?><!DOCTYPE html>
<html>
<head>
    <title>შესვლა</title>
    <?php echo incinhead(); echo headerr0(); ?>
</head>
<body class="bodylogin">
	<div class="main">
		<br>
			<div class="logtop">
				პროფილში შესვლა
			</div>
		<!--<p style="text-align:center">პროფილში შესასვლელად გამოიყენეთ თქვენი უნიკალური კოდი და პაროლი.</p>-->
		<div class="lgcont">
			<div class="logbox">
				<input type="text" id="username" placeholder="კოდი">
				<input type="password" id="password" placeholder="პაროლი">
			</div>
			<div class="logbotbut" onclick="adlogincheck()"> შესვლა</div>
			<br/>
		</div>
			
	</div>
	
</body>
</html>