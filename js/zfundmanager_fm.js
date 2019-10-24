var grid_fm;
var data_fm = []; 
var select_mode_fm = 0;

function fm_initiate()
{
    fm_initiate_grid();
    fm_initiate_dlg();
    $("#fm_b_new").click(function(){
        fm_reset_dlg();
        ipt_enable($("#fm_i_fm_code_dlg"),true);
        $("#fm_dlg").dialog('open');
    });
    $("#fm_b_edit").click(function(){
        var fm_selected_row  = grid_fm.getActiveCell();
        if(fm_selected_row)
        {
            if(fm_selected_row.row>=data_fm.length)
                alert('Choose the fund manager fisrt!');
            else
            {
                ipt_enable($("#fm_i_fm_code_dlg"),false);
                select_mode_fm=2;
                fm_get_data_dlg(data_fm[fm_selected_row.row].fmcode);
                $("#fm_dlg").dialog('open');
            }
        }
        else alert('Choose the fund manager fisrt!');
    });
    grid_fm.onDblClick.subscribe(function(e) {     
        var fm_selected_cell = grid_fm.getCellFromEvent(e);
        select_mode_fm=2;
        ipt_enable($("#fm_i_fm_code_dlg"),false);
        fm_get_data_dlg(data_fm[fm_selected_cell.row].fmcode);
        $("#fm_dlg").dialog('open');
    }); 
}
function fm_show()
{
    fm_load_data(); 
    //fm_load_select($("#fm_s_fm"),1);
    //fm_load_select($("#fm_s_fm_dlg"),0);
}

