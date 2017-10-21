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
$slctdSchTopic=0;
if(isset($_SESSION['last_sch_topic'])) $slctdSchTopic=intval($_SESSION['last_sch_topic']);

$sch_topics=get_sch_topics();
?><!DOCTYPE html>
<html>
<head>
    <title>თემის დამატება</title>
    <?php echo incinhead(); ?>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>

    <script>
    $sch_topics=JSON.parse('<?php echo json_encode($sch_topics)?>');
    $slctdSchTopic=<?php echo $slctdSchTopic; ?>;
    </script>
</head>
<body>
<?php echo headerr2($username); ?>
<br/>
	<div class="main">
		<?php 
		if($aSubjs&($aSubjs-1)){
			$x='აირჩიეთ საგანი: <select class="slctio" id="chssubj" style="width: 160px;">'; 
			for($i=1; $i<count($subjects); $i++) {if((pow(2,$i)&intval($aSubjs))==0) continue; if($cssubj==$i) $slc='selected'; else $slc=''; $x.='<option '.$slc.' value="'.$i.'">'.$subjects[$i].'</option>';} echo $x.'</select>&nbsp;&nbsp;&nbsp;&nbsp;';
			}
		?>
		კლასი: <select class="slctio" id="classelc"  style="width: 150px;"><?php for($i=2; $i<=9; $i++) if($slctdClass==$i) echo '<option value="'.$i.'" selected>'.$i.'</option>'; else echo '<option value="'.$i.'">'.$i.'</option>';
		 if($slctdClass==10) echo '<option value=10 selected>10,11,12</option>'; else echo '<option value=10>10,11,12</option>'; ?></select>
		<br/><br/>მშობელი თემა: <select class="selectpicker slcpccc" data-show-subtext="true" data-live-search="true" id="sch_topicselc" style="width:80%"></select>

		<textarea class="adtextar shem2" id="adtxt0" style="width: 100%" placeholder="სახელი"></textarea>
		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="addsch_topic(1,undefined)">თემის დამატება</button></div>
		<script>
		$(function(){
			lstsubj=<?php if($aSubjs&($aSubjs-1)) echo '$("#chssubj option:selected").val()'; else echo log($aSubjs,2); ?>;
			updSchTopcs();
			str='#classelc';
			$(""+str).change(function () { 
				updSchTopcs();
			});
		});
		</script>
</body>
</html>