function xd1_initiate()
{
    $("#xd1_i_date").datepicker();$("#xd1_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#xd1_s_fm").change(function(){
        ipt_pf_load_select($("#xd1_s_pf"),2,this.value);
        ipt_fm_set_default(this.value);
        ipt_pf_set_default('');
    });
    $("#xd1_s_fm").change(function(){
        ipt_check_nav_status('$$%^',$("#xd1_i_date").val(),$("#xd1_s_last_dt"),$("#xd1_s_ns"),$("#xd1_s_last_gl_dt"),$("#xd1_s_gs"),false,$("#xd1_s_cyear"),'','');
    });
    $("#xd1_i_date").change(function(){
        ipt_check_nav_status($("#xd1_s_pf").val(),this.value,$("#xd1_s_last_dt"),$("#xd1_s_ns"),$("#xd1_s_last_gl_dt"),$("#xd1_s_gs"),false,$("#xd1_s_cyear"),'','');
    });    
    $("#xd1_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#xd1_i_date").val(),$("#xd1_s_last_dt"),$("#xd1_s_ns"),$("#xd1_s_last_gl_dt"),$("#xd1_s_gs"),false,$("#xd1_s_cyear"),'','');
        ipt_pf_set_default(this.value);
    });
    $("#xd1_b_view").click(function(){
        if($("#xd1_s_pf").val()=='') alert('Choose the portfolio!');
        else if($("#xd1_s_gs").html()!='Done') alert('GL is not Done!');
        else
            xd1_view();      
    });
    $("#xd1_b_preview").click(function(){
        $("#xd1_h_a").val('0');
        if($("#xd1_s_pf").val()=='') alert('Choose the portfolio!');
        else if($("#xd1_s_gs").html()!='Done') alert('GL is not Done!');
        else
           $("#xd1_frm").submit();
    });
    $("#xd1_b_pdf").click(function(){
        $("#xd1_h_a").val('1');
       // setTimeout(function() {   
           if($("#xd1_s_pf").val()=='') alert('Choose the portfolio!');
            else if($("#xd1_s_gs").html()!='Done') alert('GL is not Done!');
            else
               $("#xd1_frm").submit();
        //},1);
        
    });
    
}

function xd1_show()
{
    xd1_reset();
    ipt_fm_load($("#xd1_s_fm"),0);
    ipt_pf_load('_*_M',$("#xd1_s_pf"),2);
    ipt_enable($("#xd1_b_view"),true);
    c_status('rf',0);
    
}
function xd1_reset()
{
    $("#xd1_i_date").val(open_svr_dt);
    $("#xd1_s_no").val('1');
    $("#xd1_d_view").html('');
    $("#xd1_s_last_dt").html(''); 
    $("#xd1_s_last_gl_dt").html(''); 
    $("#xd1_s_ns").html(''); 
    $("#xd1_s_gs").html(''); 
    $("#xd1_s_cyear").html(''); 
}
function xd1_view()
{
    c_status('xd1',1);
    ipt_enable($("#xd1_b_view"),false);
     var xd1_post = $.post(uri+'/index.php/cxd1/view',{
        pf:$("#xd1_s_pf").val(),
        dt:$("#xd1_i_date").val(),
        no:$("#xd1_s_no").val()
    },function(xd1_data) { });
    xd1_post.done(function(xd1_msg){
        $("#xd1_d_view").html(xd1_msg);
        ipt_enable($("#xd1_b_view"),true);
        c_status('xd1',0);
    });
    xd1_post.fail(function(jqXHR, textStatus) {ipt_enable($("#xd1_b_view"),true);c_status('xd1',0);$("#xd1_d_view").html('');});
}