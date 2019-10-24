var grid_gl;
var data_gl = []; 
var select_mode_gl = 0;

function gl_initiate()
{
    gl_initiate_grid();
    gl_initiate_dlg();
    $("#gl_b_new").click(function(){
        select_mode_gl=0;
        gl_reset_dlg();
        $("#gl_i_accno_dlg").removeAttr("readonly"); 
        $("#gl_dlg").dialog('open');
    });
    $("#gl_b_edit").click(function(){
        var gl_selected_row  = grid_gl.getActiveCell();
        if(gl_selected_row)
        {
            if(gl_selected_row.row>=data_gl.length)
                alert('Choose the account fisrt!');
            else
            {
                gl_get_data_dlg(data_gl[gl_selected_row.row].glno,data_gl[gl_selected_row.row].glname,data_gl[gl_selected_row.row].glsign,data_gl[gl_selected_row.row].gltype,data_gl[gl_selected_row.row].glcur);  
                $("#gl_i_accno_dlg").attr("readonly", "readonly");              
                $("#gl_dlg").dialog('open');
            }
        }
        else alert('Choose the account fisrt!');
    });
    
    $("#gl_s_fm").change(function(){
        $("#gl_s_fm_dlg").val(this.value);
        ipt_pf_load_select($("#gl_s_pf"),1,this.value);
        ipt_pf_load_select($("#gl_s_pf_dlg"),1,this.value);
        gl_load_data(this.value,'ALL');
        ipt_fm_set_default(this.value);
    });
    
    $("#gl_s_pf").change(function(){
        $("#gl_s_pf_dlg").val(this.value);
        gl_load_data($("#gl_s_fm").val(),this.value);
        ipt_pf_set_default(this.value);  
    });
    
    $("#gl_s_fm_dlg").change(function(){
        ipt_pf_load_select($("#gl_s_pf_dlg"),1,this.value);
    });
    
    
    grid_gl.onDblClick.subscribe(function(e) {
        var gl_selected_cell = grid_gl.getCellFromEvent(e);
        gl_get_data_dlg(data_gl[gl_selected_cell.row].glno,data_gl[gl_selected_cell.row].glname,data_gl[gl_selected_cell.row].glsign,data_gl[gl_selected_cell.row].gltype,data_gl[gl_selected_cell.row].glcur);
        $("#gl_dlg").dialog('open');
    });
}
function gl_show()
{
    var  ia_fm =''
    if (ipt_check_fm()!='_*_M')
        ia_fm=  ipt_check_fm();    
    ipt_fm_load($("#gl_s_fm"),1,$("#gl_s_fm_dlg"),1);       
    ipt_pf_load(ia_fm,$("#gl_s_pf"),1,$("#gl_s_pf_dlg"),1);      
    if(ia_fm=='') ia_fm='ALL';
    var ia_pf='ALL';
    if(ipt_check_pf()!='' && ipt_check_pf()!='ALL')
        ia_pf=ipt_check_pf();
    
    gl_load_data(ia_fm,ia_pf);
}

function gl_initiate_grid()
{
    var columns_gl = [];
    var options_gl = [];
    columns_gl = [
        {id:"fmcode", name:"FM", field:"fmcode",width:60}
        ,{id:"pfcode", name:"FUND", field:"pfcode",width:60}
        ,{id:"glno", name:"ACC NO", field:"glno",width:60}
        ,{id:"glname", name:"ACC NAME", field:"glname",width:240}
        ,{id:"glsign", name:"SIGN", field:"glsign",width:50}
        ,{id:"gltype", name:"TYPE", field:"gltype",width:50}
        ,{id:"glcur", name:"CUR", field:"glcur",cssClass:"cell_center",width:50}
    ];

    options_gl = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_gl = new Slick.Grid("#gl_slick", data_gl, columns_gl, options_gl);
    grid_gl.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function gl_initiate_dlg()
{
    $("#gl_dlg").dialog({ 
            title:        'GL Master'
        ,    width:        490
        ,    height:        210
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){gl_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function gl_load_data(p_fm,p_pf)
{
    c_status('gl',1);
    var gl_post = $.post(uri+'/index.php/cgl/list_data',{fm:p_fm,pf:p_pf},function(gl_data) { },'json');
    gl_post.done(function(gl_msg){   
        if(gl_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_gl.length=0;
        for (var i=0; i<gl_msg.r_rows; i++) {
           var d = (data_gl[i] = {});     
           d["fmcode"] = gl_msg.r_data[i].fmcode;          
           d["pfcode"] = gl_msg.r_data[i].pfcode;
           d["glno"] = gl_msg.r_data[i].glno;
           d["glname"] = gl_msg.r_data[i].glname; 
           d["glsign"] = gl_msg.r_data[i].glsign; 
           d["gltype"] = gl_msg.r_data[i].gltype;
           d["glcur"] = gl_msg.r_data[i].glcur; 
        }       
        grid_gl.invalidateAllRows();
        grid_gl.updateRowCount();
        grid_gl.render();
        c_status('gl',0);
    });
    gl_post.fail(function(jqXHR, textStatus) {c_status('gl',0);});
}
function gl_save_data()
{
    if($("#gl_s_cur_dlg_h").val()!=$("#gl_s_cur_dlg").val() && $("#gl_s_cur_dlg_h").val()!='')
        if(!confirm('Currency is changed, continue ?'))
            return 0;
    if(!confirm('Save data?'))
        return 0;
    c_status('pf',1);
    var pfsave_post = $.post(uri+'/index.php/cgl/save_data',{
        fm_code:$("#gl_s_fm_dlg").val(),
        pf_code:$("#gl_s_pf_dlg").val(),
        gl_no:$("#gl_i_accno_dlg").val(),
        gl_name:$("#gl_i_accname_dlg").val(),
        gl_sign:$("#gl_s_sign_dlg").val(),
        gl_type:$("#gl_s_type_dlg").val(),
        gl_cur:$("#gl_s_cur_dlg").val(),
        gl_cur1:$("#gl_s_cur_dlg_h").val()
    },function(pfsave_data) { });
    pfsave_post.done(function(pfsave_msg){ 
        
        gl_load_data($("#gl_s_fm").val(),$("#gl_s_pf").val())
        if(pfsave_msg=='0')
            c_nosession();
        else if(pfsave_msg=='1')
        {
            alert('Success saving data!');
            $("#gl_dlg").dialog('close');
        }
        else
            alert('error saving data!');
        c_status('pf',0);
    });
    pfsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('pf',0);});
}

function gl_reset_dlg()
{    
    $("#gl_i_accno_dlg").val('');
    $("#gl_i_accname_dlg").val('');
    $("#gl_s_cur_dlg_h").val('');
}
function gl_get_data_dlg(p_gl,p_glname,p_glsign,p_gltype,p_cur)
{
    $("#gl_i_accno_dlg").val(p_gl);
    $("#gl_i_accname_dlg").val(p_glname);
    $("#gl_s_sign_dlg").val(p_glsign);
    $("#gl_s_type_dlg").val(p_gltype);
    $("#gl_s_cur_dlg").val(p_cur);
    $("#gl_s_cur_dlg_h").val(p_cur);    
}