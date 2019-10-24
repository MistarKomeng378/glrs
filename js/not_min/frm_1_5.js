function initiate_form_1_5()
{
    $("#i_1_5_pf_code").keyup(function(e){
       if(is_not_tabenter(e.keyCode) && e.keyCode!=112)
            change_pf_name(this.value,1);
       if(e.keyCode==112){
            show_dlg_pf();
        }              
        set_tot_unit_1_5($("#i_1_5_pf_code").val(),$("#i_1_5_date").val());
    });
    $("#i_1_5_date").change(function(){
        set_tot_unit_1_5($("#i_1_5_pf_code").val(),$("#i_1_5_date").val());
    });
    $("#i_1_5_tot_unit").keyup(function(e){
       if(is_not_tabenter(e.keyCode))       
            $("#span_1_5_tot_unit").html(strtomoney(parseFloat(0+$("#i_1_5_tot_unit").val())));
    });                    
    $("#b_1_5_save").click(function(){
        if( $("#i_1_5_pf_code").val()=='')
            alert("Portfolio code is empty!");
        else
            if(confirm("Are you want to save?"))
                post_1_5();
    });                    
    $("#b_1_5_del").click(function(){
         if( $("#i_1_5_pf_code").val()=='')
            alert("Portfolio code is empty!");
        else
            del_data_1_5();
    });    
    $("#b_1_5_refresh").click(function(){
        clear_form_1_5(0);
    });                           
    clear_form_1_5(1);
}



function clear_form_1_5(act_no)
{
   $("#span_1_5_tot_unit").html('');
   $("#i_1_5_pf_name").val('');
   $("#i_1_5_pf_code").val('');
   $("#i_1_5_date").val(open_svr_dt);
   $("#i_1_5_tot_unit").val('');
}

function set_tot_unit_1_5(pf_code,dt)
{
    var ada = false;
    //alert(uri+'/index.php/tb/get_unit_issued/'+trim(pf_code)+'/'+trim(dt));
    var obj_get = $.getJSON(uri+'/index.php/tb/get_unit_issued/'+decodeurl(pf_code)+'/'+decodeurl(dt), function(data) {
      if(data.r_num_rows=='1')
      {
        $("#i_1_5_tot_unit").val(data.r_sdata[0].TotalUnitIssued);
        $("#span_1_5_tot_unit").html(strtomoney(parseFloat(0+data.r_sdata[0].TotalUnitIssued)));
        ada =true;
      }                  
    });
    obj_get.done(function(msg){
        if(!msg.r_login)
            show_dlg_login();
        else if(!ada)                                                      
        {
            $("#i_1_5_tot_unit").val('');
            $("#span_1_5_tot_unit").html("0");
        }
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_1_5_tot_unit").val('');
        $("#span_1_5_tot_unit").html("0");
        alert("Getting data error :" + textStatus);
    });
    
}

function post_1_5()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
    state_progress(1);            
    var obj_post = $.post(uri+"/index.php/tb_save/save_unit", 
        { pf_code:$("#i_1_5_pf_code").val(), unit_dt:$("#i_1_5_date").val(),
            tot_unit:$("#i_1_5_tot_unit").val()},function(data) {
        if(data.r_success==1)
            clear_form_1_5();             
        //else  
        //set_status("Data total unit issued gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
    },'json');
    obj_post.done(function(msg){
        if(!msg.r_login)
            show_dlg_login();
        else
             alert("Saving data success!");
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        state_progress(0);
    });
            
   // if(!sukses_post)
   //     set_status("Data total unit issued gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
}

function del_data_1_5()
{
    if(confirm("Are you sure?"))
    {
        //alert(uri +"/index.php/tb_delete/del_portfolio");
        state_progress(1);
        var request = $.ajax({
          url: uri +"/index.php/tb_delete/del_unit",
          type: "POST",
          data: {pf_code : $("#i_1_5_pf_code").val(),
                 dt_process : $("#i_1_5_date").val()},
          dataType: "json"
        });
        request.done(function(msg) {  //alert(msg);
            if(!msg.r_login)
                show_dlg_login();
            else                   
              if(msg.r_success==0)
                  alert("Deletion is failed.");
              else                                          
                 alert("Deletion is success");                            
            clear_form_1_5();
            state_progress(0);
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request deletion failed: " + textStatus );
          state_progress(0);
        });
    }
    
}
