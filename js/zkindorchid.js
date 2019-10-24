var grid_ock;
var data_ock = []; 
var select_mode_ock = 0;

function ock_initiate()
{
    ock_initiate_grid();
    ock_initiate_dlg();
    $("#ock_b_new").click(function(){
        ock_reset_dlg();
        ipt_enable($("#ock_i_ock_code_dlg"),true);
        $("#ock_dlg").dialog('open');
    });
    
    $("#ock_b_edit").click(function(){
        var ock_selected_row  = grid_ock.getActiveCell();
        if(ock_selected_row)
        {
            if(ock_selected_row.row>=data_ock.length)
                alert('Choose the Kind Orchid fisrt!');
            else
            {
                ipt_enable($("#ock_i_ock_code_dlg"),false);
                select_mode_ock=2;
                ock_get_data_dlg(data_ock[ock_selected_row.row].ockid);
                $("#ock_dlg").dialog('open');
            }
        }
        else alert('Choose the Kind Orchid fisrt!');
    });
    grid_ock.onDblClick.subscribe(function(e) {     
        var ock_selected_cell = grid_ock.getCellFromEvent(e);
        select_mode_ock=2;
        ipt_enable($("#ock_i_ock_code_dlg"),false);
        ock_get_data_dlg(data_ock[ock_selected_cell.row].ockid);
        $("#ock_dlg").dialog('open');
    }); 
}
function ock_show()
{
    ock_load_data(); 
    //ock_load_select($("#ock_s_ock"),1);
    //ock_load_select($("#ock_s_ock_dlg"),0);
}
//Tampil Data  (table)
function ock_initiate_grid()
{
    var columns_ock = [];
    var options_ock = [];
    columns_ock = [
        {id:"ockid", name:"Kind Orchid ID", field:"ockid",width:85},
        {id:"ockname", name:"KindO rchid Name", field:"ockname",width:250}
    ];

    options_ock = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_ock = new Slick.Grid("#ock_slick", data_ock, columns_ock, options_ock);
    grid_ock.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function ock_initiate_dlg()
{
    $("#ock_dlg").dialog({ 
            title:        'Kind Orchid'
        ,    width:        350
        ,    height:        200
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){ock_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
// Tampil Data (Source)
function ock_load_data()
{
    c_status('ock',1);
    var ock_post = $.post(uri+'/index.php/ckindorchid/list_data',{t:'0'},function(ock_data) { },'json');
    ock_post.done(function(ock_msg){   
        if(ock_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_ock.length=0;
        for (var i=0; i<ock_msg.r_rows; i++) {
           var d = (data_ock[i] = {});     
           d["ockid"] = ock_msg.r_data[i].ockid; 
           d["ockname"] = ock_msg.r_data[i].ockname; 
        }       
        grid_ock.invalidateAllRows();
        grid_ock.updateRowCount();
        grid_ock.render();
        c_status('ock',0);
    });
    ock_post.fail(function(jqXHR, textStatus) {c_status('ock',0);});
}
// Untuk Save Data
function ock_save_data()
{
    if(!confirm('Simpan Data?'))
        return 0;
    c_status('ock',1);
    var ocksave_post = $.post(uri+'/index.php/ckindorchid/save_data',{
        ock_code:$("#ock_i_ock_code_dlg").val(),//ini type_id
        ock_name:$("#ock_i_ock_name_dlg").val(),
        
    },function(ocksave_data) { });
    ocksave_post.done(function(ocksave_msg){
        ock_load_data(); 		
        if(ocksave_msg=='0')
            c_nosession();
        else if(ocksave_msg=='1')
        {
			
            alert('Success saving data!');
            $("#ock_dlg").dialog('close');
        }
        else
		
            alert('error saving data!');
        c_status('ock',0);
    });
    ocksave_post.fail(function(jqXHR, textStatus) {alert('error saving data2!');c_status('ock',0);});
}

function ock_reset_dlg()
{        
    $("#ock_i_ock_code_dlg").val('');
    $("#ock_i_ock_name_dlg").val('');
}
function ock_get_data_dlg(p_ock)
{
    c_status('ock',1);
    var ock_post = $.post(uri+'/index.php/ckindorchid/get_data',{ock_code:p_ock},function(ock_data) { },'json');
    ock_post.done(function(ock_msg){ 
        if(ock_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        if(ock_msg.r_rows==0)
            ock_reset_dlg();
        else
        {
            $("#ock_i_ock_code_dlg").val(ock_msg.r_data[0].ockid);
            $("#ock_i_ock_name_dlg").val(ock_msg.r_data[0].ockname);
        }               
        c_status('ock',0);
    });
    ock_post.fail(function(jqXHR, textStatus) {ock_reset_dlg();c_status('ock',0);});
}
