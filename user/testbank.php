<?php
session_start();
$loc="../";
require_once("../php/functions.php");
load();
if(!is_user($id,$username,$hashed)) redirect_to("../login.php");
$query="SELECT * FROM tst WHERE author='{$id}' AND type=0 ORDER BY datee DESC";
$results=mysqli_query($con,$query);
$query2="SELECT COUNT(*) FROM students WHERE tchid='{$id}'";
$results2=mysqli_query($con,$query2);
$res2=mysqli_fetch_array($results2);
?>
<!DOCTYPE html>
<html>
<head>
	<title> ტესტ ბანკი </title>
	<?php echo incinhead(); echo headerr(); ?>
</head>
<body style="background-image: url(../css/pattern.png); background-repeat: repeat; background-color: white;">
	<?php if($res2[0]<10) echo "<div id='notenough'> ტესტ ბანკის გამოსაყენებლად საჭიროა დამატებული გყავდეთ მინიმუმ 10 მოსწავლე 
	<br> <button class=\"logbotbut regbutton\" id='addstudents' onclick=\"location.href='addstudents.php'\">მოსწავლეების დამატება </button></div>" ?>
	<div class="main" <?php if($res2[0]<10) echo "style='display:none'" ?>>
		<div style="text-align: center; margin: 106px 0px 10px 0px; ">
			<button class="addbutton" onclick="location.href='tstbank.php'">ტესტის შექმნა</button>
		</div>
	<table class="mmdtbl" >
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
			        $x.="<td> <img src=\"../css/img/download-button.svg\" style='width:20px; cursor: pointer' onclick=\"alert('სურათების სანახავად word ფაილის გახსნისას მიანიჭეთ რედაქტირების უფლება'); location.href='../word.php?id=".$res['id']."'\"></td>";
			        $x.='</tr>';
			    }
			    echo $x;
			?>
			</tbody>
		</table>
		</div>
		<script>
		/*	function doit(){
				alert('სურათების სანახავად word ფაილის გახსნისას მიანიჭეთ რედაქტირების უფლება');
				;

			}*/
		</script>



</body>
</html>
