<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) redirect_to('../adminlogin.php');
if(!isset($_GET['id'])) redirect_to('questions.php');
$idd=intval($_GET['id']);
$query="SELECT * FROM questions WHERE id={$idd}";
$results=mysqli_query($con,$query);
if(!mysqli_num_rows($results)) redirect_to('questions.php');
$res=mysqli_fetch_array($results);
$chs=unserialize($res['choices']);
//$res['statement']=unserialize($res['statement']);

$cssubj=0;
if(isset($_SESSION['last_subj'])) $cssubj=intval($_SESSION['last_subj']);
$type=$res['type'];
$ristvis=$res['ristvis'];
$cssubj=$res['subject'];
$slctdSchTopic=$res['sch_topic'];
$sch_topics=[];
$sch_topics=get_sch_topics();

$srtlsxl=['აირჩიეთ','მარტივი','საშუალო','რთული'];
/*if($type==1){
	$arswArr=$chs[count($chs)-1];
}*/

$topics=get_sch_topics();
$subtopics=$topics;
for($i=0; $i<count($subtopics); $i++){
	$indx[$sch_topics[$i][0]]=$i;
}

if($res['subject']==1) $stClass=1; else $stClass=2;

$rsgnbrv=['','მათემატიკური','ინგლისური შეცდომა','ქართული შეცდომა','ლოგიკის შეცდომა'];
?><!DOCTYPE html>
<html>
<head>
    <title>კითხვის შეცვლა</title>
    <?php echo incinhead(); ?>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>
    
    <script>
    $topics=JSON.parse('<?php echo json_encode($topics)?>');
    $subtopics=JSON.parse('<?php echo json_encode($subtopics)?>');
    $indx=JSON.parse('<?php echo json_encode($indx)?>');
    $slctdTopic=<?php echo $res['topic']; ?>; 
    $slctdSubtopic=<?php echo $res['subtopic']; ?>;
    $sch_topics=JSON.parse('<?php echo json_encode($sch_topics)?>');
    $slctdSchTopic=<?php echo $slctdSchTopic; ?>;
    </script>
