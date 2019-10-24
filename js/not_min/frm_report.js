function initiate_form_report()
{
    $("#i_4_1_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
            get_tm(this.value);
        }
    });
    $("#i_4_2_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
        }
    });
    $("#i_4_3_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
            {
                change_pf_name(this.value,2);
                get_tm(this.value);
            }
            if(e.keyCode==112){
                show_dlg_pf();
            }
        }
    });
    $("#i_4_4_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
        }
    });
    $("#i_4_5_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
        }
    });
    $("#i_4_6_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
        }
    });
    $("#i_4_7_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
        }
    });
    $("#i_4_8_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
        }
    });
    $("#i_4_8_acc_no").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {                                      
            if(e.keyCode==112)
                show_dlg_acc($("#i_4_8_pf_code").val(),'','','','','','');
            else
                change_account_name(this.value);
        }
    });
    $("#b_4_1_refresh").click(function(){  
        clear_form_4_1();
    });
    $("#b_4_2_refresh").click(function(){  
        clear_form_4_2();
    });
    $("#b_4_3_refresh").click(function(){  
        clear_form_4_3();
    });
    $("#b_4_4_refresh").click(function(){  
        clear_form_4_4();
    });
    $("#b_4_5_refresh").click(function(){  
        clear_form_4_5();
    });
    $("#b_4_6_refresh").click(function(){  
        clear_form_4_6();
    });
    $("#b_4_7_refresh").click(function(){  
        clear_form_4_7();
    }); 
    $("#b_4_8_refresh").click(function(){  
        clear_form_4_8();
    });
}



function clear_form_4_1(act_no)
{
   $("#i_4_1_pf_code").val('');
   $("#i_4_1_pf_name").val('');
   $("#i_4_1_start_date").val(start_year_svr_dt);
   $("#i_4_1_end_date").val(open_svr_dt);
   $("#i_4_1_rpt").val('ALL');         
}

function clear_form_4_2(act_no)
{
   $("#i_4_2_pf_code").val('');
   $("#i_4_2_pf_name").val('');
   $("#i_4_2_start_ydate").val(start_year_svr_dt);
   $("#i_4_2_start_mdate").val(start_month_svr_dt);
   $("#i_4_2_end_ydate").val(open_svr_dt);
   $("#i_4_2_rpt").val('ALL');         
}

function clear_form_4_3(act_no)
{
   $("#i_4_3_pf_code").val('');
   $("#i_4_3_pf_name").val('');                      
   $("#i_4_3_dt").val(open_svr_dt);
   $("#i_4_3_tm").val('');         
}

function clear_form_4_4(act_no)
{
   $("#i_4_4_pf_code").val('');
   $("#i_4_4_pf_name").val('');
   $("#i_4_4_dt").val(open_svr_dt);    
}
function clear_form_4_5(act_no)
{
   $("#i_4_5_pf_code").val('');
   $("#i_4_5_pf_name").val('');
   $("#i_4_5_dt").val(open_svr_dt);    
}
function clear_form_4_6(act_no)
{
   $("#i_4_6_pf_code").val('');
   $("#i_4_6_pf_name").val('');
   $("#i_4_6_dt").val(open_svr_dt);    
}
function clear_form_4_7(act_no)
{
   $("#i_4_5_pf_code").val('');
   $("#i_4_5_pf_name").val('');
   $("#i_4_5_dt").val(open_svr_dt);    
}

function get_tm(pf_code)
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
                if(top_menu_no==4 && leaf_menu_no==1)
                    $("#i_4_1_start_date").val('01-01-'+data.r_sdata[0].CurYear);
                if(top_menu_no==4 && leaf_menu_no==2)
                    $("#i_4_2_start_ydate").val(data.r_sdata[0].CurYear);
                if(top_menu_no==4 && leaf_menu_no==3)
                    $("#i_4_3_tm").val(data.r_sdata[0].PricingHour);
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)                           
            $("#i_4_3_tm").val('');    
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_4_3_tm").val('');             
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}
function change_account_name(accno)
{
    state_progress(1);
    var ada = false;                                                    
    //alert(uri+"/index.php/tb/get_gl_acc_name/" + decodeurl(accno));
    var obj_get = $.getJSON(uri+"/index.php/tb/get_gl_acc_name/" + decodeurl(accno),function(data) {
        if(data.r_success==1)
        {                                              
            if(data.r_num_rows>0)
            {     
                if(top_menu_no==4 && leaf_menu_no==8)
                    $("#i_4_8_acc_name").val(data.r_sdata[0].AccountName);
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)                           
            $("#i_4_8_acc_name").val('');    
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_4_8_acc_name").val('');             
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}