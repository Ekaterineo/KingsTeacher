<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
//$rnk=is_admin($id,$username,$hashed);
//if($rnk) redirect_to('admin/home.php');
if(is_user($id,$username,$hashed)) redirect_to('home.php');
if(!isset($_SESSION['username'])) redirect_to('../login.php');
$cities=get_cities();
$schools=get_schools();
$user=get_all_things($id);
$name=$user['name'];
$surname=$user['surname'];
$school=$user['school'];
$city=$user['city'];
$subject=$user['subject'];
$mobile=$user['mobile'];
$mail=$user['mail'];
if($user['city']=='') $user['city']=0;
if($user['school']=='') $user['school']=0;
;
?><!DOCTYPE html>
<html>
<head>
    <title>რეგისტრაცია</title>
    <?php echo incinhead(); echo headerr(); ?>
    <script>
	    cities=JSON.parse('<?php echo json_encode($cities); ?>');
	    schools=JSON.parse('<?php echo json_encode($schools); ?>');
    </script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>
</head>
<body class="bodylogin">
	<div class="main">
		<br>
		<div class="lgcont">
			<div class="logtop" style="margin-top:20px"> რეგისტრაცია </div>
			<div class="logbox">

				<input type="text" class="pale" id="name" placeholder="სახელი">  <script> if("<?php echo $name?>"!="")document.getElementById("name").value = "<?php echo $name?>"; </script>
				<input type="text" class="pale" id="surname" placeholder="გვარი"> <script> if("<?php echo $surname?>"!="")document.getElementById("surname").value = "<?php echo $surname?>"; </script>
				<select class="slct some1 selectpicker" data-show-subtext="true"  data-live-search="true" id="slccity" ><option value="0">აირჩიეთ ქალაქი</option>
				<?php for($i=1; $i<count($cities); $i++) {if($user['city']==$cities[$i][0]) $dmt='selected="true"'; else $dmt=''; echo "<option {$dmt} value='{$cities[$i][0]}'>{$cities[$i][1]}</option>";} if($user['city']==250) $dmt='selected="true"'; else $dmt=''; echo "<option {$dmt} value='250'>სხვა</option>"; ?> 
				</select><br/><br>
				<select class="slct some2 selectpicker" data-show-subtext="true"  data-live-search="true" id="slcschool" style="margin-bottom:5px; width:100%"><option value="0">აირჩიეთ სკოლა</option>
				</select><br/><br>
				<select class="pale slct" id="slcsubj" style="height: 36px;"><option value="0">აირჩიეთ საგანი</option> <option value="1" <?php if($subject==1) echo 'selected';?>>მათემატიკა</option><option value="2" <?php if($subject==2) echo 'selected';?>>ინგლისური</option><option value="3" <?php if($subject==3) echo 'selected';?>>ქართული</option><option value="5"  <?php if($subject==5) echo 'selected';?>>დაწყებითი</option></select>				
 				<br/>
 				<input type="number" class="pale" id="mob" placeholder="მობილური"> <script> if("<?php echo $mobile?>"!="0")document.getElementById("mob").value = "<?php echo $mobile?>"; </script>
				<input type="text" id="mail" class="pale" placeholder="მეილი" name="mail"> <script> if("<?php echo $mail?>"!="")document.getElementById("mail").value = "<?php echo $mail?>"; </script>
				<input type="password" class="pale" id="password" placeholder="პაროლი" style="font-size: 18px; width: 100%" autocomplete="off">
				<input type="password"  class="pale" id="password2" placeholder="გაიმეორეთ პაროლი" autocomplete="off">
			</div>

			<button class="logbotbut" tabindex="-1" onclick="rgcheckk()" style="width: 383px; border:none">
				რეგისტრაცია
			</button>
		</div>
		<!--<button onclick="location.href = '../logout.php'">
				გამოსვლა
			</button>

		<a id="ntregist" onclick="location.href='login.php'">დარეგისტრირებული ხართ?</a>-->
	</div>
	<script>
		$(document).ready(function(){

			$('#slccity').selectpicker('refresh');
			//{ldschool(<?php echo $user['city'].",";?><?php echo $user['school'];?>);}
			$('#slcschool').selectpicker('refresh');
			ldschool($('#slccity option:selected').val(),<?php echo $user['school'];?>);

			$('#slccity').change(function(){
					ldschool($('#slccity option:selected').val(),<?php echo $user['school'];?>);
					$('#slcschool').selectpicker('refresh');

			});
			$('#slcschool').change(function(){
					ldschool(<?php echo $user['city'];?>,$('#slcschool option:selected').val(),);
					//$('#slcschool').selectpicker('refresh');

			});
			$('#name').geo();
			$('#surname').geo();
			
			setTimeout(function() {
				$('.input-block-level').geo();
			}, 3000);
		});
	</script>
</body>
</html>	