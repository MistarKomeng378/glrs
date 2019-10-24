function ibpar_initiate()
{
    $("#ibpar_i_date").datepicker();$("#ibpar_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    /*$("#ibpar_b_reload").click(function(){
        ibpar_list($("#ibpar_i_date").val());
    });
    ibpar_initiate_upload();
    $("#ibpar_b_upload").click(function(){
        ibpar_upload();
    });
    $("#ibpar_i_date").change(function(){
        ibpar_list(this.value);
    });*/
}
function ibpar_show()
{
    $("#ibpar_i_date").val(open_svr_dt);
    /*$("#ibpar_i_dt").html(open_svr_dt);
    ibpar_list(open_svr_dt);*/
}

function ibpar_upload()
{
    if($("#ibpar_f").val()=='' )
        alert('Choose the files!');
    else if(confirm('Extract IBPA Data on ' + $("#ibpar_i_date").val() +'?')) $('#frm_ibpa').submit();    
}
function ibpar_initiate_upload()
{
    $('#frm_ibpa').submit(function(){
        var response,rdata;
        c_status('ibpa',1);
        var frame_ibpa=$("#iframe_ibpa").load(function(){c_status('ibpa',0);
            response=frame_ibpa.contents().find('body');
            if(response.html()!='')
                alert(response.html());
            else
                ibpar_list($("#ibpar_i_date").val());
            frame_ibpa.unbind("load");
            setTimeout(function(){ response.html(''); },1);            
        });
    });
}
function ibpar_list(p_dt)
{
    c_status('ibpa',1);
    $("#ibpar_d_view").html('');
    var ibpar_post = $.post(uri+'/index.php/cibpa/list_file',{dt:p_dt},function(ibpar_data) { });
    ibpar_post.done(function(ibpar_msg){ 
        if(ibpar_msg=='0')
        {
            c_nosession();
            return 0;
        }
        $("#ibpar_d_view").html(ibpar_msg);
        c_status('ibpa',0);
    });
    ibpar_post.fail(function(jqXHR, textStatus) {c_status('ibpa',0);});
}