var grid_oc;
var data_oc = []; 
var select_mode_oc = 0;

function oc_initiate()
{
    oc_initiate_grid();
    oc_initiate_dlg();
    $("#oc_b_new").click(function(){
        oc_reset_dlg();
        ipt_enable($("#oc_i_oc_code_dlg"),true);
        $("#oc_dlg").dialog('open');
    });
    $("#oc_b_edit").click(function(){
        var oc_selected_row  = grid_oc.getActiveCell();
        if(oc_selected_row)
        {
            if(oc_selected_row.row>=data_oc.length)
                alert('Choose the Type Orchid fisrt!');
            else
            {
                ipt_enable($("#oc_i_oc_code_dlg"),false);
                select_mode_oc=2;
                oc_get_data_dlg(data_oc[oc_selected_row.row].ocid);
                $("#oc_dlg").dialog('open');
            }
        }
        else alert('Choose the Type Orchid fisrt!');
    });
    grid_oc.onDblClick.subscribe(function(e) {     
        var oc_selected_cell = grid_oc.getCellFromEvent(e);
        select_mode_oc=2;
        ipt_enable($("#oc_i_oc_code_dlg"),false);
        oc_get_data_dlg(data_oc[oc_selected_cell.row].ocid);
        $("#oc_dlg").dialog('open');
    }); 
}
function oc_show()
{
    oc_load_data(); 
    //oc_load_select($("#oc_s_oc"),1);
    //oc_load_select($("#oc_s_oc_dlg"),0);
}
//Tampil Data  (table)
function oc_initiate_grid()
{
    var columns_oc = [];
    var options_oc = [];
    columns_oc = [
        {id:"ocid", name:"Type Orchid ID", field:"ocid",width:85},
        {id:"ocname", name:"Type Orchid Name", field:"ocname",width:250}
    ];

    options_oc = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_oc = new Slick.Grid("#oc_slick", data_oc, columns_oc, options_oc);
    grid_oc.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function oc_initiate_dlg()
{
    $("#oc_dlg").dialog({ 
            title:        'Orchid Parameter'
        ,    width:        350
        ,    height:        200
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){oc_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
// Tampil Data (Source)
function oc_load_data()
{
    c_status('oc',1);
    var oc_post = $.post(uri+'/index.php/corchid/list_data',{t:'0'},function(oc_data) { },'json');
    oc_post.done(function(oc_msg){   
        if(oc_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_oc.length=0;
        for (var i=0; i<oc_msg.r_rows; i++) {
           var d = (data_oc[i] = {});     
           d["ocid"] = oc_msg.r_data[i].ocid; 
           d["ocname"] = oc_msg.r_data[i].ocname; 
        }       
        grid_oc.invalidateAllRows();
        grid_oc.updateRowCount();
        grid_oc.render();
        c_status('oc',0);
    });
    oc_post.fail(function(jqXHR, textStatus) {c_status('oc',0);});
}
// Untuk Save Data
function oc_save_data()
{
    if(!confirm('Simpan Data?'))
        return 0;
    c_status('oc',1);
    var ocsave_post = $.post(uri+'/index.php/corchid/save_data',{
        oc_code:$("#oc_i_oc_code_dlg").val(),//ini
        oc_name:$("#oc_i_oc_name_dlg").val(),
        
    },function(ocsave_data) { });
    ocsave_post.done(function(ocsave_msg){
        oc_load_data(); 		
        if(ocsave_msg=='0')
            c_nosession();
        else if(ocsave_msg=='1')
        {
			
            alert('Success saving data!');
            $("#oc_dlg").dialog('close');
        }
        else
		
            alert('error saving data1!');
        c_status('oc',0);
    });
    ocsave_post.fail(function(jqXHR, textStatus) {alert('error saving data2!');c_status('oc',0);});
}

function oc_reset_dlg()
{        
    $("#oc_i_oc_code_dlg").val('');
    $("#oc_i_oc_name_dlg").val('');
}
function oc_get_data_dlg(p_oc)
{
    c_status('oc',1);
    var oc_post = $.post(uri+'/index.php/corchid/get_data',{oc_code:p_oc},function(oc_data) { },'json');
    oc_post.done(function(oc_msg){ 
        if(oc_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        if(oc_msg.r_rows==0)
            oc_reset_dlg();
        else
        {
            $("#oc_i_oc_code_dlg").val(oc_msg.r_data[0].ocid);
            $("#oc_i_oc_name_dlg").val(oc_msg.r_data[0].ocname);
        }               
        c_status('oc',0);
    });
    oc_post.fail(function(jqXHR, textStatus) {oc_reset_dlg();c_status('oc',0);});
}
