<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if($rnk!=5 && $rnk!=6) redirect_to('home.php');

$birthday=0;
if($id==3 && date('m-d',time())=='10-05') $birthday=1;
?><!DOCTYPE html>
<html>
<head>
    <title>ადმინისტრატორის შესასვლელი ფორმა</title>
    <?php echo incinhead(); ?>
</head>
<body class="bodylogin" style="background: url(../css/img/test.svg) bottom -10px right -30px no-repeat, #fbfbfb; background-size:150px auto;">
<?php echo headerr2(); ?>
	<div class="main"><br/>
		<div align="center">
			
			<button class="admbigbx admbigbgt admbigclick" onclick="location.href='images.php'"><img src="../css/picture.svg" height="45"/> სურათები</button>
			<button class="admbigbx admbigbgt admbigclick" onclick="location.href='questions.php'"><img src="../css/question.svg" height="45"/> კითხვები</button>
			<br/>
			 <?php if(can_view_user($rnk)) echo '<br/><br/><button class="admbigbx admbigbgt admbigclick" onclick="location.href=\'tsts_statistics.php\'"><img src="../css/tests.svg" height="45"/>  კითხვების სტატისტიკა</button>';?>
		</div>
	</div>
</body>
</html>