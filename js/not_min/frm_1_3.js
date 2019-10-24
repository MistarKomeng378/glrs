function initiate_form_1_3()
{
    $("#i_1_3_pf_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode) && e.keyCode!=112)
        {
            change_pf_name(this.value,2);
            change_detail_1_3(this.value,$("#i_1_3_gl_group").val(),$("#i_1_3_mm_acc_type").val());
        }
        if(e.keyCode==112){
            show_dlg_pf();
        }
    });   
    $("#i_1_3_gl_group").keyup(function(e){
        change_detail_1_3($("#i_1_3_pf_code").val(),this.value,$("#i_1_3_mm_acc_type").val());
    });
    $("#i_1_3_mm_acc_type").keyup(function(e){
        change_detail_1_3($("#i_1_3_pf_code").val(),$("#i_1_3_gl_group").val(),this.value);
    });
    $("#i_1_3_profit_no").keyup(function(e){
        change_desc_1_3(this.value,'#i_1_3_profit_desc','profit',1);
    });
    $("#i_1_3_loss_no").keyup(function(e){
        change_desc_1_3(this.value,'#i_1_3_loss_desc','loss',1);
    });
    $("#i_1_3_asset_no").keyup(function(e){
        change_desc_1_3(this.value,'#i_1_3_asset_desc','asset',1);
    });
    $("#i_1_3_ir_no").keyup(function(e){
        change_desc_1_3(this.value,'#i_1_3_ir_desc','interest receivable',1);
    });
    $("#i_1_3_ii_no").keyup(function(e){
        change_desc_1_3(this.value,'#i_1_3_ii_desc','interest income',1);
    });
    $("#i_1_3_trd_no").keyup(function(e){
        change_desc_1_3(this.value,'#i_1_3_trd_desc','tax reserve debet',1);
    });
    $("#i_1_3_trc_no").keyup(function(e){
        change_desc_1_3(this.value,'#i_1_3_trc_desc','tax reserver credit',1);
    });
    
    $("#b_1_3_save").click(function(){
         if( $("#i_1_3_pf_code").val()=='')
            alert("Portfolio code is empty!");
        else
            if(confirm("Are you want to save?"))
                post_1_3();
    });     
    $("#b_1_3_refresh").click(function(){
        clear_form_1_3(1);
    });
         
    $("#b_1_3_del").click(function(){
         if( $("#i_1_3_pf_code").val()=='')
            alert("Portfolio code is empty!");
        else
            del_data_1_3();
    });
    clear_form_1_3(1);
}
/*
function change_pf_name_1_3(pf_code)
{                                                 
    var ada = false;
    //alert(uri+'/index.php/tb/get_portfolio_name/'+pf_code);
    $.getJSON(uri+'/index.php/tb/get_portfolio_name/1/'+pf_code, function(data) {
      if(data.r_num_rows=='1')
        $("#i_1_3_pf_name").val(data.r_sdata[0].PortfolioName);
      ada =true;
    });
    if(!ada)
        $("#i_1_3_pf_name").val('');
} */
function change_desc_1_3(no_obj,desc_name,desc,act)
{
    if(no_obj!='' && no_obj!='null' && no_obj!=null )
    {
        var ada1= false;
        //alert(uri+'/index.php/tb/get_mtm_acc_name/'+ no_obj +'/'+ $("#i_1_3_pf_code").val());
        var obj_get = $.getJSON(uri+'/index.php/tb/get_mtm_acc_name/'+ decodeurl(no_obj) +'/'+ decodeurl($("#i_1_3_pf_code").val()),function(data1) {
            
            if(parseInt(data1.r_num_rows)>=1)                                   
            {
                $(desc_name).val(data1.r_sdata[0].AccountName);
                ada1 =true;
            }
            //else
             //   if(act!=1)
              //      alert('Gl account for ' + desc + ' is not available!');
        });
        obj_get.done(function(msg){
            if(!msg.r_login)                                                     
                show_dlg_login();
            else if(!ada1)          
                $(desc_name).val('');
        });    
        obj_get.fail(function(jqXHR, textStatus) {   
            $(desc_name).val('');
            alert("Getting data error :" + textStatus);
        });
    }
    
    //alert('au ah gelap');
}

