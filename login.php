<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
//$rnk=is_admin($id,$username,$hashed);
//if($rnk) redirect_to('admin/home.php');
if(is_user($id,$username,$hashed)) redirect_to('user/home.php');
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
				<input type="text" id="username" placeholder="კოდი" name="code">
				<input type="password" id="password" placeholder="პაროლი">
			</div>
			<div class="logbotbut" id='loggin' onclick="logincheck()"> შესვლა</div>
			<div class="logbotbut" id="nocode" onclick="location.href='user/registration2.php'" style=> არ გაქვთ კოდი და პაროლი? </div>
			<div class="logbotbut" id='ressp' onclick="location.href='reset_password.php'" style="margin-top: 5px">  დაგავიწყდათ კოდი ან პაროლი? </div>
			<br/>
		</div>
			
	</div>
	<script>
		$(document).keypress(function(e) {
		    if(e.which == 13) {
		        logincheck();
		    }
		});
	</script>
</body>
</html>