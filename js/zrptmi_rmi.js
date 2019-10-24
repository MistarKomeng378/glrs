function rmi_initiate()
{
    $("#rmi_i_date").datepicker();$("#rmi_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#rmi_s_fm").change(function(){
        ipt_pf_load_select($("#rmi_s_pf"),2,this.value);        
    });
    $("#rmi_s_pf").change(function(){        
    });        
    $("#rmi_b_view").click(function(){
        rmi_view($("#rmi_s_name").val());
    });
    $("#rmi_b_preview").click(function(){
        rmi_preview($("#rmi_s_name").val());
    });
    $("#rmi_s_name").change(function(){
        if(this.value=='NAVB')
        {
            ipt_show($("#rmi_tr_fm"),false);
            ipt_show($("#rmi_tr_pf"),false);
        }
        else if(this.value=='NAVD')
        {
            ipt_show($("#rmi_tr_fm"),true);
            ipt_show($("#rmi_tr_pf"),true);
        }
         else if(this.value=='NAVS' || this.value=='NAVD1')
        {
            ipt_show($("#rmi_tr_fm"),true);
            ipt_show($("#rmi_tr_pf"),false);
        }
        else if(this.value=='PP')
        {
            ipt_show($("#rmi_tr_fm"),true);
            ipt_show($("#rmi_tr_pf"),true);
        }
        
    });
}

function rmi_show()
{
    rmi_reset();
    ipt_fm_load($("#rmi_s_fm"),2);
    ipt_pf_load('_*_M',$("#rmi_s_pf"),2);
    /*ipt_enable($("#rmi_b_view"),true);
    c_status('rmi',0);*/
    
}
function rmi_reset()
{
    $("#rmi_i_date").val(open_svr_dt);
    $("#rmi_s_name").val('NAVA');
    $("#rmi_d_view").html('');
    
    $("#rmi_s_name").val('NAV');
    ipt_show($("#rmi_tr_fm"),false);
    ipt_show($("#rmi_tr_pf"),false);
    ipt_enable($("#rmi_b_view"),true);
}
function rmi_view(p_rn)
{
    c_status('rmi',1);
    ipt_enable($("#rmi_b_view"),false);
     var rmi_post = $.post(uri+'/index.php/crmi/view',{
        fm:$("#rmi_s_fm").val(),
        pf:$("#rmi_s_pf").val(),
        dt:$("#rmi_i_date").val(),
        rn:$("#rmi_s_name").val(),
        a:1
    },function(rmi_data) { });
    rmi_post.done(function(rmi_msg){ 
        $("#rmi_d_view").html(rmi_msg);
        ipt_enable($("#rmi_b_view"),true);
        c_status('rmi',0);
    });
    rmi_post.fail(function(jqXHR, textStatus) {ipt_enable($("#rmi_b_view"),true);c_status('rmi',0);$("#rmi_d_view").html('');});
}