<?php
//$loc="../";
require_once("connections.php");
$aSubjs=0;
$subjects=['','მათემატიკა','ინგლისური','ქართული'];
function conf_query(){
  global $con;
    if(mysqli_error($con)) die("Database connection failed ".mysqli_error($con));
}

function redirect_to($location = NULL){
    if($location!=NULL){
        header("Location: {$location}");
        exit;
  }
}
function load(){
     global $id,$username,$hashed,$con;
    mysqli_query($con,"SET NAMES 'utf8'");
     if(isset($_SESSION["id"])){
        $id=intval($_SESSION["id"]);
     } else $id=0;
     if(isset($_SESSION["username"])){
        $username=strval($_SESSION["username"]);
     } else $username="";
     if(isset($_SESSION["hashed"])){
        $hashed=strval($_SESSION["hashed"]);
     } else $hashed="";
     if(isset($_SESSION['aSubjs'])){
       $aSubjs=intval($_SESSION['aSubjs']);
     }
}
function headerr0(){
  global $loc;
  echo '<div class="upper">
      <img src="'.$loc.'css/work-02.svg" id="logo" style="cursor:pointer" onclick="location.href=\''.$loc.'user/home.php\'">
    </div>';
}
function headerr(){
  global $loc;
  echo '<div class="upper">
      <img src="'.$loc.'css/work-02.svg" id="logo" style="cursor:pointer" onclick="location.href=\''.$loc.'user/home.php\'">
      </div>
      <div id="homebar"> <table > <tr> <td> <img src="'.$loc.'css/img/home-black-shape.svg" style="width:30px; margin: 0px 30px 0px 80px" onclick="location.href=\''.$loc.'user/home.php\'"> </td> <td onclick="location.href=$loc+\'user/addstudents.php\'"> მოსწავლების დამატება</td> <td onclick="location.href=$loc+\'user/testbank.php\'">ტესტ ბანკი</td><td onclick="location.href=$loc+\'user/profile.php\'"> პროფილი </td> <td style="padding-left: 30px;" onclick="location.href=$loc+\'logout.php\'">გასვლა</td> </tr></table> </div>

    ';
}
function headerh($id){
  global $loc;
  global $con;
  $user=get_all_things($id);
  $name=$user['name'];
  $username=$user['username'];
  $query="SELECT COUNT(*) FROM students WHERE tchid={$id}";
  $result=mysqli_query($con,$query) or die(mysqli_error($con));
  $res=mysqli_fetch_array($result);
  $numstudents=$res[0];
  echo '<div class="upper">
      <img src="'.$loc.'css/work-02.svg" id="logo" style="cursor:pointer" onclick="location.href=\''.$loc.'user/home.php\'">
      <div style="margin-top: -40px">
      <div class="gamarjoba" style="display:block"> თქვენი კოდია: '.$username.' </div><div class="gamarjoba"> თქვენი მოსწავლეები: '.$numstudents.' </div> <div class="gamarjoba" style="margin-top: -30px; margin-left: 62%"> გამარჯობა, '.$name.' </div> 
      </div>
      </div>
      <div id="homebar"> <table > <tr> <td> <img src="'.$loc.'css/img/home-black-shape.svg" style="width:30px; margin: 0px 30px 0px 80px" onclick="location.href=\''.$loc.'user/home.php\'"> </td> <td onclick="location.href=$loc+\'user/addstudents.php\'"> მოსწავლების დამატება</td> <td onclick="location.href=$loc+\'user/testbank.php\'">ტესტ ბანკი</td><td onclick="location.href=$loc+\'user/profile.php\'"> პროფილი </td> <td style="padding-left: 30px;" onclick="location.href=$loc+\'logout.php\'">გასვლა</td> </tr></table> </div>

    ';
}
function headerr2($username){
  global $loc;
  echo '<div class="upper2">
      <img src="'.$loc.'css/kings.svg" id="logo" onclick="location.href=\''.$loc.'admin/home.php\'" style="cursor:pointer"/>
    </div>
    <div id="myusername">'.$username.'</div>
    <div class="logbotbut" id="logout" onclick="location.href=\''.$loc.'logout.php\'"> გასვლა</div> <br> <br>';
}
function headerr3(){
  global $loc;
  echo '<div class="upper" id="headerr3is">
      <img src="'.$loc.'css/work-02.svg" class="logo3" id="logo" style="cursor:pointer" onclick="location.href=\''.$loc.'user/home.php\'">
    </div>';
}
function gt_first_subj($subj){ //ორობითი ჩანაწერიდან ამოვიღოთ პირველი ერთიანი
    $pw=1;
    for($i=1; $i<=10; $i++){
        $pw*=2;
        if($subj&$pw) return $i;
    }
    return 0;
}
/*function get_topics(){
    global $con;
    $query="SELECT id,name,subj,class FROM topics";
    $results=mysqli_query($con,$query);
    $ds=array();
    $ds[]=0;
    while($res=mysqli_fetch_array($results, MYSQLI_NUM)){
        $ds[$res[0]]=$res;
    }
    return $ds;
}
function get_sub_topics(){
    global $con;
    $query="SELECT id,tid,name,stid FROM subtopics";
    $results=mysqli_query($con,$query);
    $ds=array();
    $ds[]=[];
    while($res=mysqli_fetch_array($results, MYSQLI_NUM)){
        if(!isset($ds[$res[1]])) $ds[$res[1]]=[];
        $ds[$res[1]][]=$res;
    }
    return $ds;
}*/
function is_user($id,$username,$hashed){
    global $con,$lsttimelogin,$aSubjs;
    if(isset($_SESSION['user'],$_SESSION['id'],$_SESSION['aSubjs']) && $_SESSION['id']==$id && isset($_SESSION['registered']) && $_SESSION['registered']==1) {
        $lsttimelogin=$_SESSION['lastlogin'];
        if(isset($_SESSION['aSubjs']))  $aSubjs=intval($_SESSION['aSubjs']);
        return 1;
    }
  $id=intval($id);
  if(preg_match('/[^A-Za-z0-9]/', $username)) return 0;
  if(preg_match('/[^A-Za-z0-9]/', $hashed)) return 0;
  $query="SELECT id,lastlogin,registered,subject FROM usert where id={$id} AND username='{$username}' AND hashed_password='{$hashed}'";
  $results=mysqli_query($con,$query);
    if(!mysqli_num_rows($results)) return 0;
    $res=mysqli_fetch_array($results);
    $lsttimelogin=$res['lastlogin'];

    if(intval($res['subject'])!=5) { 
      $_SESSION['aSubjs']=pow(2,intval($res['subject']));
      $aSubjs=pow(2,$res['subject']);
    }
    else {
      $_SESSION['aSubjs']=2;
      $aSubjs=2;
    } 
    $reg=$res['registered'];
    if($reg==0) return 0;
    $_SESSION['lastlogin']=$lsttimelogin;
    $dttm=date('Y-m-d H:i:s',time());
    $query="UPDATE usert set lastlogin='{$dttm}' WHERE id={$id}";
    $results=mysqli_query($con,$query);
    $_SESSION['user']=1;
    
    return 1;
}
function is_admin($id,$username,$hashed){
  //echo "aaaaa"; echo "id=".$id;
  global $con,$aSubjs;
    if(isset($_SESSION['isAdmin'],$_SESSION['id'],$_SESSION['aSubjs']) && isset($_SESSION['rank']) && $_SESSION['id']==$id) {
      $aSubjs=intval($_SESSION['aSubjs']); return $_SESSION['rank'];
    }
  $id=intval($id);
  if(preg_match('/[^A-Za-z0-9]/', $username)) return 0;
  if(preg_match('/[^A-Za-z0-9]/', $hashed)) return 0;
  /*
  echo "username=".$username;
  echo "hashed_password=".$hashed;*/
  $query="SELECT rnk,subjs FROM admins where id={$id} AND username='{$username}' AND hashed_password='{$hashed}'";
  $results=mysqli_query($con,$query);
    if(!mysqli_num_rows($results)) return 0;
    $res=mysqli_fetch_array($results);
    $_SESSION['rank']=intval($res['rnk']);
    $_SESSION['aSubjs']=intval($res['subjs']);
    $aSubjs=intval($res['subjs']);
    $_SESSION['isAdmin']=1;
    return $res['rnk'];
  //$result=mysqli_fetch_array($result_set);
}
function get_cities(){
    global $con;
    $query="SELECT id,name,code,region FROM cities";
    $results=mysqli_query($con,$query);
    $ds=array();
    $ds[]=0;
    while($res=mysqli_fetch_array($results, MYSQLI_NUM)){
        $ds[$res[0]]=$res;
    }
    return $ds;
}
function get_all_things($idd){
    global $con;
    $idd=intval($idd);
    $query="SELECT * FROM usert where id={$idd}";
    $results=mysqli_query($con,$query);
    $res=mysqli_fetch_array($results,MYSQLI_ASSOC);
    return $res;
}
function get_schools(){
    global $con;
    $query="SELECT id,name,code,city_code FROM schools";
    $results=mysqli_query($con,$query);
    $ds=array();
    $ds[]=0;
    while($res=mysqli_fetch_array($results, MYSQLI_NUM)){
        $ds[$res[0]]=[$res[0],htmlspecialchars($res[1], ENT_QUOTES, 'UTF-8'),$res[2],$res[3]];
    }
    return $ds;
}
function get_city_by_name($nme){
    global $con;
    $nme=strval($nme);
    $query="SELECT id,name,code,region FROM cities where name='{$nme}'";
    $results=mysqli_query($con,$query);
    //conf_query($results);
    if(!mysqli_num_rows($results)) return 0;
    $res=mysqli_fetch_array($results, MYSQLI_NUM);
    return $res;
}
function get_school_by_city_and_name($nme,$city_code){
    global $con;
    $nme=strval($nme);
    $city_code=intval($city_code);
    $query="SELECT id,name,code,city_code FROM schools where city_code={$city_code} AND name='{$nme}'";
    $results=mysqli_query($con,$query);
    //conf_query($results);
    if(!mysqli_num_rows($results)) return 0;
    $res=mysqli_fetch_array($results, MYSQLI_NUM);
    return $res;
}
function get_sch_topics($cls=0){
    global $con;
    if($cls==0) $query="SELECT id,name,subj,class,parent,pos FROM sch_topics ORDER BY parent ASC, pos ASC";
    else $query="SELECT id,name,subj,class,parent,pos FROM sch_topics WHERE class={$cls} ORDER BY parent ASC, pos ASC";
    $results=mysqli_query($con,$query);
    $ds=array();
    $ds[]=0;
    $i=0;
    while($res=mysqli_fetch_array($results, MYSQLI_NUM)){
        $ds[$i++]=$res;
    }
    return $ds;
}

