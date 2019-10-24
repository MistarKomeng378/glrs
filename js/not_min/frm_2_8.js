function initiate_form_2_8()
{
    $("#i_2_8_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value);
       if(e.keyCode==112){
            show_dlg_pf();
        }
    });
    
    initiate_ajaxFileUpload_2_8();   
   $("#b_2_8_refresh").click(function(){
        clear_form_2_8(1);
    });      
    clear_form_2_8(1);
}

function clear_form_2_8(act_no)
{
   $("#i_2_8_f").val('');
}



function initiate_ajaxFileUpload_2_8()
{
    $('#b_2_8_upload').click(function(){ 
        if($("#i_2_8_f").val()=='')
        {
            alert('Empty file name.');    
            return false;
        }     
        else   
            if(confirm("Upload Data?"))
                $('#frm_2_8_form').submit();
    }); 
    var success_upload = false;
    $('#frm_2_8_form').submit(function(){
        var response,returnresponse;
        state_progress(1);
        var frm_frame = $("#iframe_2_8").load(function(){
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

