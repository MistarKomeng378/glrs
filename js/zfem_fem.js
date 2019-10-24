var grid_fem;
var data_fem = []; 
var select_mode_fem = 0;
var selected_code_fem = '';
var selected_pf_fem='';
var selected_tier_fem='F';
var row_fem = -1;

function fem_initiate()
{
    $("#fem_i_from_dlg").datepicker();$("#fem_i_from_dlg").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#fem_i_to_dlg").datepicker();$("#fem_i_to_dlg").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    fem_initiate_grid();
    fem_initiate_grid_t();
    fem_initiate_dlg();
    fem_initiate_dlg1();
    $("#fem_b_edit").click(function(){
        fem_reset_dlg();
        selected_code_fem='';
        selected_pf_fem=$("#fem_s_pf").val();
        var fem_selected_row  = grid_fem.getActiveCell();
        if(fem_selected_row)
        {
            row_fem=fem_selected_row.row;
            if(fem_selected_row.row<data_fem.length)
            {
                selected_code_fem=data_fem[fem_selected_row.row].feecode;
                selected_pf_fem=data_fem[fem_selected_row.row].pfcode;
                selected_tier_fem=data_fem[fem_selected_row.row].feeflattier;    
                $("#fem_s_pct_dlg").val(data_fem[fem_selected_row.row].feetype);
                $("#fem_i_val_dlg").val(data_fem[fem_selected_row.row].feeval);
                $("#fem_s_year_dlg").val(data_fem[fem_selected_row.row].feeyear);
                $("#fem_s_flat_dlg").val(data_fem[fem_selected_row.row].feeflattier);
                $("#fem_s_enable_dlg").val(data_fem[fem_selected_row.row].feeenable);
                $("#fem_s_inctax_dlg").val(data_fem[fem_selected_row.row].feeincs);
                $("#fem_i_tax_dlg").val(data_fem[fem_selected_row.row].feetax);
                $("#fem_s_baseon_dlg").val(data_fem[fem_selected_row.row].feebase);
                $("#fem_i_fnav_dlg").val(data_fem[fem_selected_row.row].feefnav);
            }
        }
        
        $("#fem_h_pf_dlg").val(selected_pf_fem);
        $("#fem_s_code_dlg").val(selected_code_fem==''?'CUST':selected_code_fem);
        if(selected_code_fem=='' && selected_pf_fem=='') alert('Please choose the Portfolio first!');
        else
        {             
            $("#fem_sp_pf").html(selected_pf_fem);
            $("#fem_dlg").dialog('open');
        }
    });
    $("#fem_b_add_tier").click(function(){
        $("#fem_h_pf_dlg2").val(selected_pf_fem);
        $("#fem_h_code_dlg2").val(selected_code_fem);
        $("#fem_sp_pf2").html(selected_pf_fem);
        $("#fem_sp_code2").html(selected_code_fem);
        $("#fem_dlg1").dialog('open');
        fem_reset_dlg_t();
    });
    $("#fem_s_pf").change(function(){
        fem_load_data($("#fem_s_fm").val(),this.value);
        ipt_pf_set_default(this.value); 
        fem_enable_tier_button(false,false,false);
    });
    $("#fem_s_fm").change(function(){
        ipt_fm_set_default(this.value);
        ipt_pf_load(this.value,$("#fem_s_pf"),2);      
        fem_load_data(this.value,'');
        fem_enable_tier_button(false,false,false);        
    });
    grid_fem.onDblClick.subscribe(function(e) {
        var fem_selected_row = grid_fem.getCellFromEvent(e);
        selected_code_fem=data_fem[fem_selected_row.row].feecode;
        selected_pf_fem=data_fem[fem_selected_row.row].pfcode;
         $("#fem_s_pct_dlg").val(data_fem[fem_selected_row.row].feetype);
        $("#fem_i_val_dlg").val(data_fem[fem_selected_row.row].feeval);
        $("#fem_s_year_dlg").val(data_fem[fem_selected_row.row].feeyear);
        $("#fem_s_flat_dlg").val(data_fem[fem_selected_row.row].feeflattier);
        $("#fem_s_enable_dlg").val(data_fem[fem_selected_row.row].feeenable);
        $("#fem_s_inctax_dlg").val(data_fem[fem_selected_row.row].feeincs);
        $("#fem_i_tax_dlg").val(data_fem[fem_selected_row.row].feetax);
        $("#fem_s_code_dlg").val(selected_code_fem==''?'CUST':selected_code_fem);
        $("#fem_s_baseon_dlg").val(data_fem[fem_selected_row.row].feebase);
        $("#fem_i_fnav_dlg").val(data_fem[fem_selected_row.row].feefnav);
        $("#fem_h_pf_dlg").val(selected_pf_fem);
        $("#fem_sp_pf").html(selected_pf_fem);
        $("#fem_dlg").dialog('open');
    });
    grid_fem.onClick.subscribe(function(e) { 
        var fem_selected_cell = grid_fem.getCellFromEvent(e);
        selected_tier_fem=data_fem[fem_selected_cell.row].feeflattier;  
        selected_code_fem=data_fem[fem_selected_cell.row].feecode;
        selected_pf_fem=data_fem[fem_selected_cell.row].pfcode;
        row_fem=fem_selected_cell.row;    
        if(data_fem[fem_selected_cell.row].feeflattier=='T')
        {
            fem_enable_tier_button(true,false,false);
            fem_load_data_t(selected_pf_fem,selected_code_fem);
        }else
        {
            fem_enable_tier_button(false,false,false);
            fem_grid_clear_t();
        }
        
        
    });
    
    grid_fem_t.onClick.subscribe(function(e) { 
        fem_enable_tier_button(true,true,true);
    });
    $("#fem_b_edit_tier").click(function(){
        var fem_row_t  = grid_fem_t.getActiveCell();
        if(fem_row_t)
        {
            if(fem_row_t.row<data_fem_t.length)
            {
                $("#fem_h_pf_dlg2").val(selected_pf_fem);
                $("#fem_h_code_dlg2").val(selected_code_fem);
                $("#fem_sp_pf2").html(selected_pf_fem);
                $("#fem_sp_code2").html(selected_code_fem);
                $("#fem_s_seq_dlg2").val(data_fem_t[fem_row_t.row].feedno);
                $("#fem_i_pct_dlg2").val(data_fem_t[fem_row_t.row].feedpct);
                $("#fem_i_range_dlg2").val(data_fem_t[fem_row_t.row].feedend);
                $("#fem_dlg1").dialog('open');
            }
        }
    });
     grid_fem_t.onDblClick.subscribe(function(e) {
        var fem_row_t = grid_fem_t.getCellFromEvent(e);
        $("#fem_h_pf_dlg2").val(selected_pf_fem);
        $("#fem_h_code_dlg2").val(selected_code_fem);
        $("#fem_sp_pf2").html(selected_pf_fem);
        $("#fem_sp_code2").html(selected_code_fem);
        $("#fem_s_seq_dlg2").val(data_fem_t[fem_row_t.row].feedno);
        $("#fem_i_pct_dlg2").val(data_fem_t[fem_row_t.row].feedpct);
        $("#fem_i_range_dlg2").val(data_fem_t[fem_row_t.row].feedend);
        $("#fem_dlg1").dialog('open');        
     });
     $("#fem_b_del_tier").click(function(){
        var fem_row_t  = grid_fem_t.getActiveCell();
        if(fem_row_t)
        {
            if(fem_row_t.row<data_fem_t.length)
            {
                fem_delete_data_t(selected_pf_fem,selected_code_fem,data_fem_t[fem_row_t.row].feedno);
            }
        }
     });
     $("#fem_b_get").click(function(){
        window.open(uri+'/index.php/cfee/udata','feeget');
     });
}
function fem_show()
{
    var  ia_fm =''
    if (ipt_check_fm()!='_*_M')
        ia_fm=  ipt_check_fm();    
    ipt_fm_load($("#fem_s_fm"),2);       
    ipt_pf_load(ia_fm,$("#fem_s_pf"),2);      
    if(ia_fm=='') ia_fm='';
    var ia_pf='';
    if(ipt_check_pf()!='' && ipt_check_pf()!='ALL')
        ia_pf=ipt_check_pf();
    fem_load_code();
    $("#fem_i_from_dlg").val(open_svr_dt);
    $("#fem_i_to_dlg").val('31-12-2099');
    fem_load_data(ia_fm,ia_pf);
    fem_enable_tier_button(false,false,false);
    fem_grid_clear_t();
}

