<?php
session_start();
require('functions.php');
global $con;
load();
if(is_admin($id,$username,$hashed)) $das=0;
else if(isset($_POST["username"]) && isset($_POST["password"])){
    $das=-1;
    $srnm=strval($_POST["username"]);
    $passwd=strval($_POST["password"]);
    if(preg_match('/[^A-Za-z0-9]/', $srnm)) {$das=1;}
    if(preg_match('/[^A-Za-z0-9]/', $passwd)) {$das=2;}
    $hashedp=hash('sha512',$passwd);
    if($das==-1){
            $query="SELECT * FROM admins WHERE username='{$srnm}' AND hashed_password='{$hashedp}'";
            $results=mysqli_query($con,$query);
            if(!mysqli_num_rows($results)) $das=3;
            else {
                $res=mysqli_fetch_array($results);
                $_SESSION["id"]=$res["id"];
                $_SESSION["username"]=$res["username"];
                $_SESSION["hashed"]=$hashedp;
            }
    }
}
else $das=0;
echo $das;
?>