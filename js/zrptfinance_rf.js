function rf_initiate()
{
    $("#rf_i_sdate").datepicker();$("#rf_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#rf_i_date").datepicker();$("#rf_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#rf_s_fm").change(function(){
        ipt_pf_load_select($("#rf_s_pf"),2,this.value);
        ipt_fm_set_default(this.value);
        ipt_pf_set_default('');
    });
    $("#rf_s_fm").change(function(){
        ipt_check_nav_status('$$%^',$("#rf_i_date").val(),$("#rf_s_last_dt"),$("#rf_s_ns"),$("#rf_s_last_gl_dt"),$("#rf_s_gs"),false,$("#rf_s_cyear"),'','');
    });
    $("#rf_i_date").change(function(){
        ipt_check_nav_status($("#rf_s_pf").val(),this.value,$("#rf_s_last_dt"),$("#rf_s_ns"),$("#rf_s_last_gl_dt"),$("#rf_s_gs"),false,$("#rf_s_cyear"),'','');
    });    
    $("#rf_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#rf_i_date").val(),$("#rf_s_last_dt"),$("#rf_s_ns"),$("#rf_s_last_gl_dt"),$("#rf_s_gs"),false,$("#rf_s_cyear"),'','');
        if($("#rf_s_name").val()=='GAM')
            ipt_gl_load_select($("#rf_s_acc"),1,this.value);
        ipt_pf_set_default(this.value);
    });        
    $("#rf_b_view").click(function(){
        if($("#rf_s_pf").val()=='') alert('Choose the portfolio!');
        else
        {
            var rf_t_sel = $("#rf_s_name").val();
            if(rf_t_sel=='FB')
                alert('Use preview button to view the Financial Book!');
            else if(rf_t_sel=='GAM' && $("#rf_s_acc").val()=='ALL')
                alert("Print preview is available for ALL Account, \nPlease choose account no if you want to view!");
            else
            {
                if( (rf_t_sel=='BS' || rf_t_sel=='PL' || rf_t_sel=='NC' || rf_t_sel=='DBG') && $("#rf_s_gs").html()!='Done' )
                        alert('GL is not Done!');
                else if( (rf_t_sel=='VAL' || rf_t_sel=='TB' || rf_t_sel=='GAM' || rf_t_sel=='NAV'  ) && $("#rf_s_ns").html()!='Approved' )
                        alert('NAV is not Approved!');
                else
                    rf_view();
            }
        }
    });
    $("#rf_b_preview").click(function(){
        if($("#rf_s_pf").val()=='') alert('Choose the portfolio!');
        else
        {
            $("#rf_h_v").val('0');
            var rf_t_sel = $("#rf_s_name").val();
            if( (rf_t_sel=='BS' || rf_t_sel=='PL' || rf_t_sel=='NC' || rf_t_sel=='DBG') && $("#rf_s_gs").html()!='Done' )
                    alert('GL is not Done!');
            else if( (rf_t_sel=='VAL' || rf_t_sel=='MTM' || rf_t_sel=='TB' || rf_t_sel=='GAM' || rf_t_sel=='NAV'  || rf_t_sel=='FB' ) && $("#rf_s_ns").html()!='Approved' )
                    alert('NAV is not Approved!');
            else
                $("#rf_frm").submit();
        }        
    });
    $("#rf_b_preview_mi").click(function(){
        if($("#rf_s_fm").val()=='') alert('Choose the fundmanager!');
        else
        {
            $("#rf_h_v").val('1');
            var rf_t_sel = $("#rf_s_name").val();
            if( rf_t_sel=='NAV' || rf_t_sel=='BS' || rf_t_sel=='PL' || rf_t_sel=='VAL' || rf_t_sel=='TB' || rf_t_sel=='GAM' || rf_t_sel=='FB')
            {
                $("#rf_frm").submit();
            }
        }        
    });
    $("#rf_s_name").change(function(){
        if(this.value=='BS') rf_sdt_show(false);
        else if(this.value=='PL') rf_sdt_show(true);
        else if(this.value=='VAL') rf_sdt_show(false);
        else if(this.value=='MTM') rf_sdt_show(false);
        else if(this.value=='TB') rf_sdt_show(true); 
        else if(this.value=='NC') rf_sdt_show(true); 
        else if(this.value=='GAM') rf_sdt_show(true);
        else if(this.value=='NAV') rf_sdt_show(false);
        else if(this.value=='DGB') rf_sdt_show(false);
        else if(this.value=='NP') rf_sdt_show(true); 
        else if(this.value=='XD11' ||this.value=='XD12' ||this.value=='XD13' ) rf_sdt_show(false);
        else if(this.value=='FB') rf_sdt_show(false);
        
        if(this.value=='GAM' || this.value=='PL' ) 
        {
            rf_sacc_show(true);
            $("#rf_i_sdate").val(start_month_svr_dt);
        }
        else 
        {
            rf_sacc_show(false);
            $("#rf_i_sdate").val(start_year_svr_dt);
        }
        
        if(this.value=='VAL' || this.value=='MTM' || this.value=='TB' || this.value=='NP' || this.value=='XD11' || this.value=='XD12' || this.value=='XD13' || this.value=='FB') rf_srt_show(false);
        else rf_srt_show(true);
    });
}

