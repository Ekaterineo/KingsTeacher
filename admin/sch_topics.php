<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) redirect_to('../adminlogin.php');

$cls=0;
if(isset($_GET['class'])){
	$cls=intval($_GET['class']);
	if($cls<2 || $cls>10) $cls=0;
	else $_SESSION['last_class']=$cls;
}
else if(isset($_SESSION['last_class'])) $cls=intval($_SESSION['last_class']);
if($cls<2 || $cls>10) $cls=0;
if($cls==0) $cls=2;

$cSubj=-1;
if($aSubjs&($aSubjs-1)==0) $cSubj=log($aSubjs,2);
else if(isset($_GET['subj'])){
	if(isset($_GET['subj']) && pow(intval($_GET['subj']),2)&$aSubjs) $cSubj=intval($_GET['subj']);
}
else if(isset($_SESSION['last_subj']))
	if(pow(intval($_SESSION['last_subj']),2)&$aSubjs) $cSubj=intval($_SESSION['last_subj']);

if($cSubj==-1) $cSubj=gt_first_subj($aSubjs);
$_SESSION['last_subj']=$cSubj;



$tpck="topic"; if($cSubj==16) $tpck='week';


$dmt1='subj='.$cSubj.' ';
if($cls!=0) {if($dmt1!='') $dmt1.='AND '; $dmt1.=" class={$cls} ";}

$query="SELECT * FROM sch_topics WHERE {$dmt1} ORDER BY id DESC";
//echo $query;
$results=mysqli_query($con,$query) or die(mysqli_error($con));

$sch_topics=get_sch_topics($cls);

?><!DOCTYPE html>
<html>
<head>
    <title>კითხვები</title>
    <?php echo incinhead(); ?>
    <style>
    .djClst{
    width: 100%;
    margin: 15px 0;
    border-radius: 5px;
    box-shadow: rgba(0, 0, 0, 0.39) 0 2px 7px;
    overflow: hidden;
    }
    .djClst{
	    background: #fff;
    }
    .djTpc{
    vertical-align: top;
    margin: 0 10px;
    width: 80px;
    }
    .djClsheader{
    	padding: 5px 10px;
    font-size: 19px;
	    background: #ededed;
	    display: block;
    }
    </style>
    <script>
	    tstbnk=1;
	    cSubj=<?php echo $cSubj; ?>;
	    $sch_topics=JSON.parse('<?php echo json_encode($sch_topics)?>');
    </script>
</head>
<body>
<?php echo headerr2($username); ?>
<br/>
	<div class="main">
		<div style="text-align: center; margin-bottom:10px; <?php if($rnk==6) echo 'display: none;';?>"><button class="addbutton" onclick="location.href='addsch_topic.php'">თემის დამატება</button></div>
		<?php
			if($aSubjs&($aSubjs-1)){
				$x='';
				$x='აირჩიეთ საგანი: <select class="slctio" id="chssubj" style="width: 160px;">'; 
				for($i=1; $i<count($subjects); $i++) {if($i==4) continue; if((pow(2,$i)&intval($aSubjs))==0) continue; if($cSubj==$i) $slc='selected'; else $slc=''; $x.='<option '.$slc.' value="'.$i.'">'.$subjects[$i].'</option>';} echo $x.'</select><br/><br/>';
			}
		?>
		<select class="slctio" id="chsclass"><option value="0">აირჩიეთ კლასი</option><?php for($i=2; $i<=9; $i++){$dmt=''; if($cls==$i) $dmt='selected'; echo '<option value="'.$i.'" '.$dmt.'>'.$i.'</option>'; }
		$dmt=''; if($cls==10) $dmt='selected'; echo '<option value=10 '.$dmt.'>10,11,12</option>'; ?></select>
		<div>
		<div id="schtpcssdiv">

		</div>
	</div>

	<script>
		$("#chsclass").change(function(){
			location.href='sch_topics.php?subj='+cSubj+'&class='+$("#chsclass option:selected").val();
		});
		$('#chssubj').change(function(){
			location.href='sch_topics.php?subj='+$("#chssubj option:selected").val();
		});
		$('#schtpcssdiv').html(gtwrtsch_topics(<?php echo $cls ?>, 0));
	</script>
</body>
</html>