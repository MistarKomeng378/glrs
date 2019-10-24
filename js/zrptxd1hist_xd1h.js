function xd1h_initiate()
{
    $("#xd1h_i_date").datepicker();$("#xd1h_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#xd1h_s_fm").change(function(){
        ipt_pf_load_select($("#xd1h_s_pf"),2,this.value);
    });
    $("#xd1h_s_fm").change(function(){
        ipt_check_nav_status('$$%^',$("#xd1h_i_date").val(),$("#xd1h_s_last_dt"),$("#xd1h_s_ns"),$("#xd1h_s_last_gl_dt"),$("#xd1h_s_gs"),false,$("#xd1h_s_cyear"),'','');
    });
    $("#xd1h_i_date").change(function(){
        ipt_check_nav_status($("#xd1h_s_pf").val(),this.value,$("#xd1h_s_last_dt"),$("#xd1h_s_ns"),$("#xd1h_s_last_gl_dt"),$("#xd1h_s_gs"),false,$("#xd1h_s_cyear"),'','');
    });    
    $("#xd1h_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#xd1h_i_date").val(),$("#xd1h_s_last_dt"),$("#xd1h_s_ns"),$("#xd1h_s_last_gl_dt"),$("#xd1h_s_gs"),false,$("#xd1h_s_cyear"),'','');
    });
    $("#xd1h_b_view").click(function(){
        if($("#xd1h_s_pf").val()=='') alert('Choose the portfolio!');
        //else if($("#xd1h_s_gs").html()!='Done') alert('GL is not Done!');
        else
            xd1h_view();      
    });
    $("#xd1h_b_preview").click(function(){
        if($("#xd1h_s_pf").val()=='') alert('Choose the portfolio!');
        //else if($("#xd1h_s_gs").html()!='Done') alert('GL is not Done!');
        else
           $("#xd1h_frm").submit();
    });
    
}

function xd1h_show()
{
    xd1h_reset();
    ipt_fm_load($("#xd1h_s_fm"),0);
    ipt_pf_load('_*_M',$("#xd1h_s_pf"),2);
    ipt_enable($("#xd1h_b_view"),true);
    c_status('xd1h',0);
    
}
function xd1h_reset()
{
    $("#xd1h_i_date").val(open_svr_dt);
    $("#xd1h_s_no").val('1');
    $("#xd1h_d_view").html('');
    $("#xd1h_s_last_dt").html(''); 
    $("#xd1h_s_last_gl_dt").html(''); 
    $("#xd1h_s_ns").html(''); 
    $("#xd1h_s_gs").html(''); 
    $("#xd1h_s_cyear").html(''); 
}
function xd1h_view()
{
    c_status('xd1h',1);
    ipt_enable($("#xd1h_b_view"),false);
     var xd1h_post = $.post(uri+'/index.php/cxd1h/view',{
        pf:$("#xd1h_s_pf").val(),
        dt:$("#xd1h_i_date").val(),
        no:$("#xd1h_s_no").val()
    },function(xd1h_data) { });
    xd1h_post.done(function(xd1h_msg){
        $("#xd1h_d_view").html(xd1h_msg);
        ipt_enable($("#xd1h_b_view"),true);
        c_status('xd1h',0);
    });
    xd1h_post.fail(function(jqXHR, textStatus) {ipt_enable($("#xd1h_b_view"),true);c_status('xd1h',0);$("#xd1h_d_view").html('');});
}