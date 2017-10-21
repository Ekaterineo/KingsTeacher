
<?php
session_start();
$loc="../";
require_once("../php/functions.php");
load();
if(!is_user($id,$username,$hashed))  redirect_to('../login.php');
$cities=get_cities();
$schools=get_schools();
$user=get_all_things($id);
$name=$user['name'];
$username=$user['username'];
$query="SELECT COUNT(*) FROM students WHERE tchid={$id}";
$result=mysqli_query($con,$query) or die(mysqli_error($con));
$res=mysqli_fetch_array($result);
$numstudents=$res[0];

?><!DOCTYPE html>
<html>
<head>
    <style>

        #div1 {
           text-decoration: none;
           color: white;
           font-weight: bold;
           display: inline-block;
           border-right: 30px solid transparent;
           border-bottom: 50px solid #ffb200;
           height: 0;
           line-height: 53px;
           box-sizing: border-box;
           font-size: 20px;
           padding-left: 150px;
        }
    </style>
    <title>მთავარი</title>
    <?php echo incinhead(); echo headerh($id);?>
    <script>
    	cities=JSON.parse('<?php echo json_encode($cities); ?>');
    	schools=JSON.parse('<?php echo json_encode($schools); ?>');
    	usercity='<?php echo $user["city"]; ?>';
    	userschool='<?php echo $user["school"]; ?>';
    </script>
     <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>
    
    

</head>
<body class="bodylogin">
	<div class="main1">
		<div class="toppage">
		</div>
        <div class="explain">
            <p style="font-size: 20px"> ონლაინ პლატფორმა სპეციალურად პედაგოგებისთვის შექმნილი ონლაინ სივრცეა, რომელიც კინგსმა  ერთ-ერთი ყველაზე აქტუალური პრობლემის, ტესტ-ბანკების სიმცირის, მოსაგვარებლად შექმნა.
            პლატფორმაში გაერთიანდა სამი საგანი: ქართული ენა, ინგლისური ენა, მათემატიკა, 12 000-ამდე ტესტური დავალებით, რომელიც 2 ძირითადი მიმართულებით გადანაწილდება:
            </p>
            <br>
            <!---->
            <p style="font-size: 30px; text-align: center"> სკოლის ხაზი </p>
            <br>
            <div>
               <img src="../css/img/1-01.jpg" style="width: 400px; float: left;">
               <ul>
                    <li>  სემესტრის 15 სასწავლო კვირის განმავლობაში თქვენ ყოველკვირეულად მიიღებთ საგაკვეთილო თემატიკის შესაბამის ტესტურ დავალებებს</li>
                    <li> გექნებათ შესაძლებლობა საგაკვეთილო პროცესში დანერგოთ ინფორმაციული საკომუნიკაციო ტექნოლოგიები </li>
                    <li> შეძლებთ სიახლეები შეიტანოთ თქვენი მოსწავლეების სასკოლო ცხოვრებაში, აზიაროთ განათლების მიღების ინოვაციურ მეთოდებს და მათი ყოველდღიური განვითარების პროცესი მეტი ეფექტურობით წარმართოთ </li>
                </ul>
                <div style="clear:both"></div>
            </div>
            <br> <br>
            <p style="font-size: 30px; text-align: center"> ინდივიდუალური ხაზი </p>
            
            <div style="margin-top: 30px;">
                <img src="../css/img/1-02.jpg" style="width: 400px; display: inline-block; float: left;">
                
                <ul style="margin-top: 30px;">
                    <li>  დაგეხმარებათ საჭიროებების მიხედვით მიუდგეთ კონკრეტულ მოსწავლეს</li>
                    <li> პლატფორმაში არსებული ტესტებით, დააგენერიროთ თითოეული მოსწავლის დონის შესაბამისი ტესტი </li>
                    <li> განუვითაროთ და გააძლიეროთ მოსწავლის ის  საგნობრივი მიმართულებები, რომლებშიც მისი ცოდნა ნაკლებად მყარია </li>
                </ul>
                <div style="clear:both"></div>
            </div>
            <br> <br>
            
            </div>
       
	</div>
        <div style="width: 100%;background-color: red">
            <div style="float:left;width:50%;background-color:#02025b; color:white;" id="div1">
                საკონტაქტო ნომერი: 2 30 61 31
            </div>
            <div style="float:left;width:50%;background-color:#02025b;padding-top: 31px;" >
                <img src="../css/facebook-logo-button.svg" class="contact1" id="contacts2" onclick='window.open("https://www.facebook.com/KingsProgram/?fref=ts");'>
                <img src="../css/youtube.svg" class="contact1" onclick='window.open("https://www.youtube.com/user/KingsOlympiad");'> 
            </div>
        </div>

	<!--<?php if($user['city']==0 || $user['school']==0){
		 $xx='<br> <br><select class="slct some1 selectpicker" data-show-subtext="true"  data-live-search="true" id="slccity" style="margin-top:20px" ><option value="0">აირჩიეთ ქალაქი</option>';
    	for($i=1; $i<count($cities)+4; $i++) if($cities[$i][0]!='') {if($user['city']==$cities[$i][0]) $dmt='selected="true"'; else $dmt='';
    	$xx.="<option ".$dmt." value=".$cities[$i][0].">".$cities[$i][1]."</option>";
   		}
    if($user['city']==250) $dmt='selected="true"'; else $dmt=''; 
    $xx.="<option ".$dmt." value='250'>სხვა</option>";
    $xx.='</select><br/><br><select class="slct some2 selectpicker" data-show-subtext="true"  data-live-search="true" id="slcschool" style="margin-bottom:5px; width:100%"><option value="0">აირჩიეთ სკოლა</option></select>';
    $xx.='<button class="logbotbut regbutton" onclick="savect($(\'#slccity option:selected\').val(),$(\'#slcschool option:selected\').val())" style="margin-top:68%">შენახვა</button>';
       echo '<div class="blck"></div><div id="blinfo" class="blinfo2" style="max-width:450px;"><div class="blinfh" style="background:  #1e63b5;"><div class="blinfheader">შეიყვანეთ ქალაქი და სკოლა</div></div><div class="blinfinfo" style="background:white; height:500px">'.$xx.'</div> </div>';
       echo "<script>
		$(document).ready(function(){

			$('#slccity').selectpicker('refresh');
			$('#slcschool').selectpicker('refresh');
			ldschool($('#slccity option:selected').val(),".$user['school'].");
			$('#slccity').change(function(){
					ldschool($('#slccity option:selected').val(),".$user['school'].");
					$('#slcschool').selectpicker('refresh');

			});
			$('#slcschool').change(function(){
					ldschool($('#slccity option:selected').val(),$('#slcschool option:selected').val());
			});			
			setTimeout(function() {
				$('.input-block-level').geo();
			}, 3000);
		});
	</script>";
   /* $('.blck').click(function () {
    $('body').css('overflow','auto');
    $(this).next().remove();
    $(this).remove();
    });*/
	} ?>-->
	
</body>
</html>