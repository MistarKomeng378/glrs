var grid_ia;
var data_ia = []; 
var select_mode_ia = 0;

function ia_initiate()
{
    ia_initiate_grid();
    ia_initiate_dlg();
     $("#ia_s_fm").change(function(){
        $("#ia_s_fm_dlg").val(this.value);
        ipt_pf_load_select($("#ia_s_pf"),1,this.value);
        ia_load_data(this.value,'ALL');
    });
    $("#ia_s_pf").change(function(){
        $("#ia_s_pf_dlg").val(this.value);
        ia_load_data($("#ia_s_fm").val(),this.value);
    });
    $("#ia_b_edit").click(function(){
        if($("#ia_s_pf").val()=='' || $("#ia_s_pf").val()=='ALL')
            alert('Please choose the portfolio!');
        else
        {
            ia_get_data_dlg($("#ia_s_pf").val());
            $("#ia_h_pf_dlg").val($("#ia_s_pf").val());
            $("#ia_s_pf_dlg").html($("#ia_s_pf  option:selected").html());
            $("#ia_dlg").dialog('open');
        }
    }); 
}
function ia_show()
{
    //ia_load_data('ALL','ALL'); 
    ipt_fm_load($("#ia_s_fm"),1,$("#ia_s_fm_dlg"),1);
        
    var  ia_fm ='ALL'
    if (ipt_check_fm()!='_*_M')
        ia_fm=  ipt_check_fm();
    ipt_pf_load(ia_fm,$("#ia_s_pf"),1,null,null);
    var ia_pf = 'ALL';
    if (ipt_check_pf()!='')
        ia_pf=  ipt_check_pf();
    ia_load_data(ia_fm,ia_pf);
}

function ia_initiate_grid()
{
    var columns_ia = [];
    var options_ia = [];
    columns_ia = [
        {id:"pfcode", name:"Fund Code", field:"pfcode",width:80,cssClass:"cell_center"}
        ,{id:"atype", name:"Asset Type", field:"atype",width:200}
        ,{id:"amin", name:"Minimum/ Val", field:"amin",width:100,cssClass:"cell_right"}
        ,{id:"amax", name:"Maximum", field:"amax",width:100,cssClass:"cell_right"}
    ];

    options_ia = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_ia = new Slick.Grid("#ia_slick", data_ia, columns_ia, options_ia);
    grid_ia.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function ia_initiate_dlg()
{
    $("#ia_dlg").dialog({ 
            title:        'Investment Allocation'
        ,    width:        470
        ,    height:        270
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){ia_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function ia_load_data(p_fm,p_pf)
{
    c_status('ia',1);
    var ia_post = $.post(uri+'/index.php/cia/list_data',{fm:p_fm,pf:p_pf},function(ia_data) { },'json');
    ia_post.done(function(ia_msg){
        if(ia_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_ia.length=0;
        for (var i=0; i<ia_msg.r_rows; i++) {
           var d = (data_ia[i] = {});
           d["pfcode"] = ia_msg.r_data[i].PORTFOLIOCODE;
           d["atype"] = ia_msg.r_data[i].ASSETTYPE;
           d["amin"] = ia_msg.r_data[i].MINIMUM; 
           d["amax"] = ia_msg.r_data[i].MAXIMUM; 
        }       
        grid_ia.invalidateAllRows();
        grid_ia.updateRowCount();
        grid_ia.render();
        c_status('ia',0);
    });
    ia_post.fail(function(jqXHR, textStatus) {c_status('ia',0);});
}
function ia_save_data()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('pf',1);
    var pfsave_post = $.post(uri+'/index.php/cia/save_data',{
        pf:$("#ia_s_pf_dlg").val(),
        a_min:$("#ia_i_eq_min_dlg").val(),
        a_max:$("#ia_i_eq_max_dlg").val(),
        fi_min:$("#ia_i_fi_min_dlg").val(),
        fi_max:$("#ia_i_fi_max_dlg").val(),
        mm_min:$("#ia_i_mm_min_dlg").val(),
        mm_max:$("#ia_i_mm_max_dlg").val(),
        c_min:$("#ia_i_c_min_dlg").val(),
        c_max:$("#ia_i_c_max_dlg").val(),
        sub_min:$("#ia_i_subs_dlg").val(),
        red_min:$("#ia_i_red_dlg").val()
    },function(pfsave_data) { });
    pfsave_post.done(function(pfsave_msg){ 
        
        ia_load_data($("#ia_s_pf").val())
        if(pfsave_msg=='0')
            c_nosession();
        else if(pfsave_msg=='1')
        {
            alert('Success saving data!');
            ia_load_data($("#ia_s_fm_dlg").val(),$("#ia_s_pf_dlg").val());
            $("#ia_dlg").dialog('close');
        }
        else
            alert('error saving data!');
        c_status('pf',0);
    });
    pfsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('pf',0);});
}

function ia_reset_dlg()
{    
    $("#ia_i_accno_dlg").val('');
    $("#ia_i_accname_dlg").val('');
    $("#ia_s_cur_dlg_h").val('');
}
function ia_get_data_dlg(p_pf)
{
    c_status('ia',1);
    
    var ia_post = $.post(uri+'/index.php/cia/get_data',{pf:p_pf},function(ia_data) { },'json');
    ia_post.done(function(ia_msg){  
        if(ia_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        
        for (var i=0; i<ia_msg.r_rows; i++) {
           if(ia_msg.r_data[i].ASSETTYPE=='EQUITY') {$("#ia_i_eq_min_dlg").val(ia_msg.r_data[i].MINIMUM);$("#ia_i_eq_max_dlg").val(ia_msg.r_data[i].MAXIMUM);}
           if(ia_msg.r_data[i].ASSETTYPE=='FIX INCOME') {$("#ia_i_fi_min_dlg").val(ia_msg.r_data[i].MINIMUM);$("#ia_i_fi_max_dlg").val(ia_msg.r_data[i].MAXIMUM);}
           if(ia_msg.r_data[i].ASSETTYPE=='MONEY MARKET') {$("#ia_i_mm_min_dlg").val(ia_msg.r_data[i].MINIMUM);$("#ia_i_mm_max_dlg").val(ia_msg.r_data[i].MAXIMUM);}
           if(ia_msg.r_data[i].ASSETTYPE=='CASH') {$("#ia_i_c_min_dlg").val(ia_msg.r_data[i].MINIMUM);$("#ia_i_c_max_dlg").val(ia_msg.r_data[i].MAXIMUM);}
           if(ia_msg.r_data[i].ASSETTYPE=='SUBSCRIPTION FEE') {$("#ia_i_subs_dlg").val(ia_msg.r_data[i].MINIMUM);}
           if(ia_msg.r_data[i].ASSETTYPE=='REDEMPTION FEE') {$("#ia_i_red_dlg").val(ia_msg.r_data[i].MINIMUM);}
        }       
        c_status('ia',0);
    });
    ia_post.fail(function(jqXHR, textStatus) {c_status('ia',0);});    
    
}