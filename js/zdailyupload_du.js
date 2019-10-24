var grid_du;
var data_du = []; 
var select_mode_du = 0;

function du_initiate()
{
    $("#du_i_date").datepicker();$("#du_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#du_i_sdate").datepicker();$("#du_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#du_s_fm").change(function(){
        ipt_pf_load_select($("#du_s_pf"),2,this.value);
        ipt_fm_set_default(this.value);
        ipt_pf_set_default('');
        du_reset();
    });
    $("#du_s_pf").change(function(){
        ipt_check_nav_status(this.value, $("#du_i_date").val(),$("#du_s_last_dt"),$("#du_s_nav_status"),$("#du_s_last_gl_dt"),$("#du_s_gl_status"),false,false,'du');
        ipt_pf_set_default(this.value);
    });
    $("#du_i_date").change(function(){
        ipt_check_nav_status( $("#du_s_pf").val(),this.value,$("#du_s_last_dt"),$("#du_s_nav_status"),$("#du_s_last_gl_dt"),$("#du_s_gl_status"),false,false,'du');
    });
    $("#du_b_upload").click(function(){
        du_upload();
    });
    $("#du_b_refresh").click(function(){
        du_clear_files();
    });
    du_initiate_upload();
    
}
function du_show()
{
    $("#du_i_date").val(open_svr_dt);
    $("#du_i_sdate").val(open_svr_dt);
    du_reset();
    ipt_fm_load($("#du_s_fm"),2);
    ipt_pf_load('_*_M',$("#du_s_pf"),2);
    du_clear_files();
}
function du_reset()
{    
    
    $("#du_s_last_dt").html('');
    $("#du_s_last_gl_dt").html('');
    $("#du_s_nav_status").html('');
    $("#du_s_gl_status").html('');
    
}
function du_clear_files()
{
    //$("#du_f_fi_sec").val('');
    //$("#du_f_fi_trx").val('');
    $("#du_f_val").val('');
    $("#du_f_journal").val('');    
}
function du_upload()
{
    if($("#du_s_pf").val()=='')
    {
        alert('Choose the portfolio!');
        return 0;
    }
    var du_post = $.post(uri+'/index.php/cnav/check_status',{
        pf:$("#du_s_pf").val(),
        dt:$("#du_i_date").val()
    },function(du_data) { },'json');
    du_post.done(function(du_msg){
        if($("#du_f_val").val()!='' && du_msg.r_data['n_s']!='0' && du_msg.r_data['n_s']!=null )
            alert("Can't upload valuation, NAV is approved!'");
        //else if($("#du_f_fi_trx").val()!='' && du_msg.r_data['n_s']!='0')
        //alert("Can't upload FI transaction, NAV is approved!'");
        else if($("#du_f_journal").val()!='' && du_msg.r_data['c_n']!='A' && du_msg.r_data['c_n']!=null)
            alert("Can't upload Journal, NAV is not approved!'");
        else if($("#du_f_journal").val()!='' && du_msg.r_data['c_n']=='A' && du_msg.r_data['g_s']!='0')
            alert("Can't upload Journal, GL Done!'");
        //else if($("#du_f_val").val()=='' && $("#du_f_fi_trx").val()=='' && $("#du_f_journal").val()=='')
        else if($("#du_f_val").val()==''  && $("#du_f_journal").val()=='')
            alert('Please choose the files!');
        else
            if(confirm('Upload Data?')) $('#frm_du').submit();
    });
    du_post.fail(function(jqXHR, textStatus) {
        alert('error checking nav status!');
    });
}
function du_initiate_upload()
{
    $('#frm_du').submit(function(){
        var response;
        c_status('du',1);
        var frame_du=$("#iframe_du").load(function(){
            response=frame_du.contents().find('body');     
            if(isJSON(response.html()))
            { 
                rdata=$.parseJSON(response.html());
                var str_alert='Upload result:';
                
                if(rdata.u_val==1)
                {
                    str_alert+= "\nValuation data: " + rdata.u_valrows.count + ' rows';
                    str_alert+='\n    Valuation.........................'+rdata.u_valrows.val+' inserted';
                    str_alert+='\n    Bank Account Statement............'+rdata.u_valrows.bas+' inserted';
                    str_alert+='\n    Account Balance...................'+rdata.u_valrows.bal+' inserted';
                    str_alert+='\n    Transaction Listing...............'+rdata.u_valrows.trx+' inserted';
                    str_alert+='\n    Outstanding.......................'+rdata.u_valrows.ost+' inserted';
                }
                if(rdata.u_jur==1)
                    str_alert+= "\nJournal Data data: " + rdata.u_jurrows.count + ' rows..............'+rdata.u_jurrows.inserted+' inserted';
                alert(str_alert);
            }
            else
                alert('Something error, please re upload!');
            frame_du.unbind("load");
            setTimeout(function(){ response.html(''); },1);            
            c_status('du',0);
        });
    });
}
