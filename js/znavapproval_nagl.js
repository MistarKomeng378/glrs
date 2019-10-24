function nagl_initiate()
{
    $("#nagl_i_date").datepicker();$("#nagl_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#nagl_b_view").click(function(){ 
        nagl_view();
    });
    $("#nagl_b_done").click(function(){ 
        if(confirm("GL Done for listed portfolio?"))
            nagl_done();
    });
}
function nagl_show()
{
    $("#nagl_i_date").val(open_svr_dt);
    nagl_view_clear();
    ipt_enable($("#nagl_b_done"),false);
}

function nagl_view()
{
    c_status('nagl',1);
    $("#nagl_h_date").val($("#nagl_i_date").val());
    ipt_enable($("#nagl_b_view"),false);
    ipt_enable($("#nagl_b_done"),false);
     var nagl_post = $.post(uri+'/index.php/cnagl/pre_nagl',{
        dt:$("#nagl_i_date").val()
    },function(nagl_data) { });
    nagl_post.done(function(nagl_msg){
        $("#nagl_d_view").html(nagl_msg);
        ipt_enable($("#nagl_b_view"),true);
        ipt_enable($("#nagl_b_done"),true);
        c_status('nagl',0);
    });
    nagl_post.fail(function(jqXHR, textStatus) {ipt_enable($("#nagl_b_view"),true);c_status('nagl',0);nagl_view_clear();});
}
function nagl_view_clear()
{
    $("#nagl_d_view").html('');
}
function nagl_done()
{
    c_status('nagl',1); 
    ipt_enable($("#nagl_b_done"),false);
     var nagl_post = $.post(uri+'/index.php/cnagl/nagl_done',{
        dt:$("#nagl_h_date").val()
    },function(nagl_data) { });
    nagl_post.done(function(nagl_msg){
        c_status('nagl',0);
        ipt_enable($("#nagl_b_done"),true);
        if(nagl_msg==1)
            alert('GL Done for ALL, sucess!');
        nagl_view();
    });
    nagl_post.fail(function(jqXHR, textStatus) {ipt_enable($("#nagl_b_done"),true);c_status('nagl',0);nagl_view_clear();});
}