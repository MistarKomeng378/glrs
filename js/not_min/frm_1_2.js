function initiate_form_1_2()
{
    $("#i_1_2_fm_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))  
        {
            change_fm_name(this.value,1);
            change_fm_maintenance_1_2(this.value);
        }
        if(e.keyCode==112){
            show_dlg_fm();
        }
    });
    $("#b_1_2_save").click(function(){
        if( $("#i_1_2_fm_code").val()=='')
            alert("Fund manager code is empty!");
        else
            if(confirm("Are you want to save?"))
                post_1_2();
    });
    $("#b_1_2_del").click(function(){
         if( $("#i_1_2_fm_code").val()=='')
            alert("Fund manager code is empty!");
        else
            del_data_1_2();
    });
    clear_form_1_2(1);
    $("#b_1_2_refresh").click(function(){
        clear_form_1_2(1);
    });
}

function change_fm_maintenance_1_2(fm_code)
{
    var ada = false;
    var obj_get = $.getJSON(uri+'/index.php/tb/get_fundmanager_maintenance/'+decodeurl(fm_code), function(data) {
      if(data.r_num_rows>=1)
      {
        $("#i_1_2_fm_code").val(data.r_sdata[0].FundManagerCode);
        $("#i_1_2_fm_name").val(data.r_sdata[0].FundManagerName);
        $("#i_1_2_addr1").val(data.r_sdata[0].Address1);
        $("#i_1_2_addr2").val(data.r_sdata[0].Address2);
        $("#i_1_2_addr3").val(data.r_sdata[0].Address3);
        $("#i_1_2_city").val(data.r_sdata[0].City);
        $("#i_1_2_post_code").val(data.r_sdata[0].PostCode);
        $("#i_1_2_country").val(data.r_sdata[0].Country);
        $("#i_1_2_phone1").val(data.r_sdata[0].Phone1);
        $("#i_1_2_phone2").val(data.r_sdata[0].Phone2);
        $("#i_1_2_fax1").val(data.r_sdata[0].Fax1);
        $("#i_1_2_fax2").val(data.r_sdata[0].Fax2);
        ada =true;
      }
    });
    obj_get.done(function(msg){      
        if(!msg.r_login)                                                     
            show_dlg_login();
        else if(!ada)
            clear_form_1_2(2);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        clear_form_1_2(3);
        alert("Getting data error :" + textStatus);
    });
}

function clear_form_1_2(act_no)
{
    if(act_no==1)
        $("#i_1_2_fm_code").val('');
    $("#i_1_2_fm_name").val('');
    if(act_no!=3)
    {
        $("#i_1_2_addr1").val('');
        $("#i_1_2_addr2").val('');
        $("#i_1_2_addr3").val('');
        $("#i_1_2_city").val('');
        $("#i_1_2_post_code").val('');
        $("#i_1_2_country").val('');
        $("#i_1_2_phone1").val('');
        $("#i_1_2_phone2").val('');
        $("#i_1_2_fax1").val('');
        $("#i_1_2_fax2").val('');
    }
}

function post_1_2()
{
    state_progress(1);    
    var obj_post = $.post(uri+"/index.php/tb_save/save_fundmanager", 
        { fm_code:$("#i_1_2_fm_code").val(), fm_name:$("#i_1_2_fm_name").val(),
            addr1:$("#i_1_2_addr1").val(),addr2:$("#i_1_2_addr2").val(), 
            addr3:$("#i_1_2_addr3").val(), city:$("#i_1_2_city").val(),
            post_code:$("#i_1_2_post_code").val(),country:$("#i_1_2_country").val(),
            phone1:$("#i_1_2_phone1").val(),phone2:$("#i_1_2_phone2").val(),
            fax1:$("#i_1_2_fax1").val(),fax2:$("#i_1_2_fax2").val()},function(data) {
        if(data.r_success==1)
            clear_form_1_2(1);      
    },"json");
    obj_post.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        else
             alert("Saving data success!");
        state_progress(0);
    });
    obj_post.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        state_progress(0);
    });                         
   // if(!sukses_post)
    //    set_status("Data fund manager gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
}
function del_data_1_2()
{
    if(confirm("Are you sure?"))
    {
        state_progress(1);
        //alert(uri +"/index.php/tb_delete/del_portfolio");
        var request = $.ajax({
          url: uri +"/index.php/tb_delete/del_fundmanager",
          type: "POST",
          data: {fm_code : $("#i_1_2_fm_code").val()},
          dataType: "json"
        });
        request.done(function(msg) {
            if(!msg.r_login)
                show_dlg_login();
            else
              if(msg.r_success==0)
                alert("Fund manager code is being used at portfolio data, deletion is not allowed.");
              else
                 alert("Deletion is success");
            clear_form_1_2(1);
            state_progress(0);
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request deletion failed: " + textStatus );
          state_progress(0);
        });
    }
    
}
         
