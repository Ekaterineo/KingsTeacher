<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
/*$rnk=is_admin($id,$username,$hashed);
if(!$rnk) redirect_to('../adminlogin.php');*/
ini_set('max_execution_time', 60*30);

function user_id_by_code($nm){
	$nm=strval($nm);
	global $con;
	$query="SELECT id FROM usert where username='$nm'";
	$results=mysqli_query($con,$query);
    if(!mysqli_num_rows($results)) return 0;
    $res=mysqli_fetch_array($results);
    return $res['id'];
}
$query2="SELECT id, mobile, first_name_and_surname FROM usert";
$result2=mysqli_query($con,$query2) or die(mysqli_error($con));
while($res2=mysqli_fetch_array($result2)){
	$tcharray[$res2[1]]=[$res2[0],$res2[2]];
}

$ct=array();
$sch=array();
?><!DOCTYPE html>
<html>
<head>
    <title>ქალაქები</title>
    <?php incinhead(); ?>
</head>
<body class="bodylogin">
	<div class="main">
		<?php
		$row = 1;
		$prev=[];
		$prev['nmsrnm']=0;
		$prev['school']=0;
		$prev['city']=0;
		$prev['region']=0;
		$prev['id']=0;
		if (($handle = fopen("skolebidan wamogebuli siebi programists 10.10.csv", "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		  	if($row==1) {$row++; continue;}
		    $num = count($data);
	    	$chnhgd=0;


		    $usr['mobile']=strval(str_replace(' ', '', $data[6]));

		    if($usr['mobile']=='') continue;
		    $usr['nmsrnm']=strval($data[5]);
		    if($usr['nmsrnm']=='') continue;
		    $usr['username']=strval($data[0]);

		    $std['name']=strval($data[8]);
		    if($std['name']=='') continue;
		    $std['surname']=strval($data[9]);
		    if($std['surname']=='') continue;
		    $std['mobile']=strval(str_replace(' ', '', $data[10]));
		    if($std['mobile']=='') continue;
		    
	    	
		    if(($prev['nmsrnm']==strval($data[5]))&&($prev['school']==strval($data[3]))){
		    	$querri="SELECT COUNT(*) FROM students WHERE tchid={$prev['id']} AND name='{$std['name']}' AND surname='{$std['surname']}' AND mobile='{$std['mobile']}'";
				$resulli=mysqli_query($con,$querri) or die(mysqli_error($con));
				$resi2=mysqli_fetch_array($resulli);
				if($resi2[0]==0){
					$querrio="INSERT INTO students(name,surname,mobile,tchid,fromexcel) VALUES ('{$std['name']}', '{$std['surname']}', '{$std['mobile']}', {$prev['id']},1)";
					$resullio=mysqli_query($con,$querrio) or die(mysqli_error($con));
				}

		    }
		    else{
			    if(isset($tcharray[$usr['mobile']])){
			    	//print_r($tcharray[$usr['mobile']]);
			    	if($tcharray[$usr['mobile']][1]==$usr['nmsrnm']){
						$querr="SELECT COUNT(*) FROM students WHERE tchid={$tcharray[$usr['mobile']][0]} AND name='{$std['name']}' AND surname='{$std['surname']}' AND mobile='{$std['mobile']}'";
						$resull=mysqli_query($con,$querr) ;
						$resi=mysqli_fetch_array($resull);
						if($resi[0]==0){
							$querr="INSERT INTO students(name,surname,mobile,tchid,fromexcel) VALUES ('{$std['name']}', '{$std['surname']}', '{$std['mobile']}', {$tcharray[$usr['mobile']][0]},1)";

							$resull=mysqli_query($con,$querr);
						}
			    	}
			    } 
			    else{
			    	$querr="SELECT id FROM usert WHERE mobile={$usr['mobile']} AND first_name_and_surname='{$usr['nmsrnm']}' LIMIT 1";
					$resull=mysqli_query($con,$querr);
					if(mysqli_num_rows($resull)!=0){
						$resi=mysqli_fetch_array($resull);
						$querri="SELECT COUNT(*) FROM students WHERE tchid={$resi[0]} AND name='{$std['name']}' AND surname='{$std['surname']}' AND mobile='{$std['mobile']}'";
						$resulli=mysqli_query($con,$querri) ;
						$resi2=mysqli_fetch_array($resulli);
						if($resi2[0]==0){
							$querrio="INSERT INTO students(name,surname,mobile,tchid,fromexcel) VALUES ('{$std['name']}', '{$std['surname']}', '{$std['mobile']}', {$resi[0]},1)";
							$resullio=mysqli_query($con,$querrio) or die(mysqli_error($con));
						}
					}
					else{

						$usr['region']=strval($data[1]);
				    	$usr['city']=0; $usr['school']=0;
				    	$pieces=explode(" ", $usr['nmsrnm']);
					    if($data[2]!=''){
						    $ct=get_city_by_name($data[2]);
						    $usr['city']=$ct[0];
						    $sch=get_school_by_city_and_name($data[3],$ct[2]);
						    $usr['school']=$sch[0];
						}
						if($usr['school']=='') $usr['school']=0;
					    if($data[7]!='') {
					    	if(strval($data[7])=="მათემატიკა") $usr['subject']=1;
					    	else if(strval($data[7])=="ინგლისური") $usr['subject']=2;
					    	else if(strval($data[7])=="ქართული") $usr['subject']=3;
					    	else if(strval($data[7])=="დაწყებითი") $usr['subject']=5;
					    }
					    else $usr['subject']=0;
					    $password=mt_rand(100000,999999);
					    $hashed_password=hash('sha512', $password);
					    $que="SELECT username FROM usert ORDER BY id DESC LIMIT 1";
					    $rr=mysqli_query($con,$que) or die(mysqli_error($con));
					    $resrr=mysqli_fetch_array($rr);
					    $usernm=$resrr[0]+1;
				    	$querr="INSERT INTO usert(username, name, surname, mobile, city, school,region,subject, first_name_and_surname, fromexcel, password, first_password, hashed_password) VALUES ({$usernm},'{$pieces[0]}', '{$pieces[1]}', {$usr['mobile']}, {$usr['city']}, {$usr['school']}, '{$usr['region']}', {$usr['subject']}, '{$usr['nmsrnm']}', 1, {$password}, {$password},'{$hashed_password}')";
				    	//echo $querr;
						$resull=mysqli_query($con,$querr) or die(mysqli_error($con));
						$query5="SELECT id FROM usert WHERE first_name_and_surname='{$usr['nmsrnm']}' AND mobile='{$std['mobile']}' LIMIT 1";
				    	$result5=mysqli_query($con,$query5) or die(mysqli_error($con));
				    	$res5=mysqli_fetch_array($result5);
				    	echo $$query5;
						$querrio="INSERT INTO students(name,surname,mobile,tchid,fromexcel) VALUES ('{$std['name']}', '{$std['surname']}', '{$std['mobile']}', {$res5[0]},1)";

							echo $querrio;
						$resullio=mysqli_query($con,$querrio)  or die(mysqli_error($con));	
					}
					$prev['nmsrnm']=strval($data[5]);
			    	$prev['school']=strval($data[3]);
			    	$prev['city']=strval($data[2]);
			    	$prev['region']=strval($data[1]);
			    	$query4="SELECT id FROM usert WHERE first_name_and_surname='{$usr['nmsrnm']}' AND mobile={$usr['mobile']} ORDER BY id ASC LIMIT 1";
			    	$result4=mysqli_query($con,$query4);
			    	$res4=mysqli_fetch_array($result4);
			    	$prev['id']=$res4[0];

			    }
			}
		  }
		  fclose($handle);
		}
	?>
	</div>
</body>
</html>