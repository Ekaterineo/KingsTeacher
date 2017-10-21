<?php
session_start();
require('functions.php');
global $con;
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) $das=0;
else if(isset($_GET["id"])){
    $das=-1;
    $idd=intval($_GET["id"]);
    echo $idd;
    $query="SELECT url, author FROM img where id={$idd}";
    $results=mysqli_query($con,$query);
    $res=mysqli_fetch_array($results);
    if($res['author']!=$id) header("Location: ../admin/images.php");
    $urll=$res['url'];
    $query="DELETE FROM img where id={$idd}";
    $results=mysqli_query($con,$query);
    unlink('../imgs/'.$urll);
    header("Location: ../admin/images.php");
}
else {$das=0; echo $das;}
if($das!==0) echo json_encode($das);
?>