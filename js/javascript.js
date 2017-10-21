function logincheck() {
    var username = $("#username").val();
    var password = $("#password").val();
    $("#username,#password").removeClass("incrinput");
    $("#username,#password").keydown(function () { $(this).removeClass("incrinput"); });
    $.post($loc+"php/logincheck.php", { username: username, password: password }, function (succ) {
        console.log(succ);
        if (succ == -1) {
            window.location.href = '' + $loc + 'user/home.php';
        }
        else if(succ==-2){
            window.location.href = ''+ $loc + 'user/registration.php';
        }
        else { $("#username,#password").addClass('incrinput');}
    });
}
function adlogincheck() {
    var username = $("#username").val();
    var password = $("#password").val();
    $("#username,#password").removeClass("incrinput");
    $("#username,#password").keydown(function () { $(this).removeClass("incrinput"); });
    $.post($loc+"php/adlogincheck.php", { username: username, password: password }, function (succ) {
        console.log(succ);
        if (succ == -1) {
            window.location.href = '' + $loc + 'admin/home.php';
        }
        else {
            $("#username,#password").addClass('incrinput');
        }
    });
}

function rgcheckk(a){
    if(typeof a == 'undefined'){var ariss=0;}
    else var ariss=a;
    console.log('aris=',ariss);
    var crct=1;
    var name = $("#name").val();
    var surname = $("#surname").val();
    if(ariss==1) {var pass = makepassword();}
    else {
        var pass = $("#password").val();
        var pass2 = $("#password2").val();
    }
    var mob = $("#mob").val();
    var school = $('#slcschool option:selected').val();
    //var mail=$("#mail").val();
    var city = $('#slccity option:selected').val();
    var subject = $('#slcsubj option:selected').val();
    $("#name,#surname,#mob,#slccity,#slcsubj,#school,#password, #password2").removeClass("incrinput");//
    $("#name,#surname,#mob,#password, #password2").keydown(function () { $(this).removeClass("incrinput"); });//#mail
    $('#slcsubj').change(function () { $('#slcsubj').removeClass("incrinput"); });
    $('.some1').change(function () { $('[data-id="slccity"]').removeClass("incrinput"); });
    $('.some2').change(function () { $('[data-id="slcschool"]').removeClass("incrinput"); });
    //if(mail.length!=0 && !mail.match('@')) {$("#mail").addClass('incrinput'); crct=0;}
    if(name.length<2) {$("#name").addClass('incrinput'); crct=0;}
    if(surname.length<4) {$("#surname").addClass('incrinput'); crct=0;}
    if(ariss==0){
        if(pass.length==0) {$("#password").addClass('incrinput'); crct=0;}
        if(pass2.length==0) {$("#password2").addClass('incrinput'); crct=0;}
        if(pass!=pass2)  {$("#password,#password2").addClass('incrinput'); crct=0;}
    }
    
    if(mob.length!=9 || String(mob)[0]!=5) {$("#mob").addClass('incrinput'); crct=0;}
    if(city==0) {$('[data-id="slccity"]').addClass('incrinput'); crct=0;}
    if(subject==0) {$("#slcsubj").addClass('incrinput'); crct=0;}
    if(school==0) {$('[data-id="slcschool"]').addClass('incrinput'); crct=0;}
   // if(mail.length<7) {$("#mail").addClass('incrinput'); crct=0;}
    if(crct==0) return;
    uName=name; uSurname=surname; uPass=pass; uMob=parseInt(mob); uCity=parseInt(city); uSubject=parseInt(subject); /*uMail=mail;*/ uSchool=school;
    
    
    if(ariss==2){
        $.post($loc+"php/updprofile.php", { uName: uName, uSurname:uSurname, uMob:uMob, uCity:uCity, uSchool:uSchool, uSubject:uSubject, ariss:ariss }, function (succ2) {
            console.log(succ2);
            console.log("succ2=",succ2);
            if(succ2==-1) alert("თქვენი პროფილი განახლებულია");
            else if(succ2==22) alert("აღნიშნული ტელეფონის ნომერი უკვე დარეგისტრირებულია");
        });
    } 
    else{
        $('body').append('<div class="blck"></div>');
        $.post($loc+"php/regusert.php", { uName: uName, uSurname:uSurname, uPass:uPass, uMob:uMob, uCity:uCity, uSubject:uSubject, /*uMail:uMail,*/ uSchool:uSchool, uSubject:uSubject, ariss:ariss }, function (succ) {
            console.log(succ);
            succ=JSON.parse(succ);
           // console.log("succ.length=",succ.length);
            if(succ.length==4){

                alert('გთხოვთ, პაროლის ველში შეიყვანოთ სტანდარტული სიმბოლოები');
                $('.blck').remove();
            }
            else if(succ.length==5){
                alert('გთხოვთ, სახელი შეიყვანოთ ქართული ასოებით');
                $('.blck').remove();
            }
            else if(succ.length==2){
                alert('გთხოვთ, გვარი შეიყვანოთ ქართული ასოებით');
                $('.blck').remove();
            }
            else if(succ.length==3){
                $('#tstmain').html('<div class="dsrlbtest"></div>');
                $('.lgcont').remove();
                $('.main').html('<p style="font-size: 25px; margin: auto; margin-top: 30px;">აღნიშნული ტელეფონის ნომერი უკვე დარეგისტრირებულია</p><br/><br><p class="logbotbut" style="display: block; cursor:pointer; max-width: 200px; margin: 0 auto;" onclick="location.href=\'../login.php\'">სცადეთ შესვლა</p><br><br>');
                $('.blck').remove();
            }


            else {
                console.log("ranairad");
                $('#tstmain').html('<div class="dsrlbtest"></div>');
                $('.lgcont').remove();
                if(succ.length==0){ 
                    console.log("შეცდომაა");
                    $('.dsrlbtest').html('რაღაც შეცდომაა 😔');
                }
                else if(succ.length==1){
                    console.log("სწორია. username=",succ[0]);
                    yy='<p style="font-size: 21px; margin: auto; margin-top: 30px; text-align: center">თქვენ წარმატებით დარეგისტრირდით,<br/>შეგიძლიათ, შეხვიდეთ თქვენს პირად პროფილში მონაცემების გამოყნებით, რომელიც გამოგეგზავნათ სმს-ის სახით მითითებულ ნომერზე.</p><br/>';
                    yy+='<div class="lgcont"><div class="logbox"> <input type="text" id="username" placeholder="კოდი" name="code" value='+succ[0]+' ><input type="password" id="password" placeholder="პაროლი" style="height:29px;"></div><div class="logbotbut" onclick="logincheck()"> შესვლა</div> </div> <br>';
                    yy+='<div><br/><input type="number" id="mobbilurio" placeholder="მობილური" value="'+uMob+'" style=" display: block; margin: 6px auto; font-size: 20px; border-radius: 2px; border: 1px solid #bfbfbf; padding: 7px 5px;"><br/><a class="logbotbut" style="font-size: 14px; cursor:pointer; margin: auto; display: block" onclick="tvdngmgzvn()">სმს-ის თავიდან გამოგზავნა აღნიშნულ ნომერზე</a><br></div>';
                    $('.main').html(yy);
                }
                $('.blck').remove();
            }
        });
    }
}
function updpassword(){
    var crct=1;
    var passold = $("#passwordold").val();
    var pass = $("#password").val();
    var pass2 = $("#password2").val();
    $("#passwordold,#password, #password2").removeClass("incrinput");//
    $("#passwordold,#password, #password2").keydown(function () { 
        $(this).removeClass("incrinput");
    });
    if(pass.length==0) {$("#password").addClass('incrinput'); crct=0;}
    if(pass2.length==0) {$("#password2").addClass('incrinput'); crct=0;}
    if(pass!=pass2)  {$("#password,#password2").addClass('incrinput'); crct=0;}
    if(crct!=1) return;
    $.post($loc+'php/changepass.php',{passold:passold, pass:pass},function(succ){
        console.log("succ=",succ);
        if(succ==-1) {
            alert('პაროლი შეცვლილია');
            location.reload();
        }
        else if(succ==-2) {
            alert('პაროლი არასწორია');
            $("#passwordold").addClass('incrinput');

        }
        else {
            if(succ=-3) alert('გთხოვთ, პაროლის ველში შეიყვანოთ სტანდარტული სიმბოლოები');
        }
    });

}
function tvdngmgzvn(){
    number=$('#mobbilurio').val();
    $.post("../php/sndnum.php",{ number:number}, function (succ){
            console.log(succ);
    });

}
function makepassword() {
  var text = "";
  var possible = "0123456789";

  for (var i = 0; i < 6; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

function ldschool(city,school){
    var xx='';
    console.log("city=",city,"school=",school);
    var cit1=city;
    if(city==250) {$('#slcschool').html('<option value="-1">სხვა</option>'); return;}
    if(city==0) {$('#slcschool').html('<option value="0">აირჩიეთ სკოლა</option>'); return;}
    xx+='<option value="0">აირჩიეთ სკოლა</option>';
    for(var i=0; i<schools.length; i++){
        if(schools[i][3]!=cities[cit1][2]) continue;
        if(schools[i][0]==school) {console.log("selected"); $dmt='selected';} else $dmt='';
        xx+='<option value="'+schools[i][0]+'" '+$dmt+'>'+schools[i][1]+'</option>';
    }
    if(school==-1) $dmt='selected'; else $dmt='';
    xx+='<option value="-1" '+$dmt+'>სხვა</option>';
    $('#slcschool').html(xx);
    $('#slcschool').selectpicker('refresh');
}


function addstd(){
    var clasi = $('#slcclass option:selected').val();
    if(clasi>0){
        $.post("../php/addstd.php",{ clasi:clasi, qvst:JSON.stringify(qvst[clasi]), numid:JSON.stringify(numid)}, function (succ){
            console.log(succ);
            if(succ==1) {alert("თქვენი მოსწავლეების მონაცემები შენახულია"); location.href="addstudents.php?class="+clasi;}
            else alert("რაღაც შეცდომაა");
        });
    }
}
var numid=new Array();

function students(clas,len,rml){
    var x='';
    if(typeof(qvst[clas])=='undefined') return;
    
    var sl=40;
    if(rml==1) len=0;
    for(i=len; i<qvst[clas].length; i++){
        x+="<p class='just ramdeni' style='margin-left:11%'> "+(i+1)+"</p><input  class=\"adtextar2\" id=adname"+i+" value=\""+qvst[clas][i][1]+"\"></input> <input  class=\"adtextar2\" id=adsurnm"+i+" value=\""+qvst[clas][i][2]+"\" style='margin-left:5%'></input><input type='number' class=\"adtextar2\" id=admob"+i+" value=\""+qvst[clas][i][3]+"\" style='margin-left:5%'></input> <br/>";
        numid[i]=[qvst[clas][i][0]];
    }
    if(rml==1) $('#studentadd').html(x);
    else
    $('#studentadd').append(x);
    console.log(rml);
}
function opngallery(idn) {
    $('body').prepend('<div class="blck"></div><div class="whtn"></div>');
    $.post($loc+"php/getpics.php", {}, function (succ) {
        succ = JSON.parse(succ);
        console.log(succ);
        var x = '';
        for (var i = 0; i < succ.length; i++) {
            x += '<div class="whtpict" onclick="chsnpict(\'' + idn + '\',\'../imgs/' + succ[i].url + '\')" style="background:url(../imgs/' + succ[i].url + '); background-size:cover;"></div>';
        }
        $('.whtn').html(x);
    });
    $('.blck').click(function () {
        $(this).next().remove();
        $(this).remove();
    });
}
function chsnpict(idn,url) {
    if(idn!="-1" && (typeof(idn)!='number' || idn>=0)) $('#adtxt' + idn + '').val($('#adtxt' + idn + '').val() + '<img src="' + url + '"/>');
    else $('#adaxnsaganm').val($('#adaxnsaganm').val() + '<img src="' + url + '"/>');
    $('.blck').next().remove();
    $('.blck').remove();
}
function addq(rml,idd) {
    if($('#adtxtTXT').length>0){
        addtq(rml,idd);
        return;
    }
    $('body').append('<div class="blck"></div>');
    ristvis=$('#locselc  option:selected').val();
    $type=$('#tpselc option:selected').val();
    //console.log("typeunda=",$type);
    $class = $('#classelc option:selected').val();
    if(rml!=3) $topic = $('#topicselc option:selected').val();
    if($('#sch_topicselc').length>0) $sch_topic=$('#sch_topicselc option:selected').val(); else $sch_topic=0;
    if($('#chssubj').length==0) subj=lstsubj; else subj = $('#chssubj option:selected').val();
    if($('.subtopicselc').length==0) subtopic=0; else {
        var nn=$('.subtopicselc').length;
        subtopic=$('#subtopicselc'+(nn)+' option:selected').val();
        if(subtopic==0 && nn>1) subtopic=$('#subtopicselc'+(nn-1)+' option:selected').val();
    }
    var ch = new Array();
    var aris = 0;
    $('.adtextar').css({ 'border-color': '#6483d0' });
    $('.adtextar').keydown(function () { $(this).css({ 'border-color': '#6483d0' }); });
    
    q = $('#adtxt0').val();
    qrnk=0;
    if($('#qrnkselc').length!=0) qrnk=$('#qrnkselc option:selected').val();
    axsn=$("#adaxnsaganm").val();
    axsn = axsn.replace(String.fromCharCode(9), '');
    if (q.length == 0) { $('#adtxt0').css('border-color', 'red'); aris = 1; }
    $('.shem2').each(function () {
        if ($(this).attr('id') == 'adtxt0');
        else {
            if ($(this).val().length > 0) {
                var cch=$(this).val();
                cch = cch.replace(String.fromCharCode(9), '');
                ch.push(cch);
            }
        }
    }).promise().done(function () {

        if (ch.length < 2 && $type==1) {
            aris = 1;
            alert('შეავსეთ მინიმუმ 2 სავარაუდო პასუხი');
        }
        else if(ch.length < 1 && $type==2){
            aris = 1;
            alert('შეიყვანეთ სწორი პასუხი');                
        }
        if (aris == 1) {$('.blck').remove(); return;}
        q = q.replace(String.fromCharCode(9), '');

        var checkedValue = 0; 
        var inputElements = document.getElementsByClassName('messageCheckbox');
        for(var i=0; inputElements[i]; ++i){
              if(inputElements[i].checked){
                   checkedValue += Math.pow(2,parseInt(inputElements[i].value));
              }
        }
        var shenishvna='';
        if($('#shenishvna').length>0){
            shenishvna=$('#shenishvna').val();
        }
        console.log("ristvis=",ristvis);

        if(rml==1)
        $.post($loc+"php/addq.php", { type:$type, subj: subj, ristvis: ristvis, class: $class, topic: $topic, subtopic: subtopic, q: q, ch: JSON.stringify(ch), qrnk: qrnk, axsn : axsn }, function (succ) {
            $('.blck').remove();
            console.log(succ);
            if (succ > 0) {
                location.href = 'q.php?id='+succ;
            }
        });
        else if(rml==2)
        $.post($loc+"php/changeq.php", { idd : idd, type: $type, subj: subj, ristvis: ristvis, class: $class, topic: $topic, subtopic: subtopic, q: q, ch: JSON.stringify(ch), qrnk: qrnk, axsn : axsn, checkedValue: checkedValue, shenishvna:shenishvna }, function (succ) {
            $('.blck').remove();
            console.log(succ);
            if (succ == -1) {
                location.href = 'q.php?id='+idd;
            }
        });
    });
}
function opnshenshvktxvb(subj){
    $('body').prepend('<div class="blck"></div>');
    $.post($loc+"php/shenishvnebiani_kitxvebi.php", { subj: subj }, function (succ) {
        console.log(succ);
        succ=JSON.parse(succ);
        var x='<table class="mmdtbl">';
        x+='<thead><tr><th>კლასი</th><th>ნანახი</th><th>შენიშვნის ნახვა</th></tr></thead><tbody>';
        for(var i=0; i<succ.length; i++){
            x+='<tr>';
            x+='<td>'+succ[i].class+'</td>';
            x+='<td>'; if(succ[i].seen==0)  x+='უნახავი'; x+='</td>';
            x+='<td><a href="q.php?id='+(succ[i].id)+'" target="_blank"><img src="../css/img/view.png" /></a></td>';
            x+='</tr>';
        }
        x+='</tbody></table>';
        $('.blck').after('<div class="whtn" style="box-shadow:none">'+x+'</div>');
        $('.blck').click(function () {
            $(this).next().remove();
            $(this).remove();
        });
    });
}
var tstbnk=0;
function updTopcs(){
    var x='';
   
    if($('#chssubj').length==0) $subj=lstsubj;
    else $subj = parseInt($('#chssubj option:selected').val());

    $('#qrnkselctdiv').show();
    if($subj==1) $('.arswrtar').show(); else $('.arswrtar').hide();

    $class = $('#classelc option:selected').val();
    x+='<option value="0" selected >აირჩიეთ თემა</option>'; 
    for(var i in $sch_topics){

        if($sch_topics[i][2]!=$subj || $sch_topics[i][3]!=$class || $sch_topics[i][4]!=0) continue;
        if($sch_topics[i][0]==$slctdTopic) { x+='<option value="'+$sch_topics[i][0]+'" selected>'+$sch_topics[i][1]+'</option>'; }
        else {x+='<option value="'+$sch_topics[i][0]+'">'+$sch_topics[i][1]+'</option>';} 
    }
    $('#topicselc').html(x);
    updSubtopics(1);
    $("#topicselc").change(function () { 
         updSubtopics(1);
         if($("#topicselc").val()==0) $('#DvSbtpc').html('');
    });
    if($("#topicselc").val()==0) $('#DvSbtpc').html('');
     updSch_Topics();
}
var sbtpcs=[];
function updSubtopics(lvl){
    console.log('lvl',lvl);
    $('#subtopicselc'+(lvl-1)).nextAll('br').remove();
    for(var i=lvl; i<40; i++){
        if($('#subtopicselc'+i).length>0) $('#subtopicselc'+i).remove();
        else break;
    }
    if(lvl<sbtpcs.length) sbtpcs.length=lvl; 
    if($('#chssubj').length==0) $subj=lstsubj;
    else $subj = $('#chssubj option:selected').val();
    if($('#topicselc').length==0) {$('#DvSbtpc').html(''); return;}
    $topic = $('#topicselc option:selected').val();
    if(lvl!=1){$topic=sbtpcs[lvl-1];}
   // console.log("topic=",$topic);
    /*if($sch_topics[$topic][1]=='ტექსტის გააზრება' && ((tstbnk!=0 && $subj!=3) || tstbnk==0)) {
        updsheskvn($subj,3);
    }
    else*/
     if($subj!=4 && lsttype!=0){
        updsheskvn($subj);
    }
    //if(typeof($subtopics[$topic])=='undefined' || $subtopics[$topic].length==0) {$('#DvSbtpc').html(''); return;}
    var x='<br/><br/><select class="slctio subtopicselc" id="subtopicselc'+lvl+'" style="width:100%">';
    x+='<option value="0">აირჩიეთ ქვეთემა</option>';
    var shvd=0;

    for(var i=0; i<$subtopics.length; i++){
       // if(lvl==1) {if($subtopics[$topic][i][3]!=0) continue;}
        //else {if($subtopics[$topic][i][3]==0) continue; if($subtopics[$topic][i][3]!=sbtpcs[lvl-1]) continue;}
               //console.log(i,"parent=",$subtopics[i][4],"topic=",$topic);
        if($subtopics[i][4]!=$topic) continue;  
            //   console.log("i=",i);

        if(lvl==1) {if($subtopics[i][4]==0) continue; if($sch_topics[$indx[$subtopics[i][4]]][4]!=0) continue;}
        else {

            if($sch_topics[$indx[$subtopics[i][4]]][4]==0) continue;
            if($subtopics[i][4]!=sbtpcs[lvl-1]) continue;
            
        }

        shvd=1;
        if(parseInt($subtopics[i][0])==parseInt($slctdSubtopic) || is_subtpc_parent($topic,$subtopics[i][0],$slctdSubtopic)) {
            x+='<option value="'+$subtopics[i][0]+'" selected>'+$subtopics[i][1]+'</option>';
            sbtpcs[lvl]=parseInt($subtopics[i][0]);
        }
        else x+='<option value="'+$subtopics[i][0]+'">'+$subtopics[i][1]+'</option>'; 

    }
    x+='</select>';
    if(!shvd) { return; }
    if(shvd && typeof(sbtpcs[lvl])=='undefined') sbtpcs[lvl]=0;
    if(lvl==1) $('#DvSbtpc').html(x);
    else $('#DvSbtpc').append(x);
    if (shvd && lvl<6 && sbtpcs[lvl]) updSubtopics(lvl+1);
    //if(lvl>1) return;
    $('#subtopicselc'+lvl).change(function(){
        var lvld=$(this).attr('id').substr(12);
        sbtpcs[lvld]=parseInt($('#subtopicselc'+lvld+' option:selected').val());
        updSubtopics(parseInt(lvld)+1);
    });
}
function updSch_Topics(){
    if($('#chssubj').length==0) $subj=lstsubj;
    else $subj = parseInt($('#chssubj option:selected').val());
    $class = $('#classelc option:selected').val();
    var x='<select class="selectpicker slcpccc" data-show-subtext="true" data-live-search="true" id="sch_topicselc">';
    x+='<option value="0">აირჩიეთ წიგნის ქვეთემა</option>';
    for(var i in $sch_topics){
        if($sch_topics[i][2]!=$subj || $sch_topics[i][3]!=$class) continue;
        if($sch_topics[i][4]==0 && $subj!=2) continue;
        if($sch_topics[i][0]==$slctdSchTopic) x+='<option value="'+$sch_topics[i][0]+'" selected>'+$sch_topics[i][1]+'</option>'; 
        else x+='<option value="'+$sch_topics[i][0]+'">'+$sch_topics[i][1]+'</option>'; 
    }
    x+='</select>';
    $('#wgntmSlctDiv').html(x);
    $('#sch_topicselc').selectpicker('refresh');
}

function updSchTopcs(){
    var x='';
    if($('#chssubj').length==0) $subj=lstsubj;
    else $subj = parseInt($('#chssubj option:selected').val());

    $class = $('#classelc option:selected').val();
    
    x+='<option value="0">აირჩიეთ მშობელი თემა</option>';
    for(var i in $sch_topics){
        if($sch_topics[i][2]!=$subj || $sch_topics[i][3]!=$class) continue;
        if($sch_topics[i][0]==$slctdSchTopic) x+='<option value="'+$sch_topics[i][0]+'" selected>'+$sch_topics[i][1]+'</option>'; 
        else x+='<option value="'+$sch_topics[i][0]+'">'+$sch_topics[i][1]+'</option>'; 
    }
    $('#sch_topicselc').html(x);
    $('#sch_topicselc').selectpicker('refresh');
}

var lsttype=-1;
function updsheskvn(subj,type){
    if(typeof(type)=='undefined') type=0;
    subj=parseInt(subj);
    if(subj==4) type=2; //ლოგიკა
    lsttype=type;
    console.log(subj,type);
    var x='';
    //if(type==0 || type==1){ //ჩვეულებრივი კითხვა
        $('#qrnkselctdiv').show();
        x+='<textarea class="adtextar shem2" id="adtxt0" placeholder="კითხვა"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(0)"></div></div><hr/>';
        x+='<textarea class="adtextar shem2" id="adtxt1" placeholder="სწორი პასუხი"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(1)"></div></div><div id="savaraudo" style="display:block">';
        for(var i=2; i<=5; i++) x+='<textarea class="adtextar shem2" id="adtxt'+i+'" placeholder="სავარაუდო ვარიანტი"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery('+i+')"></div></div>';
        x+='</div><textarea class="adtextar" id="adaxnsaganm" placeholder="ახსნა-განმარტება" style="width: calc(100% - 45px); border-color:#ffc800; min-height: 100px"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(-1)"></div><div class="srchaxsn" onclick="srchAxsna()"></div></div>';
        $('#KtxvDiv').html(x);
        if(subj!=1) $('.arswrtar').hide(); else $('.arswrtar').show();
    //}
    /*else if(type==2){ //ლოგიკის კითხვა
        $('#qrnkselctdiv').hide();
        x+='<textarea class="adtextar shem2" id="adtxt0" placeholder="კითხვა"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(0)"></div></div><hr/>';
        x+='<textarea class="adtextar shem2" id="adtxt1" placeholder="სწორი პასუხი"></textarea>';
        for(var i=2; i<=2; i++) x+='<textarea class="adtextar shem2" id="adtxt'+i+'" placeholder="მინიშნება #'+(i-1)+'"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery('+i+')"></div></div>';
        x+='<textarea class="adtextar" id="adaxnsaganm" placeholder="ახსნა-განმარტება" style="width: calc(100% - 45px); border-color:#ffc800; min-height: 100px"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(-1)"></div></div>';
        $('#KtxvDiv').html(x);
    }
    else if(type==3){ //ტექსტის გააზრება ან ამგვარი ტიპის. ტექსტი და რამდენიმე კითხვა
        x+='<textarea class="adtextar shem2" id="adtxtTXT" placeholder="ტექსტი" style="min-height: 200px;"></textarea><div class="ertd"><div class="imgvtar" onclick="opngallery(\'TXT\')"></div></div><hr/>';
        x+='<div class="plsktxdiv" align="center" onclick="txtaddqustion('+subj+')"><div class="plsktxv"></div>კითხვის დამატება</div>';
        $('.addbutton').text('გამოქვეყნება');
        $('#KtxvDiv').html(x);
    }*/
    $('#qrnkselctdiv').show();
}
function is_subtpc_parent($topic,prnt,chld){
    if(prnt==chld) return 1;
    for(var i=0; i<$subtopics.length; i++){
        if($subtopics[i][4]!=prnt) continue;
        if(is_subtpc_parent($topic,$subtopics[i][0],chld)==1) return 1;
    }
    return 0;
}
function unnescapeHtml(text) {
    return text
        .replace(/&amp;/g, '&')
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"')
        .replace(/&#039;/g, "'");
}
Curq=-1;
Ctype=0;
whchprt=0;
totpas=0;
totcpas=0;
chmshemoxz=new Array();
ch=new Array();
function trnsfch(s) {
    //rewrite string :D
    var n = s.length;
    var s2 = "";
    var stc = new Array();
    var rmdzglk = 0; //რამდენი ძაღლუკა :დ
    var lstbrw=0;
    if(s.indexOf("href")>=0) return s;
    for (var i = 0; i < n; i++) {
        if(s[i]=='`') lstbrw++;
        if(lstbrw%2==1 || s[i]=='`') {s2+=s[i]; continue;}
        if (s[i] == '\n' || s[i] == '\r') {
            s2+='<br/>';
        }
        else if (s[i] == '@') {
            if (rmdzglk % 2 == 1) { rmdzglk++; s2 += '</u>'; }
            else { rmdzglk++; s2 += '<u>'; }
        }
        else if (s[i] == '^' || s[i] == '_') {
            if(i < n - 1 && (s[i+1]=='_' || s[i+1]==' ' || s[i+1]=='.' || s[i+1]==','))  {s2 += s[i]; continue;}
            if (s[i] == '^') s2 += '<sup>';
            else s2 += '<sub>';
            if (i < n - 1) {
                if (s[i + 1] == '(') stc.push(s[i]);
                else {
                    s2 += s[i + 1];
                    if (s[i] == '^') s2 += '</sup>';
                    else s2 += '</sub>';
                }
            }
            i++;
        }
        else if (s[i] == ')' && stc.length>0) {
            if (stc[stc.length - 1] == '^') s2 += '</sup>';
            else if (stc[stc.length - 1] == '_') s2 += '</sub>';
            else s2 += ')';
            stc.pop();
        }
        else if (s[i] == '(') {
            s2 += s[i];
            stc.push(s[i]);
        }
        else if(s[i]=='*') s2+='⋅';
        else s2 += s[i];
    }
    return s2;
}
var expId=0;
var exPln=new Array();
var curQId=0;
var choicesQmixedvit=[];
function wrtq(idd,type,stat,choces,vw,axsn,ql,swr,axlatuwina){
    var choices=new Array();
    if(typeof(axlatuwina)=='undefined') axlatuwina=0;
    if(axlatuwina) curQId=idd;
    var x='';
    if(typeof(vw)=='undefined') vw=0;
    if(typeof(axsn)=='undefined') axsn="";
    if(typeof(ql)=='undefined') ql=0;
    if(typeof(swr)=='undefined') swr=0;
    if(ql>0) {
        x+='<div align="center" id="D1ktxvql">';
        for(var i=0; i<ql; i++){
            var dl=Math.random()*0.4+0.3;
            var rdn=2;
            rdn=Math.ceil(dl/0.4)+1;
            x+='<div class="D1ktxqlstr D1ktxqlstrTst" id="D1ktxqlstr'+i+'_'+idd+'" style="animation: xtnvStr 0.4s -'+dl+'s '+rdn+' ease;"></div>';
        }
        x+='</div>';
    }
    x+='<div class="Qstat">';
    x+=trnsfch(unnescapeHtml(stat));
    x+='</div>';
    x+='<div class="Qchoices">';
    chh=[];
    nn=choces.length;
    //if(type==1) nn=choces.length-1;

    for(var i=0; i<nn; i++){
        choices[i]=[choces[i],i];
        console.log(choices[i],", ");
    }
    Winawhchprt=whchprt;
     console.log("type=",type);
     if(type==2){

        x+='<br/>';
        if(vw==1){
            if(swr==0) x+='<input style="border-color: rgb(15, 218, 15);" value="'+choices[0][0]+'" disabled type="text" class="lgcpsx">';
            else x+='<input style="border-color: rgb(218, 15, 15);" value="'+choices[0][0]+'" disabled type="text" class="lgcpsx">';
            //for(var i=1; i<choices.length; i++) x+='<center>მინიშნება #'+i+': '+choices[i][0]+'</center>';
            x+='</div>';
            x+='<center>';
            if(choices.length>1) x+='<br/>';
            if(axsn.length>0){
                expId++;
                exPln[expId]=axsn;
                x+='<button class="LogShemdgbut" onclick="shwexpln('+expId+','+(200)+')">ახსნა-განმარტება</button><div style="clear:both"></div>';
            }
            x+='</center>';
        }
        else if(vw==0){
            x+='<input id="" class="lgcpsx" type="text" placeholder="ჩაწერეთ პასუხი" />';
        }
    }
    else {
        if(vw==0 || vw==2) choices=shuffleA(choices);
        if(typeof(choicesQmixedvit[idd])=='undefined') choicesQmixedvit[idd]=choices;
        else choices=choicesQmixedvit[idd];
        for(var i=0; i<choices.length; i++) {if(choices[i][1]==swr) {whchprt=i;} chh[i]=choices[i][1];}
        //console.log(choices);
        for(var i=0; i<choices.length; i++){
            dmtcl='';
            if(vw){if(i==whchprt) dmtcl='swrlbl';
                if(vw==2){
                    if(i==whchprt) dmtcl='swrlbl swrlblshmx';
                    else if(chmshemoxz[CCq]==chh[i]) dmtcl='arswrlbl';
                }
            }
        //    if(vw==1 && type==1){ if(choces[nn].indexOf(i)!=-1) dmtcl+=' shlrdb'; }
            if(axlatuwina) radibo='radibo'; else radibo='radiboo';
            x+='<input type="radio" name="'+radibo+'" id="radibo' + i + '" class="usrradios" value="' + i + '"><label for="radibo' + i + '" id="lblch' + i + '" class="lblch1 '+dmtcl+'" style="display:block; margin-top:10px;"><span class="lbsp"></span><a>' + trnsfch(unnescapeHtml(choices[i][0])) + '</a></label>';
        }
        x+='</div>';
        if(vw && axsn.length>0) {
            expId++;
            exPln[expId]=axsn;
            x+='<button class="btnaxsn" onclick="shwexpln('+expId+')">ახსნა-განმარტება</button><div style="clear:both"></div>';
        }
    }
    if(!axlatuwina) whchprt=Winawhchprt;
    if(axlatuwina) {
        ch.length=0;
        for(var i=0; i<chh.length; i++) ch[i]=chh[i];
    }
    return x;
}
function wrttxt(idd,subj,clas,nqs,type,stat,vw,chakec){
    var x='';
    x+='<div class="txtcntrr">';
    x+='<div class="txtzdnwl">ტექსტი<img src="../css/img/arrow-down.svg" style="float:right; width:30px; border: 0px;"></div>';
    x+='<div class="txtactltxt">';
    if(vw==2) x+='<br/><br/><button class="btnchv" onclick="location.href=\''+$loc+'admin/edittxt.php?id='+idd+'\'">ტექსტის რედაქტირება</button><br/><br/><br/>';
    x+=trnsfch(unnescapeHtml(stat));
    x+='</div>';
    x+='</div>';
    return x;
}
function dlt_question(qid){
    if(confirm('ნამდვილად გწადია კითხვის წაშლა? კარგად დაფიქრდი')){
        $('body').prepend('<div class="blck"></div>');
        $.post($loc+"php/del_question.php", { qid: qid }, function (succ) {
            if(succ=='-1') {window.close(); location.href='questions.php';}
            else {console.log(succ); $('.blck').remove(); alert('რაღაც შეცდომაა :/');}
        });
    }
}
function shwexpln(xiid,pxx){


        $('body').append('<div class="shtwvnn"></div><div class="D1tsfdfdbckblion"><div class="D1tsfdblnboxcenter">'+trnsfch(unnescapeHtml(exPln[xiid]))+'<div><button class="axsngsgb" onclick="rmvAxsna()">გასაგებია</button></div></div><div class="D1tslion D1tsarlionaxsna"></div></div>');
        $('.D1tsfdfdbckblion').animate({'bottom':pxx+'px', 'opacity': 1},1000);

    $('#expndiv a[href]').attr('target','__blank');
    MathJax.Hub.Queue(['Typeset', MathJax.Hub, 'math-display']);
}
function addsch_topic(rml,idd) {
    var aris=0;
    $('body').append('<div class="blck"></div>');
    $class = $('#classelc option:selected').val();
    if($('#chssubj').length==0) subj=lstsubj; else subj = $('#chssubj option:selected').val();
    
    $('.adtextar').css({ 'border-color': '#6483d0' });
    $('.adtextar').keydown(function () { $(this).css({ 'border-color': '#6483d0' }); });
    
    q = $('#adtxt0').val();
    q = q.replace(String.fromCharCode(9), '');
    if (q.length == 0) { $('#adtxt0').css('border-color', 'red'); aris = 1; }
    
    if (aris == 1) {$('.blck').remove(); return;}

    prnt=$('#sch_topicselc option:selected').val();

    if(rml==1)
    $.post($loc+"php/addsch_topic.php", { subj: subj, class: $class, parent: prnt,  namee: q }, function (succ) {
        $('.blck').remove();
        console.log(succ);
        if (succ == -1) {
            location.href = 'sch_topics.php';
        }
    });
    else if(rml==2)
    $.post($loc+"php/changesch_topic.php", { idd : idd, subj: subj, class: $class, parent: prnt, namee: q }, function (succ) {
        $('.blck').remove();
        console.log(succ);
        if (succ == -1) {
            location.href = 'sch_topics.php';
        }
    });
}
function gtwrtsch_topics(classs,parent){
    var x='';
    var shevida=0;
    for(var i in $sch_topics){
        if($sch_topics[i][2]!=cSubj) continue;
        if($sch_topics[i][3]!=classs) continue;
        if($sch_topics[i][4]!=parent) continue;
        shevida=1;
        x+='<li>';
        x+=$sch_topics[i][1];
        x+='<div class="slchtpcchange" onclick="location.href=\'editsch_topic.php?id='+$sch_topics[i][0]+'\'"></div><div class="slchtpcdelete" onclick="dlt_sch_topic('+$sch_topics[i][0]+')"></div>';
        x+=gtwrtsch_topics(classs,$sch_topics[i][0]);
        x+='</li>';
    }
    if(shevida) return '<ul>'+x+'</ul>';
    else return '';
}
function dlt_sch_topic(tid,pos){
    if(confirm('ნამდვილად გწადია თემის წაშლა? კარგად დაფიქრდი')){
        $('body').prepend('<div class="blck"></div>');
        $.post($loc+"php/del_sch_topic.php", { tid: tid }, function (succ) {
            if(succ=='-1') {location.href='sch_topics.php';}
            else {console.log(succ); $('.blck').remove(); alert('რაღაც შეცდომაა :/');}
        });
    }
}
function shwexpln(xiid,pxx){


        $('body').append('<div class="shtwvnn"></div><div class="D1tsfdfdbckblion"><div class="D1tsfdblnboxcenter">'+trnsfch(unnescapeHtml(exPln[xiid]))+'<div><button class="axsngsgb" onclick="rmvAxsna()">გასაგებია</button></div></div><div class="D1tslion D1tsarlionaxsna"></div></div>');
        $('.D1tsfdfdbckblion').animate({'bottom':pxx+'px', 'opacity': 1},1000);

    $('#expndiv a[href]').attr('target','__blank');
    MathJax.Hub.Queue(['Typeset', MathJax.Hub, 'math-display']);
}
function findtopic(subj,clas,topic,subtopic){
    i=0; n=0;
    if(typeof(topicsarray[subj][clas][topic])!='undefined'){
        n=topicsarray[subj][clas][topic].length();
        for(i=0; i<n; i++){
            if(topicsarray[subj][clas][topic][i]==subtopic) {truee=1; break;}
            else{
                ans=findtopic(subj,clas,topicsarray[subj][clas][topic][i],subtopic);
                if(ans==1) {truee=1; break;}
            }
        }
        if(truee==1) return 1;
        else return 0;

    }
    else return 0;
}
l=1;
function lddtdtq(subj,clas,topic){
    if(typeof(topic)=='undefined' || topic==0) topic=-1;
    if(typeof(qvs)=='undefined') qvs=new Array();
    var x='';
    var sl=40;
    for(i=0; i<qvst[subj].length; i++){
        if(qvst[subj][i][2]!=clas) continue;
        if(topic!=-1){
            if(qvst[subj][i][5]!=topic && qvst[subj][i][6]==0) continue;
            else if(qvst[subj][i][6]!=0){
                wasfound=findtopic(subj,clas,topic,qvst[subj][i][6]);
                if(wasfound==0) continue
            }
        }
        if(sl==0) break;
        qvst[subj][i][0]=parseInt(qvst[subj][i][0]);
        if(qvs.indexOf(qvst[subj][i][0])!=-1) dmtclass='chsselected'; else dmtclass='';
        if(0==0) {
            svr='';
            for(var j=0; j<qvst[subj][i][3].length; j++){
                svr+='<li>'+qvst[subj][i][3][j]+'</li>';
            }
            if(typeof(editshivar)!='undefined' && editshivar==1){
                x+='<div class="chsqvst '+dmtclass+'" qvstn_id="'+qvst[subj][i][0]+'" romlii='+i+' romelia="'+qvst[subj][i][4]+'" onclick="qvstsel(this,0,'+subj+')">'+trnsfch(unnescapeHtml(qvst[subj][i][1]))+'<div class="svrdbchnd"><ul>'+svr+'</ul><br/></div></div>';
                if(dmtclass=='chsselected'){
                    newth='<table><tr id="washlistvis'+qvst[subj][i][0]+'"> <td class="washla"> '+l+'. </td><td><div class="mytstqtns" >'+trnsfch(unnescapeHtml(qvst[subj][i][1]))+'</div> </td> <td><a href="q.php?id='+qvst[subj][i][0]+'" target="_blank"><img id="rubbishimg" src="../css/img/view.png" /></a> </td> <td> <img id="rubbishimg" src="../css/img/rubbish-bin-delete-button.svg" onclick="rmvmyqvstn('+qvst[subj][i][0]+',this)"> </td> <tr> </table>';//if(qvst[subj][i][4]==1) x+='<a href="qbnk.php?id='+qvst[subj][i][0]+'" style="color:white" target="__blank">კითხვის ნახვა</a></div></div>';
                    l++;
                    $('#myqvstns').append(newth);
                }
            }
            else {
                x+='<div class="chsqvst '+dmtclass+'" qvstn_id="'+qvst[subj][i][0]+'"  romlii='+i+' romelia="'+qvst[subj][i][4]+'" onclick="qvstsel(this,0,'+subj+',$(\'.chsselected\').length)">'+trnsfch(unnescapeHtml(qvst[subj][i][1]))+'<div class="svrdbchnd"><ul>'+svr+'</ul><br/>';
                //else
               // x+='<a href="q.php?id='+qvst[subj][i][0]+'" style="color:white" target="__blank">კითხვის ნახვა</a>';
                x+='</div></div>';
            }
        }
        //x+='<div class="chsqvst '+dmtclass+'" qvstn_id="'+qvst[subj][i][0]+'" onclick="qvstsel(this)">'+qvst[subj][i][1]+'</div>';
    }
    $('#qvstns').html(x);
    $('.subtopicselc').change(function(){
        console.log('camein');
        $n=$('.subtopicselc').length;
        if($('#subtopicselc'+$n+' option:selected').val()!=0){
        lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val(),$('#subtopicselc'+$n+' option:selected').val());
        }
        else  lddtdtq($('#chssubj option:selected').val(),$('#classelc option:selected').val(),$('#subtopicselc'+($n-1)+' option:selected').val());
    });
}

//console.log("chselected=",)
function qvstsel(th,t_type,subj,n){
    n=$('.chsselected').length;
    if(typeof(t_type)=='undefined') t_type=0;
    if(typeof(subj)=='undefined') subj=0;
    if($(th).hasClass('chsselected')) {
        if(t_type==1){
            var ol_pindex = Olq_tnmmd.indexOf(parseInt($(th).attr('qvstn_id')));
            if (ol_pindex > -1) {
                Olq_tnmmd.splice(ol_pindex, 1);
                $(th).find('.mrmdnktxv').remove();
                for(var i=0; i<Olq_tnmmd.length; i++){
                    $("[qvstn_id='" + Olq_tnmmd[i] + "']").find('.mrmdnktxv').text(i+1);
                }
            }
        }
        qqid=$(th).attr('qvstn_id'); 
        rmvmyqvstn(qqid);
        $(th).removeClass('chsselected');
    }
    else {
        qqid=$(th).attr('qvstn_id'); 
        romliia=$(th).attr('romlii');
        console.log("th=",th);
        n++;
        newth='<table><tr id="washlistvis'+qqid+'"> <td class="washla"> '+n+'. </td><td><div class="mytstqtns" >'+trnsfch(unnescapeHtml(qvst[subj][romliia][1]))+'</div> </td> <td><a href="q.php?id='+qqid+'" target="_blank"><img id="rubbishimg" src="../css/img/view.png" /></a> </td> <td> <img id="rubbishimg" src="../css/img/rubbish-bin-delete-button.svg" onclick="rmvmyqvstn('+qqid+',this)"> </td> <tr> </table>';
        //console.log('../user/q.php?',qqid);
        $('#myqvstns').append(newth);
        if(t_type==1){
            //
            Olq_tnmmd.push(parseInt($(th).attr('qvstn_id')));
            $(th).prepend('<span class="mrmdnktxv">'+Olq_tnmmd.length+'</span>'); 

           /* */
        }

        
        $(th).addClass('chsselected');
    }
}
function rmvmyqvstn(id,th){
    $("#washlistvis"+id).remove();
    n=1;
    $('.washla').each(function () {
        $(this).html(n+".");
        n++;
    });
    //$(th).removeClass('chsselected');
    $('.chsqvst[qvstn_id="'+id+'"]').removeClass('chsselected');
}
function addt2(editid){
    if(typeof(editid)=='undefined') editid=-1;
    var aris=0;
    $('input').css('border-color', 'initial');
    subj = $('#chssubj option:selected').val();
   // tpp = $('#chstype option:selected').val();
    cls = $('#classelc option:selected').val();
    name= $('#inptname').val();
    if(name=='') name="ტესტი";
    console.log("name=", name);
    var ch = new Array();
    var sh = new Array();
    if(aris==1) {$("html, body").animate({ scrollTop: 0 },500); return;}
    $('.chsselected').each(function () {
        ch.push(parseInt($(this).attr('qvstn_id')));
        //sh.push(parseInt($(this).attr('romelia')));
    }).promise().done(function () {
        if (ch.length < 2) {
            aris = 1;
            alert('შემოხაზეთ მინიმუმ 2 კითხვა');
        }
        if (aris == 1) return;
        if(editid==-1){
            $.post($loc+"php/addt2.php", { subj: subj, cls:cls, name:name, ch: JSON.stringify(ch)}, function (succ) {
                console.log("succ=",succ);
                if (succ == -1) {
                    location.href = $loc+'user/testbank.php';
                }
            });
        }
        else{
             $.post($loc+"php/changebankt.php", {tid:editid, subj: subj, cls:cls, name:name, ch: JSON.stringify(ch)}, function (succ) {
                console.log("succ=",succ);
                if (succ == -1) {
                    location.href = $loc+'user/testbank.php';
                }
            });
        }
    });
}
function ktxvSwria(qid,rml){
    $.post($loc+"php/ktxvSwria.php", { qid: qid,rml: rml }, function (succ) {
        console.log(succ);
        window.close();
    });
}

function trnsfch(s) {
    //rewrite string :D
    var n = s.length;
    var s2 = "";
    var stc = new Array();
    var rmdzglk = 0; //რამდენი ძაღლუკა :დ
    var lstbrw=0;
    if(s.indexOf("href")>=0) return s;
    for (var i = 0; i < n; i++) {
        if(s[i]=='`') lstbrw++;
        if(lstbrw%2==1 || s[i]=='`') {s2+=s[i]; continue;}
        if (s[i] == '\n' || s[i] == '\r') {
            s2+='<br/>';
        }
        else if (s[i] == '@') {
            if (rmdzglk % 2 == 1) { rmdzglk++; s2 += '</u>'; }
            else { rmdzglk++; s2 += '<u>'; }
        }
        else if (s[i] == '^' || s[i] == '_') {
            if(i < n - 1 && (s[i+1]=='_' || s[i+1]==' ' || s[i+1]=='.' || s[i+1]==','))  {s2 += s[i]; continue;}
            if (s[i] == '^') s2 += '<sup>';
            else s2 += '<sub>';
            if (i < n - 1) {
                if (s[i + 1] == '(') stc.push(s[i]);
                else {
                    s2 += s[i + 1];
                    if (s[i] == '^') s2 += '</sup>';
                    else s2 += '</sub>';
                }
            }
            i++;
        }
        else if (s[i] == ')' && stc.length>0) {
            if (stc[stc.length - 1] == '^') s2 += '</sup>';
            else if (stc[stc.length - 1] == '_') s2 += '</sub>';
            else s2 += ')';
            stc.pop();
        }
        else if (s[i] == '(') {
            s2 += s[i];
            stc.push(s[i]);
        }
        else if(s[i]=='*') s2+='⋅';
        else s2 += s[i];
    }
    return s2;
}
function rmvAxsna(){
    $('.shtwvnn').remove();
    $('.D1tsfdfdbckblion').animate({'bottom':'0px', 'opacity': 0},{duration:1000, complete:function(){$('.D1tsfdfdbckblion').remove();} });
}
function renewschool(){
    xx='<select class="slct some1 selectpicker" data-show-subtext="true"  data-live-search="true" id="slccity" ><option value="0">აირჩიეთ ქალაქი</option>';
    for($i=1; $i<cities.length+4; $i++) if(cities[$i][0]!='') {if(usercity==cities[$i][0]) $dmt='selected="true"'; else $dmt='';
    xx+="<option "+$dmt+" value="+cities[$i][0]+">"+cities[$i][1]+"</option>";
    }
    if(usercity==250) $dmt='selected="true"'; else $dmt=''; 
    xx+="<option "+$dmt+" value='250'>სხვა</option>";
    xx+='</select><br/><br><select class="slct some2 selectpicker" data-show-subtext="true"  data-live-search="true" id="slcschool" style="margin-bottom:5px; width:100%"><option value="0">აირჩიეთ სკოლა</option>';
    xx+='<button onclick="savect()">შენახვა</button>';
       // xx+='<script>$(document).ready(function(){$("#slccity").selectpicker("refresh");$(\'#slcschool\').selectpicker(\'refresh\');ldschool($(\'#slccity option:selected\').val(),'+userschool+'); $(\'#slccity\').change(function(){ldschool($(\'#slccity option:selected\').val(),'+userschool+');$(\'#slcschool\').selectpicker(\'refresh\'); });$(\'#slcschool\').change(function(){ldschool($(\'#slcschool option:selected\').val(),$(\'#slcschool option:selected\').val());});setTimeout(function() { $(\'.input-block-level\').geo(); }, 3000); });</script>';
    $('body').append('<div class="blck"></div><div id="blinfo" class="blinfo2" style="max-width:450px;"><div class="blinfh" style="background:  #1caff6;"><div class="blinfheader">შეიყვანეთ ქალაქი და სკოლა</div></div><div class="blinfinfo" style="background:#e9e9e9">'+xx+'</div> </div>');
   /* $('.blck').click(function () {
    $('body').css('overflow','auto');
    $(this).next().remove();
    $(this).remove();
    });*/
}
function savect(city,school){
     $.post($loc+"php/updcity.php", { school: school, city:city}, function (succ) {
                console.log("succ=",succ);
                if (succ == -1) {
                    location.reload();
                }
    });

}