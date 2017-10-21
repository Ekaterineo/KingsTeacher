<?php
session_start();
$loc="../";
require_once("../php/functions.php");
load();
if(!is_user($id,$username,$hashed))  redirect_to('../login.php');
$query="SELECT * FROM students WHERE tchid='{$id}'";
$results=mysqli_query($con,$query);
$ds=[];
while($res=mysqli_fetch_array($results)){
	//echo "aaa"; echo $res['id'];
	$ds[intval($res['class'])][]=[$res['id'],$res['name'],$res['surname'],$res['mobile'],$res['class']];
}
$clas=-1; 
if(isset($_GET['class'])) $clas=intval($_GET['class']);
if($clas>12 || $clas<1) $clas=-1;

?><!DOCTYPE html>
<html>
<head>
    <title>მოსწავლის დამატება</title>
    <?php echo incinhead(); echo headerr(); ?>
    <script>
    qvst=JSON.parse('<?php echo json_encode($ds);?>');
    </script>

</head>
<body>
<body class="bodylogin">
	<div class="main1" style="margin-top: 7%">
			
		<div style="display: inline">
			<div class="classbtn" id="classaba"> კლასი </div>
			<select class="adclassarea" id="slcclass" ><option value="-1"></option>
				<?php for($i=2; $i<=9; $i++) if($clas!=$i) {echo "<option value='{$i}'>{$i}</option>";} else {echo "<option value='{$i}' selected>{$i}</option>";}
				if($clas!=10) {echo "<option value=10 >10,11,12</option>";} else {echo "<option value=10 selected>10,11,12</option>";} ?> 
			</select>
		</div>

		<p class="stdbtn"> მოსწავლე </p>
		<br/> <br>
		<div <?php if($clas==-1) echo 'class="invisible"'?> >
			<p class="just" id="namee"> სახელი </p>
			<p class="just" id="surnamee"> გვარი </p>
			<p class="just" id="tel"> ტელეფონი </p>
			<br>
		</div>
		<div class="std">
			<div id="studentadd">
			</div>
		</div>
		<div <?php if($clas==-1) echo 'class="invisible"'?>>
			<div class="addplus" onclick="addline()"> <img src="../css/plus-black-symbol.svg" id="plus"> </div>
			<div class="logbotbut" onclick="addstd()" id="save"> შენახვა</div>
		</div>
	</div>
</div>
	<script>
			function addline(){
				p=0;
				if(clas==-1) return;
				i=$('.ramdeni').length;
				if(typeof(qvst[clas])=='undefined'){
					p=1;
					qvst[clas]=[];
					if(clas>0){
						for(j=0; j<10; j++) qvst[clas][j]=[-1,"","","",0];
					} 

				} 
				else if($('.ramdeni').length<10){
					for(j=i; j<10; j++) qvst[clas][j]=[-1,"","","",0];
				}
				else
				qvst[clas][i]=[-1,"","","",0];
				//console.log("qvstaaa",qvst[clas][i]);
				$('.adtextar2').geo();
				numid[i]=[0,0];
				//console.log('numid',i,numid[i],numid);
				all(p);
			}
			//students($('#slcclass option:selected').val(),0,1);

			function all(rml){
					console.log("rml=",rml);
					$('.adtextar2').geo();

						students($('#slcclass option:selected').val(),$('.ramdeni').length,rml);
						clas=$('#slcclass option:selected').val();
						var n=$('.ramdeni').length;
						if(n<10) addline();
						//console.log('n=',n);
						for(i=0; i<n; i++){
							$('.adtextar2').geo();
							//console.log('#adname'+i,$('#adname'+i).length);
							$('#adname'+i).keyup(function(){
								//console.log("aaa");
								var name = $('#adname'+$(this).attr("id").substr(6)).val();
								if(name.length<2 && name.length!=0);
								else $('#adname'+$(this).attr("id").substr(6)).removeClass("incrinput");
								qvst[clas][$(this).attr("id").substr(6)][1]=$('#adname'+$(this).attr("id").substr(6)).val();
								numid[$(this).attr("id").substr(6)][1]=1; 
								
							}).focusout(function(){
								var name = $('#adname'+$(this).attr("id").substr(6)).val();
								
						        if(name.length<2 && name.length!=0){
									$('#adname'+$(this).attr("id").substr(6)).addClass('incrinput');}
							});	
							$('#adsurnm'+i).keyup(function(){
								//console.log(surname.length);
								var surname = $('#adsurnm'+$(this).attr("id").substr(7)).val();
								if(surname.length<4 && surname.length!=0);
								else $('#adsurnm'+$(this).attr("id").substr(7)).removeClass("incrinput");
								numid[$(this).attr("id").substr(7)][1]=1;
								qvst[clas][$(this).attr("id").substr(7)][2]=$('#adsurnm'+$(this).attr("id").substr(7)).val();
							}).focusout(function(){
								var surname = $('#adsurnm'+$(this).attr("id").substr(7)).val();
								
						        if(surname.length<4 && surname.length!=0){ $('#adsurnm'+$(this).attr("id").substr(7)).addClass('incrinput');}
							});	
							$('#admob'+i).keyup(function(){
								var mobile = $('#admob'+$(this).attr("id").substr(5)).val();
								if((mobile.length!=9 || String(mobile)[0]!=5) && (mobile.length!=0));
								 else $('#admob'+$(this).attr("id").substr(5)).removeClass("incrinput");
								numid[$(this).attr("id").substr(5)][1]=1;
								qvst[clas][$(this).attr("id").substr(5)][3]=$('#admob'+$(this).attr("id").substr(5)).val();
								
							}).focusout(function(){
								var mobile = $('#admob'+$(this).attr("id").substr(5)).val();
								if((mobile.length!=9 || String(mobile)[0]!=5) && (mobile.length!=0)){
									$('#admob'+$(this).attr("id").substr(5)).addClass('incrinput');
								} 
							});
						}
						if((typeof(qvst[clas])=='undefined' || qvst[clas].length==0) && clas!=-1) addline();
			}

				$(document).ready(function(){
					all(0);
					$('#slcclass').change(function(){
						all(1);
						$('.invisible').css({"display":"block"});
					});
					
				});

		
		$('.adtextar2').geo();
	</script>
</body>
</html>