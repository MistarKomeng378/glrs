function rfh_initiate()
{
    $("#rfh_i_sdate").datepicker();$("#rfh_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#rfh_i_date").datepicker();$("#rfh_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#rfh_s_fm").change(function(){
        ipt_pf_load_select($("#rfh_s_pf"),2,this.value);
    });
    $("#rfh_s_fm").change(function(){
        ipt_check_nav_status('$$%^',$("#rfh_i_date").val(),$("#rfh_s_last_dt"),$("#rfh_s_ns"),$("#rfh_s_last_gl_dt"),$("#rfh_s_gs"),false,$("#rfh_s_cyear"),'','');
    });
    $("#rfh_i_date").change(function(){
        ipt_check_nav_status($("#rfh_s_pf").val(),this.value,$("#rfh_s_last_dt"),$("#rfh_s_ns"),$("#rfh_s_last_gl_dt"),$("#rfh_s_gs"),false,$("#rfh_s_cyear"),'','');
    });    
    $("#rfh_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#rfh_i_date").val(),$("#rfh_s_last_dt"),$("#rfh_s_ns"),$("#rfh_s_last_gl_dt"),$("#rfh_s_gs"),false,$("#rfh_s_cyear"),'','');
        if($("#rfh_s_name").val()=='GAM')
            ipt_gl_load_select($("#rfh_s_acc"),1,this.value);
    });        
    $("#rfh_b_view").click(function(){
        if($("#rfh_s_pf").val()=='') alert('Choose the portfolio!');
        else
        {
            var rfh_t_sel = $("#rfh_s_name").val();
            if(rfh_t_sel=='GAM' && $("#rfh_s_acc").val()=='ALL')
                alert("Print preview is available for ALL Account, \nPlease choose account no if you want to view!");
            else
            /*{
                if( (rfh_t_sel=='BS' || rfh_t_sel=='PL' || rfh_t_sel=='NC' || rfh_t_sel=='DBG') && $("#rfh_s_gs").html()!='Done' )
                        alert('GL is not Done!');
                else if( (rfh_t_sel=='VAL' || rfh_t_sel=='MTM' || rfh_t_sel=='TB' || rfh_t_sel=='GAM' || rfh_t_sel=='NAV' ) && $("#rfh_s_ns").html()!='Approved' )
                        alert('NAV is not Approved!');
                else
                    rfh_view();
            } */
                rfh_view();
        }
    });
    $("#rfh_b_preview").click(function(){
        if($("#rfh_s_pf").val()=='') alert('Choose the portfolio!');
        else
        {
            var rfh_t_sel = $("#rfh_s_name").val();
           /* if( (rfh_t_sel=='BS' || rfh_t_sel=='PL' || rfh_t_sel=='NC' || rfh_t_sel=='DBG') && $("#rfh_s_gs").html()!='Done' )
                    alert('GL is not Done!');
            else if( (rfh_t_sel=='VAL' || rfh_t_sel=='MTM' || rfh_t_sel=='TB' || rfh_t_sel=='GAM' || rfh_t_sel=='NAV' ) && $("#rfh_s_ns").html()!='Approved' )
                    alert('NAV is not Approved!');
            else*/
                $("#rfh_frm").submit();
        }        
    });
    $("#rfh_s_name").change(function(){
        if(this.value=='BS') rfh_sdt_show(false);
        else if(this.value=='PL' || this.value=='TB' || this.value=='NC' || this.value=='GAM' ) rfh_sdt_show(true); 
        else if(this.value=='MTM' || this.value=='NAV' || this.value=='XD11' || this.value=='XD12' || this.value=='XD13') rfh_sdt_show(false);
        
        if(this.value=='GAM' || this.value=='PL') 
        {
            rfh_sacc_show(true);
            $("#rfh_i_sdate").val(start_month_svr_dt);
        }
        else 
        {
            rfh_sacc_show(false);
            $("#rfh_i_sdate").val(start_year_svr_dt);
        }
        
        if(this.value=='VAL' || this.value=='MTM' || this.value=='TB' || this.value=='XD11' || this.value=='XD12' || this.value=='XD13') rfh_srt_show(false);
        else rfh_srt_show(true);
    });
}

function rfh_show()
{
    rfh_reset();
    ipt_fm_load($("#rfh_s_fm"),2);
    ipt_pf_load('_*_M',$("#rfh_s_pf"),2);
    ipt_enable($("#rfh_b_view"),true);
    c_status('rfh',0);
    
}
function rfh_reset()
{
    $("#rfh_i_sdate").val(start_year_svr_dt);
    $("#rfh_i_date").val(open_svr_dt);
    $("#rfh_i_type").val('ALL');
    $("#rfh_d_view").html('');
    $("#rfh_s_last_dt").html(''); 
    $("#rfh_s_last_gl_dt").html(''); 
    $("#rfh_s_ns").html(''); 
    $("#rfh_s_gs").html(''); 
    $("#rfh_s_cyear").html(''); 
    
    $("#rfh_s_name").val('BS');
    rfh_srt_show(true);
    rfh_sdt_show(false);
    rfh_sacc_show(false);
}
function rfh_sdt_show(p_show)
{
    if(!p_show)
        $("#rfh_i_sdate").val(start_year_svr_dt);
    ipt_show($("#rfh_tr_sdt"),p_show);
}
function rfh_sacc_show(p_show)
{
    if(p_show) ipt_gl_load_select($("#rfh_s_acc"),1,$("#rfh_s_pf").val());
    ipt_show($("#rfh_tr_sacc"),p_show);
}
function rfh_srt_show(p_show)
{   
    ipt_show($("#rfh_tr_srt"),p_show);
}
function rfh_view()
{
    c_status('rfh',1);
    ipt_enable($("#rfh_b_view"),false);
     var rfh_post = $.post(uri+'/index.php/cfinhist/view_rpt',{
        pf:$("#rfh_s_pf").val(),
        sdt:$("#rfh_i_sdate").val(),
        dt:$("#rfh_i_date").val(),
        rt:$("#rfh_i_type").val(),
        rn:$("#rfh_s_name").val(),
        acc:$("#rfh_s_acc").val(),
        a:1
    },function(rfh_data) { });
    rfh_post.done(function(rfh_msg){
        $("#rfh_d_view").html(rfh_msg);
        ipt_enable($("#rfh_b_view"),true);
        c_status('rfh',0);
    });
    rfh_post.fail(function(jqXHR, textStatus) {ipt_enable($("#rfh_b_view"),true);c_status('rfh',0);$("#rfh_d_view").html('');});
}