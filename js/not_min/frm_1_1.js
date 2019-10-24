function initiate_form_1_1()
{
    $("#i_1_1_pf_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))
        {
            change_pf_name(this.value,2);
            get_data_1_1($("#i_1_1_pf_code").val());
        }
        if(e.keyCode==112){
            show_dlg_pf();
        }
       // if(is_not_tabenter(e.keyCode))
        //get_data_1_1($("#i_1_1_pf_code").val());
    });
    $("#i_1_1_fm_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))
            change_fm_name(this.value,2);
        if(e.keyCode==112){
            show_dlg_fm();
        }
    });
    $("#b_1_1_save").click(function(){
        if($("#i_1_1_pf_code").val()=='' )
            alert("Portfolio code are empty!");
        else
            if(confirm("Are you want to save?"))
                post_1_1();
    });
    $("#b_1_1_refresh").click(function(){
        clear_form_1_1(1);
    });
    $("#b_1_1_del").click(function(){
        if($("#i_1_1_pf_code").val()=='' )
            alert("Portfolio code are empty!");
        else
            del_data_1_1();
    });
    clear_form_1_1(1);
}

function clear_form_1_1(act_no)
{
    $("#i_1_1_pf_code").val(''); 
    $("#i_1_1_pf_name").val(''); 
    $("#i_1_1_fm_name").val(''); 
    $("#i_1_1_fm_code").val(''); 
    $("#i_1_1_urs_code").val(''); 
    //$("#i_1_1_cur_year").val(''); 
    $("#i_1_1_cur_year").val($("#i_1_1_start_year").val());
    $("#i_1_1_price_hour").val(''); 
    $("#i_1_1_status").removeAttr('selected') ;
}

function post_1_1()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
     //clear_status();
     //set_status("Saving data...",1);
    state_progress(1);
    //var msg_post = "Saving data failed, check the database connection!";
    //alert('a');
    //var is_login = false;
    var obj_post = $.post(uri+"/index.php/tb_save/save_portfolio", 
        { pf_code:$("#i_1_1_pf_code").val(), pf_name:$("#i_1_1_pf_name").val(),
            fm_name:$("#i_1_1_fm_name").val(),fm_code:$("#i_1_1_fm_code").val(), 
            urs_code:$("#i_1_1_urs_code").val(), cur_year:$("#i_1_1_cur_year").val(),
            price_hour:$("#i_1_1_price_hour").val(),flag:$("#i_1_1_flag").val() },function(data) {
                //alert(data);
        if(data.r_success==1)
            clear_form_1_1();      
        //is_login = data.r_login;                                                                                     
    },"json");
    obj_post.done(function(msg) { 
        //alert(msg);
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else
            alert("Saving data success!"); 
        //set_status(msg_post,err_post);
        state_progress(0);
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        //set_status(msg_post,err_post);
        state_progress(0);
    });
    
    //if(!sukses_post)
    //    set_status("Data portfolio gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
}
function get_data_1_1(pf_code)
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
                $("#i_1_1_fm_code").val(data.r_sdata[0].FundManagerCode);
                $("#i_1_1_fm_name").val(data.r_sdata[0].FundManagerName);
                $("#i_1_1_urs_code").val(data.r_sdata[0].URSMappingCode);
                $("#i_1_1_cur_year").val('01-01-'+data.r_sdata[0].CurYear);
                $("#i_1_1_price_hour").val(data.r_sdata[0].PricingHour);
                $("#i_1_1_flag").val(data.r_sdata[0].ActiveFlag).attr("selected", "selected");
                //$("#i_1_1_flag").html(data.r_sdata[0].ActiveFlag);     
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)
        {
            $("#i_1_1_urs_code").val('');
            $("#i_1_1_cur_year").val('');
            $("#i_1_1_price_hour").val('');
            $("#i_1_1_status").removeAttr('selected') ; 
            //$("#i_1_1_flag").val('');
            $("#i_1_1_fm_name").val(''); 
            $("#i_1_1_fm_code").val('');
        }
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_1_1_urs_code").val('');
        $("#i_1_1_cur_year").val('');
        $("#i_1_1_price_hour").val('');
        $("#i_1_1_status").removeAttr('selected') ; 
        //$("#i_1_1_flag").val('');
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}

function del_data_1_1()
{
    if(confirm("Are you sure?"))
    {
        //alert(uri +"/index.php/tb_delete/del_portfolio");
        state_progress(1);
        var request = $.ajax({
          url: uri +"/index.php/tb_delete/del_portfolio",
          type: "POST",
          data: {pf_code : $("#i_1_1_pf_code").val()},
          dataType: "json"
        });
        request.done(function(msg) {
            //alert(msg);
             if(!msg.r_login)
                show_dlg_login();
            else
              if(msg.r_success==0)                                                    
                  alert("Portfolio has already had transactions, deletion is not allowed.");
              else
                  alert("Deleting data success!");
            clear_form_1_1();
            state_progress(0);
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request deletion failed: " + textStatus );
          state_progress(0);
        });
    }
    
}     