function fm_initiate_grid()
{
    var columns_fm = [];
    var options_fm = [];
    columns_fm = [
        {id:"fmcode", name:"FM CODE", field:"fmcode",width:65}
        ,{id:"fmname", name:"FM NAME", field:"fmname",width:260}
        ,{id:"fmtime", name:"Time", field:"fmtime",width:40}
        ,{id:"fmibpa", name:"IBPA", field:"fmibpa",width:60}
        ,{id:"fmaddr1", name:"Address1", field:"fmaddr1",width:200}
        ,{id:"fmaddr2", name:"Address2", field:"fmaddr2",width:200}
        ,{id:"fmcity", name:"City", field:"fmcity",width:80}
        ,{id:"fmcountry", name:"Country", field:"fmcountry",width:80}
        ,{id:"fmphone1", name:"Phone 1", field:"fmphone1",width:80}
        ,{id:"fmfax1", name:"Fax 1", field:"fmfax1",width:80}        
        ,{id:"fmmail", name:"Mail Flag", field:"fmmail",width:50}        
    ];

    options_fm = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_fm = new Slick.Grid("#fm_slick", data_fm, columns_fm, options_fm);
    grid_fm.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function fm_initiate_dlg()
{
    $("#fm_dlg").dialog({ 
            title:        'Fund Manager'
        ,    width:        450
        ,    height:        480
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){fm_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function fm_load_data()
{
    c_status('fm',1);
    var fm_post = $.post(uri+'/index.php/cfundmanager/list_data',{t:'0'},function(fm_data) { },'json');
    fm_post.done(function(fm_msg){   
        if(fm_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_fm.length=0;
        for (var i=0; i<fm_msg.r_rows; i++) {
           var d = (data_fm[i] = {});     
           d["fmcode"] = fm_msg.r_data[i].fmcode; 
           d["fmname"] = fm_msg.r_data[i].fmname; 
           d["fmaddr1"] = fm_msg.r_data[i].addr1; 
           d["fmaddr2"] = fm_msg.r_data[i].addr2; 
           d["fmcity"] = fm_msg.r_data[i].city; 
           d["fmcountry"] = fm_msg.r_data[i].country; 
           d["fmphone1"] = fm_msg.r_data[i].phone1; 
           d["fmfax1"] = fm_msg.r_data[i].fax1; 
           d["fmmail"] = fm_msg.r_data[i].mail; 
           d["fmtime"] = fm_msg.r_data[i].pricinghour;
           d["fmibpa"] = fm_msg.r_data[i].ibpacode;
        }       
        grid_fm.invalidateAllRows();
        grid_fm.updateRowCount();
        grid_fm.render();
        c_status('fm',0);
    });
    fm_post.fail(function(jqXHR, textStatus) {c_status('fm',0);});
}
function fm_save_data()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('fm',1);
    var fmsave_post = $.post(uri+'/index.php/cfundmanager/save_data',{
        fm_code:$("#fm_i_fm_code_dlg").val(),
        fm_name:$("#fm_i_fm_name_dlg").val(),
        fm_addr1:$("#fm_i_fm_addr1_dlg").val(),
        fm_addr2:$("#fm_i_fm_addr2_dlg").val(),
        fm_addr3:$("#fm_i_fm_addr3_dlg").val(),
        fm_city:$("#fm_i_fm_city_dlg").val(),
        fm_country:$("#fm_i_fm_country_dlg").val(),
        fm_postal:$("#fm_i_fm_postal_dlg").val(),
        fm_phone1:$("#fm_i_fm_phone1_dlg").val(),
        fm_phone2:$("#fm_i_fm_phone2_dlg").val(),
        fm_fax1:$("#fm_i_fm_fax1_dlg").val(),
        fm_fax2:$("#fm_i_fm_fax2_dlg").val(),
        fm_mail:$("#fm_i_fm_mail_dlg").val(),
        fm_mailaddr:$("#fm_i_fm_mailaddr_dlg").val(),
        fm_mailcc:$("#fm_i_fm_mailaddrcc_dlg").val(),
        fm_time:$("#fm_i_fm_ph_dlg").val(),
        fm_ibpa:$("#fm_i_fm_ibpa_dlg").val()
        
    },function(fmsave_data) { });
    fmsave_post.done(function(fmsave_msg){
        fm_load_data(); 
        if(fmsave_msg=='0')
            c_nosession();
        else if(fmsave_msg=='1')
        {
            alert('Success saving data!');
            $("#fm_dlg").dialog('close');
        }
        else
            alert('error saving data!');
        c_status('fm',0);
    });
    fmsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('fm',0);});
}

function fm_reset_dlg()
{    
    $("#fm_i_fm_code_dlg").val('');
    $("#fm_i_fm_name_dlg").val('');
    $("#fm_i_fm_addr1_dlg").val('');
    $("#fm_i_fm_addr2_dlg").val('');
    $("#fm_i_fm_addr3_dlg").val('');
    $("#fm_i_fm_city_dlg").val('');
    $("#fm_i_fm_country_dlg").val('');
    $("#fm_i_fm_postal_dlg").val('');
    $("#fm_i_fm_phone1_dlg").val('');
    $("#fm_i_fm_phone2_dlg").val('');
    $("#fm_i_fm_fax1_dlg").val('');
    $("#fm_i_fm_fax2_dlg").val('');
    $("#fm_i_fm_mail_dlg").val('N');
     $("#fm_i_fm_mailaddr_dlg").val('');
     $("#fm_i_fm_mailaddrcc_dlg").val('');
     $("#fm_i_fm_ph_dlg").val('');
     $("#fm_i_fm_ibpa_dlg").val('');
}
function fm_get_data_dlg(p_fm)
{
    c_status('fm',1);
    var fm_post = $.post(uri+'/index.php/cfundmanager/get_data',{fm_code:p_fm},function(fm_data) { },'json');
    fm_post.done(function(fm_msg){ 
        if(fm_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        if(fm_msg.r_rows==0)
            fm_reset_dlg();
        else
        {
            $("#fm_i_fm_code_dlg").val(fm_msg.r_data[0].fmcode);
            $("#fm_i_fm_name_dlg").val(fm_msg.r_data[0].fmname);
            $("#fm_i_fm_addr1_dlg").val(fm_msg.r_data[0].fmaddr1);
            $("#fm_i_fm_addr2_dlg").val(fm_msg.r_data[0].fmaddr2);
            $("#fm_i_fm_addr3_dlg").val(fm_msg.r_data[0].fmaddr3);
            $("#fm_i_fm_city_dlg").val(fm_msg.r_data[0].fmcity);
            $("#fm_i_fm_country_dlg").val(fm_msg.r_data[0].fmcountry);
            $("#fm_i_fm_postal_dlg").val(fm_msg.r_data[0].fmpost);
            $("#fm_i_fm_phone1_dlg").val(fm_msg.r_data[0].fmphone1);
            $("#fm_i_fm_phone2_dlg").val(fm_msg.r_data[0].fmphone1);
            $("#fm_i_fm_fax1_dlg").val(fm_msg.r_data[0].fmfax1);
            $("#fm_i_fm_fax2_dlg").val(fm_msg.r_data[0].fmfax3);
            $("#fm_i_fm_mail_dlg").val(fm_msg.r_data[0].fmmail);
             $("#fm_i_fm_mailaddr_dlg").val(fm_msg.r_data[0].fmmailaddr);
             $("#fm_i_fm_mailaddrcc_dlg").val(fm_msg.r_data[0].fmmailcc);
             $("#fm_i_fm_ph_dlg").val(fm_msg.r_data[0].fmtime);
             $("#fm_i_fm_ibpa_dlg").val(fm_msg.r_data[0].fmibpa);
        }               
        c_status('fm',0);
    });
    fm_post.fail(function(jqXHR, textStatus) {fm_reset_dlg();c_status('fm',0);});
}