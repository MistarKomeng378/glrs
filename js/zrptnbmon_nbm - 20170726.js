function nbm_initiate()
{
    $("#nbm_i_sdate").datepicker();$("#nbm_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#nbm_b_view").click(function(){
        nbm_view();
    });
}
function nbm_show()
{
    $("#nbm_i_sdate").val(open_svr_dt);
    nbm_view_clear();
}

function nbm_view()
{
    c_status('nbm',1);
    ipt_enable($("#nbm_b_view"),false);
     var nbm_post = $.post(uri+'/index.php/cnbm/view_proc',{
        dt:$("#nbm_i_sdate").val(),
        a:1
    },function(nbm_data) { });
    nbm_post.done(function(nbm_msg){
        $("#nbm_d_view").html(nbm_msg);
        ipt_enable($("#nbm_b_view"),true);
        c_status('nbm',0);
    });
    nbm_post.fail(function(jqXHR, textStatus) {ipt_enable($("#nbm_b_view"),true);c_status('nbm',0);nbm_view_clear();});
}
function nbm_view_clear()
{
    $("#nbm_d_view").html('');
}