<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) redirect_to('../adminlogin.php');
$page=1;
if(isset($_GET['page'])){
    $page=intval($_GET['page']);
}

$auth=0;
if(isset($_GET['auth']) && $_GET['auth']==1) $auth=1;

$cls=0;
$tpc=-1;
$qrn=-1;
if(isset($_GET['class'])){
	$cls=intval($_GET['class']);
	if($cls<2 || $cls>9) $cls=0;
}
if(isset($_GET['topic'])) $tpc=intval($_GET['topic']);
if(isset($_GET['qrnk'])) $qrn=intval($_GET['qrnk']);

$cSubj=-1;
if($aSubjs&($aSubjs-1)==0) $cSubj=log($aSubjs,2);
else 
if(isset($_GET['subj'])){
	if(isset($_GET['subj']) && pow(intval($_GET['subj']),2)&$aSubjs) $cSubj=intval($_GET['subj']);
}
else if(isset($_SESSION['last_subj']))
	if(pow(intval($_SESSION['last_subj']),2)&$aSubjs) $cSubj=intval($_SESSION['last_subj']);

if($cSubj==-1) $cSubj=gt_first_subj($aSubjs);
$_SESSION['last_subj']=$cSubj;


$lmtt=100;
$offst=($page-1)*$lmtt;


$tpck="topic"; 


$dmt1='subject='.$cSubj.' ';
if($id!=2) {if($auth==0) $dmt1.="AND author={$id} "; else $dmt1.="AND author!={$id} "; }
if($cls!=0) {if($dmt1!='') $dmt1.='AND '; $dmt1.=" class={$cls} ";}
if($tpc!=-1) {if($dmt1!='') $dmt1.='AND '; $dmt1.=" {$tpck}={$tpc} ";}
if($qrn!=-1) {if($dmt1!='') $dmt1.='AND '; $dmt1.=" qrnk={$qrn} ";}


$query="SELECT * FROM questions_baza WHERE {$dmt1}  ORDER BY id DESC LIMIT {$lmtt} OFFSET {$offst}";
//echo $query;
$results=mysqli_query($con,$query) or die(mysqli_error($con));


$queryN="SELECT COUNT(*) FROM questions_baza WHERE {$dmt1}";
$resultsN=mysqli_query($con,$queryN) or die(mysqli_error($con));
$Num_of_questions=mysqli_fetch_array($resultsN)[0];


$dmt2='';
if($cls!=0) $dmt2="AND class={$cls}";


$query2="SELECT class,qrnk,COUNT(*) FROM questions_baza WHERE subject={$cSubj} {$dmt2} GROUP BY class,qrnk ORDER BY class ASC, qrnk ASC";
$results2=mysqli_query($con,$query2) or die(mysqli_error($con));


$dascls=[];
$sull=[];
$gdxdl=[];

$stClass=2;
for($i=$stClass; $i<=9; $i++){
	$query3="SELECT COUNT(*) FROM questions_baza WHERE class={$i} AND subject={$cSubj} AND axsna=''";
	$results3=mysqli_query($con,$query3) or die(mysqli_error($con));
	$res=mysqli_fetch_array($results3);
	$dascls[$i]=$res[0];

	$query3="SELECT COUNT(*) FROM questions_baza WHERE class={$i} AND subject={$cSubj}";
	$results3=mysqli_query($con,$query3) or die(mysqli_error($con));
	$res=mysqli_fetch_array($results3);
	$sull[$i]=$res[0];

	if($rnk==6){
		$query3="SELECT COUNT(*) FROM questions_baza WHERE class={$i} AND subject={$cSubj} AND gdxdl!=0 AND gdxdl!=-2";
		$results3=mysqli_query($con,$query3) or die(mysqli_error($con));
		$res=mysqli_fetch_array($results3);
		$gdxdl[$i]=$res[0];
	}
}

if($rnk==5){
$queryS="SELECT COUNT(*) FROM shenishvnebi INNER JOIN questions_baza ON questions_baza.id=shenishvnebi.qid WHERE seen=0 AND subject={$cSubj} AND author={$id}";
	$resultsS=mysqli_query($con,$queryS) or die(mysqli_error($con));
	$res=mysqli_fetch_array($resultsS);
	$Shenishv=intval($res[0]);
}


$topics=get_topics();
$topics[0]=[0,'უთემო'];


