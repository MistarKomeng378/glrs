var grid_fed;
var data_fed = []; 
var select_mode_fed = 0;
var selected_code_fed = '';
var selected_pf_fed='';
var selected_tier_fed='F';
var row_fed = -1;

function fed_initiate()
{
    $("#fed_i_date").datepicker();$("#fed_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#fed_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#fed_i_date").val(),$("#fed_s_nav"),false,false,false,false,false,'fed',false);
        ipt_pf_set_default(this.value); 
    });
    $("#fed_s_fm").change(function(){
        ipt_pf_load(this.value,$("#fed_s_pf"),2);
        ipt_fm_set_default(this.value);
    });
    $("#fed_b_calc").click(function(){
        
    });
}
function fed_show()
{
    var  ia_fm =''
    if (ipt_check_fm()!='_*_M')
        ia_fm=  ipt_check_fm();    
    ipt_fm_load($("#fed_s_fm"),2);       
    ipt_pf_load(ia_fm,$("#fed_s_pf"),2);      
    if(ia_fm=='') ia_fm='';
    var ia_pf='';
    if(ipt_check_pf()!='' && ipt_check_pf()!='')
        ia_pf=ipt_check_pf();
    $("#fed_i_date").val(open_svr_dt);
    ipt_check_nav_status(ia_pf,open_svr_dt,$("#fed_s_nav"),false,false,false,false,false,'fed',false);
}
  
function fed_load_data(p_pf,p_dt)
{
    var fed_post_code = $.post(uri+'/index.php/cfee/list_code',{},function(fed_data) { });
    fed_post_code.done(function(fed_msg_code){ 
        $("#fed_s_code_dlg").html(fed_msg_code)
    });
}
function fed_load_data(p_pf,p_dt)
{
    if(!confirm('Calc Daily Fee?'))
        return 0;
    c_status('fed',1);
    var fed_post = $.post(uri+'/index.php/cfee/calc',{pf:p_pf,dt:p_dt},function(fed_data) { },'json');
    fed_post.done(function(fed_msg){   
        if(fed_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_fed.length=0;
        for (var i=0; i<fed_msg.r_rows; i++) {
           var d = (data_fed[i] = {});     
           d["pfcode"] = fed_msg.r_data[i].PORTFOLIOCODE;
           d["feedesc"] = fed_msg.r_data[i].FEEDESCRIPTION;
           d["feeenable"] = fed_msg.r_data[i].FEESTATUS;          
           d["feecode"] = fed_msg.r_data[i].FEECODE;
           d["feetype"] = fed_msg.r_data[i].PCTAMTFLAG;
           d["feeval"] = fed_msg.r_data[i].PCTVALUE; 
           d["feeyear"] = fed_msg.r_data[i].YEARBASE; 
           d["feefrom"] = fed_msg.r_data[i].from_s;
           d["feeto"] = fed_msg.r_data[i].to_s; 
           d["feeflattier"] = fed_msg.r_data[i].RATETYPE; 
           d["feedaily"] = fed_msg.r_data[i].SAVEACCRUAL; 
        }       
        row_fed=-1;
        fed_enable_tier_button(false,false,false);
        
        fed_grid_clear_t();
        grid_fed.invalidateAllRows();
        grid_fed.updateRowCount();
        grid_fed.render();
        c_status('fed',0);
    });
    fed_post.fail(function(jqXHR, textStatus) {c_status('fed',0);});
}
function fed_save_data()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('fed',1);
    var pfsave_post = $.post(uri+'/index.php/cfee/save_data',{
        pf_code:$("#fed_h_pf_dlg").val(),
        fed_code:$("#fed_s_code_dlg").val(),
        fed_pct:$("#fed_s_pct_dlg").val(),
        fed_val:$("#fed_i_val_dlg").val(),
        fed_year:$("#fed_s_year_dlg").val(),
        fed_from:$("#fed_i_from_dlg").val(),
        fed_to:$("#fed_i_to_dlg").val(),
        fed_flat:$("#fed_s_flat_dlg").val(),
        fed_daily:$("#fed_s_daily_dlg").val(),
        fed_enable:$("#fed_s_enable_dlg").val()
    },function(pfsave_data) { });
    pfsave_post.done(function(pfsave_msg){
        
        //fed_load_data($("#fed_s_fm").val(),$("#fed_s_pf").val())
        if(pfsave_msg=='0')
            c_nosession();
        else if(pfsave_msg=='1')
        {
            alert('Success saving data!');
            $("#fed_dlg1").dialog('close');
            fed_load_data($("fed_s_fm").val(),$("fed_s_pf").val())
        }
        else
            alert('error saving data!');
        c_status('fed',0);
        
    });
    pfsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('fed',0);});
}
       