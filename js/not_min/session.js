var t;
var t1;
var dlg_login_is_show = false;
//var is_do_login = false;
var timer_cek_login = 120000;  //120000
//var timer_do_logout = 1800000;
function initiate_session()
{
    //show_dlg_login();
    check_login();
}
function cek_session()
{
    
}
function show_dlg_login()
{
    dlg_login_is_show = true;
   // if(is_do_login)
    //   clearTimeout(t1) ;
    //is_do_login=false;
    $.blockUI({ message: $('#dialogBox_login'),css: { width : '290px', textAlign : 'right',cursor:'auto'} });
    
}
function close_dlg_login()
{                  
    $.unblockUI();
}
function do_login()
{
    $("#progress_login").show();
    var sukses_login = false;
    //alert(uri+"/index.php/tb/do_login");
    var obj_post = $.post(uri+"/index.php/tb/do_login", 
        {pemakai:$("#i_login_pemakai").val(),password:$("#i_login_password").val()},function(data) {          
        if(data.r_login)
        {
            nm = data.r_sdata[0].nama;
            nm_full = data.r_sdata[0].nama_full;
            sukses_login=true;
        }                                                                                                      
    },'json');
    obj_post.done(function(msg){   
        if(sukses_login)
        {
            $("#i_login_password").val('')
            close_dlg_login(); 
            dlg_login_is_show = false;
            //t1=setTimeout("set_finish_session()",timer_do_logout);
            //id_do_login=true;
        }
        else                 
            alert("Wrong password or user.");
        $("#i_login_password").val('');
        $("#progress_login").hide();
    });
    obj_get.fail(function(jqXHR, textStatus) {  
        alert("Getting login info error :" + textStatus);
        $("#progress_login").hide();
    });
    
}
function reset_login()
{
    $("#i_login_pemakai").val('');
    $("#i_login_password").val('');
}

function check_login()
{
    //alert(uri+'/index.php/tb/check_login');
    var obj_get = $.getJSON(uri+'/index.php/tb/check_login',function(data) {
        if(!data.r_login)                                                     
            if(!dlg_login_is_show)
                show_dlg_login();    //9i9i9i9i9i
    });         /*sadsa
    asdasd
    asdasd
    asd
    */
    t=setTimeout("check_login()",timer_cek_login);                 
}

//function set_finish_session()
//{
//   if(is_do_login)
//        window.location = uri+'/index.php/tb_main';
//}