function rf_show()
{
    rf_reset();
    ipt_fm_load($("#rf_s_fm"),2);
    ipt_pf_load('_*_M',$("#rf_s_pf"),2);
    ipt_enable($("#rf_b_view"),true);
    c_status('rf',0);
    ipt_check_nav_status(ipt_check_pf(),$("#rf_i_date").val(),$("#rf_s_last_dt"),$("#rf_s_ns"),$("#rf_s_last_gl_dt"),$("#rf_s_gs"),false,$("#rf_s_cyear"),'','');   
}
function rf_reset()
{
    $("#rf_i_sdate").val(start_year_svr_dt);
    $("#rf_i_date").val(open_svr_dt);
    $("#rf_i_type").val('ALL');
    $("#rf_d_view").html('');
    $("#rf_s_last_dt").html(''); 
    $("#rf_s_last_gl_dt").html(''); 
    $("#rf_s_ns").html(''); 
    $("#rf_s_gs").html(''); 
    $("#rf_s_cyear").html(''); 
    
    $("#rf_s_name").val('NAV');
    rf_srt_show(true);
    rf_sdt_show(false);
    rf_sacc_show(false);
}
function rf_sdt_show(p_show)
{
    if(!p_show)
        $("#rf_i_sdate").val(start_year_svr_dt);
    ipt_show($("#rf_tr_sdt"),p_show);
}
function rf_sacc_show(p_show)
{
    if(p_show) ipt_gl_load_select($("#rf_s_acc"),1,$("#rf_s_pf").val());
    ipt_show($("#rf_tr_sacc"),p_show);
}
function rf_srt_show(p_show)
{   
    ipt_show($("#rf_tr_srt"),p_show);
}
function rf_view()
{
    c_status('rf',1);
    ipt_enable($("#rf_b_view"),false);
     var rf_post = $.post(uri+'/index.php/cfin/view_rpt',{
        pf:$("#rf_s_pf").val(),
        sdt:$("#rf_i_sdate").val(),
        dt:$("#rf_i_date").val(),
        rt:$("#rf_i_type").val(),
        rn:$("#rf_s_name").val(),
        acc:$("#rf_s_acc").val(),
        a:1
    },function(rf_data) { });
    rf_post.done(function(rf_msg){
        $("#rf_d_view").html(rf_msg);
        ipt_enable($("#rf_b_view"),true);
        c_status('rf',0);
    });
    rf_post.fail(function(jqXHR, textStatus) {ipt_enable($("#rf_b_view"),true);c_status('rf',0);$("#rf_d_view").html('');});
}