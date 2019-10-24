function fu_initiate()
{
    $("#fu_i_date").datepicker();$("#fu_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#fu_b_refresh").click(function(){
        fu_clear_files();
    });
    fu_initiate_upload();
    $("#fu_b_upload").click(function(){
        fu_upload();
    });
    $("#fu_b_upload_proc").click(function(){
        fu_upload_proc();
    });
    $("#fu_i_date").change(function(){
        $("#fu_s_ondt").html(this.value);
        fu_nav_list(this.value);
    });
    $("#fu_s_fm").change(function(){
        ipt_pf_load_select($("#fu_s_pf"),1,this.value);
        fu_reset();
    });
    $("#fu_s_pf").change(function(){
        ipt_check_nav_status(this.value, $("#fu_i_date").val(),$("#fu_s_last_dt"),$("#fu_s_nav_status"),$("#fu_s_last_gl_dt"),$("#fu_s_gl_status"),false,false,'du');
    });
    $("#fu_i_date").change(function(){
        ipt_check_nav_status( $("#fu_s_pf").val(),this.value,$("#fu_s_last_dt"),$("#fu_s_nav_status"),$("#fu_s_last_gl_dt"),$("#fu_s_gl_status"),false,false,'du');
    });
}
function fu_show()
{
    $("#fu_i_date").val(open_svr_dt);
    $("#fu_s_ondt").html(open_svr_dt);
    fu_clear_files();
    fu_nav_list(open_svr_dt);
    ipt_fm_load($("#fu_s_fm"),1);
    ipt_pf_load('_*_M',$("#fu_s_pf"),1);
    fu_reset();
}

function fu_clear_files()
{
    $("#fu_f_fi_sec").val('');
    $("#fu_f_fi_trx").val('');
}
function fu_reset()
{
    $("#fu_s_last_dt").html('');
    $("#fu_s_last_gl_dt").html('');
    $("#fu_s_nav_status").html('');
    $("#fu_s_gl_status").html('');
}
function fu_upload()
{
    $("#fu_i_a").val('0');
    if($("#fu_f_fi_sec").val()=='' && $("#fu_f_fi_trx").val()=='')
        alert('Choose the files!');
    else if(confirm('Upload Data FI on ' + $("#fu_i_date").val() +'?')) $('#frm_fu').submit();    
}
function fu_upload_proc()
{
    $("#fu_i_a").val('1');
    if($("#fu_f_fi_sec").val()=='' && $("#fu_f_fi_trx").val()=='')
    {
        if(confirm('Process Tax on ' + $("#fu_i_date").val() +'?')) $('#frm_fu').submit();    
    }
    else
    {
        if(confirm('Upload Data FI And Process Tax on ' + $("#fu_i_date").val() +'?')) $('#frm_fu').submit();    
    }
}

function fu_initiate_upload()
{
    $('#frm_fu').submit(function(){
        var response,rdata;
        c_status('fu',1);
        var frame_fu=$("#iframe_fu").load(function(){c_status('fu',0);
            response=frame_fu.contents().find('body');
            if(isJSON(response.html()))
            {
                rdata=$.parseJSON(response.html());
                var str_alert=''
                str_alert+='Upload result:';
                if(rdata.u_fisec==1)
                    str_alert+= "\nFI Security data: " + rdata.u_fisecrows.count + ' rows..............'+rdata.u_fisecrows.inserted+' inserted';
                if(rdata.u_fitrx==1)
                    str_alert+= "\nFI Transaction data: " + rdata.u_fitrxrows.count + ' rows..............'+rdata.u_fitrxrows.inserted+' inserted';
                if( (rdata.u_fisec==0 && rdata.u_fitrx==0) && $("#fu_i_a").val()==1)
                    str_alert='Process Tax Done!';
                alert(str_alert);
            }
            else
                alert('Something error, please re upload!');
            frame_fu.unbind("load");
            setTimeout(function(){ response.html(''); },1);            
            
        });
    });
}
function fu_nav_list(p_dt)
{
    c_status('fu',1);
    $("#fu_tbody").html('');
    var fu_post = $.post(uri+'/index.php/cnav/approved_list',{dt:p_dt},function(fu_data) { });
    fu_post.done(function(fu_msg){ 
        if(fu_msg=='0')
        {
            c_nosession();
            return 0;
        }
        $("#fu_tbody").html(fu_msg);
        c_status('fu',0);
    });
    fu_post.fail(function(jqXHR, textStatus) {c_status('fu',0);});
}