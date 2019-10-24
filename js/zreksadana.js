var grid_tp;
var data_tp = []; 
var select_mode_tp = 0;

function tp_initiate()
{
    tp_initiate_grid();
    tp_initiate_dlg();
    $("#tp_b_new").click(function(){
        tp_reset_dlg();
        ipt_enable($("#tp_i_tp_code_dlg"),true);
        $("#tp_dlg").dialog('open');
    });
    $("#tp_b_edit").click(function(){
        var tp_selected_row  = grid_tp.getActiveCell();
        if(tp_selected_row)
        {
            if(tp_selected_row.row>=data_tp.length)
                alert('Choose the Type Reksadana fisrt!');
            else
            {
                ipt_enable($("#tp_i_tp_code_dlg"),false);
                select_mode_tp=2;
                tp_get_data_dlg(data_tp[tp_selected_row.row].tpcode);
                $("#tp_dlg").dialog('open');
            }
        }
        else alert('Choose the Type Reksadana fisrt!');
    });
    grid_tp.onDblClick.subscribe(function(e) {     
        var tp_selected_cell = grid_tp.getCellFromEvent(e);
        select_mode_tp=2;
        ipt_enable($("#tp_i_tp_code_dlg"),false);
        tp_get_data_dlg(data_tp[tp_selected_cell.row].tpcode);
        $("#tp_dlg").dialog('open');
    }); 
}
function tp_show()
{
    tp_load_data(); 
    //tp_load_select($("#tp_s_tp"),1);
    //tp_load_select($("#tp_s_tp_dlg"),0);
}

function tp_initiate_grid()
{
    var columns_tp = [];
    var options_tp = [];
    columns_tp = [
        {id:"tpcode", name:"TR Code", field:"tpcode",width:85}
        ,{id:"tpname", name:"Type Reksadana", field:"tpname",width:250}
    ];

    options_tp = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_tp = new Slick.Grid("#tp_slick", data_tp, columns_tp, options_tp);
    grid_tp.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function tp_initiate_dlg()
{
    $("#tp_dlg").dialog({ 
            title:        'Parameter Reksadana'
        ,    width:        350
        ,    height:        200
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){tp_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function tp_load_data()
{
    c_status('tp',1);
    var tp_post = $.post(uri+'/index.php/creksadana/list_data',{t:'0'},function(tp_data) { },'json');
    tp_post.done(function(tp_msg){   
        if(tp_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_tp.length=0;
        for (var i=0; i<tp_msg.r_rows; i++) {
           var d = (data_tp[i] = {});     
           d["tpcode"] = tp_msg.r_data[i].tpcode; 
           d["tpname"] = tp_msg.r_data[i].tpname; 
        }       
        grid_tp.invalidateAllRows();
        grid_tp.updateRowCount();
        grid_tp.render();
        c_status('tp',0);
    });
    tp_post.fail(function(jqXHR, textStatus) {c_status('tp',0);});
}
function tp_save_data()
{
    if(!confirm('Simpan Data?'))
        return 0;
    c_status('tp',1);
    var tpsave_post = $.post(uri+'/index.php/creksadana/save_data',{
        tp_code:$("#tp_i_tp_code_dlg").val(),//ini
        tp_name:$("#tp_i_tp_name_dlg").val(),
        tp_ket:$("#tp_i_tp_ket_dlg").val()
        
    },function(tpsave_data) { });
    tpsave_post.done(function(tpsave_msg){
        tp_load_data(); 		
        if(tpsave_msg=='0')
            c_nosession();
        else if(tpsave_msg=='1')
        {
			
            alert('Success saving data!');
            $("#tp_dlg").dialog('close');
        }
        else
		
            alert('error saving data1!');
        c_status('tp',0);
    });
    tpsave_post.fail(function(jqXHR, textStatus) {alert('error saving data2!');c_status('tp',0);});
}

function tp_reset_dlg()
{        
    $("#tp_i_tp_code_dlg").val('');
    $("#tp_i_tp_name_dlg").val('');
    $("#tp_i_tp_ket_dlg").val('');
}
function tp_get_data_dlg(p_tp)
{
    c_status('tp',1);
    var tp_post = $.post(uri+'/index.php/creksadana/get_data',{tp_code:p_tp},function(tp_data) { },'json');
    tp_post.done(function(tp_msg){ 
        if(tp_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        if(tp_msg.r_rows==0)
            tp_reset_dlg();
        else
        {
            $("#tp_i_tp_code_dlg").val(tp_msg.r_data[0].tpcode);
            $("#tp_i_tp_name_dlg").val(tp_msg.r_data[0].tpname);
            $("#tp_i_tp_ket_dlg").val(tp_msg.r_data[0].tpket);
        }               
        c_status('tp',0);
    });
    tp_post.fail(function(jqXHR, textStatus) {tp_reset_dlg();c_status('tp',0);});
}