function fem_initiate_grid()
{
    var columns_fem = [];
    var options_fem = [];
    columns_fem = [
        {id:"pfcode", name:"FUND", field:"pfcode",width:50}
        ,{id:"feeenable", name:"ENABLE", field:"feeenable",width:50}
        ,{id:"feecode", name:"CODE", field:"feecode",width:50}
        ,{id:"feedesc", name:"DESCRIPTION", field:"feedesc",width:180}
        ,{id:"feetype", name:"TYPE", field:"feetype",width:50}
        ,{id:"feeval", name:"VALUE", field:"feeval",width:120, cssClass:"cell_right"}          
        ,{id:"feebase", name:"BASEON", field:"feebase",width:80}
        ,{id:"feefnav", name:"FIRSTNAV", field:"feefnav",width:120, cssClass:"cell_right"}          
        ,{id:"feeyear", name:"YEAR", field:"feeyear",width:60}
        ,{id:"feeflattier", name:"FLAT/TIER", field:"feeflattier",width:100}
        ,{id:"feetax", name:"Tax", field:"feetax",width:40}
        ,{id:"feeinc", name:"Include Tax", field:"feeinc",width:80}        
    ];
    options_fem = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_fem = new Slick.Grid("#fem_slick", data_fem, columns_fem, options_fem);
    grid_fem.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
}
function fem_initiate_dlg()
{
    $("#fem_dlg").dialog({ 
            title:        'Fee Maintenance'
        ,    width:        830
        ,    height:        160
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){fem_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function fem_initiate_dlg1()
{
    $("#fem_dlg1").dialog({ 
            title:        'Fee Tiering Maintenance '
        ,    width:        320
        ,    height:        160
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){fem_save_data_t();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function fem_load_code()
{
    var fem_post_code = $.post(uri+'/index.php/cfee/list_code',{},function(fem_data) { });
    fem_post_code.done(function(fem_msg_code){ 
        $("#fem_s_code_dlg").html(fem_msg_code)
    });
}
function fem_load_data(p_fm,p_pf)
{
    c_status('fem',1);
    var fem_post = $.post(uri+'/index.php/cfee/list_master',{fm:p_fm,pf:p_pf},function(fem_data) { },'json');
    fem_post.done(function(fem_msg){
        if(fem_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_fem.length=0;
        for (var i=0; i<fem_msg.r_rows; i++) {
           var d = (data_fem[i] = {});     
           d["pfcode"] = fem_msg.r_data[i].PORTFOLIOCODE;
           d["feedesc"] = fem_msg.r_data[i].FEEDESCRIPTION;
           d["feeenable"] = fem_msg.r_data[i].FEESTATUS;          
           d["feecode"] = fem_msg.r_data[i].FEECODE;
           d["feetype"] = fem_msg.r_data[i].PCTAMTFLAG;
           d["feeval"] = fem_msg.r_data[i].PCTVALUE; 
           d["feeyear"] = fem_msg.r_data[i].YEARBASE; 
           d["feebase"] = fem_msg.r_data[i].NAVBASEDON; 
           d["feefnav"] = fem_msg.r_data[i].FIRSTNAVU; 
           d["feeflattier"] = fem_msg.r_data[i].RATETYPE; 
           d["feeinc"] = fem_msg.r_data[i].INCLUDETAX==0?'No':'Yes'; 
           d["feeincs"] = fem_msg.r_data[i].INCLUDETAX; 
           d["feetax"] = fem_msg.r_data[i].TAXRATE; 
        }       
        row_fem=-1;
        fem_enable_tier_button(false,false,false);
        
        fem_grid_clear_t();
        grid_fem.invalidateAllRows();
        grid_fem.updateRowCount();
        grid_fem.render();
        c_status('fem',0);
    });
    fem_post.fail(function(jqXHR, textStatus) {c_status('fem',0);});
}
function fem_save_data()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('fem',1);
    var pfsave_post = $.post(uri+'/index.php/cfee/save_data',{
        pf_code:$("#fem_h_pf_dlg").val(),
        fem_code:$("#fem_s_code_dlg").val(),
        fem_pct:$("#fem_s_pct_dlg").val(),
        fem_val:$("#fem_i_val_dlg").val(),
        fem_year:$("#fem_s_year_dlg").val(),
        fem_flat:$("#fem_s_flat_dlg").val(),
        fem_daily:'N',
        fem_inc:$("#fem_s_inctax_dlg").val(),
        fem_tax:$("#fem_i_tax_dlg").val(),
        fem_enable:$("#fem_s_enable_dlg").val(),
        fem_base:$("#fem_s_baseon_dlg").val(),
        fem_fnav:$("#fem_i_fnav_dlg").val()
    },function(pfsave_data) { });
    pfsave_post.done(function(pfsave_msg){
        
        //fem_load_data($("#fem_s_fm").val(),$("#fem_s_pf").val())
        if(pfsave_msg=='0')
            c_nosession();
        else if(pfsave_msg=='1')
        {
            alert('Success saving data!');
            $("#fem_dlg").dialog('close');
            fem_load_data($("#fem_s_fm").val(),$("#fem_s_pf").val())
        }
        else
            alert('error saving data!');
        c_status('fem',0);
        
    });
    pfsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('fem',0);});
}

function fem_reset_dlg()
{    
    $("#fem_h_pf_dlg").val('');
    $("#fem_s_code_dlg").val('');
    $("#fem_sp_pf").html('');
    $("#fem_s_pct_dlg").val('');
    $("#fem_i_val_dlg").val('');
    $("#fem_s_year_dlg").val('');
    $("#fem_i_from_dlg").val('');
    $("#fem_i_to_dlg").val('');
    $("#fem_s_flat_dlg").val('');
    $("#fem_s_daily_dlg").val('');
    $("#fem_s_enable_dlg").val('');
    $("#fem_s_baseon_dlg").val('PREVNAV');
    $("#fem_i_fnav_dlg").val('1000');
}
function fem_enable_tier_button(p_1,p_2,p_3)
{
    if(p_1)
        $("#fem_b_add_tier").removeAttr('disabled');
    else
        $("#fem_b_add_tier").attr('disabled','disabled'); 
    if(p_2)
        $("#fem_b_edit_tier").removeAttr('disabled');
    else
        $("#fem_b_edit_tier").attr('disabled','disabled'); 
    if(p_3)
        $("#fem_b_del_tier").removeAttr('disabled');
    else
        $("#fem_b_del_tier").attr('disabled','disabled'); 
}

var grid_fem_t;
var data_fem_t = []; 

function fem_initiate_grid_t()
{
    var columns_fem_t = [];
    var options_fem_t = [];
    columns_fem_t = [
        {id:"feedno", name:"SEQNO", field:"feedno",width:50}
        ,{id:"feedpct", name:"PCT", field:"feedpct",width:90,cssClass:"cell_right"}
        ,{id:"feedend", name:"ENDRANGE", field:"feedend",width:150,cssClass:"cell_right"}
    ];
    options_fem_t = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_fem_t = new Slick.Grid("#fem_slick_tier", data_fem_t, columns_fem_t, options_fem_t);
    grid_fem_t.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
}
function fem_load_data_t(p_pf,p_code)
{
    c_status('fem',1);
    var fem_post_t1 = $.post(uri+'/index.php/cfee/list_master_detail',{pf:p_pf,code:p_code},function(fem_data_t1) { },'json');
    fem_post_t1.done(function(fem_msg_t1){   
        if(fem_msg_t1.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_fem_t.length=0;
        for (var i=0; i<fem_msg_t1.r_rows; i++) {
           var d = (data_fem_t[i] = {});     
           d["feedpct"] = fem_msg_t1.r_data[i].PROGPCT;
           d["feedend"] = fem_msg_t1.r_data[i].ENDRANGE;
           d["feedno"] = fem_msg_t1.r_data[i].PROGSEQNO;          
        }       
        grid_fem_t.invalidateAllRows();
        grid_fem_t.updateRowCount();
        grid_fem_t.render();
        c_status('fem',0);
    });
    fem_post_t1.fail(function(jqXHR, textStatus) {c_status('fem',0);});
}
function fem_grid_clear_t()
{
    data_fem_t.length=0;
    grid_fem_t.invalidateAllRows();
    grid_fem_t.updateRowCount();
    grid_fem_t.render();
}
function fem_save_data_t()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('fem',1);
    var pfsave_post_t = $.post(uri+'/index.php/cfee/save_data_detail',{
        pf_code:$("#fem_h_pf_dlg2").val(),
        fem_code:$("#fem_h_code_dlg2").val(),
        fem_pct:$("#fem_i_pct_dlg2").val(),
        fem_end:$("#fem_i_range_dlg2").val(),
        fem_no:$("#fem_s_seq_dlg2").val()
    },function(pfsave_data_t) { });
    pfsave_post_t.done(function(pfsave_msg_t){
        
        //fem_load_data($("#fem_s_fm").val(),$("#fem_s_pf").val())
        if(pfsave_msg_t=='0')
            c_nosession();
        else if(pfsave_msg_t=='1')
        {
            fem_load_data_t($("#fem_h_pf_dlg2").val(),$("#fem_h_code_dlg2").val());
            alert('Success saving data!');
            $("#fem_dlg1").dialog('close');            
        }
        else
            alert('error saving data!');
        c_status('fem',0);
        
    });
    pfsave_post_t.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('fem',0);});
}
function fem_reset_dlg_t()
{
    $("#fem_s_seq_dlg2").val('1');
    $("#fem_i_pct_dlg2").val('0');
    $("#fem_i_range_dlg2").val('0');
}

function fem_delete_data_t(p_pf,p_code,p_no)
{
    if(!confirm('Delete data?'))
        return 0;
    c_status('fem',1);
    var pfdel_post_t = $.post(uri+'/index.php/cfee/delete_data_detail',{
        pf_code:p_pf,
        fem_code:p_code,
        fem_no:p_no
    },function(pfsave_data_t) { });
    pfdel_post_t.done(function(pfsave_msg_t){
        
        //fem_load_data($("#fem_s_fm").val(),$("#fem_s_pf").val())
        if(pfsave_msg_t=='0')
            c_nosession();
        else if(pfsave_msg_t=='1')
        {
            fem_load_data_t(p_pf,p_code);
            alert('Success delete data!');
        }
        else
            alert('error saving data!');
        c_status('fem',0);
        
    });
    pfdel_post_t.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('fem',0);});
}