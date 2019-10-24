function rsinvest_initiate()
{
    $("#rsinvest_i_date").datepicker();$("#rsinvest_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
}

function rsinvest_show()
{
    rsinvest_reset();
}
function rsinvest_reset()
{
    $("#rsinvest_i_date").val(open_svr_dt)
}
