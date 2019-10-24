function initiate_form_2_5()
{
    $("#i_2_5_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value);
            get_data_2_5($("#i_2_5_pf_code").val(),$("#i_2_5_date").val());
            $("#i_2_5_pf_code_up").val(this.value);
       if(e.keyCode==112){
            show_dlg_pf();
        }
    });   
    $("#i_2_5_pf_code_up").keyup(function(e){
       if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value);
            get_data_2_5($("#i_2_5_pf_code_up").val(),$("#i_2_5_date").val());
       if(e.keyCode==112){
            show_dlg_pf();
        }
    });                                                  
    initiate_ajaxFileUpload_2_5();
    $("#i_2_5_date").change(function(){
        get_data_2_5($("#i_2_5_pf_code").val(),$("#i_2_5_date").val());
    });
    $("#i_2_5_amount").keyup(function(e){
       if(is_not_tabenter(e.keyCode))       
            $("#span_2_5_amount").html(strtomoney($("#i_2_5_amount").val()));
            //$("#span_2_5_amount").html(strtomoney(parseFloat(0+$("#i_2_5_amount").val())));
    });                  
    $("#b_2_5_save").click(function(){
        if(confirm("Save data?"))
            post_2_5();
    });
    $("#b_2_5_del").click(function(){
        if(confirm("Delete data?"))
            delete_2_5();
    });
    $("#b_2_5_refresh").click(function(){
        clear_form_2_5(1);
    });  
    clear_form_2_5(1);
}
                 
function get_data_2_5(pf_code,dt)
{
    state_progress(1);
    var ada = false;
    //alert(uri+"/index.php/tb/get_portfolio/" + encodeURIComponent(pf_code));
    //alert(uri+"/index.php/tb/get_tax/" + decodeurl(pf_code) + '/' + decodeurl(dt));
    var obj_get = $.getJSON(uri+"/index.php/tb/get_fi/" + decodeurl(pf_code) + '/' + decodeurl(dt),function(data) {
        if(data.r_success==1)
        {
            //var txt_select = 
            //alert(data.r_sdata[0].FundManagerCode);
            if(data.r_num_rows>0)
            {     
                $("#i_2_5_amount").val(data.r_sdata[0].AdjustmentAmount);
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        //alert(msg);
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)                           
             $("#i_2_5_amount").val('');
             $("#span_2_5_amount").html(strtomoney($("#i_2_5_amount").val()));
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_2_5_amount").val('');            
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}

function clear_form_2_5(act_no)
{
   $("#i_2_5_pf_code").val('');
    $("#i_2_5_pf_name").val('');
    $("#i_2_5_date").val('');
    $("#i_2_5_amount").val('');
    $("#i_2_5_f").val('');
    $("#span_2_5_amount").html('');
    $("#i_2_5_date").val(open_svr_dt);
    $("#i_2_5_date_up").val(open_svr_dt);
}



function initiate_ajaxFileUpload_2_5()
{
    $('#b_2_5_upload').click(function(){  
        if($("#i_2_5_f").val()=='')
        {
            alert('Empty file name.');
            return false;
        }       
        $('#frm_2_5_form').submit();
    }); 
    var success_upload = false;
    $('#frm_2_5_form').submit(function(){
        var response,returnresponse;
        state_progress(1);
        var frm_frame = $("#iframe_2_5").load(function(){
            response = frm_frame.contents().find('body');  
            returnResponse = $.parseJSON(response.html()); 
            //alert(response);
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

function post_2_5()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
    if(trim($("#i_2_5_pf_code").val())=='')
    {
        alert("Empty protfolio code");
        return false;
    }                         
    state_progress(1);
    var obj_post = $.post(uri+"/index.php/tb_upload/save_fi", 
        { pf_code:$("#i_2_5_pf_code").val(), fi_date:$("#i_2_5_date").val(),
        fi_amount:$("#i_2_5_amount").val() },function(data) {     
            clear_form_2_5();                                                                                                           
    },'json');
    obj_post.done(function(msg) { 
        if(!msg.r_login)
            show_dlg_login();
        else
            alert("Saving data success!");
        state_progress(0);
        clear_form_2_5(1);
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        state_progress(0);
    });
} 

function delete_2_5()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
    if(trim($("#i_2_5_pf_code").val())=='')
    {
        alert("Empty protfolio code");
        return false;
    }                         
    state_progress(1);
    var obj_post = $.post(uri+"/index.php/tb_upload/delete_fi", 
        { pf_code:$("#i_2_5_pf_code").val(), fi_date:$("#i_2_5_date").val(),
        fi_amount:$("#i_2_5_amount").val() },function(data) {     
            clear_form_2_5();                                                                                                           
    },'json');
    obj_post.done(function(msg) { 
        if(!msg.r_login)
            show_dlg_login();
        else
            alert("Delete data success!");
        state_progress(0);
        clear_form_2_5(1);
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        state_progress(0);
    });
}     