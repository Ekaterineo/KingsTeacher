<?php
session_start();
$loc="../";
require('functions.php');
load();
global $connection;
$das=0;
if(!is_admin($id,$username,$hashed)) $das=1;
if($das==0){
    $query="SELECT * from img WHERE 1 ORDER by id DESC LIMIT 100";
    if($das==0){
        $results=mysqli_query($con,$query);
        $das=array();
        while($res=mysqli_fetch_array($results)){
            array_push($das,$res);
        }
    }
    
}
echo json_encode($das);
?>