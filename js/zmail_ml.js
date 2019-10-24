var grid_ml;
var data_ml = []; 
var select_mode_ml = 0;

function ml_initiate()
{
    ml_initiate_grid();
    ml_initiate_dlg();
    $("#ml_b_new").click(function(){
        ml_reset_dlg();
        $("#ml_dlg").dialog('open');
    });
    $("#ml_b_edit").click(function(){
        var ml_selected_row  = grid_ml.getActiveCell();
        if(ml_selected_row)
        {
            if(ml_selected_row.row>=data_ml.length)
                alert('Choose the sender fisrt!');
            else
            {
                ml_get_data_dlg(data_ml[ml_selected_row.row].mlid,data_ml[ml_selected_row.row].mldef,data_ml[ml_selected_row.row].mlhost,data_ml[ml_selected_row.row].mluser,data_ml[ml_selected_row.row].mlpass,data_ml[ml_selected_row.row].mlsender,data_ml[ml_selected_row.row].mlsendername);
                $("#ml_dlg").dialog('open');
            }
        }
        else alert('Choose the sender fisrt!');
    });
    grid_ml.onDblClick.subscribe(function(e) {     
        var ml_selected_cell = grid_ml.getCellFromEvent(e);
        ml_get_data_dlg(data_ml[ml_selected_cell.row].mlid,data_ml[ml_selected_cell.row].mldef,data_ml[ml_selected_cell.row].mlhost,data_ml[ml_selected_cell.row].mluser,data_ml[ml_selected_cell.row].mlpass,data_ml[ml_selected_cell.row].mlsender,data_ml[ml_selected_cell.row].mlsendername);
        $("#ml_dlg").dialog('open');
    });
}
function ml_show()
{
    ml_load_data();
    //ml_load_select($("#ml_s_ml"),1);
    //ml_load_select($("#ml_s_ml_dlg"),0);
}

function ml_initiate_grid()
{
    var columns_ml = [];
    var options_ml = [];
    columns_ml = [
        {id:"mldef", name:"DEFAULT", field:"mldef",width:55}
        ,{id:"mlhost", name:"HOST", field:"mlhost",width:200}
        ,{id:"mluser", name:"USER", field:"mluser",width:220}
        ,{id:"mlsender", name:"SENDER", field:"mlsender",width:220}
        ,{id:"mlsendername", name:"SENDER NAME", field:"mlsendername",width:200}
    ];

    options_ml = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_ml = new Slick.Grid("#ml_slick", data_ml, columns_ml, options_ml);
    grid_ml.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function ml_initiate_dlg()
{
    $("#ml_dlg").dialog({ 
            title:        'Mail Sender'
        ,    width:        370
        ,    height:        230
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){ml_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function ml_load_data()
{
    c_status('fm',1);
    var ml_post = $.post(uri+'/index.php/cmail/list_data',{},function(ml_data) { },'json');
    ml_post.done(function(ml_msg){   
        if(ml_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_ml.length=0;
        for (var i=0; i<ml_msg.r_rows; i++) {
           var d = (data_ml[i] = {});     
           d["mlid"] = ml_msg.r_data[i].mailid; 
           d["mldef"] = ml_msg.r_data[i].maildef; 
           d["mlhost"] = ml_msg.r_data[i].mailhost; 
           d["mluser"] = ml_msg.r_data[i].mailuser; 
           d["mlpass"] = ml_msg.r_data[i].mailpass; 
           d["mlsender"] = ml_msg.r_data[i].mailsend; 
           d["mlsendername"] = ml_msg.r_data[i].mailsendname; 
        }       
        grid_ml.invalidateAllRows();
        grid_ml.updateRowCount();
        grid_ml.render();
        c_status('fm',0);
    });
    ml_post.fail(function(jqXHR, textStatus) {c_status('fm',0);});
}
function ml_save_data()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('ml',1);
    var mlsave_post = $.post(uri+'/index.php/cmail/save_data',{
        ml_id:$("#ml_i_id_dlg").val(),
        ml_def:$("#ml_s_default_dlg").val(),
        ml_host:$("#ml_i_host_dlg").val(),
        ml_user:$("#ml_i_user_dlg").val(),
        ml_pass:$("#ml_i_pass_dlg").val(),
        ml_send:$("#ml_i_sender_dlg").val(),
        ml_sendname:$("#ml_i_sendername_dlg").val()        
    },function(mlsave_data) { });
    mlsave_post.done(function(mlsave_msg){
        if(mlsave_msg=='0')
            c_nosession();
        else if(mlsave_msg=='1')
        {
            alert('Success saving data!');
            $("#ml_dlg").dialog('close');
        }
        else
            alert('error saving data!');
        c_status('ml',0);
        ml_load_data();
    });
    mlsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('ml',0);});
}

function ml_reset_dlg()
{    
    $("#ml_s_default_dlg").val('0');
    $("#ml_i_host_dlg").val('');
    $("#ml_i_user_dlg").val('');
    $("#ml_i_pass_dlg").val('');
    $("#ml_i_sender_dlg").val('');
    $("#ml_i_sendername_dlg").val('');
    $("#ml_i_id_dlg").val('0');
    
}
function ml_get_data_dlg(p_id,p_def,p_host,p_user,p_pass,p_send,p_sendname)
{
    $("#ml_i_id_dlg").val(p_id);
    $("#ml_s_default_dlg").val(p_def);
    $("#ml_i_host_dlg").val(p_host);
    $("#ml_i_user_dlg").val(p_user);
    $("#ml_i_pass_dlg").val(p_pass);
    $("#ml_i_sender_dlg").val(p_send);
    $("#ml_i_sendername_dlg").val(p_sendname);
    
}