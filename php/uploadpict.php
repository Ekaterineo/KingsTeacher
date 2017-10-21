<?php
session_start();
$loc="../";
require('functions.php');
load();
global $con;
$rnk=is_admin($id,$username,$hashed);
if(!$rnk) redirect_to('../adminlogin.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body> <div class="main" style="text-align:center;">
<?php
$das=0;
if($das==0 && isset($_FILES["uploadedfile"])){
    if($_FILES['uploadedfile']['type']!="image/jpeg" && $_FILES['uploadedfile']['type']!="image/png") {
        echo 'გთხოვთ, ატვირთოთ მხოლოდ .jpg ან .png ფაილი, რომელთა ზომა არ აღემატება 1Mb-ს';
        $das=1;
    }
    if($das==0){
    if($_FILES['uploadedfile']['type']=="image/jpeg") $gaf='jpg'; else $gaf='png';
        $dir='imgs/';
        $plc='kimg';
        $nwnm='../'.$dir.''.$plc.'.'.$gaf.'';
        $sin=''.$plc.'.'.$gaf.'';
        $j=150;
        while(file_exists($nwnm)){
            $j++;
            $nwnm='../'.$dir.''.$plc.''.$j.'.'.$gaf.'';
            $sin=''.$plc.''.$j.'.'.$gaf.'';
        }
        $subj=gt_first_subj($aSubjs);
        $query="INSERT INTO img (url,author,subj) VALUES('{$sin}',{$id},{$subj})";
        echo $query;
        $result_set=mysqli_query($con,$query);

        move_uploaded_file( $_FILES['uploadedfile']['tmp_name'], $nwnm);


        $query="SELECT id FROM img WHERE url='{$sin}'";
        $result_set=mysqli_query($con,$query);
        $res=mysqli_fetch_array($result_set);

        sleep(2);
        header("Location: ../admin/images.php");
        exit;
    }
}
else $das=1;
?>
</div>
</body>
</html>