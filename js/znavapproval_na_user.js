var na_view_progress =0;
function na_initiate()
{
    $("#na_i_date").datepicker();$("#na_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#na_s_fm").change(function(){
        ipt_pf_load_select($("#na_s_pf"),2,this.value);
        ipt_fm_set_default(this.value);
        ipt_pf_set_default('');
        na_reset();        
    });
    $("#na_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#na_i_date").val(),$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),$("#na_s_urs_dt"),$("#na_s_cur_year"),'na','na_enable_button');
        ipt_pf_set_default(this.value);
        na_reset();
    });
    $("#na_i_date").change(function(){
        ipt_check_nav_status($("#na_s_pf").val(),this.value,$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),$("#na_s_urs_dt"),$("#na_s_cur_year"),'na','na_enable_button');
        na_reset();
    });
    $("#na_b_view").click(function(){
        if ($("#na_s_pf").val()=='')
            alert('Choose the fund!');
        else
        {
        $("#na_i_pf_h").val($("#na_s_pf").val());
        $("#na_i_date_h").val($("#na_i_date").val());
        //ipt_check_nav_status($("#na_s_pf").val(),$("#na_i_date").val(),$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),false,false,'','na_enable_button');
        na_view_nav();
        }
    });
    $("#na_b_approve").click(function(){na_approve(); });
    $("#na_b_unapprove").click(function(){na_unapprove(); });
    $("#na_b_gl_done").click(function(){na_gldone(); });
    $("#na_b_gl_undone").click(function(){na_glundone(); });
    
}
function na_show()
{
    na_view_progress=0;
    na_reset();
    $("#na_i_date_h").val(open_svr_dt);
    $("#na_i_date").val(open_svr_dt);
    ipt_fm_load($("#na_s_fm"),2);
    var  ia_fm ='_*_M'
    if (ipt_check_fm()!='_*_M')
        ia_fm=  ipt_check_fm();
    ipt_pf_load(ia_fm,$("#na_s_pf"),2);
    if(ipt_check_pf()!='')
    {
        ipt_check_nav_status(ipt_check_pf(),$("#na_i_date").val(),$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),$("#na_s_urs_dt"),$("#na_s_cur_year"),'na','na_enable_button');
    }
}
function na_reset()
{   
    na_view_progress=0;
    $("#na_i_pf_h").val('');
    $("#na_s_last_dt").html('');
    $("#na_s_last_gl_dt").html('');
    $("#na_s_ns").html('');
    $("#na_s_gs").html('');    
    $("#na_s_urs_dt").html('');   
    
    na_button_disable();
    na_view_clear();
}
function na_button_disable()
{
    $("#na_b_approve").attr("disabled", "disabled");    
    $("#na_b_unapprove").attr("disabled", "disabled");    
    $("#na_b_gl_done").attr("disabled", "disabled");    
    $("#na_b_gl_undone").attr("disabled", "disabled");        
}
function na_view_clear(){
    $("#na_tb_cat").html('');
    $("#na_s_invest").html('');
    $("#na_s_gl").html('');
    $("#na_s_diff").html('');
    $("#na_d_view").html('');
    $("#na_d_viewval").html(''); 
    $("#na_d_viewint").html('');
    $("#s_nav_prev").html('');
    $("#s_nav_c").html('');
    $("#na_tr_nav_prev").hide();
    $("#na_tr_nav_c").hide();
}
function na_enable_button(p_ns,p_gs,p_cn,p_cg,puy,p_u,p_ad,c_ys,g_eoy)
{
    if(c_ys==0)
    {
        $("#na_b_approve").attr("disabled", "disabled");        
        $("#na_b_gl_done").attr("disabled", "disabled");
        $("#na_b_unapprove").attr("disabled", "disabled");
        $("#na_b_gl_undone").attr("disabled", "disabled");
    }
    else
    {
        if( (p_ns!='0' && p_ns!='null') || p_ad=='0')
            $("#na_b_approve").attr("disabled", "disabled");        
        else
            $("#na_b_approve").removeAttr("disabled");
            
        if(p_gs!=0 || p_cn!='A')
            $("#na_b_gl_done").attr("disabled", "disabled");        
        else
            $("#na_b_gl_done").removeAttr("disabled");
    }
}
function na_view_nav()
{
    na_view_progress=0;
    c_status('na',1);
    ipt_enable($("#na_b_view"),false);
     var nav_post = $.post(uri+'/index.php/cnav/get_pre_approval',{
        pf:$("#na_s_pf").val(),
        dt:$("#na_i_date").val()
    },function(nav_data) { },'json');
    nav_post.done(function(nav_msg){
        $("#na_s_invest").html(nav_msg.r_det['invest']);
        $("#na_s_gl").html(nav_msg.r_det['gl']);
        $("#na_s_diff").html(nav_msg.r_det['diff']);
        $("#s_nav_prev").html('Previous Nav: '+ nav_msg.r_det['prev'] + ' - ' +(nav_msg.r_det['u']==1?'Increase':'Decrease'));
        if(nav_msg.r_det['u']==0)
            $("#na_tr_nav_prev").css('background-color', 'red');
        else
            $("#na_tr_nav_prev").css('background-color', 'green');
        $("#na_tr_nav_prev").show();
    
        $("#s_nav_c").html('Changes per Days: '+ nav_msg.r_det['c'] + '%' );
        if(nav_msg.r_det['a']==0)
            $("#na_tr_nav_c").css('background-color', 'green');
        else
            $("#na_tr_nav_c").css('background-color', 'red');
        $("#na_tr_nav_c").show();
        $("#na_i_nc_h").val( nav_msg.r_det['a']);
        $("#na_i_rd_h").val( nav_msg.r_det['pty']);
        
        $("#na_d_view").html(nav_msg.r_sect);
        $("#na_d_viewval").html(nav_msg.r_val);
        $("#na_d_viewint").html(nav_msg.r_valint);
        $("#na_d_viewtax").html(nav_msg.r_fi);
        
        $("#na_tb_cat").html(nav_msg.s_cat);
        ipt_enable($("#na_b_view"),true);
        c_status('na',0);
        na_view_progress=1;
    });
    nav_post.fail(function(jqXHR, textStatus) {ipt_enable($("#na_b_view"),true);c_status('na',0);na_view_clear();});
}
function na_approve()
{
    if(na_view_progress==0)
    {
        alert('Please wait or view the the nav first!!');
        return 0;
    }
    if(!confirm('Approve?'))
        return 0;    
    if($("#na_i_pf_h").val()=='')
    {
        alert('Please view the nav first!');
        return 0;
    }
    if($("#na_s_last_dt").html()!= $("#na_s_urs_dt").html() && $("#na_s_last_dt").html()!='')
    {
        alert('Please check on URS, not posted yet!');
        return 0;
    }
    if($("#na_i_nc_h").val()==1)
    {
        alert('Mutual Fund Changes per Days out of the threshold, contact the dept head!');
        return(0);
    }
    c_status('na',1);
    ipt_enable($("#na_b_approve"),false);
     var nav_post = $.post(uri+'/index.php/cnav/approve',{
        pf:$("#na_i_pf_h").val(),
        dt:$("#na_i_date_h").val()
    },function(nav_data) { });
    nav_post.done(function(nav_msg){
        c_status('na',0);
        if(nav_msg=='1')
            alert('Approve success!');
        else
            alert('Approve failed!');
        ipt_check_nav_status($("#na_s_pf").val(),$("#na_i_date").val(),$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),$("#na_s_urs_dt"),$("#na_s_cur_year"),'','na_enable_button');
        na_view_nav();
    });
    nav_post.fail(function(jqXHR, textStatus) {c_status('na',0);na_view_nav();});
}
function na_unapprove()
{
    if(na_view_progress==0)
    {
        alert('Please wait or view the the nav first!!');
        return 0;
    }
    if(!confirm('UnApprove?'))
        return 0;
    if($("#na_i_pf_h").val()=='')
    {
        alert('Please view the nav first!');
        return 0;
    }
    c_status('na',1);
    ipt_enable($("#na_b_unapprove"),false);
     var nav_post = $.post(uri+'/index.php/cnav/unapprove',{
        pf:$("#na_i_pf_h").val(),
        dt:$("#na_i_date_h").val()
    },function(nav_data) { });
    nav_post.done(function(nav_msg){
        c_status('na',0);
        if(nav_msg=='1')
            alert('UnApprove success!');
        else
            alert('UnApprove failed!');
        ipt_check_nav_status($("#na_s_pf").val(),$("#na_i_date").val(),$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),$("#na_s_urs_dt"),$("#na_s_cur_year"),'','na_enable_button');
        na_view_nav();        
    });
    nav_post.fail(function(jqXHR, textStatus) {c_status('na',0);na_view_nav();});
}
function na_gldone()
{
    if(na_view_progress==0)
    {
        alert('Please wait or view the the nav first!!');
        return 0;
    }
    var diff_s = $("#na_s_diff").html().replace(/,/g,"");
    if ( (0+parseInt(diff_s)>=5) || (0+parseInt(diff_s)<=-5) )
    {
        alert('NAV Investment different With NAV GL more than or equivalent 5!');
        return 0;
    }
    else if(!confirm('GL Done?'))
        return 0;
    if($("#na_i_pf_h").val()=='')
    {
        alert('Please view the nav first!');
        return 0;
    }
    c_status('na',1);
    ipt_enable($("#na_b_gl_done"),false);
     var nav_post = $.post(uri+'/index.php/cnav/gldone',{
        pf:$("#na_i_pf_h").val(),
        dt:$("#na_i_date_h").val()
    },function(nav_data) { });
    nav_post.done(function(nav_msg){
        c_status('na',0);
        if(nav_msg=='1')
            alert('GL Done success!');
        else
            alert('GL Done failed!');
        ipt_check_nav_status($("#na_s_pf").val(),$("#na_i_date").val(),$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),$("#na_s_urs_dt"),$("#na_s_cur_year"),'','na_enable_button');
        na_view_nav();
    });
    nav_post.fail(function(jqXHR, textStatus) {c_status('na',0);na_view_nav();});
}
function na_glundone()
{
    if(na_view_progress==0)
    {
        alert('Please wait or view the the nav first!!');
        return 0;
    }
    if(!confirm('GL UnDone?'))
        return 0;
    if($("#na_i_pf_h").val()=='')
    {
        alert('Please view the nav first!');
        return 0;
    }
    c_status('na',1);
    ipt_enable($("#na_b_gl_undone"),false);
     var nav_post = $.post(uri+'/index.php/cnav/glundone',{
        pf:$("#na_i_pf_h").val(),
        dt:$("#na_i_date_h").val()
    },function(nav_data) { });
    nav_post.done(function(nav_msg){
        c_status('na',0);
        if(nav_msg=='1')
            alert('GL UnDone success!');
        else
            alert('GL UnDone failed!');
        ipt_check_nav_status($("#na_s_pf").val(),$("#na_i_date").val(),$("#na_s_last_dt"),$("#na_s_ns"),$("#na_s_last_gl_dt"),$("#na_s_gs"),$("#na_s_urs_dt"),$("#na_s_cur_year"),'','na_enable_button');
        na_view_nav();
    });
    nav_post.fail(function(jqXHR, textStatus) {c_status('na',0);na_view_nav();});
}
