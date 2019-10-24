function initiate_form_2_4()
{
    $("#i_2_4_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value);
            get_data_2_4($("#i_2_4_pf_code").val(),$("#i_2_4_date").val());
       if(e.keyCode==112){
            show_dlg_pf();
        }
    });
    $("#i_2_4_date").change(function(){
        get_data_2_4($("#i_2_4_pf_code").val(),$("#i_2_4_date").val());
    });
    initiate_ajaxFileUpload_2_4();   
    $("#b_2_4_save").click(function(){
        if(confirm("Save data?"))
            post_2_4();
    });
    $("#b_2_4_refresh").click(function(){
        clear_form_2_4(1);
    });
    $("#b_2_4_del").click(function(){
        if(confirm("Delete data"))
            delete_2_4();
    });
    
    clear_form_2_4(1);
}

function get_data_2_4(pf_code,dt)
{
    state_progress(1);
    var ada = false;
    //alert(uri+"/index.php/tb/get_portfolio/" + encodeURIComponent(pf_code));
    //alert(uri+"/index.php/tb/get_tax/" + decodeurl(pf_code) + '/' + decodeurl(dt));
    var obj_get = $.getJSON(uri+"/index.php/tb/get_tax/" + decodeurl(pf_code) + '/' + decodeurl(dt),function(data) {
        if(data.r_success==1)
        {
            //var txt_select = 
            //alert(data.r_sdata[0].FundManagerCode);
            if(data.r_num_rows>0)
            {     
                $("#i_2_4_amount").val(data.r_sdata[0].TaxReservedAmt);
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        //alert(msg);
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)                           
             $("#i_2_4_amount").val('');
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_2_4_amount").val('');            
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}

function post_2_4()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
    if(trim($("#i_2_4_pf_code").val())=='')
    {
        alert("Empty protfolio code");
        return false;
    }                         
    state_progress(1);
    var obj_post = $.post(uri+"/index.php/tb_upload/save_tax_reserved", 
        { pf_code:$("#i_2_4_pf_code").val(), tax_date:$("#i_2_4_date").val(),
        tax_amount:$("#i_2_4_amount").val() },function(data) {     
            clear_form_2_4();                                                                                                           
    },"json");
    obj_post.done(function(msg) { 
        if(!msg.r_login)
            show_dlg_login();
        else
            alert("Saving data success!");
        state_progress(0);
        clear_form_2_4(1)
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        state_progress(0);
    });
} 
function delete_2_4()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
    if(trim($("#i_2_4_pf_code").val())=='')
    {
        alert("Empty protfolio code");
        return false;
    }                         
    state_progress(1);
    var obj_post = $.post(uri+"/index.php/tb_upload/delete_tax_reserved", 
        { pf_code:$("#i_2_4_pf_code").val(), tax_date:$("#i_2_4_date").val() },function(data) {     
            clear_form_2_4();                                                                                                           
    },"json");
    obj_post.done(function(msg) { 
        if(!msg.r_login)
            show_dlg_login();
        else
            alert("Delete data success!");
        state_progress(0);
        clear_form_2_4(1);
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        state_progress(0);
    });
}            

function clear_form_2_4(act_no)
{                        
    $("#i_2_4_pf_code").val('');
    $("#i_2_4_pf_name").val('');
    $("#i_2_4_date").val(open_svr_dt);
    $("#i_2_4_date_up").val(open_svr_dt);
    $("#i_2_4_amount").val('');
    $("#i_2_4_f").val('');
}



function initiate_ajaxFileUpload_2_4()
{
    //$("#b_2_4_log").attr("disabled", "disabled");
    $('#b_2_4_upload').click(function(){   
        if($("#i_2_4_f").val()=='')
        {
            alert('Empty file name.');
            return false;
        }   
        else if(trim($("#i_2_4_date_up").val())=='')   
            alert('Empty tax date!');
        else if(confirm("Upload data?"))
            $('#frm_2_4_form').submit();
    }); 
    var success_upload = false;
    $('#frm_2_4_form').submit(function(){
        var response,returnresponse;
        state_progress(1);
        var frm_frame = $("#iframe_2_4").load(function(){
            response = frm_frame.contents().find('body');  
            returnResponse = $.parseJSON(response.html()); 
            //alert(response);
            frm_frame.unbind("load");
            setTimeout(function ()
            {
                response.html('');
            }, 1)
            sukses_upload= true;
            //$("#b_2_4_log").removeAttr("disabled");
            if(!returnResponse.r_login)
                show_dlg_login();
            else
                alert("Upload data done");
            state_progress(0);
            clear_form_2_4();
        });    
    });
}

