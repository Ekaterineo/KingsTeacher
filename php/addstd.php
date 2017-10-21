<?php
session_start();
$loc="../";
require('functions.php');
load();
global $connection;
$das=0;
if(is_user($id,$username,$hashed)){
    if(isset($_POST['qvst']) && isset($_POST['numid']) && isset($_POST['clasi'])){
        $qvst=(array)json_decode($_POST['qvst']);
        $numid=(array)json_decode($_POST['numid']);
        $clasi=intval($_POST['clasi']);
        $clasi=min(10,max(2,$clasi));
        for($i=0; $i<sizeof($numid); $i++){

            if($numid[$i][0]==-1 && isset($numid[$i][1]) && $numid[$i][1]==1){
                $name=strval($qvst[$i][1]);
                $surname=strval($qvst[$i][2]);
                $mobile=$qvst[$i][3];
                $mob=strval($qvst[$i][3]);
                $do=1;
               // if($name=='' || $surname=='' || $mobile=='') {$do=0; continue;}
                if(preg_match('/[^ა-ჰ\\-]/', $name) || strlen(utf8_decode($name))<2) {$name=''; $do=0; /*echo "name".strlen(utf8_decode($name));*/}

                if(preg_match('/[^ა-ჰ\\-]/', $surname) || strlen(utf8_decode($surname))<4) {$surname=''; $do=0; /*echo "surname".strlen(utf8_decode($surname));*/}
                if(preg_match('/[^0-9\\-]/', $mobile) || strlen(utf8_decode($mobile))!=9 || $mob[0]!=5) {$mobile=''; $do=0;/* echo "mob".strlen(utf8_decode($mobile));*/}
                
                if($do==1)
                {
                    $query="INSERT INTO students (name,surname,mobile,class,tchid) VALUES('{$name}','{$surname}','{$mobile}','{$clasi}','{$id}')";
                    $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
                    $das=1;
                    
                }
            }
            else if($numid[$i][0]!=-1 && isset($numid[$i][1]) && $numid[$i][1]==1){
                //echo "abara";
                //echo $numid[$i][1]."a";
                $name=$qvst[$i][1];
                $surname=$qvst[$i][2];
                $mobile=$qvst[$i][3];
                $id2=$qvst[$i][0];
                $mob=strval($qvst[$i][3]);
                $do=1;
                if(preg_match('/[^ა-ჰ\\-]/', $name) || strlen(utf8_decode($name))<2) {$name=''; $do=0; }
                if(preg_match('/[^ა-ჰ\\-]/', $surname) || strlen(utf8_decode($surname))<4) {$surname=''; $do=0; }
                if(preg_match('/[^0-9\\-]/', $mobile) || strlen(utf8_decode($mobile))!=9 || $mob[0]!=5) {$mobile=''; $do=0; }
                //echo "b".$do;
                if($do==1){
                    $query="UPDATE students SET name='{$name}', surname='{$surname}', mobile='{$mobile}' WHERE id='{$id2}'";
                    $result_set=mysqli_query($con,$query) or die(mysqli_error($con));
                    $das=1;
                }
            }


        }
    }
}
echo $das;
?>