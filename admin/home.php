<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
//if($rnk) redirect_to('admin/home.php');
if(is_user($id,$username,$hashed)) redirect_to('../user/home.php');
if(!is_admin($id,$username,$hashed)) redirect_to('../login.php');
//$cities=get_cities();
$tlfn=array();
$tlfn[]=0;
//foreach($cities as $i => $cit) if($cit[3]==0) $tlfn[$i]='0322 30 62 93'; else $tlfn[$i]='0322 30 62 93';
?><!DOCTYPE html>
<html>
<head>
    <title>ადმინი</title>
    <?php echo incinhead(); echo headerr2($username); ?>
</head>
<body class="bodylogin">
	<div class="main">
		<br>
			<div class="logtop" <?php if($rnk!=5 && $rnk!=4 && $rnk!=6) echo "style='display:none'" ?>>
				<div class="admbigbx" onclick="location.href='questions.php'"><img class="qs" src="../css/question.svg"/>კითხვები </div>
			</div>
			<div class="logtop">
				<div class="admbigbx" onclick="location.href='sch_topics.php'" <?php if($rnk!=5 && $rnk!=4) echo "style='display:none'" ?>><img src="../css/img/checklist.svg" height="45"/> თემები</div>
			</div>
			<div class="logtop">
				<div class="admbigbx" onclick="location.href='images.php'" <?php if($rnk!=5 && $rnk!=4) echo "style='display:none'" ?>><img src="../css/img/picture.svg" height="45"/> სურათები</div>
			</div>
			<div class="logtop" <?php if($rnk!=5) echo "style='display:none'" ?>>
				<div class="admbigbx" onclick="location.href='new_export_teachers.php'">მასწავლებლების ინფორმაცია </div>
			</div>

			
		
			
	</div>
	
</body>
</html>