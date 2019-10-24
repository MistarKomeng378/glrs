var curr_pageid='';
function c_nosession(){window.location=uri;}
function c_loadpage(page,pageid,loadfunc)
{
    var c_get = $.get(uri+'/index.php/c/p/'+page,{},function(c_data) { });
    c_get.done(function(c_msg){
        if(c_msg=='nosess')
            c_nosession();
        else
        {
            $("#"+pageid).html(c_msg);
            setTimeout(function() {
               if (typeof window[loadfunc] === 'function')
                    eval(loadfunc+'();');
               if(page!='nav')
                    $("#"+pageid).hide();
            },1);
        }
    });
}
function c_showpage(pageid,loadfunc)
{
    if(curr_pageid!=pageid)
    {
        $("#"+curr_pageid).hide();
        $("#"+pageid).show("slide",function(){
            if (typeof window[loadfunc] === 'function')
                eval(loadfunc+'();');
        });
    }
    curr_pageid=pageid;
    
}
function c_status(pageid,pno)
{
    if($("#"+pageid+'_progress'))
        if(pno==0)
            $("#"+pageid+'_progress').hide();
        else
            $("#"+pageid+'_progress').show();
}

var c_session_timer=120000;
var c_session_f;
function c_check_session()
{
    var c_sess=$.get(uri+'/index.php/cs/check_session',function(c_data){
        if(c_data=='')
            c_nosession();
        
    });
    c_session_f=setTimeout("c_check_session()",c_session_timer);
}
function isArray(myArray) {
    return myArray.constructor.toString().indexOf("Array") > -1;
}
function isJSON(str)
{
    try{
        JSON.parse(str);
    }catch(e){
        return false;
    }
    return true;
}

$(document).ready(function () {c_check_session();});

 Number.prototype.formatMoney=function(c,d,t){var n=this,c=isNaN(c=Math.abs(c))?2:c,d=d==undefined?",":d,t=t==undefined?".":t,s=n<0?"-":"",i=parseInt(n=Math.abs(+n||0).toFixed(c))+"",j=(j=i.length)>3?j%3:0;return s+(j?i.substr(0,j)+t:"")+i.substr(j).replace(/(\d{3})(?=\d)/g,"$1"+t)+(c?d+Math.abs(n-i).toFixed(c).slice(2):"");};function strtomoney(amount)
{var sign_money='';var val_money=trim(''+amount);if(val_money[0])
if(val_money[0]=='-')
{sign_money='-';val_money=val_money.substr(1);}
var i=parseFloat(val_money);if(isNaN(i)){i=0.00;}
return sign_money+i.formatMoney(2,'.',',');}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

var arr_bl =  { "Jan": '01', "Feb": '02', "Mar": '03',"Apr": '04', "May": '05',"Jun":'06',"Jul":07,"Aug":'08',"Sep":'09',"Oct":'10',"Nov":'11',"Dec":'12' }; 

function  dtTOdt(p_dt)
{
    var s_dt = p_dt.split(" ");
    if (s_dt.length==3)
        return  s_dt[0]+'/' + arr_bl[s_dt[1]]+'/' + s_dt[2];
    else
        return "";
}