

function upar_initiate()
{
    $("#upar_b_update").click(function(){
        upar_save_data(); 
    });
}
function upar_show()
{
    upar_load_data(); 
}
function upar_load_data()
{
    c_status('upar',1);
    var upar_post = $.post(uri+'/index.php/cuser/get_parameter',{},function(upar_data) { },'json');
    upar_post.done(function(upar_msg){   
        if(upar_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        if(upar_msg.r_data.length>0)
        {
            $("#upar_i_eld").val(upar_msg.r_data[0].expired_login);
            $("#upar_i_epd").val(upar_msg.r_data[0].expired_password);
            $("#upar_i_minp").val(upar_msg.r_data[0].min_password);
            $("#upar_s_anp").val(upar_msg.r_data[0].alphanum_pass);
            $("#upar_s_ccp").val(upar_msg.r_data[0].caps_pass);
            $("#upar_i_rtp").val(upar_msg.r_data[0].recycle_pass);
            $("#upar_i_mwp").val(upar_msg.r_data[0].wrong_pass);
            $("#upar_i_minu").val(upar_msg.r_data[0].min_user);  
            $("#upar_i_maxu").val(upar_msg.r_data[0].max_user);  
        }
        c_status('upar',0);
    });
    upar_post.fail(function(jqXHR, textStatus) {c_status('upar',0);});
}
function upar_save_data()
{
    if(!confirm('Update user parameter?'))
        return 0;
    c_status('upar',1);
    var uparsave_post = $.post(uri+'/index.php/cuser/update_parameter',{
          eld:$("#upar_i_eld").val(),
          epd:$("#upar_i_epd").val(),
          minp:$("#upar_i_minp").val(),
          anp:$("#upar_s_anp").val(),
          ccp:$("#upar_s_ccp").val(),
          rtp:$("#upar_i_rtp").val(),
          mwp:$("#upar_i_mwp").val(),
          minu:$("#upar_i_minu").val(),
          maxu:$("#upar_i_maxu").val()
    },function(uparsave_data) { });
    uparsave_post.done(function(uparsave_msg){
        if(uparsave_msg=='0')
            c_nosession();
        else if(uparsave_msg=='1')
            alert('Success saving data!');     
        else
            alert('error saving data!');      
        upar_load_data();
        c_status('upar',0);
    });
    uparsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('upar',0);});
}
