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
$que="SELECT subject FROM usert WHERE id={$id} AND username={$username}";
$resultebio=mysqli_query($con,$que) or die(mysqli_error($con));
$resebio=mysqli_fetch_array($resultebio);
$subjj=$resebio[0];
$query="SELECT id, name, subj,class,parent FROM sch_topics";
$results=mysqli_query($con,$query) or die(mysqli_error($con));
while($res=mysqli_fetch_array($results)){
	$topicsarray[$res['subj']][$res['class']][$res['parent']][]=$res['id'];

}
$query="SELECT id,subject,statement,class,choices,topic,subtopic FROM questions WHERE ristvis=0";
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
	$ds[intval($res['subject'])][]=[$res['id'],strval($res['statement']),intval($res['class']),$res['choices'],1,$res['topic'],$res['subtopic']];
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

//$topics=get_topics();

$sch_topics=[];
$sch_topics=get_sch_topics();
$subtopics=$sch_topics;
$indx=[];
$indx[0]=-1;
for($i=0; $i<count($subtopics); $i++){
	$indx[$sch_topics[$i][0]]=$i;
}

$stClass=2; $enClass=10;
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
    	topicsarray=JSON.parse('<?php echo json_encode($topicsarray);?>')
   		qvst=JSON.parse('<?php echo json_encode($ds);?>');
   		topcs=JSON.parse('<?php echo json_encode($tpcs);?>');
	    $subtopics=JSON.parse('<?php echo json_encode($subtopics)?>');
	    $indx=JSON.parse('<?php echo json_encode($indx)?>');
	    $slctdTopic=<?php echo $slctdTopic; ?>;
	    $slctdSubtopic=<?php echo $slctdSubtopic; ?>;
	    $sch_topics=JSON.parse('<?php echo json_encode($sch_topics)?>');
	    $slctdSchTopic=<?php echo $slctdSchTopic; ?>;

    </script>
</head>
<body style="background-image: url(../css/pattern.png); background-repeat: repeat; background-color: white;">
<?php echo headerr3(); ?>
<br/>
	<div class="main">
		<br/>
	
		<div id="chosehead" style="margin-top: 4%;">
			<center>
				<?php
					
					$x='<div style="display: inline-block; font-size: 22px">საგანი: &nbsp;&nbsp; </div><select class="slctio" id="chssubj" style="width: 175px; ">'; 
					for($i=1; $i<count($subjects); $i++) {
						
						if($i!=$subjj && $subjj!=5){continue;}
						else{
							if($cssubj==$i) $slc='selected'; else $slc='';
							$x.='<option '.$slc.' value="'.$i.'">'.$subjects[$i].'</option>';
						}
					} 
						echo $x.'</select>&nbsp;&nbsp;&nbsp;&nbsp;';
				?> &nbsp;&nbsp;&nbsp;
				 <div style="display: inline-block; font-size: 22px"> კლასი: &nbsp;&nbsp; </div><select class="slctio" id="classelc"  style="width: 175px;"><?php for($i=$stClass; $i<=$enClass; $i++) if($slctdClass==$i) echo '<option value="'.$i.'" selected>'.$i.'</option>'; else echo '<option value="'.$i.'">'.$i.'</option>'; if($slctdClass!=10) {echo "<option value=10 >10,11,12</option>";} else {echo "<option value=10 selected>10,11,12</option>";} ?>?></select>
				 <br/>
				 <div style="display: inline-block; font-size: 22px"> თემა: </div> <select class="slctio" id="topicselc" style="width:80%; margin-top:5px"></select>
				<br/><div id="DvSbtpc"></div>
				<br/><br/>
				<br/><br/>
			</center>
		</div>	

		<div id="qvstns" class="kitxvebi">
		</div>
	
	
		<div class="mytest">
			<div class='mytestname' style="width: 100%">
				<center><input class="inpname" id="inptname" placeholder="შეიყვანეთ ტესტის სახელი"> </input></center>
				
			</div> 
			<div id="myqvstns">
			</div>
		</div>
		<center><div id="savetest" onclick="addt2()" style="cursor: pointer;"> ტესტის შექმნა </div></center>
		<!--<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="addt2()">შექმნა</button></div>-->

				<!--<?php echo $aSubjs&($aSubjs-1);?>-->
		<script>

			$(function(){
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
			});
			lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
			
			$(document).ready(function(){
				$("#tpselc").change(function(){
					if($("#tpselc option:selected").val()==2){
						$('#savaraudo').css({"display":"none"});
						
					}
					else $('#savaraudo').css({"display":"block"});
				});
				pckd=$('#chssubj option:selected').val();
				pckd2=$('#classelc option:selected').val();
				$('#chssubj').change(function(){
				if($('.chsselected').length!=0){
						if(confirm("დარწმუნებული ხართ რომ გსურთ საგნის შეცვლა? თქვენს მიერ არჩეული კითხვები არ შეინახება")){
							$('.kitxvebi').html('');
							$('#myqvstns').html('');
							n=1;
							lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
						}
						else{
							$('#chssubj').val(pckd);
						}
				}
				else {
					lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
				}
				});
				$('#classelc').change(function(){
					console.log()
					if($('.chsselected').length!=0){
						if(confirm("დარწმუნებული ხართ რომ გსურთ კლასის შეცვლა? თქვენს მიერ არჩეული კითხვები არ შეინახება")){
							$('.kitxvebi').html('');
							$('#myqvstns').html('');
							n=1;
							lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
						}
						else{
							$('#classelc').val(pckd2);
						}
					}
					else{
						lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val());
					}
				});
				$('#topicselc').change(function(){
					lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val(),$('#topicselc option:selected').val());
				});
				
			});

		</script>
</body>
</html>