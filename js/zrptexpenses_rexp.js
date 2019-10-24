function rexp_initiate()
{
    $("#rexp_i_date").datepicker();$("#rexp_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#rexp_s_fm").change(function(){
        ipt_pf_load_select($("#rexp_s_pf"),2,this.value);
    });
    $("#rexp_b_view").click(function(){
        rexp_view();
    });
    
}
function rexp_show()
{
    $("#rexp_i_date").val(open_svr_dt);
    ipt_fm_load($("#rexp_s_fm"),2);
    ipt_pf_load('_*_M',$("#rexp_s_pf"),2);
}
function rexp_view()
{
    c_status('rexp',1);
    ipt_enable($("#rexp_b_view"),false);
     var rexp_post = $.post(uri+'/index.php/cexp/view',{
        pf:$("#rexp_s_pf").val(),
        dt:$("#rexp_i_date").val()
    },function(rexp_data) { });
    rexp_post.done(function(rexp_msg){
        $("#rexp_d_view").html(rexp_msg);
        ipt_enable($("#rexp_b_view"),true);
        c_status('nl',0);
    });
    rexp_post.fail(function(jqXHR, textStatus) {ipt_enable($("#rexp_b_view"),true);c_status('rexp',0);rexp_view_clear();});
}