if($rnk==5){
	$resultsStt1=mysqli_query($con,"SELECT author, COUNT(*) FROM questions_baza WHERE subject={$cSubj} GROUP BY author") or die(mysqli_error($con));
	$sullKtx=0; $chmKtx=0;
	while($resStt=mysqli_fetch_array($resultsStt1)){
		$sullKtx+=$resStt[1];
		if($resStt[0]==$id) $chmKtx+=$resStt[1];
	}
	$dgTime=strtotime('today');
	$resultsStt2=mysqli_query($con,"SELECT COUNT(*) FROM questions_baza WHERE author={$id} AND subject={$cSubj} AND addedTime>={$dgTime}") or die(mysqli_error($con));
	$dgRamdn=mysqli_fetch_array($resultsStt2)[0];
}


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
    .StkA{
    	font-size:20px;
    	padding: 10px 15px;
    	background: #ccc;
    	margin-top: 20px;
    	border-radius: 5px; 
    	cursor: pointer;
    }
    </style>
    <script>
	    tstbnk=1;
	    cSubj=<?php echo $cSubj; ?>;
    </script>
</head>
<body>
<?php echo headerr2(); ?>
<br/>
	<div class="main">
		<div style="text-align: center; margin-bottom:10px; <?php if($rnk==6) echo 'display: none;';?>"><button class="addbutton" onclick="location.href='addq_baza.php'">კითხვის დამატება</button></div>

		<?php
		if($rnk==5){
			$x='';
			$x.='<div class="AdmnStatCont">';
			$x.='<div class="AdmnStatDv">';
			$x.='<div>';
			$x.='<a>დღეს დავამატე <b>'.$dgRamdn.'</b> კითხვა</a>';
			$x.='</div>';
			$x.='<div class="AdminPrgrCont"><div class="AdmnPrgrs" style="width:'.min(($dgRamdn/0.35),100).'%"><div class="AdmnPrgrsInner"></div></div><div class="AdminPrgShadow"></div></div>';
			$x.='</div>';
			$x.='<div class="AdmnStatDv">';
			$x.='<div>';
			if($sullKtx==0) $sullKtx=1;
			$x.='<a>კითხვების <b>'.min((round(($chmKtx/$sullKtx)*1000)/10),100).'%</b> ჩემია</a>';
			$x.='</div>';
			$x.='<div class="AdminPrgrCont"><div class="AdmnPrgrs" style="width:'.min(($chmKtx/$sullKtx)*100,100).'%"><div class="AdmnPrgrsInner"></div></div><div class="AdminPrgShadow"></div></div>';
			$x.='</div>';
			$x.='</div>';
			echo $x;
			$x='';
		}
		?>


		<?php
			if($aSubjs&($aSubjs-1)){
				$x='';
				$x='აირჩიეთ საგანი: <select class="slctio" id="chssubj" style="width: 160px;">'; 
				for($i=1; $i<count($subjects); $i++) {if((pow(2,$i)&intval($aSubjs))==0) continue; if($cSubj==$i) $slc='selected'; else $slc=''; $x.='<option '.$slc.' value="'.$i.'">'.$subjects[$i].'</option>';} echo $x.'</select><br/><br/>';
			}
		?>
		<select class="slctio" id="chsclass"><option value="0">აირჩიეთ კლასი</option><?php for($i=$stClass; $i<=9; $i++){$dmt=''; if($cls==$i) $dmt='selected'; echo '<option value="'.$i.'" '.$dmt.'>'.$i.'</option>'; }?></select>
		<div>
		<?php
			if($rnk==5){
				$xx='<div class="shnnshvnb '; if($Shenishv>0) $xx.='shenishvaqtr'; $xx.='" onclick="opnshenshvktxvb('.$cSubj.')">';
				$xx.='შენიშვნები';
				$xx.='<a>'.$Shenishv.' ახალი</a>';
				$xx.='</div>';
				echo $xx;
			}
		?>
			<?php
			if($rnk!=0){ //ეს ისე
				$xx='<div class="StkA" onclick="rglStstk()">სტატისტიკა<img src="../css/arrow-down.svg" style="float:right; width:30px"></div><div id="StstkDv">';
				$winakls=0;
				$winatopic=-1;
				$shevida=0;
				while($res=mysqli_fetch_array($results2)){
					$shevida=1;
					$sheicvClass=0;
					if($winakls!=$res[0]) {
						$dmtt=''; if($rnk==6) $dmtt=' ('.$gdxdl[$res[0]].' გადახედილი)';
						if($winakls) $xx.='</div></div>'; $xx.='<div class="djClst"><div class="djClsheader">'.$res[0].' კლასი - '.($dascls[$res[0]]).' კითხვა ახსნის გარეშე (<b>'.$sull[$res[0]].'</b>-დან) '.$dmtt.'</div>'; $winakls=$res[0]; $sheicvClass=1;}
					if($winatopic!=$res[1]) {if($winatopic!=-1 && !$sheicvClass) $xx.='</div>'; $xx.='<div style="display:inline-block" class="djTpc">'.$topics[$res[1]][1].''; $winatopic=$res[1];}
					$xx.='<li><a href="questions.php?subj='.$cSubj.'&topic='.$res[1].'&qrnk='.$res[2].'">'.$res[2].' - '.$res[3].'</a></li>';

				}
				if($shevida){
					$xx.='</div>';
					$xx.='</div>';
				} else $xx='';
				echo $xx;
			}
			?>
		</div>
		<br/>
		<table class="mmdtbl">
			<thead>
				<tr>
					<th>კითხვა</th>
					<th>კლასი</th>
					<th><?php if($rnk==5) echo 'გდხდლ'; else echo 'ახსნა';?></th>
					<!--<?php if($rnk==6 && $cSubj==1) echo '<th>შეხვდეს</th>'; ?>-->
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$x='';
				while($res=mysqli_fetch_array($results)){ 
					//$res['statement']=unserialize($res['statement'])[1];
					/*if($res['subject']!=3 && $res['qrnk']==0) $dmtt='<a style="background:red; color:white;">!!!</a>'; else */$dmtt='';
			        $x.='<tr>';
			        $x.="<td>{$dmtt}{$res['statement']}</td>";
			        $x.="<td>{$res['class']}</td>";
			        if($rnk!=5){
				        if($res['axsna']=='') $x.='<td><img src="../css/img/cross.svg" width="30"/></td>';
				        else $x.='<td><img src="../css/img/checked.svg" width="30" style="opacity:0.2"/></td>';
				    }
				    else{
				    	if($res['gdxdl']==0) $x.='<td><img src="../css/img/cross.svg" width="30"/></td>';
				    	else if($res['gdxdl']==-1) $x.='<td><img src="../css/img/checked.svg" width="30" style="opacity:1"/></td>';
				    	else if($res['gdxdl']==-2) $x.='<td><img src="../css/img/confused.svg" width="30" style="opacity:1"/></td>';
				        else $x.='<td><img src="../css/img/checked.svg" width="30" style="opacity:0.3"/></td>';
				    }
				    /*if($rnk==6  && $cSubj==1) {
			    		if($res['wgn']==1) $x.='<td><img src="../css/img/notebook.svg" width="30" style="opacity:1"/></td>';
				    	else $x.='<td></td>';
				    }*/
			        $x.='<td><a href="q.php?id='.$res['id'].'" target="_blank"><img src="../css/img/view.png" /></a></td>';
			        $x.='</tr>';
			    }
			    echo $x;
			?>
			</tbody>
		</table>
		<?php 
                $x='<div align="center">';
                if($Num_of_questions>$lmtt){
                    for($i=1; $i<=ceil($Num_of_questions/$lmtt); $i++){
                        if($page==$i) $dmt='pgqslct'; else $dmt='';
                        $x.='<div class="Pgnumqv '.$dmt.'" onclick="location.href=\'questions_bazaF.php?'.tlmurl('page',$i).'\'">'.$i.'</div>';
                    }
                    $x.='</div><br/>';
                    echo $x;
                }
            ?>
	</div>
	<script>
		$(document).ready(function(){
			$("#chsclass").change(function(){
				location.href='questions.php?subj='+cSubj+'&class='+$("#chsclass option:selected").val();
			});
			$('#chssubj').change(function(){
				location.href='questions.php?subj='+$("#chssubj option:selected").val();
			});
			$('.AdmnPrgrsInner').css('width',$('.AdminPrgrCont').width()+'px');
			$('#StstkDv').toggle();
		});
		$(document).resize(function(){
			$('.AdmnPrgrsInner').css('width',$('.AdminPrgrCont').width()+'px');
		});
		function rglStstk(){
			$('#StstkDv').slideToggle();
		}
	</script>
</body>
</html>