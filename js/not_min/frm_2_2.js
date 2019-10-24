function initiate_form_2_2()
{
    $("#i_2_2_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value);
       if(e.keyCode==112){
            show_dlg_pf();
        }
    });
     $("#b_2_2_refresh").click(function(){
        clear_form_2_2(1);
    });
    initiate_ajaxFileUpload_2_2();   
                                                      
    clear_form_2_2(1);
}
                     
function clear_form_2_2(act_no)
{
    $("#i_2_2_pf_code").val('');
    $("#i_2_2_pf_name").val('');
    $("#i_2_2_year").val('');
    $("#i_2_2_start_dt").val(start_month_svr_dt);
    $("#i_2_2_end_dt").val(open_svr_dt);
    $("#i_2_2_f").val('');
}



function initiate_ajaxFileUpload_2_2()
{
    $('#b_2_2_upload').click(function(){         
        if($("#i_2_2_pf_code").val()!='')
        {
            if($("#i_2_2_f").val()=='')
            {
                alert('Empty file name.');
                return false;
            }
            else if(confirm("Upload data?"))
                $('#frm_2_2_form').submit();
        }
        else
        {
            alert("Portfolio code kosong!");
        }
    }); 
    var success_upload = false;
    $('#frm_2_2_form').submit(function(){
        var response,returnresponse;
        state_progress(1);
        var frm_frame = $("#iframe_2_2").load(function(){
            response = frm_frame.contents().find('body'); 
            returnResponse = $.parseJSON(response.html()); 
            frm_frame.unbind("load");
            setTimeout(function ()
            {
                response.html('');
            }, 1)           
            if(!returnResponse.r_login)
                show_dlg_login();
            else
                alert("Upload data done"); 
            state_progress(0);
            clear_form_2_2();
        });    
    });
}

