function initiate_form_3_2()
{
    $("#i_3_2_pf_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))
        {
            change_pf_name(this.value,2);
            cek_rea_3_2(this.value);
        }
        if(e.keyCode==112){
            show_dlg_pf();
        }
    });
    $("#i_3_2_fm_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))
            change_fm_name(this.value,2);
        if(e.keyCode==112){
            show_dlg_fm();
        }
    });
    $("#b_3_2_process").click(function(){
        if(confirm("Do EOY process?"))
            post_3_2_process();
    });
    clear_form_3_2(1);     
}

function cek_rea_3_2(pf_code)
{
    //alert(uri+'/index.php/tb_process/get_rea/' + pf_code);
    var ada = false;
    var obj_get = $.getJSON(uri+'/index.php/tb_process/get_rea/' + pf_code , function(data) {
         if(data.r_num_rows>=1)
        {
            $("#i_3_2_rea").val(data.r_sdata[0].AccountNo);
            $("#i_3_2_rea_desc").val(data.r_sdata[0].AccountName);
            ada = true
        }                 
    });    
    
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else if(!ada)
        {
            $("#i_3_2_rea").val('');
            $("#i_3_2_rea_desc").val('');
        }
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        alert("Getting data error :" + textStatus);  
    });
}

function clear_form_3_2(act_no)
{
    $("#i_3_2_pf_code").val(''); 
    $("#i_3_2_pf_name").val(''); 
    $("#i_3_2_rea").val(''); 
    $("#i_3_2_rea_desc").val(''); 
}



function post_3_2_process()
{                      
      state_progress(1);
       var obj_post = $.post(uri+"/index.php/tb_process/do_eoy", 
        { pf_code:$("#i_3_2_pf_code").val(), rea_code:$("#i_3_2_rea").val() },function(data) {                                                                                      
    },"json");
    obj_post.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else 
            alert("EOY process sukses");
        state_progress(0);
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("EOY process error :" + textStatus);       
        state_progress(0);
    });
}

