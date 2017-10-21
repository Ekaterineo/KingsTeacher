<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
/*$rnk=is_admin($id,$username,$hashed);
if(!$rnk) redirect_to('../adminlogin.php');*/
//ini_set('max_execution_time', 60*30);
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
    <title>ქალაქები</title>
    <?php echo incinhead(); ?>
</head>
<body class="bodylogin">
	<div class="main">
		<?php
		$row = 1;
		if (($handle = fopen("pedagogebis baza rolandistvis2.csv", "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		  	if($row==1) {$row++; continue;}
		    $num = count($data);
	    	$chnhgd=0;
		    $usr['username']=strval($data[0]);
		    if($usr['username']=='') continue;
		    $usr['city']=0; $usr['school']=0;
		    if($data[3]!=''){
			    $ct=get_city_by_name($data[3]);
			    $usr['city']=$ct[0];
			}
		    	$query="UPDATE usert SET city={$usr['city']} WHERE username={$usr['username']}";
		    	$results=mysqli_query($con,$query);
		    	/*break;
		    	echo $query.'<br/>';*/
		  }
		  fclose($handle);
		}
	?>
	</div>
</body>
</html>