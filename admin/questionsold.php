<?php
session_start();
$loc="../";
$lang=0;
require_once("../php/functions.php");
load();
$rnk=is_admin($id,$username,$hashed);
//if(!can_question($rnk)) redirect_to('../adminlogin.php');
$query="SELECT * FROM questions WHERE author={$id} ORDER BY id DESC LIMIT 150";
$results=mysqli_query($con,$query);
$subjects=["","მათემატიკა","ინგლისური","ქართული"];
$typ=["","სავარაუდოებით","ღია"];
?><!DOCTYPE html>
<html>
<head>
    <title>კითხვები</title>
    <?php echo incinhead(); ?>
    <?php echo headerr2(); ?>
</head>
<body>
<br/>
	<div class="main">
		<div style="text-align: center; margin-bottom:10px;"><button class="addbutton" onclick="location.href='addq.php'">კითხვის დამატება</button></div>
		<table class="mmdtbl">
			<thead>
				<tr>
					<th>კითხვა</th>
					<th>საგანი</th>
					<th>ქვეთემა </th>
					<th>ტიპი </th>
					<th>კლასი</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$x='';
				while($res=mysqli_fetch_array($results)){ 
			        $x.='<tr>';
			        $x.="<td>{$res['statement']}</td>";
			        $x.="<td>{$subjects[$res['subject']]}</td>";
			        $x.="<td>{$res['category']}</td>";
			        $x.="<td>{$typ[$res['type']]}</td>";
			        $x.="<td>{$res['class']}</td>";
			        $x.='<td><a href="q.php?id='.$res['id'].'" target="_blank"><img src="../css/view.png" /></a></td>';
			        $x.='</tr>';
			    }
			    echo $x;
			?>
			</tbody>
		</table>
	</div>
</body>
</html>