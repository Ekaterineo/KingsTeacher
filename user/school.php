<?php
session_start();
$loc="../";
require_once("../php/functions.php");
load();
if(!is_user($id,$username,$hashed)) redirect_to("../login.php");
$query="SELECT * FROM tst WHERE author='{$id}' AND type=1 ORDER BY datee DESC";
$results=mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<title> ტესტ ბანკი </title>
	<?php echo incinhead(); echo headerr(); ?>
</head>
<body style="background-image: url(../css/pattern.png); background-repeat: repeat; background-color: white;">
	<div class="main">
		<div style="text-align: center; margin: 106px 0px 10px 0px; ">
			<button class="addbutton" onclick="location.href='schooltest.php'">ტესტის შექმნა</button>
		</div>
	<table class="mmdtbl">
			<thead>
				<tr>
					<th>სახელი</th>
					<th>საგანი</th>
					<th>კლასი</th>
					<th>შეცვლა</th>
					<th>თარიღი</th>
					<th>გადმოწერა </th>
				</tr>
			</thead>
			<tbody>
			<?php
				$x='';
				while($res=mysqli_fetch_array($results)){
			        $x.='<tr>';
			        $x.="<td>{$res['name']}</td>";
			        $x.="<td>{$subjects[$res['subj']]}</td>";
			        $x.="<td>{$res['class']}</td>";
			        $x.='<td><a href="editbank.php?id='.$res['id'].'" target="_blank">შეცვლა</a></td>';
			        $x.='<td><a>'.$res['datee'].'</a></td>';
			        $x.="<td> <img src=\"../css/img/download-button.svg\" style='width:20px; cursor: pointer' onclick=\"location.href='../word.php?id=".$res['id']."'\"></td>";
			        $x.='</tr>';
			    }
			    echo $x;
			?>
			</tbody>
		</table>
		</div>



</body>
</html>
