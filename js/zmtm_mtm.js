var grid_mtm;
var data_mtm = []; 
var select_mode_mtm = 0;

function mtm_initiate()
{
    $("#mtm_i_date").datepicker();$("#mtm_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#mtm_i_date").change(function(){
        ipt_check_nav_status($("#mtm_s_pf").val(),this.value,$("#mtm_s_last_dt"),$("#mtm_s_ns"),$("#mtm_s_last_gl_dt"),$("#mtm_s_gs"),false,false,'','mtm_enable_button');
        mtm_view_nav($("#mtm_s_pf").val(),this.value);
    });
    $("#mtm_s_fm").change(function(){
        ipt_pf_load_select($("#mtm_s_pf"),2,this.value);
        mtm_reset();
    });
    $("#mtm_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#mtm_i_date").val(),$("#mtm_s_last_dt"),$("#mtm_s_ns"),$("#mtm_s_last_gl_dt"),$("#mtm_s_gs"),false,false,'','mtm_enable_button');
        mtm_view_nav(this.value,$("#mtm_i_date").val());
    });    
}
function mtm_show()
{
    $("#mtm_d_view").html('');
    $("#mtm_b_process").attr("disabled", "disabled");        
    $("#mtm_i_date").val(open_svr_dt);
    mtm_reset();
    ipt_fm_load($("#mtm_s_fm"),0);
    ipt_pf_load('_*_M',$("#mtm_s_pf"),2);
}
function mtm_reset()
{        
    $("#mtm_s_last_dt").html('');
    $("#mtm_s_last_gl_dt").html('');
    $("#mtm_s_ns").html('');
    $("#mtm_s_gs").html('');
    $("#mtm_s_invest").html('');
    $("#mtm_s_gl").html('');
    $("#mtm_s_diff").html('');
}
function mtm_enable_button(p_ns,p_gs,p_cn,p_cg)
{
    if(p_gs!=0)
        $("#mtm_b_process").attr("disabled", "disabled");        
    else
        $("#mtm_b_process").removeAttr("disabled");    
}

function mtm_view_nav(p_pf,p_dt)
{
    c_status('mtm',1);
    var mtm_post = $.post(uri+'/index.php/cgl/view_nav',{
        pf:p_pf,dt:p_dt
    },function(mlsave_data) { },'json');
    mtm_post.done(function(mtm_msg){
        $("#mtm_s_invest").html(mtm_msg.r_det['invest']);
        $("#mtm_s_gl").html(mtm_msg.r_det['gl']);
        $("#mtm_s_diff").html(mtm_msg.r_det['diff']);
        c_status('mtm',0);
    });
    mtm.fail(function(jqXHR, textStatus) {$("#mtm_d_view").html('');c_status('mtm',0);});
}