<?php
session_start();
$loc="";
$lang=0;
require_once("php/functions.php");
load();
/*$rnk=is_admin($id,$username,$hashed);
if(!$rnk) redirect_to('../adminlogin.php');*/

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
		if (($handle = fopen("teacher.csv", "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		  	if($row==1) {$row++; continue;}
		    $num = count($data);
	    	$chnhgd=0;
		    $usr['username']=strval($data[0]);
		    if($usr['username']=='') continue;
		    $uid=user_id_by_code($usr['username']);
		    if($uid) {
	    		$is=1;
	    		continue;
	    		$user=get_all_things($uid);
		    }
		    else $is=0;

		    $usr['password']=strval($data[1]); //if($is && $usr['password']!=$user['password']) $chnhgd=1;
		    //if($data[2]=='დასავლეთი') $usr['region']=0; else $usr['region']=1;
		    
		   // $usr['fisrt_name']=$data[5];
		    //$usr['fisrt_surname']=$data[6];
		    $usr['region']=$data[2];
		    $usr['name']=$data[5]; //if($is && $usr['name']!=$user['name']) $chnhgd=1;
		    $usr['surname']=$data[6]; 
		    $firstudrnm=$usr['name'].' '.$usr['surname'];
		    //if($is && $usr['surname']!=$user['surname']) $chnhgd=1;
		    $usr['city']=0; $usr['school']=0;
		    if($data[3]!=''){
			    $ct=get_city_by_name($data[3]);
			    $usr['city']=$ct[0];
			    $sch=get_school_by_city_and_name($data[4],$ct[2]);
			    $usr['school']=$sch[0];
			}
		    if($data[8]!='') {
		    	if(strval($data[8])=="მათემატიკა") $usr['subject']=1;
		    	else if(strval($data[8])=="ინგლისური") $usr['subject']=2;
		    	else if(strval($data[8])=="ქართული") $usr['subject']=3;
		    }
		    else $usr['subject']='';
		    if($data[7]!='') $usr['mobile']=intval($data[7]); else $usr['mobile']='';
		    
			    $hshpsw=hash('sha512',$usr['password']);
		    	$query="INSERT INTO usert (username,password,hashed_password,first_password,name,surname,first_name_and_surname,subject,city,school,mobile,region) VALUES ('{$usr['username']}','{$usr['password']}','{$hshpsw}','{$usr['password']}','{$usr['name']}','{$usr['surname']}','{$firstudrnm}','{$usr['subject']}','{$usr['city']}','{$usr['school']}','{$usr['mobile']}','{$usr['region']}')";
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