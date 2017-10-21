<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
//if(!can_question($rnk)) redirect_to('../adminlogin.php');
$cssubj=0;
if(isset($_SESSION['last_subj']) && intval($_SESSION['last_subj'])!=4) $cssubj=intval($_SESSION['last_subj']);
?><!DOCTYPE html>
<html>
<head>
    <title>კითხვის დამატება</title>
    <?php echo incinhead(); ?>
    <?php echo headerr2(); ?>
</head>
<body>
<br/>
	<div class="main">
		აირჩიეთ საგანი: <select class="slct2" id="chssubj" style="width: 150px;"><option value="1" <?php if($cssubj==1) echo 'selected';?>>მათემატიკა</option><option value="2" <?php if($cssubj==2) echo 'selected';?>>ინგლისური</option><option value="3" <?php if($cssubj==3) echo 'selected';?>>ქართული</option> </select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		კლასი: <select class="slct2" id="slcclass" style="width: 70px;">
		<?php for($i=2; $i<=9; $i++) {if($csclass==$i) $dmt='selected="true"'; else $dmt=''; echo "<option {$dmt} value='{$i}'>{$i}</option>";} ?> 
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		სირთულე: <select class="slct2" id="qrnkselc"  style="width: 70px;"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		ქვეთემა <select class="slct2" id="ctgselc"  style="width: 70px;"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		კითხვის ტიპი: <select class="slct2" id="tpselc"  style="width: 240px;"><option value="1">სავარაუდო პასუხებით</option><option value="2">ღია</option></select>
		<br/> <br/>
		<textarea class="adsmth shemdegi2" id="adtxt0" placeholder="კითხვა"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(0)"></div></div><hr/>
		<textarea class="adsmth shemdegi2" id="adtxt1" placeholder="სწორი პასუხი"></textarea><div class="ertd"><div class="rmvtar" onclick="$(this).parent().prev().remove(); $(this).parent().remove();">—</div><div class="imgvtar" onclick="opngallery(1)"></div></div>
		<div id="savaraudo">
			<textarea class="adsmth shemdegi2" id="adtxt2" placeholder="სავარაუდო ვარიანტი"></textarea><div class="ertd"><div class="rmvtar" onclick="$(this).parent().prev().remove(); $(this).parent().remove();">—</div><div class="imgvtar" onclick="opngallery(2)"></div></div>
			<textarea class="adsmth shemdegi2" id="adtxt3" placeholder="სავარაუდო ვარიანტი"></textarea><div class="ertd"><div class="rmvtar" onclick="$(this).parent().prev().remove(); $(this).parent().remove();">—</div><div class="imgvtar" onclick="opngallery(3)"></div></div>
			<textarea class="adsmth shemdegi2" id="adtxt4" placeholder="სავარაუდო ვარიანტი"></textarea><div class="ertd"><div class="rmvtar" onclick="$(this).parent().prev().remove(); $(this).parent().remove();">—</div><div class="imgvtar" onclick="opngallery(4)"></div></div>
			<textarea class="adsmth shemdegi2" id="adtxt5" placeholder="სავარაუდო ვარიანტი"></textarea><div class="ertd"><div class="rmvtar" onclick="$(this).parent().prev().remove(); $(this).parent().remove();">—</div><div class="imgvtar" onclick="opngallery(5)"></div></div>
		</div>
		
		<textarea class="adsmth" id="adaxnsaganm" placeholder="ახსნა-განმარტება" style="width: calc(100% - 97px); border-color:#ffc800; min-height: 100px"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(-1)"></div></div>

		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="addq()">კითხვის გამოქვეყნება</button></div>

		<script>
		$(document).ready(function(){
			$("#tpselc").change(function(){
				if($("#tpselc option:selected").val()==2){
					$('#savaraudo').css({"display":"none"});
					
				}
				else $('#savaraudo').css({"display":"block"});
			});
		});
	</script>
</body>
</html>