function dumi_initiate()
{ 
    $("#dumi_i_sdate").datepicker();$("#dumi_i_sdate").datepicker( "option", "dateFormat", 'dd-mm-yy' ); ; 
    $("#dumi_i_date").datepicker();$("#dumi_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); ; 
    //$("#dumi_s_fm").change(function(){
    //    dumi_list_last_approved_nav(this.value);
    //});
    $("#dumi_i_date").change(function(){
        
    });
    $("#dumi_b_upload").click(function(){
        dumi_upload();
    });
    $("#dumi_b_refresh").click(function(){
        dumi_clear_files();
    });
    dumi_initiate_upload();
}
function dumi_show()
{
    dumi_reset(ipt_curdt);
    ipt_fm_load($("#dumi_s_fm"),2);
    dumi_clear_files();  
}
function dumi_reset(p_dt)
{    
    $("#dumi_i_sdate").val(ipt_curdt);
    $("#dumi_i_date").val(ipt_curdt);
    $("#dumi_d_viewnav").html('');
    //dumi_list_last_approved_nav(ipt_check_fm());
    $("#dumi_d_view").html('');
   
}
function dumi_clear_files()
{    
    $("#dumi_f_val").val('');
    $("#dumi_f_journal1").val('');
    $("#dumi_f_journal2").val('');
    $("#dumi_f_journal3").val('');
    $("#dumi_f_journal4").val('');
    $("#dumi_f_journal5").val('');
    $("#dumi_f_journal6").val('');
    $("#dumi_f_journal7").val('');
    $("#dumi_f_journal8").val('');
    $("#dumi_f_journal9").val('');
    $("#dumi_f_journal10").val('');
    $("#dumi_f_journal11").val('');
}
function dumi_upload()
{
    if($("#dumi_s_fm").val()=='')
       alert('Please choose the Fund Manager!');
    else if(confirm('Upload Data?')) $('#frm_dumi').submit();
}
function dumi_initiate_upload()
{
    $('#frm_dumi').submit(function(){
        var response;
        $("#dumi_d_view").html('');
        c_status('dumi',1);
        var frame_du=$("#iframe_dumi").load(function(){
            response=frame_du.contents().find('body');
            $("#dumi_d_view").html(response.html());
            alert('done!')            ;
            frame_du.unbind("load");
            setTimeout(function(){ response.html(''); },1);            
            c_status('dumi',0);
        });
    });
}
function dumi_list_last_approved_nav(p_fm)
{
    var dumi_post = $.post(uri+'/index.php/cnav/list_la',{fm:p_fm},function(dumi_data) { });
    dumi_post.done(function(dumi_msg){
        $("#dumi_d_viewnav").html(dumi_msg);
    });
    dumi_post.fail(function(jqXHR, textStatus) {$("#dumi_d_viewnav").html('');});
}