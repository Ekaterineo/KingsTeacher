<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
if(!is_user($id,$username,$hashed)) redirect_to('../login.php');
$lstdate='';
if(isset($_SESSION['last_date'])) $lstdate=strval($_SESSION['last_date']);
if(isset($_GET['subj'])) $lstsubj=intval($_GET['subj']); else $lstsubj=1;
$query="SELECT id,subject,statement,class,choices,topic,subtopic FROM questions WHERE ristvis!=2";
$results=mysqli_query($con,$query) or die(mysqli_error($con));
$arvici=array();
$ds=array();
$ds[1]=array();
$ds[2]=array();
$ds[3]=array();
$tpcs=[];
$mytopics=get_sch_topics2();
while($res=mysqli_fetch_array($results)){
$res['choices']=unserialize($res['choices']);
	$ds[intval($res['subject'])][]=[$res['id'],strval($res['statement']),intval($res['class']),$res['choices'],1];
	//$indd=-1;
	if(isset($mytopics[$res['subtopic']])){
		if($res['subtopic']!=0){
			echo "indd=";
			echo $mytopics[1][0];
			if(empty($tpcs[$res['subtopic']][0])){
				$indd=$mytopics[$res['subtopic']][4];
				$tpcs[$indd][]=$res['subtopic'];
			}
			$tpcs[$res['subtopic']][0][]=$res['id'];
			
		}
		else{
			if($res['topic']!=0)
				$tpcs[$res['topic']][0][]=$res['id'];
		}
	}


}
//print_r($tpcs[11]);
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

$sch_topics=[];
$sch_topics=get_sch_topics();
$subtopics=$sch_topics;
$indx=[];
$indx[0]=-1;
for($i=0; $i<count($subtopics); $i++){
	$indx[$sch_topics[$i][0]]=$i;
}

$stClass=2; $enClass=9;
?><!DOCTYPE html>
<html>
<head>
    <title>ტესტის დამატება</title>
    <?php echo incinhead(); ?>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>
    <script>
   		qvst=JSON.parse('<?php echo json_encode($ds);?>');
   		topcs=JSON.parse('<?php echo json_encode($tpcs);?>');
   		$topics=JSON.parse('<?php echo json_encode($topics)?>');
	    $subtopics=JSON.parse('<?php echo json_encode($subtopics)?>');
	    $indx=JSON.parse('<?php echo json_encode($indx)?>');
	    $slctdTopic=<?php echo $slctdTopic; ?>;
	    $slctdSubtopic=<?php echo $slctdSubtopic; ?>;
	    $sch_topics=JSON.parse('<?php echo json_encode($sch_topics)?>');
	    $slctdSchTopic=<?php echo $slctdSchTopic; ?>;

    </script>
</head>
<body>
<?php echo headerr(); ?>
<br/>
	<div class="main">
		<!--საგანი: <select class="slctio" id="chssubj" style="width: 160px;"><option value="1" <?php if($lstsubj==1) echo 'selected';?>>მათემატიკა</option><option value="2" <?php if($lstsubj==2) echo 'selected';?> >ინგლისური</option><option value="3" <?php if($lstsubj==3) echo 'selected';?> >ქართული</option></select>
		--><br/>
		<?php
			
			$x='საგანი: <select class="slctio" id="chssubj" style="width: 160px;">'; 
			for($i=1; $i<count($subjects); $i++) {
				
				//if((pow(2,$i)&intval($aSubjs))==0){ echo intval($aSubjs)." "; continue;}
				if($cssubj==$i) $slc='selected'; else $slc='';
				$x.='<option '.$slc.' value="'.$i.'">'.$subjects[$i].'</option>';
			} 
				echo $x.'</select>&nbsp;&nbsp;&nbsp;&nbsp;';
		?>
		<br/> <br/>
		კლასი: <select class="slctio" id="classelc"  style="width: 150px;"><?php for($i=$stClass; $i<=$enClass; $i++) if($slctdClass==$i) echo '<option value="'.$i.'" selected>'.$i.'</option>'; else echo '<option value="'.$i.'">'.$i.'</option>'; ?></select>
		<br/><br/>
		თემა: <select class="slctio" id="topicselc" style="width:80%"></select>
		<br/><div id="DvSbtpc"></div>
		<!--გაშვების თარიღი: <input type="text" id="dtpicker" class="dtpckrrs" value="<?php echo $lstdate; ?>"/><br/><br/>-->
		<div id="qvstns">
		</div>
		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="addt2()">შექმნა</button></div>
		<script>

			lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
			
			$(document).ready(function(){
				$('#chssubj').change(function(){
					lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
				});
				$('#classelc').change(function(){
					lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
				});
				$('#topicselc').change(function(){
					lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
				});
			});

			$(function(){
				lstsubj=<?php if($aSubjs&($aSubjs-1)) echo '$("#chssubj option:selected").val()'; else echo $lstsubj; ?>;
				console.log("lstsubj=",lstsubj);
				updTopcs();
				str='#chssubj,#classelc'; if($('#chssubj').length==0) str='#classelc';
				$(""+str).change(function () { 
					updTopcs();
					if($('#chssubj').length==0) nnsubj=lstsubj;
					else nnsubj=$("#chssubj option:selected").val();
					if(nnsubj!=lstsubj && (nnsubj==4)) updsheskvn(nnsubj);
					lstsubj=nnsubj;
				});
			});

           // $('#dtpicker').datepicker({dateFormat: "yy-mm-dd"});
		</script>
</body>
</html>