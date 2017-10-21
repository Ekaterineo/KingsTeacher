<?php
session_start();
$loc="../";
require($loc.'php/functions.php');
load();
global $connection;
$das=0;
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) $das=1;
else if($das==0 && isset($_POST['wid'],$_POST['idd'])){
	$wid=intval($_POST['wid']);
	$idd=intval($_POST['idd']);

    echo '2';

    $query="SELECT url FROM img where id={$idd}";
    $results=mysqli_query($con,$query) or die(mysqli_error($con));
    if(!mysqli_num_rows($results)) exit;
    $res=mysqli_fetch_array($results);

    echo '3';

    $url=$res['url'];

    $image = new Imagick();
    $image->readImage(realpath('../imgs/'.$url));
    $d = $image->getImageGeometry();
    $w = $d['width'];
    $h = $d['height'];
    $raw=$wid;
    $rah=$raw*($h/$w);
    $image->resizeImage($raw,$rah,Imagick::FILTER_SINC,0.9);
    $image->writeImage(realpath('../imgs/'.$url));

    $das=-1;
    
}
else $das="Merror0";
echo $das;
//echo $das;
?>