<?php
session_start();
$loc="../";
$lang=0;
require_once("php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
//if(!can_pay_user($rnk)) redirect_to('home.php');

$cities=get_cities();
$cities[250]=[250,'სხვა'];
$sch=get_schools();
$sch[25000]=[25000,'სხვა',0];
//$dealers=get_dealers();
$query="SELECT schools.id, schools.name, cities.id, cities.name, schools.city_code FROM schools INNER JOIN cities ON schools.city_code=cities.code";
$results=mysqli_query($con,$query);
$sub=['','მათემატიკა','ინლისური','ქართული','','დაწყებითი'];
$crd_nums=array();
?>

<?php
				$x='';
				$list = array (array('ქალაქი','ID ქალაქი', 'სკოლა', 'ID სკოლა'));
				while($res=mysqli_fetch_array($results)){
					

					$sr=[$res[3],$res[2],$res[1],$res[0]];
			        $list[]=$sr;

			    }
			    echo $x;

$fp = fopen('export_school.csv', 'w');

fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
redirect_to('export_school.csv');
?>
