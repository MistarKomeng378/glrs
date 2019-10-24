function initiate_form_3_1()
{
    $("#i_3_1_pf_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))
        {
            change_pf_name(this.value,2);
            get_tm_3_1(this.value);
        }
        if(e.keyCode==112){
            show_dlg_pf();
        }
    });
    $("#i_3_1_fm_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))
            change_fm_name(this.value,2);
        if(e.keyCode==112){
            show_dlg_fm();
        }
    });
    $("#b_3_1_process").click(function(){
        if(confirm("Do mtm process?"))
            post_3_1();
    });
    $("#b_3_1_refresh").click(function(){
        clear_form_3_1(1);
    }); 
    clear_form_3_1(1);
}
                              
function clear_form_3_1(act_no)
{
    $("#i_3_1_pf_code").val(''); 
    $("#i_3_1_pf_name").val('');  
    $("#i_3_1_date").val(open_svr_dt); 
    $("#i_3_1_time").val(''); 
}

function post_3_1()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
    clear_status();
    set_status('Begin process...',0);
    var err_post = 0;     
    var pf_dt_cur = 0;
    var sys_dt_cur = 0;
    //alert(uri+'/index.php/tb_process/is_valid_dt/' + $("#i_3_1_pf_code").val() + '/' + $("#i_3_1_date").val());
    var obj_get = $.getJSON(uri+'/index.php/tb_process/is_valid_dt/' + decodeurl($("#i_3_1_pf_code").val()) + '/' + decodeurl($("#i_3_1_date").val()), function(data) {                        
        if(data.r_pf_date<=0)
        {
            pf_dt_cur =1;
            err_post = 1;
        }   
        else
        {
            if(data.r_sys_date!=1)        
                sys_dt_cur=1;
        }
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else
        {
            if (pf_dt_cur==1)
                alert("Tanggal valuation date dibawah tanggal current year!");
            if(sys_dt_cur==1)
                if(confirm("Valuation date<>System date, do you want to continue?"))
                    err_post=0;
                else
                    err_post=1;
            if(err_post==0)
                post_3_1_process();
            else
            {
                alert("Process cancelled");
                clear_status();
            }
        }
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        alert("Getting data error :" + textStatus);  
        clear_status();
    });
    //if(!sukses_post)
    //    set_status("Data portfolio gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
}

function post_3_1_process()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
    //clear_status();
    err_post=1;
    var obj_post = $.post(uri+"/index.php/tb_process/do_mtm", 
        { pf_code:$("#i_3_1_pf_code").val(), mtm_dt:$("#i_3_1_date").val(),
        mtm_time:$("#i_3_1_time").val() },function(data) {
            //alert(data);
        if(data.r_success==1)
        {
            err_post=0;
        } 
    },"json");
    obj_post.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else  if(err_post==0)
            alert("MTM process sukses");
        clear_status();
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("MTM process error :" + textStatus);  
        clear_status();
    });
    //if(!sukses_post)
    //    set_status("Data portfolio gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
}


function get_tm_3_1(pf_code)
{
    state_progress(1);
    var ada = false;
    //alert(uri+"/index.php/tb/get_portfolio/" + encodeURIComponent(pf_code));
    var obj_get = $.getJSON(uri+"/index.php/tb/get_portfolio/" + decodeurl(pf_code),function(data) {
        if(data.r_success==1)
        {
            //var txt_select = 
            //alert(data.r_sdata[0].FundManagerCode);
            if(data.r_num_rows>0)
            {     
                $("#i_3_1_time").val(data.r_sdata[0].PricingHour);
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)                           
            $("#i_3_1_time").val('');    
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_3_1_time").val('');             
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}