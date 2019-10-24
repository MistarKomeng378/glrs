function mm_initiate()
{
    $("#mm_i_sdate").datepicker();$("#mm_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#mm_b_view").click(function(){
        mm_view();
    });
}
function mm_show()
{
    $("#mm_i_sdate").val(open_svr_dt);
    mm_view_clear();
}

function mm_view()
{
    c_status('mm',1);
    ipt_enable($("#mm_b_view"),false);
     var mm_post = $.post(uri+'/index.php/cmm/view_mon',{
        dt:$("#mm_i_sdate").val(),
        a:1
    },function(mm_data) { });
    mm_post.done(function(mm_msg){
        $("#mm_d_view").html(mm_msg);
        ipt_enable($("#mm_b_view"),true);
        c_status('mm',0);
    });
    mm_post.fail(function(jqXHR, textStatus) {ipt_enable($("#mm_b_view"),true);c_status('mm',0);mm_view_clear();});
}
function mm_view_clear()
{
    $("#mm_d_view").html('');
}