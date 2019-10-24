function initiate_form_3_3()
{
    $("#i_3_3_pf_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode) && e.keyCode!=112)
            change_pf_name(this.value,2);
            get_cur_year_3_3($("#i_3_3_pf_code").val());
        if(e.keyCode==112){
            show_dlg_pf();
        }
    });
    $("#b_3_3_cancel").click(function(){
        if(confirm("Do EOY process cancellation?"))
            post_3_3_process();
    });
     $("#b_3_3_refresh").click(function(){
        clear_form_3_3(1);
    });
    clear_form_3_3(1);     
}

function get_cur_year_3_3(pf_code)
{
    //alert(uri+'/index.php/tb_process/get_rea/' + pf_code);
    var ada = false;
    var obj_get = $.getJSON(uri+'/index.php/tb/get_portfolio/' + decodeurl(pf_code) , function(data) {
         if(data.r_num_rows>=1)
        {
            var curyear = data.r_sdata[0].CurYear;
            var prevyear = curyear - 1;
            $("#i_3_3_cur_year").val('1/1/'+curyear);
            $("#i_3_3_prev_start_dt").val('1/1/'+prevyear);
            $("#i_3_3_prev_end_dt").val(data.r_sdata[0].PrevEndDate);
            ada = true
        }                 
    });    
    
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else  if(!ada)
        {
            $("#i_3_3_cur_year").val('');
            $("#i_3_3_prev_start_dt").val('');
            $("#i_3_3_prev_end_dt").val('');
        }
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        alert("Getting data error :" + textStatus);  
    });
}
            
function clear_form_3_3(act_no)
{
    $("#i_3_3_pf_code").val(''); 
    $("#i_3_2_pf_name").val(''); 
    $("#i_3_3_cur_year").val('');
    $("#i_3_3_prev_start_dt").val('');
    $("#i_3_3_prev_end_dt").val('');
}



function post_3_3_process()
{
    state_progress(1);           
    var obj_post = $.post(uri+"/index.php/tb_process/do_eoy_cancellation", 
        { pf_code:$("#i_3_3_pf_code").val(), cur_year:$("#i_3_3_cur_year").val(), prev_start_dt:$("#i_3_3_prev_start_dt").val(), prev_end_dt:$("#i_3_3_prev_end_dt").val() },function(data) {
        if(data.r_success==1)
            clear_form_3_3();     
    },"json");
    obj_post.done(function(msg){
        //alert(msg);
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else
             alert("Saving data success!");
        state_progress(0);
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("EOY process error :" + textStatus);  
        state_progress(0);
    });
}