function change_detail_1_3(pf_code,gl_group,gl_type)
{                                                 
    var ada = false;
    //uri+'/index.php/tb/get_mtm_detail/'+ decodeurl(pf_code) +'/'+ decodeurl(gl_group) + '/' + decodeurl(gl_type);
    //alert(uri+'/index.php/tb/get_mtm_detail/'+ pf_code +'/'+ gl_group + '/' + gl_type);
    //alert(uri+'/index.php/tb/get_mtm_detail/'+ encodeURIComponent(pf_code) +'/'+ encodeURIComponent(gl_group) + '/' + encodeURIComponent(gl_type));
    var obj_get = $.getJSON(uri+'/index.php/tb/get_mtm_detail/'+ decodeurl(pf_code) +'/'+ decodeurl(gl_group) + '/' + decodeurl(gl_type),function(data) {
        if(data.r_num_rows=='1')
        {
            $("#i_1_3_profit_no").val(data.r_sdata[0].ProfitAccount);
            change_desc_1_3(data.r_sdata[0].ProfitAccount,'#i_1_3_profit_desc','profit');
            $("#i_1_3_loss_no").val(data.r_sdata[0].LossAccount);
            change_desc_1_3(data.r_sdata[0].LossAccount,'#i_1_3_loss_desc','loss');
            $("#i_1_3_asset_no").val(data.r_sdata[0].AssetAccount);
            change_desc_1_3(data.r_sdata[0].AssetAccount,'#i_1_3_asset_desc','asset');
            $("#i_1_3_ir_no").val(data.r_sdata[0].IntReceivableAccount);
            change_desc_1_3(data.r_sdata[0].IntReceivableAccount,'#i_1_3_ir_desc','interest receivable');
            $("#i_1_3_ii_no").val(data.r_sdata[0].IntIncomeAccount);
            change_desc_1_3(data.r_sdata[0].IntIncomeAccount,'#i_1_3_ii_desc','interest income');
            $("#i_1_3_trd_no").val(data.r_sdata[0].TaxReserveDrAccount);
            change_desc_1_3(data.r_sdata[0].TaxReserveDrAccount,'#i_1_3_trd_desc','tax reserve debit');
            $("#i_1_3_trc_no").val(data.r_sdata[0].TaxReserveCrAccount);
            change_desc_1_3(data.r_sdata[0].TaxReserveCrAccount,'#i_1_3_trc_desc','tax reserve credit');
            
            ada =true;
        }
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
                show_dlg_login();
        else if(!ada)
            clear_form_1_3(5);
    });
    obj_get.fail(function(jqXHR, textStatus) {   
         //clear_form_1_3(5); 
        alert("Getting data error :" + textStatus);
    });
}

function clear_form_1_3(act_no)
{
    if(act_no!=5)
    {
        $("#i_1_3_pf_code").val(''); 
        $("#i_1_3_pf_name").val(''); 
        $("#i_1_3_gl_group").val('');  
        $("#i_1_3_mm_acc_type").val('');  
    }
    $("#i_1_3_profit_no").val('');
    $("#i_1_3_loss_no").val('');
    $("#i_1_3_asset_no").val('');
    $("#i_1_3_ir_no").val('');
    $("#i_1_3_ii_no").val('');
    $("#i_1_3_trd_no").val('');
    $("#i_1_3_trc_no").val('');    
    $("#i_1_3_profit_name").val('');
    $("#i_1_3_loss_name").val('');
    $("#i_1_3_asset_name").val('');
    $("#i_1_3_ir_name").val('');
    $("#i_1_3_ii_name").val('');
    $("#i_1_3_trd_name").val('');
    $("#i_1_3_trc_name").val('');    
    
}

function post_1_3()
{
    //alert(uri+"/index.php/tb_save/save_portfolio");
     state_progress(1);    
    var obj_post = $.post(uri+"/index.php/tb_save/save_mtm", 
        { pf_code:$("#i_1_3_pf_code").val(), gl_group:$("#i_1_3_gl_group").val(),
          acc_type:$("#i_1_3_mm_acc_type").val(),profit_no:$("#i_1_3_profit_no").val(), 
          loss_no:$("#i_1_3_loss_no").val(), asset_no:$("#i_1_3_asset_no").val(),
          ir_no:$("#i_1_3_ir_no").val(), ii_no:$("#i_1_3_ii_no").val(),
          trd_no:$("#i_1_3_trd_no").val(), trc_no:$("#i_1_3_trc_no").val()},function(data) {
        clear_form_1_3();   
    },"json");
    obj_post.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        else
            alert("Saving data success!");
        state_progress(0);
    });
    obj_post.fail(function(jqXHR, textStatus) {   
        alert("Saving data error : " + textStatus);
        state_progress(0); 
    });
    //if(!sukses_post)
    //    set_status("Data portfolio gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
}
function del_data_1_3()
{
    if(confirm("Are you sure?"))
    {
        //alert(uri +"/index.php/tb_delete/del_portfolio");
        state_progress(1);       
        var request = $.ajax({
          url: uri +"/index.php/tb_delete/del_mtm_param",
          type: "POST",
          data: {pf_code : $("#i_1_3_pf_code").val(),
                 gl_group : $("#i_1_3_gl_group").val(),
                 acc_type : $("#i_1_3_mm_acc_type").val()},
          dataType: "json"
        });
        request.done(function(msg) {  //alert(msg);
            if(!msg.r_login)
                show_dlg_login();
            else
              if(msg.r_success==0)      
                  alert("Something wrong, deletion is not allowed.");
              else                                                                                                         
                  clear_form_1_3();
            alert("Deletion is success");
            state_progress(0);
                 
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request deletion failed: " + textStatus );
          state_progress(0);
        });
    }
    
}
    