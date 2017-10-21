<?php
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
$qs=array();
$res=mysqli_fetch_array($results, MYSQLI_ASSOC);
$res['choices']=unserialize($res['choices']);
//$res['statement']=unserialize($res['statement']);
$qs[]=$res;


$est=[];
$txt=[];
/*if($res['textid']!=0){
    $query2="SELECT * FROM texts WHERE id={$res['textid']}";
    $results2=mysqli_query($con,$query2);
    $res2=mysqli_fetch_array($results2, MYSQLI_ASSOC);
    $res2['text']=unserialize($res2['text']);
    $txt=$res2;
}*/

$subj=intval($res['subject']);
//$wgn=intval($res['wgn']);
?><!DOCTYPE html>
<html>
<head>
    <title>კითხვა</title>
    <?php echo incinhead(); ?>
    
    <script>
        $qs=JSON.parse('<?php echo json_encode($qs);?>');
        $txt=JSON.parse('<?php echo json_encode($txt);?>');
        $gdxdl=<?php echo $res['gdxdl'] ?>; 
    </script>
    <style>
    #shnshvndiv{
        padding: 10px 25px;
        font-size: 20px;
        color: red;
        text-align: center;
    }
    </style>
</head>
<body bgcolor="#e9e9e9">
<?php echo headerr2($username); ?>
<br/>
    <div class="main">
    <button class="btnchv" onclick="location.href='addq.php'" style="float:left; <?php if($rnk==6) echo 'display:none;';?>">კითხვის დამატება</button>
    <?php if(($res['gdxdl']==0 || $res['gdxdl']==-2) && $rnk==6) echo '<button class="btnchv" onclick="ktxvSwria('.$idd.',-1)">კითხვა სწორია</button>'; if($res['gdxdl']==0 && $rnk==6) echo '<br/><button class="btnchv" onclick="ktxvSwria('.$idd.',-2)">ჰმ.. გადავხედავ შემდეგშიც</button>';
    /*if($subj==1){
        if($wgn==0) echo '<button class="btnchv" onclick="chngwgn('.$idd.',1)">შეხვდეს</button>';
        else echo '<button class="btnchv" onclick="chngwgn('.$idd.',0)">აღარ შეხვდეს</button>';
        } */?>
        <button class="btnchv" onclick="location.href='editq.php?id=<?php echo $idd; ?>'" style="float:right">კითხვის შეცვლა</button><br/>
    </div>
    <div class="main" id="tstmain">
        <div id="tstcont">
            <div id="zmtcont"></div>
           <div id="tstcontzd"></div>
           <!--  <div id="tstcontqv"></div>-->
            <?php
                $resset=mysqli_query($con, "SELECT * FROM shenishvnebi WHERE qid={$idd}");
                if(mysqli_num_rows($resset)){
                    while($ress=mysqli_fetch_array($resset))
                    echo '<div id="shnshvndiv">'.$ress['text'].'</div>';
                }
                if($rnk==4 && $res['author']==$id){
                    $resset=mysqli_query($con, "UPDATE shenishvnebi set seen=1 WHERE qid={$idd}") or die(mysqli_error($con));
                }
            ?>
        </div>
    <?php if(can_delete_question($rnk,$res['author'])) echo '<button class="btnchv" onclick="dlt_question('.$res['id'].')" style="float:right">კითხვის წაშლა!</button>';?>
    </div>
    
    <script>
        $('#tstcontzd').html(wrtq($qs[0].id,$qs[0].type,$qs[0].statement,$qs[0].choices,1,$qs[0].axsna,$qs[0].qrnk));
        /*if($qs[0].textid!=0){
            $('#txtcontr').html(wrttxt($txt.id,$txt.subj,$txt.class,$txt.nqs,$txt.text[0],$txt.text[1],2,1));
            $('.txtactltxt').slideToggle(0);
            $('.txtzdnwl').click(function(){
                $('.txtactltxt').slideToggle(200);
            });
            $('.txtactltxt .btnchv').attr('onclick','location.href=\''+$loc+'admin/edittxt.php?id='+$txt.id+'&qid='+$qs[0].id+'\'');
        }*/
        if($gdxdl!=0){
            if($gdxdl==-1) $('#tstcont').css({'border-top':'4px solid #00eb00'});
            else if($gdxdl==-2) $('#tstcont').css({'border-top':'4px solid #fbd971'});
            else $('#tstcont').css({'border-top':'4px solid #fb7e71'});
        }
    </script>
</body>
</html>