</head>
<body>
<?php echo headerr2($username); ?>
<br/>
	<div class="main">
		<?php
			if($rnk!=6){
				$x='აირჩიეთ საგანი: <select class="slctio" id="chssubj" style="width: 160px;">'; 
				for($i=1; $i<count($subjects); $i++) {
					if((pow(2,$i)&intval($aSubjs))==0) continue;
					if($cssubj==$i) $slc='selected'; else $slc='';
					$x.='<option '.$slc.' value="'.$i.'">'.$subjects[$i].'</option>';
				} 
					echo $x.'</select>&nbsp;&nbsp;&nbsp;&nbsp;';
			}
		?>
		<div id="qrnkselctdiv" style="display: inline-block;">სირთულე: <select class="slctio" id="qrnkselc" style="width: 150px;"><?php $x='<option value="0">აირჩიეთ</option>'; for($i=1; $i<=3; $i++) {if($res['qrnk']==$i) $slc='selected'; else $slc=''; $x.='<option '.$slc.' value="'.$i.'">'.$srtlsxl[$i].'</option>';} echo $x; ?></select> &nbsp;&nbsp;&nbsp;&nbsp;</div>კლასი: <select class="slctio" id="classelc"  style="width: 150px;"><?php for($i=$stClass; $i<=9; $i++) {if($res['class']==$i) echo '<option value="'.$i.'" selected>'.$i.'</option>'; else echo '<option value="'.$i.'">'.$i.'</option>';} { if($res['class']==10) echo '<option value=10 selected>10,11,12</option>'; else echo '<option value=10>10,11,12</option>';} ?></select>&nbsp;&nbsp;&nbsp;&nbsp;კითხვის ტიპი: <select class="slctio" id="tpselc"  style="width: 240px; "><option value="1" <?php if($type==1) echo "selected"?>>სავარაუდო პასუხებით</option><option value="2" <?php if($type==2) echo "selected"?>>ღია</option></select>
		<br> <br> რომელში: <select class="slctio" id="locselc"  style="width: 240px;"><?php if($id!=9) {echo'<option value="1" "selected">სკოლაში</option>';} if($id==9) {echo'<option value="2"'; if($ristvis==2) echo "selected"; echo '>ბანკში</option>';}?></select>
		<br/><br/>თემა: <select class="slctio" id="topicselc" style="width:80%"></select>
		<div id="DvSbtpc">
		</div>
		<br/>
		<textarea class="adtextar shem2" id="adtxt0" placeholder="კითხვა"><?php echo $res['statement']; ?></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(0)"></div></div><hr/>
		<textarea class="adtextar shem2" id="adtxt1" placeholder="სწორი პასუხი"><?php if(isset($chs[0])) echo $chs[0]; ?></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(1)"></div></div>
		<?php
			$x='';
			$i=2;

			while(1){
				if(!isset($chs[$i-1])) break;
				if(is_array($chs[$i-1])) break;
				$dmtb='';
				//if($type==1 && in_array($i-1,$chs[count($chs)-1])) $dmtb='<div class="arswrtar arswrMonishn" id="arswrtar'.$i.'" onclick="esaais('.$i.')">⎕</div>';
				$x.='<div class="savaraudo">';
				if($type!=2) $x.='<textarea class="adtextar shem2" id="adtxt'.$i.'" placeholder="სავარაუდო ვარიანტი">'.$chs[$i-1].'</textarea><div class="ertd">'.$dmtb.'<div class="imgvtar" onclick="opngallery('.$i.')"></div></div>';
				$x.='</div>';

				/*else $x.='<textarea class="adtextar shem2" id="adtxt'.$i.'" placeholder="მინიშნება #'.($i-1).'">'.$chs[$i-1].'</textarea><div class="ertd"><div class="imgvtar" onclick="opngallery('.$i.')"></div></div>';*/
				$i+=1;
			}
			
			$x.='<div class="savaraudo1">';
			for($j=$i; $j<=5; $j++){
				$x.='<textarea class="adtextar shem2" id="adtxt'.$j.'" placeholder="სავარაუდო ვარიანტი"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery('.$j.')"></div></div>';
			}
			$x.='</div>';
			//else $x.='<textarea class="adtextar shem2" id="adtxt'.$i.'" placeholder="მინიშნება #'.($i-1).'"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery('.$i.')"></div></div>';
			
			echo $x;
		?>

		<textarea class="adtextar" id="adaxnsaganm" placeholder="ახსნა-განმარტება" style="width: calc(100% - 45px); border-color:#ffc800; min-height: 100px"><?php echo $res['axsna']?></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(-1)"></div><div class="srchaxsn" onclick="srchAxsna()"></div></div>

		<?php if($rnk==6) {
			$mtckarr=[];
			$rmch=['',' checked '];
			$gdxdl=intval($res['gdxdl']);
			if($gdxdl<0) $gdxdl=0;
			for($i=0; $i<=5; $i++){
				if($gdxdl&pow(2,$i)) $mtckarr[$i]=1; else $mtckarr[$i]=0;
			}
			echo '<input type="checkbox" name="raTpsShecd" class="messageCheckbox" value="0" '.$rmch[$mtckarr[0]].'>გრამატიკული<br/><input type="checkbox" name="raTpsShecd" class="messageCheckbox" value="1" '.$rmch[$mtckarr[1]].'>შინაარსობრივი<br/><input type="checkbox" name="raTpsShecd" class="messageCheckbox" value="2" '.$rmch[$mtckarr[2]].'>წმინდა '.$rsgnbrv[$res['subject']].'<br/><input type="checkbox" name="raTpsShecd" class="messageCheckbox" value="3" '.$rmch[$mtckarr[3]].'>სხვა<br/><input type="checkbox" name="raTpsShecd" class="messageCheckbox" value="4" '.$rmch[$mtckarr[4]].'>ახსნა-განმარტების გაუმართავობა<br/><input type="checkbox" name="raTpsShecd" class="messageCheckbox" value="5" '.$rmch[$mtckarr[5]].'>არაპროგრამული ახსნა-განმარტება<br/>'; 
		}
		if($rnk==6) echo '<textarea class="adtextar" id="shenishvna" placeholder="შენიშვნა" style="width: 100%; border-color: #d064aa !important;"></textarea>'; ?>

		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="addq(2,<?php echo $idd; ?>)">ცვლილებების შენახვა</button></div>
		<script>

		$(function(){
			lstsubj=<?php echo $res['subject'] ?>;
			if(lstsubj==4) $('#qrnkselctdiv').remove();
			updTopcs();
			$("#classelc").change(function () { updTopcs(); });
		});
		if($("#tpselc option:selected").val()==2){
			$('.savaraudo').css({"display":"none"});
					
		}
		else $('.savaraudo').css({"display":"block"});

		if($("#tpselc option:selected").val()==2){
			$('.savaraudo1').css({"display":"none"});
					
		}
		else $('.savaraudo1').css({"display":"block"});
		$(document).ready(function(){
			$("#tpselc").change(function(){
				if($("#tpselc option:selected").val()==2){
					$('.savaraudo').css({"display":"none"});
					$('.savaraudo1').css({"display":"none"});
					console.log("none");
					
				}
				else {
					$('.savaraudo').css({"display":"block"});
					$('.savaraudo1').css({"display":"block"});
				}
			});
		});
		</script>
</body>
</html>