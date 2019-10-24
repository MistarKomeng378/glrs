function rfe_initiate()
{
    $("#rfe_i_date").datepicker();$("#rfe_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#rfe_s_fm").change(function(){
        ipt_pf_load_select($("#rfe_s_pf"),2,this.value);
    });
    $("#rfe_b_view").click(function(){
        rfe_view();
    });
    $("#rfe_s_fm").change(function(){   
        ipt_fm_set_default(this.value);
    });
    $("#rfe_s_pf").change(function(){   
         ipt_pf_set_default(this.value); 
    });
}
function rfe_show()
{
    $("#rfe_i_date").val(open_svr_dt);
    ipt_fm_load($("#rfe_s_fm"),2);
    ipt_pf_load('_*_M',$("#rfe_s_pf"),2);
    rfe_view_clear();
}
function rfe_view()
{
    c_status('rfe',1);
    ipt_enable($("#rfe_b_view"),false);
     var rfe_post = $.post(uri+'/index.php/cfee/view_exp',{
         pf:$("#rfe_s_pf").val(),
        dt:$("#rfe_i_date").val(),
        a:1
    },function(rfe_data) { });
    rfe_post.done(function(rfe_msg){
        $("#rfe_d_view").html(rfe_msg);
        ipt_enable($("#rfe_b_view"),true);
        c_status('rfe',0);
    });
    rfe_post.fail(function(jqXHR, textStatus) {ipt_enable($("#rfe_b_view"),true);c_status('rfe',0);rfe_view_clear();});
}

function rfe_view_clear()
{
     $("#rfe_d_view").html('');
}