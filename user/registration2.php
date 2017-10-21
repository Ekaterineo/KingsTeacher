<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
//$rnk=is_admin($id,$username,$hashed);
//if($rnk) redirect_to('admin/home.php');
if(is_user($id,$username,$hashed)) redirect_to('home.php');
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
?><!DOCTYPE html>
<html>
<head>
    <title>რეგისტრაცია</title>
    <?php echo incinhead(); echo headerr0(); ?>
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

				<input type="text" class="pale" id="name" placeholder="სახელი">  
				<input type="text" class="pale" id="surname" placeholder="გვარი"> 
				<select class="slct some1 selectpicker" data-show-subtext="true"  data-live-search="true" id="slccity" ><option value="0">აირჩიეთ ქალაქი</option>
				<?php for($i=1; $i<count($cities)+4; $i++) {$dmt=''; if($cities[$i][1]!="") echo "<option {$dmt} value='{$cities[$i][0]}'>{$cities[$i][1]}</option>";} if($user['city']==250) $dmt='selected="true"'; else $dmt=''; echo "<option {$dmt} value='250'>სხვა</option>"; ?> 
				</select><br/><br>
				<select class="slct some2 selectpicker" data-show-subtext="true"  data-live-search="true" id="slcschool" style="margin-bottom:5px; width:100%"><option value="0">აირჩიეთ სკოლა</option>
				</select><br/><br>
				<select class="pale slct" id="slcsubj" style="height: 36px;"><option value="0">აირჩიეთ საგანი</option> <option value="1" >მათემატიკა</option><option value="2" >ინგლისური</option><option value="3">ქართული</option><option value="5">დაწყებითი</option></select>				
 				<br/>
 				<input type="number" class="pale" id="mob" placeholder="მობილური"> 
				<!--<input type="text" id="mail" class="pale" placeholder="მეილი" name="mail">
				<input type="password" class="pale" id="password" placeholder="პაროლი" autocomplete="off" style="font-size: 18px; width: 100%">
				<input type="password"  class="pale" id="password2" placeholder="გაიმეორეთ პაროლი" autocomplete="off">--> 
			</div>

			<button class="logbotbut regbutton" tabindex="-1" onclick="rgcheckk(1)">
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
			$('#slcschool').selectpicker('refresh');

			$('#slccity').change(function(){
					ldschool($('#slccity option:selected').val(),<?php echo $user['school'];?>);
					$('#slcschool').selectpicker('refresh');

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