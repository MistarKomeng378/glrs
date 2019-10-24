function initiate_form_2_3()
{
    $("#i_2_3_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode) && e.keyCode!=112)
       {
            change_pf_name(this.value);
            get_data_2_3(this.value);
       }
       if(e.keyCode==112){    
            show_dlg_pf();
        }
    });
    $("#b_2_3_refresh").click(function(){
        clear_form_2_1(1);
    });
    initiate_ajaxFileUpload_2_3();   
                                                      
    clear_form_2_3(1);
}
                    

function clear_form_2_3(act_no)
{
    $("#i_2_3_pf_code").val('');
    $("#i_2_3_pf_name").val('');
    $("#i_2_3_price_hour").val('');
    $("#i_2_3_f").val('');
}

function get_data_2_3(pf_code)
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
                $("#i_2_3_price_hour").val(data.r_sdata[0].PricingHour);
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)                           
            $("#i_2_3_price_hour").val('');    
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_2_3_price_hour").val('');             
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}

function initiate_ajaxFileUpload_2_3()
{
    //$("#b_2_3_log").attr("disabled", "disabled");
    $('#b_2_3_upload').click(function(){         
        if($("#i_2_3_pf_code").val()!='')
        {
            if($("#i_2_3_f").val()=='')
            {
               alert('Empty file name.');    
                return false;
            }
            if(confirm('Upload data?'))
                $('#frm_2_3_form').submit();
        }
        else
        {
            set_status("Portfolio code kosong!",1);
        }
    }); 
    var success_upload = false;
    $('#frm_2_3_form').submit(function(){
        var response,returnresponse;
        state_progress(1);
        var frm_frame = $("#iframe_2_3").load(function(){
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

