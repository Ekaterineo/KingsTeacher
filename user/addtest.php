<?php
session_start();
$loc="../";
require_once("../php/functions.php");
load();
if(!is_user($id,$username,$hashed))  redirect_to('../login.php');
?><!DOCTYPE html>
<html>
<head>
    <title>ტესტის დამატება</title>
    <?php echo incinhead(); echo headerr(); ?>

</head>
<body>
<body class="bodylogin">
	<div class="main1">
			
		<div style="display: inline">
			<div class="classbtn"> კლასი </div>
			<input type="number" class="adtextar"></input>
		</div>

		<div> ტესტის შექმნა </div>
		
		<div> </div>
		<!--<p class="stdbtn"> მოსწავლე </p>
		<br/> <br>
		<p class="just" id="namee"> სახელი </p>
		<p class="just" id="namee"> გვარი </p>
		<p class="just" id="tel"> ტელეფონი </p>
		<br>
		<div class="std">
			<?php for($i=1; $i<=9; $i++){
				echo "<p class='just ramdeni' style='margin-left:11%'> ".$i." &nbsp;</p><input  class=\"adtextar2\" id=adname".$i."></input> <input  class=\"adtextar2\" id=adsurnm".$i." style='margin-left:5%'></input><input type='number' class=\"adtextar2\" id=admob".$i." style='margin-left:5%'></input> <br/>";
			}
			echo "<p class='just ramdeni' style='margin-left:11%'> ".$i."</p><input  class=\"adtextar2\" id=adname".$i."></input> <input  class=\"adtextar2\" id=adsurnm".$i." style='margin-left:5%'></input><input type='number' class=\"adtextar2\" id=admob".$i." style='margin-left:5%'></input> <br/>";
			?>
		</div>
		<div class="addplus" onclick="addline(<?php echo $i+1; ?>)"> <img src="../css/plus-black-symbol.svg" id="plus"> </div>
		<div class="logbotbut" onclick="addstd()" id="save"> შენახვა</div>
	</div>
</div>
	<script>
		$('.adtextar2').geo();
		function addline(i){
			
			$('.addplus').attr("onclick","addline("+(i+1)+")");
			$( ".std" ).append( "<p class='just ramdeni' style='margin-left:11%'> "+i+"</p><input  class=\"adtextar2\" id=adname"+i+"></input> <input  class=\"adtextar2\" id=adsurnm"+i+" style='margin-left:5%'></input><input type='number' class=\"adtextar2\" id=admob"+i+" style='margin-left:5%'></input> <br/>" );

		}
	</script>
	-->
</body>
</html>