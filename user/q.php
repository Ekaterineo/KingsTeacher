<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
if(!is_user($id,$username,$hashed)) redirect_to('../login.php');
if(!isset($_GET['id'])) redirect_to('home.php');
$idd=intval($_GET['id']);

$query="SELECT * FROM questions WHERE id={$idd}";
$results=mysqli_query($con,$query);
if(!mysqli_num_rows($results)) redirect_to('home.php');
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
<?php echo headerr(); ?>
<br/>
    <div class="main">
    </div>
    <div class="main" id="tstmain">
        <div id="tstcont" style="margin-top: 100px">
            <div id="zmtcont"></div>
           <div id="tstcontzd"></div>
        </div>
       </div>
    
    <script>
        $('#tstcontzd').html(wrtq($qs[0].id,$qs[0].type,$qs[0].statement,$qs[0].choices,1,$qs[0].axsna,$qs[0].qrnk));
        /*if($qs[0].textid!=0){
            $('#txtcontr').html(wrttxt($txt.id,$txt.subj,$txt.class,$txt.nqs,$txt.text[0],$txt.text[1],2,1));
            $('.txtactltxt').slideToggle(0);
            $('.txtzdnwl').click(function(){
              y  $('.txtactltxt').slideToggle(200);
            });
            $('.txtactltxt .btnchv').attr('onclick','location.href=\''+$loc+'admin/edittxt.php?id='+$txt.id+'&qid='+$qs[0].id+'\'');
        }*/
    </script>
</bod>
</html>