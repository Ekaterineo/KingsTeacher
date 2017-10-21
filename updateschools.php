<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!$rnk) redirect_to('../adminlogin.php');
$query="SELECT name, code FROM cities";
$result=mysqli_query($con,$query) or die(mysqli_error($con));
$num=mysqli_num_rows($result);
while($res=mysqli_fetch_array($result)){
	$ctarray[$res[0]]=intval($res[1]);
}
$query="SELECT name, code FROM cities";
$result=mysqli_query($con,$query) or die(mysqli_error($con));
$num=mysqli_num_rows($result);
while($res=mysqli_fetch_array($result)){
	$ctarray[$res[0]]=intval($res[1]);
}
//print_r($ctarray);

$query3="SELECT schools.id, schools.name, cities.id, cities.name, schools.city_code FROM schools INNER JOIN cities ON schools.city_code=cities.code";
$result=mysqli_query($con,$query3) or die(mysqli_error($con));
$num=mysqli_num_rows($result);
while($res=mysqli_fetch_array($result)){
	$scharray[]=[strval($res[1]),intval($res[0]),strval($res[3]),intval($res[2]),intval($res[4])];
}
//print_r($scharray);

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
		$n=73;
		if (($handle = fopen("schools.csv", "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		  	// $roww++; echo $roww." ";
		  	if($row==1) {$row++; continue;}
		    $num = count($data);
	    	$chnhgd=0;
	    	if($data[1]!="") $city=strval($data[1]); else continue;
	    	if($data[0]!="") $school=strval($data[0]); else continue;
	    	if(!isset($ctarray[$city]) || $ctarray[$city]==0){
	    		//echo "აბაშა".$ctarray['აბაშა'];
	    		//echo $ctarray[$city];
				$n=$n+1;
	    		$ctarray[$city]=$n;
	    		$query2="INSERT INTO cities (name, code) VALUES ('{$city}',{$n})";
	    		$resultss=mysqli_query($con,$query2) or die(mysqli_error($con));
	    		
	    		 
	    		if($n==178) $n=179;
	    	}
	    	$p=0;
	    	for($i=0; $i<2; $i++){
	    		//echo $scharray[0][0]." ".$school;
	    		if($scharray[$i][0]==$school) {$p=1; break;}
	    	}
			if($p==1){
				
				echo $school;
				//$roww++; echo $roww." "; //print_r($scharray[$school]);
	    	$que="INSERT INTO schools (name,city_code,new) VALUES ('{$school}',{$ctarray[$city]},1)";
	    	//$ress=mysqli_query($con,$que) or die(mysqli_error($con));
	    	}
	    	//echo $school;

	    	//echo "#".$ctarray[$city];
	    	

		  }


		  fclose($handle);
		}
	?>
	</div>
</body>
</html>