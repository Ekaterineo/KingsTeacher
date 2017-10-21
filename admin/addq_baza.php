<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) redirect_to('../adminlogin.php');
$cssubj=0;
if(isset($_SESSION['last_subj'])) $cssubj=intval($_SESSION['last_subj']);

$slctdClass=0;
if(isset($_SESSION['last_class'])) $slctdClass=intval($_SESSION['last_class']);
$slctdTopic=0;
if(isset($_SESSION['last_topic'])) $slctdTopic=intval($_SESSION['last_topic']);
$slctdSubtopic=0;
if(isset($_SESSION['last_subtopic'])) $slctdSubtopic=intval($_SESSION['last_subtopic']);

$tstbnk=0;
if(isset($_GET['qbnk'])) $tstbnk=intval($_GET['qbnk']);

$slctdSchTopic=0;
if(isset($_SESSION['last_sch_topic'])) $slctdSchTopic=intval($_SESSION['last_sch_topic']);

$topics=get_topics();
//$subtopics=get_sub_topics();

$sch_topics=[];
$sch_topics=get_sch_topics();
$subtopics=$sch_topics;
$indx=[];
$indx[0]=-1;
for($i=0; $i<count($subtopics); $i++){
	$indx[$sch_topics[$i][0]]=$i;
}

/*if(($aSubjs&2)>0 && $tstbnk==0) {$stClass=1; $enClass=8;} else {*/
$stClass=2; $enClass=9;
?><!DOCTYPE html>
<html>
<head>
    <title>კითხვის დამატება</title>


    <?php echo incinhead(); ?>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>

    <script>
    $topics=JSON.parse('<?php echo json_encode($topics)?>');
    $subtopics=JSON.parse('<?php echo json_encode($subtopics)?>');
    $indx=JSON.parse('<?php echo json_encode($indx)?>');
    $slctdTopic=<?php echo $slctdTopic; ?>;
    $slctdSubtopic=<?php echo $slctdSubtopic; ?>;
    <?php if(isset($_GET['qbnk'])) echo 'tstbnk='.intval($_GET['qbnk']).';';?>
    $sch_topics=JSON.parse('<?php echo json_encode($sch_topics)?>');
    $slctdSchTopic=<?php echo $slctdSchTopic; ?>;
    </script>
</head>
<body>
<?php echo headerr2(); ?>
<br/>
	<div class="main">
		<?php
			
			$x='აირჩიეთ საგანი: <select class="slctio" id="chssubj" style="width: 160px;">'; 
			for($i=1; $i<count($subjects); $i++) {
				if((pow(2,$i)&intval($aSubjs))==0) continue;
				if($cssubj==$i) $slc='selected'; else $slc='';
				$x.='<option '.$slc.' value="'.$i.'">'.$subjects[$i].'</option>';
			} 
				echo $x.'</select>&nbsp;&nbsp;&nbsp;&nbsp;';
		?>
		<div id="qrnkselctdiv" style="display: inline-block;">სირთულე: <select class="slctio" id="qrnkselc"  style="width: 150px;"><option value="0">აირჩიეთ</option><option value="1">მარტივი</option><option value="2">საშუალო</option><option value="3">რთული</option></select></div> &nbsp;&nbsp;&nbsp;&nbsp;კლასი: <select class="slctio" id="classelc"  style="width: 150px;"><?php for($i=$stClass; $i<=$enClass; $i++) if($slctdClass==$i) echo '<option value="'.$i.'" selected>'.$i.'</option>'; else echo '<option value="'.$i.'">'.$i.'</option>'; ?></select>
		&nbsp;&nbsp;&nbsp;&nbsp; კითხვის ტიპი: <select class="slctio" id="tpselc"  style="width: 240px;"><option value="1">სავარაუდო პასუხებით</option><option value="2">ღია</option></select>
		<!--<br/><br/>წიგნის თემა: <div id="wgntmSlctDiv" style="display:inline-block"><select class="selectpicker slcpccc" data-show-subtext="true" data-live-search="true" id="sch_topicselc"></select></div>-->
		<div id="KtxvDiv">

		</div>

		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="addq(1,undefined)">კითხვის გამოქვეყნება</button></div>
		<script>
		/*$(function(){
			lstsubj=<?php if($aSubjs&($aSubjs-1)) echo '$("#chssubj option:selected").val()'; else echo log($aSubjs,2); ?>;
			updTopcs();
			if(lstsubj==4) updsheskvn(lstsubj);
			//updsheskvn(lstsubj);
			str='#chssubj,#classelc'; if($('#chssubj').length==0) str='#classelc';
			$(""+str).change(function () { 
				updTopcs();
				if($('#chssubj').length==0) nnsubj=lstsubj;
				else nnsubj=$("#chssubj option:selected").val();
				if(nnsubj!=lstsubj && (nnsubj==4)) updsheskvn(nnsubj);
				lstsubj=nnsubj;
			});
		});*/
		$(document).ready(function(){
			updsheskvn($("#chssubj option:selected").val(),$("#tpselc option:selected").val());
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