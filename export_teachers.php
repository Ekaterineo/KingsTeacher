<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
//if(!can_pay_user($rnk)) redirect_to('home.php');

$cities=get_cities();
$cities[250]=[250,'სხვა'];
$sch=get_schools();
$sch[25000]=[25000,'სხვა',0];
//$dealers=get_dealers();
$query="SELECT * FROM usert WHERE registered=1";
$results=mysqli_query($con,$query);
$sub=['','მათემატიკა','ინლისური','ქართული','','დაწყებითი'];
$crd_nums=array();
?>

<?php
				$x='';
				$list = array (array('კოდი', 'სახელი', 'გვარი','რაიონი','ქალაქი', 'სკოლა','საგანი','რეგისტრაცია','შემოვიდა','რამდენჯერ შემოვიდა','ბოლო თარიღი','რამდენი კლასი','რომელი კლასები','სულ მოსწავლე','ყველაზე კლასი','ყველაზე რაოდენობა კლასში'));
				while($res=mysqli_fetch_array($results)){
					if($res['school']==-1) $res['school']=25000;
					if($res['region']!='') $registration='არსებული'; else $registration='საიტიდან';
					if($res['lastlogin']=='0000-00-00 00:00:00') {$logged='არა'; $rmdnjr=0; $rmdncls=0;$class='';} 
					else {
						$logged='კი';
						$query1="SELECT COUNT(id) FROM u_login WHERE uid=$res[0]";
						$result1=mysqli_query($con,$query1) or die(mysqli_error($con));
						$res1=mysqli_fetch_array($result1);
						$rmdnjr=$res1[0];
						$query1="SELECT DISTINCT class FROM students WHERE tchid=$res[0]";
						$result1=mysqli_query($con,$query1);
						$rmdncls=mysqli_num_rows($result1);
						$class='';
						while($res1=mysqli_fetch_array($result1)){
							$cls=strval($res1['class']);
							$class.=$cls;
							$class.=' ';
						}
						$query2="SELECT COUNT(id) FROM students WHERE tchid=$res[0]";
						$result2=mysqli_query($con,$query2) or die(mysqli_error($con));
						$ttl=mysqli_fetch_array($result2);
						$std=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
						$query2="SELECT class FROM students WHERE tchid=$res[0]";
						$result2=mysqli_query($con,$query2) or die(mysqli_error($con));
						$ttl=mysqli_num_rows($result2);
						while($res2=mysqli_fetch_array($result2)){
							$std[$res2[0]]++;
						}
						$max=0; $claass=0;
						for($i=2; $i<=9; $i++){
							if($std[$i]>$max) {$max=$std[$i]; $claass=$i;}
						}

					}

					$sr=[$res['username'],$res['name'],$res['surname'],$res['region'],$cities[$res['city']][1],$sch[$res['school']][1],$sub[$res['subject']],$registration,$logged,$rmdnjr,$res['lastlogin'],$rmdncls,$class,$ttl,$claass,$max];
			        $list[]=$sr;
			    }
			    echo $x;

$fp = fopen('export_teachers.csv', 'w');

fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
redirect_to('export_teachers.csv');
?>
