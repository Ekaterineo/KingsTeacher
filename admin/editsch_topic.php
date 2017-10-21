<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) redirect_to('../adminlogin.php');
if(!isset($_GET['id'])) redirect_to('sch_topics.php');
$idd=intval($_GET['id']);
$query="SELECT * FROM sch_topics WHERE id={$idd}";
$results=mysqli_query($con,$query);
if(!mysqli_num_rows($results)) redirect_to('sch_topics.php');
$qs=array();
$res=mysqli_fetch_array($results, MYSQLI_ASSOC);
$slctdSchTopic=$res['parent']; 
$cssubj=$res['subj'];
$sch_topics=get_sch_topics();
$slctdClass=$res['class'];
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
		კლასი: <select class="slctio" id="classelc"  style="width: 150px;"><?php for($i=2; $i<=9; $i++) if($slctdClass==$i) echo '<option value="'.$i.'" selected>'.$i.'</option>'; else echo '<option value="'.$i.'">'.$i.'</option>'; ?></select>
		<br/><br/>მშობელი თემა: <select class="selectpicker slcpccc" data-show-subtext="true" data-live-search="true" id="sch_topicselc" style="width:80%"></select>

		<textarea class="adtextar shem2" id="adtxt0" style="width: 100%" placeholder="სახელი"><?php echo $res['name']; ?></textarea>
		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="addsch_topic(2,<?php echo $idd; ?>)">თემის დამატება</button></div>
		<script>
		$(function(){
			lstsubj=<?php echo $res['subj'] ?>;
			updSchTopcs();
			str='#classelc';
			$(""+str).change(function () { 
				updSchTopcs();
			});
		});
		</script>
</body>
</html>