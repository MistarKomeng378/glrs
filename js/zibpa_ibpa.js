function ibpa_initiate()
{
    $("#ibpa_i_date").datepicker();$("#ibpa_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#ibpa_b_reload").click(function(){
        ibpa_list($("#ibpa_i_date").val());
    });
    ibpa_initiate_upload();
    $("#ibpa_b_upload").click(function(){
        ibpa_upload();
    });
    $("#ibpa_i_date").change(function(){
        ibpa_list(this.value);
    });
}
function ibpa_show()
{
    $("#ibpa_i_date").val(open_svr_dt);
    $("#ibpa_i_dt").html(open_svr_dt);
    ibpa_list(open_svr_dt);
}

function ibpa_upload()
{
    if($("#ibpa_f").val()=='' )
        alert('Choose the files!');
    else if(confirm('Extract IBPA Data on ' + $("#ibpa_i_date").val() +'?')) $('#frm_ibpa').submit();    
}
function ibpa_initiate_upload()
{
    $('#frm_ibpa').submit(function(){
        var response,rdata;
        c_status('ibpa',1);
        var frame_ibpa=$("#iframe_ibpa").load(function(){c_status('ibpa',0);
            response=frame_ibpa.contents().find('body');
            if(response.html()!='')
                alert(response.html());
            else
                ibpa_list($("#ibpa_i_date").val());
            frame_ibpa.unbind("load");
            setTimeout(function(){ response.html(''); },1);            
        });
    });
}
function ibpa_list(p_dt)
{
    c_status('ibpa',1);
    $("#ibpa_d_view").html('');
    var ibpa_post = $.post(uri+'/index.php/cibpa/list_file',{dt:p_dt},function(ibpa_data) { });
    ibpa_post.done(function(ibpa_msg){ 
        if(ibpa_msg=='0')
        {
            c_nosession();
            return 0;
        }
        $("#ibpa_d_view").html(ibpa_msg);
        c_status('ibpa',0);
    });
    ibpa_post.fail(function(jqXHR, textStatus) {c_status('ibpa',0);});
}