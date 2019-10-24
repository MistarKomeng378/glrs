function tv_initiate()
{
    $("#tv_i_sdate").datepicker();$("#tv_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#tv_b_view").click(function(){
        tv_view();
    });
}
function tv_show()
{
    $("#tv_i_sdate").val(open_svr_dt);

}