function get_sch_topics2($cls=0){
    global $con;
    if($cls==0) $query="SELECT id,name,subj,class,parent,pos FROM sch_topics ORDER BY parent ASC, pos ASC";
    else $query="SELECT id,name,subj,class,parent,pos FROM sch_topics WHERE class={$cls} ORDER BY parent ASC, pos ASC";
    $results=mysqli_query($con,$query);
    $ds=array();
    $ds[]=0;
    $i=0;
    while($res=mysqli_fetch_array($results, MYSQLI_NUM)){
        $ds[$res[0]]=$res;
    }
    return $ds;
}
function can_view_user($rnk){
    if($rnk==5) return 1;
    /*global $id;
    if($id==1 || $id==4 || $id==5 || $id==6) return 1;*/
    return 0;
}
function can_question($rnk){
    if($rnk==5 || $rnk==4 || $rnk=6) return 1;
    return 0;
}
function can_delete_question($rnk,$auth){
    global $id;
    if($rnk==4 || $rnk==5 || $rnk=6) return 1;
    return 0;
}
function tlmurl($str,$mnis){
    if(!empty($_GET)){
        $x='';
        $bl=0;
        $bnl=0;
        foreach($_GET as $key => $value){
            if($bl==1) $x.='&';
            $bl=1;
            if($key!=$str) $x.=$key.'='.$value;
            else {$x.=$key.'='.$mnis; $bnl=1;}
        }
        if($bnl==0 && $str!='') $x.='&'.$str.'='.$mnis;
        return $x;
    }
    return $str.'='.$mnis;
}
function incinhead(){
    global $loc,$favicon;
    $x='';
    $x.='
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $x.='<link rel="shortcut icon" href="'.$loc.$favicon.'"/>
    <link rel="stylesheet" type="text/css" href="'.$loc.'css/styles.css?14">
    <script src="'.$loc.'js/jquery-2.1.0.min.js"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=AM_HTMLorMML-full.js"></script>
    <script> $loc="'.$loc.'"; </script>
    <script src="'.$loc.'js/jquery.geo.typing.js"></script>
    <script src="'.$loc.'js/javascript.js?21"></script>
    ';
    $x.="<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-106322693-1', 'auto');
  ga('send', 'pageview');
</script>";

$x.='<script type="text/x-mathjax-config">MathJax.Hub.Config({messageStyle: "none"});</script>';
    return $x;
}
?>