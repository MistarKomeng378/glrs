function initiate_form_report_hist()
{
    $("#i_4_11_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))
                change_pf_name(this.value,2);
            if(e.keyCode==112){
                show_dlg_pf();
            }
            get_tm_hist(this.value);
        }
    });
    $("#i_4_12_pf_code").keyup(function(e){
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
    $("#i_4_13_pf_code").keyup(function(e){
        if(nm=='')
             show_dlg_login();
        else
        {    
            if(is_not_tabenter(e.keyCode))             
                change_pf_name(this.value,2);
            if(e.keyCode==112)
                show_dlg_pf();
        }
    });    
    $("#b_4_11_refresh").click(function(){  
        clear_form_4_1();
    });
    $("#b_4_12_refresh").click(function(){  
        clear_form_4_2();
    });
    $("#b_4_13_refresh").click(function(){  
        clear_form_4_3();
    });          
}

function get_tm_hist(pf_code)
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
                    $("#i_4_11_start_date").val(data.r_sdata[0].CurrentYear);
                if(top_menu_no==4 && leaf_menu_no==2)
                    $("#i_4_12_start_ydate").val(data.r_sdata[0].CurrentYear);
                if(top_menu_no==4 && leaf_menu_no==3)
                    $("#i_4_13_tm").val(data.r_sdata[0].PricingHour);
                ada = true;
            }
        }                                                                                                      
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();
        if(!ada)                           
            $("#i_4_13_tm").val('');    
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $("#i_4_13_tm").val('');             
        alert("error getting data :" + textStatus);
        state_progress(0);
    });
    
}

function clear_form_4_11(act_no)
{
   $("#i_4_11_pf_code").val('');
   $("#i_4_11_pf_name").val('');
   $("#i_4_11_start_date").val(start_year_svr_dt);
   $("#i_4_11_end_date").val(open_svr_dt);
   $("#i_4_11_rpt").val('ALL');         
}

function clear_form_4_12(act_no)
{
   $("#i_4_12_pf_code").val('');
   $("#i_4_12_pf_name").val('');
   $("#i_4_12_start_ydate").val(start_year_svr_dt);
   $("#i_4_12_start_mdate").val(start_month_svr_dt);
   $("#i_4_12_end_ydate").val(open_svr_dt);
   $("#i_4_12_rpt").val('ALL');         
}

function clear_form_4_13(act_no)
{
   $("#i_4_13_pf_code").val('');
   $("#i_4_13_pf_name").val('');                      
   $("#i_4_13_dt").val(open_svr_dt);
   $("#i_4_13_tm").val('');         
}
   