function initiate_form_2_10()
{
    $("#i_2_10_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value);
       if(e.keyCode==112){
            show_dlg_pf();
        }
    });
    
    initiate_ajaxFileUpload_2_10();   
   $("#b_2_10_refresh").click(function(){
        clear_form_2_10(1);
    });      
    clear_form_2_10(1);
}

function clear_form_2_10(act_no)
{
   $("#i_2_10_pf_code").val('');
   $("#i_2_10_pf_name").val('');
   $("#i_2_10_f_1").val('');
   $("#i_2_10_f_2").val('');
   $("#i_2_10_f_3").val('');
   $("#i_2_10_f_4").val('');
   $("#i_2_10_date_tax").val(open_svr_dt);
   $("#i_2_10_date_fi").val(open_svr_dt);
   $("#i_2_10_start_dt").val(start_month_svr_dt);
   $("#i_2_10_end_dt").val(open_svr_dt);
}



function initiate_ajaxFileUpload_2_10()
{
    $('#b_2_10_upload').click(function(){ 
        if($("#i_2_10_pf_code").val()=='')
        {
            alert('Portfolio code empty');    
            return false;
        }
        if(trim($("#i_2_10_f_1").val())=='' && trim($("#i_2_10_f_2").val())=='' && trim($("#i_2_10_f_3").val())=='' && trim($("#i_2_10_f_4").val())=='' )
        {
            alert('Empty filename');
            return false;
        }
        if(trim($("#i_2_10_f_1").val())!='' && trim($("#i_2_10_date_tax").val())=='' )
        {
            alert('Set date of tax reserved calculation');
            return false;
        }
        if(trim($("#i_2_10_f_2").val())!='' && trim($("#i_2_10_start_dt").val())=='' && trim($("#i_2_10_end_dt").val())==''  )
        {
            alert('Set start date & end date of journal');
            return false;
        }
        if(trim($("#i_2_10_f_4").val())!='' && trim($("#i_2_10_date_fi").val())=='' )
        {
            alert('Set date of fi adjustment');
            return false;
        }
        if(confirm("Upload Data?"))
            $('#frm_2_10_form').submit();
    }); 
    var success_upload = false;
    $('#frm_2_10_form').submit(function(){
        var response,returnresponse;
        state_progress(1);
        var frm_frame = $("#iframe_2_10").load(function(){
            response = frm_frame.contents().find('body');  
            returnResponse = $.parseJSON(response.html()); 
            frm_frame.unbind("load");
            setTimeout(function ()
            {
                response.html('');
            }, 1)
            sukses_upload= true;
            if(!returnResponse.r_login)
                show_dlg_login();
            else
                alert("Upload data done");
            state_progress(0);
        });    
    });
}

