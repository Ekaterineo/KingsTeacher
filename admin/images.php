<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
if(!can_question($rnk)) redirect_to('../adminlogin.php');
$query="SELECT * FROM img WHERE author={$id} OR (POW(2,subj)&{$aSubjs})>0 ORDER BY id DESC";
$results=mysqli_query($con,$query) or die(mysqli_error($con));
?><!DOCTYPE html>
<html>
<head>
    <title>სურათები</title>
    <?php echo incinhead(); ?>
</head>
<body>
<?php echo headerr2($username); ?>
<br/>
	<div class="main">
		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="location.href='upload_img.php'">სურათის დამატება</button></div>
		<table class="mmdtbl">
			<thead>
				<tr>
					<th>სურათი</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$x='';
				while($res=mysqli_fetch_array($results)){
			        $x.='<tr>';
			        $x.="<td><img src='../imgs/{$res['url']}'></td>";
			       $dmt='';/* if(pow(2,intval($res['subj']))&$aSubjs) $dmt='<a href="resizeImage.php?id='.$res['id'].'" target="__blank"><img src="../css/img/resize.svg" width="30"/></a>';*/
			        $x.='<td>'.$dmt.'</td>';
			        $dmt=''; if($id==$res['author']) $dmt='<a onclick="if(confirm(\'ნამდვილად გწადიათ წაშლა?\')) location.href=\'../php/delete_img.php?id='.$res['id'].'\'" style="cursor: pointer"><img src="../css/img/deleteg.png" /></a>';
			        $x.='<td>'.$dmt.'</td>';
			        $x.='</tr>';
			    }
			    echo $x;
			?>
			</tbody>
		</table>
	</div>
</body>
</html>