var grid_user;
var data_user = []; 
var select_mode_user = 0;

function user_initiate()
{
    user_initiate_grid();
    user_initiate_dlg_new();
    user_initiate_dlg_reset();
    $("#user_b_new").click(function(){
        user_reset_dlg(1);
        $("#user_dlg_new").dialog('open');
    });
    $("#user_b_edit").click(function(){
        user_reset_dlg(0);
        var user_selected_row  = grid_user.getActiveCell();
        if(user_selected_row)
        {
            if(user_selected_row.row>=data_user.length)
                alert('Choose the User!');
            else
            {
                $("#user_i_id_dlg").val(data_user[user_selected_row.row].uid);
                $("#user_i_name_dlg").val(data_user[user_selected_row.row].uname);
                $("#user_s_lvl_dlg").val(data_user[user_selected_row.row].ulvl);
                if(data_user[user_selected_row.row].ulocked==1)
                    $("#user_c_lock_dlg")[0].checked=true;
                else
                    $("#user_c_lock_dlg")[0].checked=false;
                if(data_user[user_selected_row.row].uenabled==1)
                    $("#user_c_enable_dlg")[0].checked=true;
                else
                    $("#user_c_enable_dlg")[0].checked=false;
                $("#user_dlg_new").dialog('open');
            }
        }
        else alert('Choose the User!');
    });
   
    grid_user.onDblClick.subscribe(function(e) {     
        user_reset_dlg(0);
        var user_selected_row = grid_user.getCellFromEvent(e);
        $("#user_i_id_dlg").val(data_user[user_selected_row.row].uid);
        $("#user_i_name_dlg").val(data_user[user_selected_row.row].uname);
        $("#user_s_lvl_dlg").val(data_user[user_selected_row.row].ulvl);
        if(data_user[user_selected_row.row].ulocked==1)
            $("#user_c_lock_dlg")[0].checked=true;
        else
            $("#user_c_lock_dlg")[0].checked=false;
        if(data_user[user_selected_row.row].uenabled==1)
            $("#user_c_enable_dlg")[0].checked=true;
        else
            $("#user_c_enable_dlg")[0].checked=false;
        $("#user_dlg_new").dialog('open');
    }); 
     $("#user_b_resetpass").click(function(){
        var user_selected_row  = grid_user.getActiveCell();
        if(user_selected_row)
        {
            if(user_selected_row.row>=data_user.length)
                alert('Choose the User!');
            else
            {
                $("#user_i_rpass1_dlg").val('');
                $("#user_i_rpass2_dlg").val('');
                $("#user_dlg_resetpass").dialog('open');
            }
        }
        else alert('Choose the User!');
    });
}
function user_show()
{
    user_load_data(); 
}
function user_reset_dlg(p_new)
{
    
    $("#user_i_pass1_dlg").val('');
    $("#user_i_pass2_dlg").val('');
    
    if(p_new==1)
    {
        $("#user_i_id_dlg").val('');
        $("#user_i_name_dlg").val('');
        $("#user_s_lvl_dlg").val('10');        
        $("#user_i_id_dlg").removeAttr("readonly");
        $("#user_h_action").val('n');
        $("#user_i_pass1_dlg").removeAttr("disabled");
        $("#user_i_pass2_dlg").removeAttr("disabled");
        $("#user_i_pass1_dlg").css('background-color','#ffffff');
        $("#user_i_pass2_dlg").css('background-color','#ffffff');
        $("#user_i_id_dlg").css('background-color','#ffffff');
    }
    else
    {
        $("#user_h_action").val('u');
        $("#user_i_pass1_dlg").attr("disabled", "disabled");
        $("#user_i_pass2_dlg").attr("disabled", "disabled");
        $("#user_i_pass1_dlg").css('background-color','#E0E0E0');
        $("#user_i_pass2_dlg").css('background-color','#E0E0E0');
        $("#user_i_id_dlg").css('background-color','#E0E0E0');
        $("#user_i_id_dlg").attr("readonly", "readonly");
    }
}
function user_initiate_grid()
{
    var columns_user = [];
    var options_user = [];
    columns_user = [
        {id:"uname", name:"Name", field:"uname",width:260}
        ,{id:"uid", name:"Login", field:"uid",width:110}
        ,{id:"ulvlname", name:"Level", field:"ulvlname",width:140}
        ,{id:"uenabled", name:"Enabled", field:"uenabled",cssClass:"cell_center",width:50}
        ,{id:"ulocked", name:"Locked", field:"ulocked",cssClass:"cell_center",width:50}
        ,{id:"ulastlog_s", name:"Last Login", field:"ulastlog_s",cssClass:"cell_center",width:130}
        ,{id:"ulastpass_s", name:"Last Change Password", field:"ulastpass_s",cssClass:"cell_center",width:130}
    ];

    options_user = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_user = new Slick.Grid("#user_slick", data_user, columns_user, options_user);
    grid_user.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function user_initiate_dlg_new()
{
    $("#user_dlg_new").dialog({ 
            title:        'Users'
        ,    width:        420
        ,    height:        230
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){user_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function user_initiate_dlg_reset()
{
    $("#user_dlg_resetpass").dialog({ 
            title:        'Reset Password'
        ,    width:        285  
        ,    height:        135
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Reset Password": function(){user_reset_pass();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function user_load_data()
{
    c_status('user',1);
    var user_post = $.post(uri+'/index.php/cuser/list_data',{},function(user_data) { },'json');
    user_post.done(function(user_msg){   
        if(user_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_user.length=0;
        for (var i=0; i<user_msg.r_rows; i++) {
           var d = (data_user[i] = {});     
           d["uname"] = user_msg.r_data[i].uname;          
           d["uid"] = user_msg.r_data[i].uid; 
           d["ulvlname"] = user_msg.r_data[i].ulvlname; 
           d["ulvl"] = user_msg.r_data[i].ulvl; 
           d["uenabled"] = user_msg.r_data[i].uenabled; 
           d["ulocked"] = user_msg.r_data[i].ulocked; 
           d["ulastlog_s"] = user_msg.r_data[i].ulastlog_s; 
           d["ulastpass_s"] = user_msg.r_data[i].ulastpass_s; 
        }       
        grid_user.invalidateAllRows();
        grid_user.updateRowCount();
        grid_user.render();
        c_status('user',0);
    });
    user_post.fail(function(jqXHR, textStatus) {c_status('user',0);});
}
function user_save_data()
{
    if($("#user_h_action").val()=='n' && $("#user_i_pass1_dlg").val()!=$("#user_i_pass2_dlg").val())
    {
        alert('Password missmatch!');
        return 0;
    }
    if($("#user_i_id_dlg").val()=='' ||  $("#user_i_name_dlg").val()=='')
    {
        alert('User ID or User name can not empty');
        return 0;
    }
    if(!confirm('Save data?'))
        return 0;
    c_status('user',1);
    var p_enable,p_lock;
    if($("#user_c_enable_dlg").prop('checked')) p_enable = 1; else p_enable=0;
    if($("#user_c_lock_dlg").prop('checked')) p_lock = 1; else p_lock=0;
    var pfsave_post = $.post(uri+'/index.php/cuser/save_data',{
        a:$("#user_h_action").val(),
        uid:$("#user_i_id_dlg").val(),
        uname:$("#user_i_name_dlg").val(),
        p1:$("#user_i_pass1_dlg").val(),
        p2:$("#user_i_pass2_dlg").val(),
        ulvl:$("#user_s_lvl_dlg").val(),
        uenable:p_enable,
        ulock:p_lock
    },function(pfsave_data) { });
    pfsave_post.done(function(pfsave_msg){
        c_status('user',0); 
        if(pfsave_msg=='0')
            c_nosession();
        else if(pfsave_msg=='1')
        {
            alert('Success saving data!');
            user_load_data();
            $("#user_dlg_new").dialog('close');
        }
        else
            alert(pfsave_msg);
    });
    pfsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('user',0);});
}

function user_reset_pass()
{
    if($("#user_i_pass1_dlg").val()!=$("#user_i_pass2_dlg").val())
    {
        alert('Password missmatch!');
        return 0;
    }
    if(!confirm('Reset Password?'))
        return 0;
    var user_selected_row  = grid_user.getActiveCell();
    var p_uid = data_user[user_selected_row.row].uid;
    c_status('user',1);
    var pfsave_post = $.post(uri+'/index.php/cuser/reset_pass',{
        uid:p_uid,
        p1:$("#user_i_rpass1_dlg").val(),
        p2:$("#user_i_rpass2_dlg").val(),
    },function(pfsave_data) { });
    pfsave_post.done(function(pfsave_msg){
        c_status('user',0); 
        if(pfsave_msg=='0')
            c_nosession();
        else if(pfsave_msg=='1')
        {
            alert('Success Reset Password!');
            $("#user_dlg_reset").dialog('close');
        }
        else
            alert(pfsave_msg);
    });
    pfsave_post.fail(function(jqXHR, textStatus) {alert('error reset password!');c_status('user',0);});
}
