function eod_initiate()
{
    $("#eod_s_fm").change(function(){
        ipt_pf_load_select($("#eod_s_pf"),2,this.value);
        eod_reset();
    });
    $("#eod_b_eod").click(function(){
        if($("#eod_s_pf").val() == '')
            alert('Please choose the Portfolio!');
        else if($("#eod_i_gleoy").val()=='0')
            alert('GL at 12 December, is not Done!');
        else if(confirm('Proccess end of year ' + $("#eod_s_cyear").html() + '?' ))
            eod_process();
    });
    $("#eod_s_pf").change(function(){
        ipt_check_nav_status(this.value, '1/1/1900',$("#eod_s_last_dt"),false,$("#eod_s_last_gl_dt"),false,false,$("#eod_s_cyear"),'eod',false,false,$("#eod_i_gleoy"));
    });
    $("#eod_b_ceod").click(function(){
        if($("#eod_s_pf").val() == '')
            alert('Please choose the Portfolio!');
        else if(confirm('Cancel end of year ' + $("#eod_s_cyear").html() + '?'))
            eod_cancel();
    });
}
function eod_show()
{
    ipt_fm_load($("#eod_s_fm"),2);
    ipt_pf_load('_*_M',$("#eod_s_pf"),2);
    //eod_reset();
    ipt_check_nav_status(ipt_check_pf(), '1/1/1900',$("#eod_s_last_dt"),false,$("#eod_s_last_gl_dt"),false,false,$("#eod_s_cyear"),'eod',false,false,$("#eod_i_gleoy"));
}
function eod_reset()
{
    $("#eod_s_last_dt").html('');
    $("#eod_s_last_gl_dt").html('');
    $("#eod_s_cyear").html('');
}
function eod_process()
{
    c_status('eod',1);
    ipt_enable($("#eod_b_eod"),false);
     var eod_post = $.post(uri+'/index.php/ceod/process',{
        pf:$("#eod_s_pf").val()
    },function(eod_data){});
    eod_post.done(function(eod_msg){
        if(eod_msg=='1')
            alert('End of year success!');
        else
            alert('End of year failed!');
        ipt_enable($("#eod_b_eod"),true);
        ipt_check_nav_status($("#eod_s_pf").val(), '1/1/1900',$("#eod_s_last_dt"),false,$("#eod_s_last_gl_dt"),false,false,$("#eod_s_cyear"),'eod',false,false,$("#eod_i_gleoy"));
        c_status('eod',0);
    });
    eod_post.fail(function(jqXHR, textStatus) {ipt_enable($("#eod_b_eod"),true);c_status('eod',0);eod_view_clear();});
}
function eod_cancel()
{
    c_status('eod',1);
    ipt_enable($("#eod_b_ceod"),false);
     var eod_post = $.post(uri+'/index.php/ceod/cancel',{
        pf:$("#eod_s_pf").val()
    },function(eod_data){});
    eod_post.done(function(eod_msg){
        if(eod_msg=='1')
            alert('Cancel end of year success!');
        else if(eod_msg=='2')
            alert('Could not cancel end of year when approved NAV existed!');
        else
            alert('Cancel end of year failed!');
        ipt_enable($("#eod_b_ceod"),true);
        ipt_check_nav_status($("#eod_s_pf").val(), '1/1/1900',$("#eod_s_last_dt"),false,$("#eod_s_last_gl_dt"),false,false,$("#eod_s_cyear"),'eod',false,false,$("#eod_i_gleoy"));
        c_status('eod',0);
    });
    eod_post.fail(function(jqXHR, textStatus) {ipt_enable($("#eod_b_ceod"),true);c_status('eod',0);eod_view_clear();});
}