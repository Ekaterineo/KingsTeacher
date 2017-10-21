<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if($rnk) redirect_to('admin/home.php');
if(is_user($id,$username,$hashed)) redirect_to('user/home.php');
?><!DOCTYPE html>
<html>
<head>
    <title>შესვლა</title>
    <?php echo incinhead(); ?>
</head>
<body class="bodylogin">
<?php echo headerr0(); ?>
	<div class="main">
		<br>
		<div class="lgcont">
			<div class="logtop">
				დაგავიწყდათ კოდი ან პაროლი?
			</div>
			<p style="text-align:center">შეიყვანეთ რეგისტრაციის დროს მითითებული მობილურის ნომერი და SMS-ის სახით მიიღებთ პროფილში შესვლისთვის საჭირო კოდსა და პაროლს</p>
				
			<div class="logbox">
				+995 <input type="number" style="width: calc(100% - 37px);" id="mob" placeholder="ტელეფონის ნომერი">
			</div>
			<div class="logbot">
				<button class="logbotbut" onclick="reset_password()">გაგზავნა</button>
			</div>
		</div>
		<a id="ntregist" onclick="location.href='login.php'">უკან დაბრუნება</a>
	</div>
	<script>
		$(document).keypress(function(e) {
		    if(e.which == 13) {
		        reset_password();
		    }
		});
		function reset_password(){
			crct=1;
		    var mob = $("#mob").val();
		    $("#mob").removeClass("incrinput");
		    if(mob.length!=9) {$("#mob").addClass('incrinput'); crct=0;}
		    if(mob[0]!=5) {$("#mob").addClass('incrinput'); crct=0;}
		    $("#mob").keydown(function () { $(this).removeClass("incrinput"); });
		    if(crct==0) return;
		    $('.logbotbut').attr('onclick','');
			$.post($loc+"php/reset_passbymob.php", { mob: mob }, function (succ) {
		        //console.log(succ);
		        if (succ == -1) {
		        	location.href="login.php";
		        }
		        else if(succ == 3) {
		        	$('body').append('<div class="blck"></div><div id="blinfo"><div class="blinfh" style="background:#6483d0;"><div class="blinfheader">ნომერი ბაზაში არ მოიძებნა. </div></div></div>'); // დარეკეთ ჩვენს ცხელ ხაზზე: <a style="display: inline-block;">0322 30 62 93</a>
				    $('.blck').click(function () {
		                $('body').css('overflow','auto');
		                $(this).next().remove();
		                $(this).remove();
		            });
				    $('.logbotbut').attr('onclick','reset_password()');
		        }
		        else console.log(succ);
		    });
		}
	</script>
</body>
</html>