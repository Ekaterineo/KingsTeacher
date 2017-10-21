<?php
session_start();
require('functions.php');
global $con;
load();
/*if(is_admin($id,$username,$hashed)) $das=0;
else*/ if(isset($_POST["username"]) && isset($_POST["password"])){
    $das=-1;
    $srnm=strval($_POST["username"]);
    $passwd=strval($_POST["password"]);
    if(preg_match('/[^A-Za-z0-9]/', $srnm)) {$das=1;}
    if(preg_match('/[^A-Za-z0-9]/', $passwd)) {$das=2;}
    $hashedp=hash('sha512',$passwd);
    if($das==-1){
            $query="SELECT * FROM usert WHERE username='{$srnm}' AND hashed_password='{$hashedp}'";
            $results=mysqli_query($con,$query);
            if(!mysqli_num_rows($results)) $das=3;
            else {
                $res=mysqli_fetch_array($results);
                $_SESSION["id"]=$res["id"];
                $tmm=time();
                $results=mysqli_query($con,"INSERT INTO u_login (uid,timee) VALUES({$res['id']},{$tmm})");
                $results=mysqli_query($con,"UPDATE usert set lastlogin='".date('Y-m-d H:i:s',$tmm)."' WHERE id={$res['id']}");
                $_SESSION["username"]=$res["username"];
                $_SESSION["registered"]=$res["registered"];
                if($res["registered"]==1){
                    $_SESSION["user"]=1;
                    $_SESSION["hashed"]=$hashedp;
                    
                    $_SESSION['lastlogin']=date('Y-m-d H:i:s',$tmm);
                }
                if($res["registered"]==0) $das=-2;
            }
    }
    
}
else $das=0;
echo $das;
?>