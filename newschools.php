<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!$rnk) redirect_to('adminlogin.php');

function user_id_by_code($nm){
	$nm=strval($nm);
	global $con;
	$query="SELECT id FROM usert where username='$nm'";
	$results=mysqli_query($con,$query);
    if(!mysqli_num_rows($results)) return 0;
    $res=mysqli_fetch_array($results);
    return $res['id'];
}


$ct=array();
$sch=array();
?><!DOCTYPE html>
<html>
<head>
    <title>სკოლები განახლება</title>
    <?php echo incinhead(); ?>
</head>
<body class="bodylogin">
	<div class="main">
		<?php
		$row = 1;
		if (($handle = fopen("skolebi rolands.csv", "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		  	if($row==1) {$row++; continue;}
		    $num = count($data);
	    	$chnhgd=0;
	    	$usr['kingsid']=intval($data[4]);
	    	$usr['id']=intval($data[3]);
		    $usr['cityname']=strval($data[2]);
		   // echo $usr['cityname']." ";
		    if(($usr['cityname']=='') || ($usr['id']=='') || ($usr['kingsid']=='')) continue;
		    	$query="UPDATE schools SET kingsid={$usr['kingsid']} WHERE id={$usr['id']} AND name='{$usr['cityname']}'";
		    	$results=mysqli_query($con,$query) or die(mysqli_error($con));
		    	/*break;
		    	echo $query.'<br/>';*/
		  }
		  fclose($handle);
		}
	?>
	</div>
</body>
</html>