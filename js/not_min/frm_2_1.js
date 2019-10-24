function initiate_form_2_1()
{
    $("#i_2_1_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value,2);
       if(e.keyCode==112){
            show_dlg_pf();
        }
    });
    $("#b_2_1_refresh").click(function(){
        clear_form_2_1(1);
    });
    
    initiate_ajaxFileUpload_2_1();   
                                                      
    clear_form_2_1(1);
}
          

function clear_form_2_1(act_no)
{
    $("#i_2_1_pf_code").val('');
    $("#i_2_1_pf_name").val('');
    $("#i_2_1_f").val('');
}



function initiate_ajaxFileUpload_2_1()
{
    var success_upload = false;
    $('#b_2_1_upload').click(function(){         
        if($("#i_2_1_pf_code").val()!='')
        {
            if($("#i_2_1_f").val()=='')
            {
               alert('Empty file name.');    
                return false;
            }
            if(confirm("Upload data?"))
            {
                state_progress(1);
                var count_data = 0;
                $.getJSON(uri+'/index.php/tb/get_count_pf/1/'+decodeurl($("#i_2_1_pf_code").val()), function(data) {
                    count_data = parseInt(data.r_num_rows);
                    var continue_upload = false;
                    if(count_data>0)
                        continue_upload = confirm('Data already exist, do you want to continue?');
                    else
                        continue_upload = true;
                    state_progress(0);
                    if(continue_upload)
                        $('#frm_2_1_form').submit();
                });
            }
        }
        else
        {
            set_status("Portfolio code kosong!",1);
        }
    }); 
    
    $('#frm_2_1_form').submit(function(){
        var response,returnresponse;
        state_progress(1);
        var frm_frame = $("#iframe_2_1").load(function(){
            response = frm_frame.contents().find('body');  
            returnResponse = $.parseJSON(response.html()); 
            frm_frame.unbind("load");
            setTimeout(function ()
            {
                response.html('');
            }, 1);
            sukses_upload= true;
            if(!returnResponse.r_login)
                show_dlg_login();
            else
                alert("Upload data done"); 
            state_progress(0);
        });    
    });
}

