function subred_initiate()
{
    $("#subred_i_date").datepicker();$("#subred_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#subred_b_reload").click(function(){
        subred_list($("#subred_i_date").val());
    });
    subred_initiate_upload();
    $("#subred_b_upload").click(function(){
        subred_upload();
    });
    $("#subred_i_date").change(function(){
        subred_rekon(this.value);
        $("#subred_h_date").val(this.value);
    });
    $("#subred_b_view").click(function(){
        subred_preview();
    });
}
function subred_show()
{
    $("#subred_i_date").val(open_svr_dt);
    $("#subred_h_date").val(open_svr_dt);
    subred_rekon(open_svr_dt);
}

function subred_upload()
{
    if($("#subred_f").val()=='' )
        alert('Choose the files!');
    else if(confirm('Do subscription & redemption reconciliation on ' + $("#subred_i_date").val() +'?')) $('#frm_subred').submit();    
}
function subred_initiate_upload()
{
    $('#frm_subred').submit(function(){
        var response,rdata;
        c_status('subred',1);
        var frame_subred=$("#iframe_subred").load(function(){
            c_status('subred',0);
            response=frame_subred.contents().find('body');
            if(response.html()!='')
                alert(response.html());
            else
                subred_rekon(p_dt);
            frame_subred.unbind("load");
            setTimeout(function(){ response.html(''); },1);            
        });
    });
}
function subred_rekon(p_dt)
{
    c_status('subred',1);
    $("#subred_d_view").html('');
    var subred_post = $.post(uri+'/index.php/csubred/get_rekon',{dt:p_dt,a:1},function(subred_data) { });
    subred_post.done(function(subred_msg){ 
        if(subred_msg=='0')
        {
            c_nosession();
            return 0;
        }
        $("#subred_d_view").html(subred_msg);
        c_status('subred',0);
        
    });
    subred_post.fail(function(jqXHR, textStatus) {c_status('subred',0);});
}

function subred_preview()
{
    $('#frm_subred_v').submit();
}