<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) redirect_to('../adminlogin.php');
?><!DOCTYPE html>
<html>
<head>
    <title>სურათის ატვირთვა</title>
    <?php echo incinhead(); ?>
</head>
<body>
<?php echo headerr2(); ?>
<br/>
	<div class="main">
		<div class="fileuplddiv"><form id="chemifrm" enctype="multipart/form-data" action="../php/uploadpict.php" method="post"><p>სურათის ასატვირთად აირჩიეთ ფაილი</p><input id="uploadBtn" name="uploadedfile" type="file" class="upload"><input id="uploadBtn2" type="submit" name="submit" value="ატვირთვა" onclick="chbnlb()"></form></div>
	</div>
	<script>
		function chbnlb(){
	        $('body').append('<div class="blck"></div>');
		}
	</script>
</body>
</html>