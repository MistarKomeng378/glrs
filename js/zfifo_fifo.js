function fifo_initiate()
{
    
    $("#fifo_s_fm").change(function(){
        ipt_pf_load_select($("#fifo_s_pf"),2,this.value);
        $("#fifo_s_sec").html('');
        $("#fifo_d_view").html('');
    });
    $("#fifo_b_view").click(function(){
        if($("#fifo_s_pf").val()=='') alert('Choose the portfolio!');
        else
            fifo_view();      
    });
    $("#fifo_b_preview").click(function(){
        if($("#fifo_s_pf").val()=='') alert('Choose the portfolio!');
        else
           $("#fifo_frm").submit();
    });
    $("#fifo_s_pf").change(function(){
        ipt_sectrx_load_select($("#fifo_s_sec"),1,this.value);
        $("#fifo_d_view").html('');
    });
}

function fifo_show()
{
    fifo_reset();
    ipt_fm_load($("#fifo_s_fm"),0);
    ipt_pf_load('_*_M',$("#fifo_s_pf"),2);
    ipt_enable($("#fifo_b_view"),true);
    c_status('rf',0);
    ipt_sectrx_load_select($("#fifo_s_sec"),1,ipt_check_pf());
    
}
function fifo_reset()
{
    $("#fifo_s_sec").html('');
    $("#fifo_i_unit").val('0');
    $("#fifo_i_proc").val('0');
}
function fifo_view()
{
    c_status('fifo',1);
    ipt_enable($("#fifo_b_view"),false);
     var fifo_post = $.post(uri+'/index.php/cfifo/view',{
        pf:$("#fifo_s_pf").val(),
        sec:$("#fifo_s_sec").val(),
        u:$("#fifo_i_unit").val(),
        p:$("#fifo_i_proc").val()
    },function(fifo_data) { });
    fifo_post.done(function(fifo_msg){
        $("#fifo_d_view").html(fifo_msg);
        ipt_enable($("#fifo_b_view"),true);
        c_status('fifo',0);
    });
    fifo_post.fail(function(jqXHR, textStatus) {ipt_enable($("#fifo_b_view"),true);c_status('fifo',0);$("#fifo_d_view").html('');});
}