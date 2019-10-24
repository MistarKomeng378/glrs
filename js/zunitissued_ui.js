function ui_initiate()
{
    $("#ui_i_date").datepicker();$("#ui_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#ui_s_fm").change(function(){
        ipt_pf_load_select($("#ui_s_pf"),2,this.value);
        ipt_fm_set_default(this.value);
        ipt_pf_set_default('');
        ui_reset('',$("#ui_i_date").val());        
    });
    $("#ui_s_pf").change(function(){
        ipt_pf_set_default(this.value);
        ui_reset(this.value,$("#ui_i_date").val());        
    });
    $("#ui_i_date").change(function(){        
        ui_get_data($("#ui_s_pf").val(),this.value);        
    });
    $("#ui_b_update").click(function(){
        if ($("#ui_s_pf").val()=='')
            alert('Choose the fund!');
        else
        {
            ui_update();
        }
    });
}
function ui_show()
{
    ui_view_progress=0;
    $("#ui_i_date").val(open_svr_dt);
    ipt_fm_load($("#ui_s_fm"),2);
    var  ia_fm ='_*_M';
    if (ipt_check_fm()!='_*_M')
        ia_fm=  ipt_check_fm(); 
    ipt_pf_load(ia_fm,$("#ui_s_pf"),2);
    
    ui_reset(ipt_check_pf(),open_svr_dt);
}

function ui_reset(p_pf,p_dt)
{
    ui_get_last_date(p_pf);
    ui_get_data(p_pf,p_dt);
}
function ui_get_last_date(p_pf)
{   
    var lui_post = $.post(uri+'/index.php/cui/get_last_date',{
        pf:$("#ui_s_pf").val()
    },function(lui_data) { 
        if(lui_data.r_rows>0)
        {
            $("#ui_s_dt").html(lui_data.r_data[0].dt);
            $("#ui_s_amount").html(lui_data.r_data[0].amount);
        }
        else
        {
            $("#ui_s_dt").html("");
            $("#ui_s_amount").html("");
        }
    },'json');
}
function ui_get_data(p_pf,p_dt)
{
    var lui1_post = $.post(uri+'/index.php/cui/get_data',{
        pf:$("#ui_s_pf").val(),
        dt:$("#ui_i_date").val()
    },function(lui1_data) { 
        if(lui1_data.r_rows>0)
        {
            $("#ui_i_amount").val(lui1_data.r_data[0].TotalUnitIssued);
        }
        else
        {
            $("#ui_i_amount").val("");
        }
    },'json');
}
function ui_update()
{
    c_status('ui',1);
    ipt_enable($("#ui_b_update"),false);
     var lui2_post = $.post(uri+'/index.php/cui/upd_data',{
        pf:$("#ui_s_pf").val(),
        dt:$("#ui_i_date").val(),
        nml:$("#ui_i_amount").val()
    },function(lui2_data) { },'json');
    lui2_post.done(function(lui2_msg){
        if(lui2_msg.r_data[0].err==1)
            alert('last nav approved is lest than the date!');
        else if(lui2_msg.r_data[0].err==0)
            alert('success!');
        ipt_enable($("#ui_b_update"),true);
        c_status('ui',0);
        ui_reset($("#ui_s_pf").val(),$("#ui_i_date").val());
    },'json');
    lui2_post.fail(function(jqXHR, textStatus) {ipt_enable($("#ui_b_update"),true);c_status('na',0);ui_reset($("#ui_s_pf").val(),$("#ui_i_date").val());});
    
}