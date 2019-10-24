function nl_initiate()
{
    $("#nl_i_sdate").datepicker();$("#nl_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#nl_i_edate").datepicker();$("#nl_i_edate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#nl_s_fm").change(function(){
        ipt_pf_load_select($("#nl_s_pf"),2,this.value);
    });
    $("#nl_b_view").click(function(){
        nl_view();
    });
    
}
function nl_show()
{
    $("#nl_i_sdate").val(open_svr_dt);
    $("#nl_i_edate").val(open_svr_dt);
    ipt_fm_load($("#nl_s_fm"),2);
    ipt_pf_load('_*_M',$("#nl_s_pf"),2);
}
function nl_view()
{
    c_status('nl',1);
    ipt_enable($("#nl_b_view"),false);
     var nl_post = $.post(uri+'/index.php/cnl/view_listing',{
         pf:$("#nl_s_pf").val(),
        sdt:$("#nl_i_sdate").val(),
        edt:$("#nl_i_edate").val(),
        a:1
    },function(nl_data) { });
    nl_post.done(function(nl_msg){
        $("#nl_d_view").html(nl_msg);
        ipt_enable($("#nl_b_view"),true);
        c_status('nl',0);
    });
    nl_post.fail(function(jqXHR, textStatus) {ipt_enable($("#nl_b_view"),true);c_status('nl',0);nl_view_clear();});
}