<?php
header("Content-type: application/vnd.ms-word;charset=utf-8");
header("Content-Disposition: attachment;Filename=document_name.doc");

session_start();
$loc="";
require_once("php/functions.php");
load();
if(!is_user($id,$username,$hashed)) redirect_to('login.php');
if(!isset($_GET['id'])) redirect_to('user/testbank.php');
$idd=intval($_GET['id']);
$alpha=["","ა","ბ","გ","დ","ე","ვ","ზ"];
$query="SELECT * FROM tst WHERE id={$idd}";
$results=mysqli_query($con,$query);
$rs=mysqli_fetch_array($results);
$qss=unserialize($rs['questions']);
$axlqvst=array();
for($i=0; $i<count($qss); $i++){
	$axlqvst[]=$qss[$i];
}
$query="SELECT id,statement,choices FROM questions WHERE subject={$rs['subj']} AND class={$rs['class']} ORDER BY id DESC";
$results=mysqli_query($con,$query);
$ds=[[],[],[],[]];
while($res=mysqli_fetch_array($results)){
	$ds[intval($res['id'])][]=[$res['statement'],unserialize($res['choices'])];
	//print_r($ds[intval($res['id'])]);
}

function imgpathd($str){
	return str_replace('src="../','src="http://pedagogi.kings.ge/',$str);
}
function trnsfch($s) {
    //rewrite string :D
   	$n = strlen ($s);
    $s2 = "";
    $stc = [];
    $rmdzglk = 0; //რამდენი ძაღლუკა :დ
    $lstbrw=0;
    if(strpos($s,"href")) return $s;
    for ($i = 0; $i < $n; $i++) {
        if($s[$i]=='`') $lstbrw++;
        if($lstbrw%2==1 || $s[$i]=='`') {$s2.=$s[$i]; continue;}
        if ($s[$i] == '\n' || $s[$i] == '\r') {
            $s2.='<br/>';
        }
        else if ($s[$i] == '@') {
            if ($rmdzglk % 2 == 1) { $rmdzglk++; $s2 .= '</u>'; }
            else { $rmdzglk++; $s2 .= '<u>'; }
        }
        else if ($s[$i] == '^' || $s[$i] == '_') {
            if($i < $n - 1 && ($s[$i+1]=='_' || $s[$i+1]==' ' || $s[$i+1]=='.' || $s[$i+1]==','))  {$s2 .= $s[$i]; continue;}
            if ($s[$i] == '^') $s2 .= '<sup>';
            else $s2 .= '<sub>';
            if ($i < $n - 1) {
                if ($s[$i + 1] == '(') $stc[]=$s[$i];
                else {
                    $s2 .= $s[$i + 1];
                    if ($s[$i] == '^') $s2 .= '</sup>';
                    else $s2 .= '</sub>';
                }
            }
            $i++;
        }
        else if ($s[$i] == ')' && count($stc)>0) {
            if ($stc[count($stc) - 1] == '^') $s2 .= '</sup>';
            else if ($stc[count($stc) - 1] == '_') $s2 .= '</sub>';
            else $s2 .= ')';
            array_pop($stc);
        }
        else if ($s[$i] == '(') {
            $s2 .= $s[$i];
            $stc[]=$s[$i];
        }
        else if($s[$i]=='*') $s2.='⋅';
        else $s2 .= $s[$i];
    }
    return $s2;
}
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
echo "<body>";
echo "<center><img src='http://pedagogi.kings.ge/css/img/kings.svg'></center> ";
echo "<br> <br> <br> <center> <b style='width:100%; font-size: 30px; text-align: center'>".$rs['name']."</b> </center><br><br>";

if($rs['subj']==2){
    for($i=0; $i<count($qss); $i++){
    	echo "<br>";
    	$n=$i+1;
    	echo $n.".";
    	echo "&nbsp; &nbsp;";
    	//echo trnsfch($ds[$qss[$i]][0][0]);
    	echo imgpathd(htmlspecialchars_decode(trnsfch($ds[$qss[$i]][0][0])));
    	echo "<br>";
    	echo "<ol type='a'";
		for($j=0; $j<count($ds[$qss[$i]][0][1]); $j++){
            $answers[]=$ds[$qss[$i]][0][1][$j];
		}
        shuffle($answers);
        for($j=0; $j<count($answers); $j++){
            echo "<li>".imgpathd(htmlspecialchars_decode(trnsfch($answers[$j])))." </li>";
        }
        $answers=[];
    	echo "</ol>";
    }
}
else{
    for($i=0; $i<count($qss); $i++){
        echo "<br>";
        $n=$i+1;
        echo $n.".";
        echo "&nbsp; &nbsp;";
        //echo trnsfch($ds[$qss[$i]][0][0]);
        echo imgpathd(htmlspecialchars_decode(trnsfch($ds[$qss[$i]][0][0])));
        
        for($j=0; $j<count($ds[$qss[$i]][0][1]); $j++){
            $answers[]=$ds[$qss[$i]][0][1][$j];
        }
        shuffle($answers);
        for($j=0; $j<count($answers); $j++){
            echo "<p> &nbsp;&nbsp; &nbsp; &nbsp;".$alpha[$j+1].". &nbsp;".imgpathd(htmlspecialchars_decode(trnsfch($answers[$j])))." </>";
        }
        $answers=[];
        echo "<br><br>";
    }

}
echo "</body>";
echo "</html>";
?>