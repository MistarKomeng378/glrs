var grid_fm;
var data_fm = []; 
var select_mode_fm = 0;

function fs_initiate()
{
    fs_initiate_grid();
    /*fs_initiate_dlg();
    $("#fs_b_new").click(function(){
        fs_reset_dlg();
        ipt_enable($("#fs_i_fs_code_dlg"),true);
        $("#fs_dlg").dialog('open');
    });
    $("#fs_b_edit").click(function(){
        var fs_selected_row  = grid_fm.getActiveCell();
        if(fs_selected_row)
        {
            if(fs_selected_row.row>=data_fm.length)
                alert('Choose the fund manager fisrt!');
            else
            {
                ipt_enable($("#fs_i_fs_code_dlg"),false);
                select_mode_fm=2;
                fs_get_data_dlg(data_fm[fs_selected_row.row].fmcode);
                $("#fs_dlg").dialog('open');
            }
        }
        else alert('Choose the fund manager fisrt!');
    });
    grid_fm.onDblClick.subscribe(function(e) {     
        var fs_selected_cell = grid_fm.getCellFromEvent(e);
        select_mode_fm=2;
        ipt_enable($("#fs_i_fs_code_dlg"),false);
        fs_get_data_dlg(data_fm[fs_selected_cell.row].fmcode);
        $("#fs_dlg").dialog('open');
    });   */
}
function fs_show()
{
    //fs_load_data(); 
    //fs_load_select($("#fs_s_fm"),1);
    //fs_load_select($("#fs_s_fs_dlg"),0);
}

function fs_initiate_grid()
{
    var columns_fm = [];
    var options_fm = [];
    columns_fm = [
        {id:"scode", name:"Code", field:"scode",width:65}
        ,{id:"scat", name:"Category", field:"scat",width:50}
        ,{id:"sname", name:"Name", field:"sname",width:240}
        ,{id:"srate", name:"Rate", field:"srate",width:60}
        ,{id:"sfreq", name:"Freq", field:"sfreq",width:60}
        ,{id:"sld", name:"Last Coupon", field:"sld",width:110}
        ,{id:"snd", name:"Next Coupon", field:"snd",width:110}
        ,{id:"smd", name:"Maturity", field:"smd",width:110}
        ,{id:"syear", name:"Days in Year", field:"syear",width:60}
        ,{id:"smonth", name:"Days in Month", field:"smonth",width:60}
    ];

    options_fm = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_fm = new Slick.Grid("#fs_slick", data_fm, columns_fm, options_fm);
    grid_fm.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function fs_initiate_dlg()
{
    $("#fs_dlg").dialog({ 
            title:        'Fund Manager'
        ,    width:        450
        ,    height:        480
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){fs_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function fs_load_data()
{
    c_status('fm',1);
    var fs_post = $.post(uri+'/index.php/cfundmanager/list_data',{t:'0'},function(fs_data) { },'json');
    fs_post.done(function(fs_msg){   
        if(fs_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_fm.length=0;
        for (var i=0; i<fs_msg.r_rows; i++) {
           var d = (data_fm[i] = {});     
           d["fmcode"] = fs_msg.r_data[i].fmcode; 
           d["fmname"] = fs_msg.r_data[i].fmname; 
           d["fmaddr1"] = fs_msg.r_data[i].addr1; 
           d["fmaddr2"] = fs_msg.r_data[i].addr2; 
           d["fmcity"] = fs_msg.r_data[i].city; 
           d["fmcountry"] = fs_msg.r_data[i].country; 
           d["fmphone1"] = fs_msg.r_data[i].phone1; 
           d["fmfax1"] = fs_msg.r_data[i].fax1; 
           d["fmmail"] = fs_msg.r_data[i].mail; 
           d["fmtime"] = fs_msg.r_data[i].pricinghour;
           d["fmibpa"] = fs_msg.r_data[i].ibpacode;
        }       
        grid_fm.invalidateAllRows();
        grid_fm.updateRowCount();
        grid_fm.render();
        c_status('fm',0);
    });
    fs_post.fail(function(jqXHR, textStatus) {c_status('fm',0);});
}
function fs_save_data()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('fm',1);
    var fmsave_post = $.post(uri+'/index.php/cfundmanager/save_data',{
        fs_code:$("#fs_i_fs_code_dlg").val(),
        fs_name:$("#fs_i_fs_name_dlg").val(),
        fs_addr1:$("#fs_i_fs_addr1_dlg").val(),
        fs_addr2:$("#fs_i_fs_addr2_dlg").val(),
        fs_addr3:$("#fs_i_fs_addr3_dlg").val(),
        fs_city:$("#fs_i_fs_city_dlg").val(),
        fs_country:$("#fs_i_fs_country_dlg").val(),
        fs_postal:$("#fs_i_fs_postal_dlg").val(),
        fs_phone1:$("#fs_i_fs_phone1_dlg").val(),
        fs_phone2:$("#fs_i_fs_phone2_dlg").val(),
        fs_fax1:$("#fs_i_fs_fax1_dlg").val(),
        fs_fax2:$("#fs_i_fs_fax2_dlg").val(),
        fs_mail:$("#fs_i_fs_mail_dlg").val(),
        fs_mailaddr:$("#fs_i_fs_mailaddr_dlg").val(),
        fs_mailcc:$("#fs_i_fs_mailaddrcc_dlg").val(),
        fs_time:$("#fs_i_fs_ph_dlg").val(),
        fs_ibpa:$("#fs_i_fs_ibpa_dlg").val()
        
    },function(fmsave_data) { });
    fmsave_post.done(function(fmsave_msg){
        fs_load_data(); 
        if(fmsave_msg=='0')
            c_nosession();
        else if(fmsave_msg=='1')
        {
            alert('Success saving data!');
            $("#fs_dlg").dialog('close');
        }
        else
            alert('error saving data!');
        c_status('fm',0);
    });
    fmsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('fm',0);});
}

function fs_reset_dlg()
{    
    $("#fs_i_fs_code_dlg").val('');
    $("#fs_i_fs_name_dlg").val('');
    $("#fs_i_fs_addr1_dlg").val('');
    $("#fs_i_fs_addr2_dlg").val('');
    $("#fs_i_fs_addr3_dlg").val('');
    $("#fs_i_fs_city_dlg").val('');
    $("#fs_i_fs_country_dlg").val('');
    $("#fs_i_fs_postal_dlg").val('');
    $("#fs_i_fs_phone1_dlg").val('');
    $("#fs_i_fs_phone2_dlg").val('');
    $("#fs_i_fs_fax1_dlg").val('');
    $("#fs_i_fs_fax2_dlg").val('');
    $("#fs_i_fs_mail_dlg").val('N');
     $("#fs_i_fs_mailaddr_dlg").val('');
     $("#fs_i_fs_mailaddrcc_dlg").val('');
     $("#fs_i_fs_ph_dlg").val('');
     $("#fs_i_fs_ibpa_dlg").val('');
}
function fs_get_data_dlg(p_fm)
{
    c_status('fm',1);
    var fs_post = $.post(uri+'/index.php/cfundmanager/get_data',{fs_code:p_fm},function(fs_data) { },'json');
    fs_post.done(function(fs_msg){ 
        if(fs_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        if(fs_msg.r_rows==0)
            fs_reset_dlg();
        else
        {
            $("#fs_i_fs_code_dlg").val(fs_msg.r_data[0].fmcode);
            $("#fs_i_fs_name_dlg").val(fs_msg.r_data[0].fmname);
            $("#fs_i_fs_addr1_dlg").val(fs_msg.r_data[0].fmaddr1);
            $("#fs_i_fs_addr2_dlg").val(fs_msg.r_data[0].fmaddr2);
            $("#fs_i_fs_addr3_dlg").val(fs_msg.r_data[0].fmaddr3);
            $("#fs_i_fs_city_dlg").val(fs_msg.r_data[0].fmcity);
            $("#fs_i_fs_country_dlg").val(fs_msg.r_data[0].fmcountry);
            $("#fs_i_fs_postal_dlg").val(fs_msg.r_data[0].fmpost);
            $("#fs_i_fs_phone1_dlg").val(fs_msg.r_data[0].fmphone1);
            $("#fs_i_fs_phone2_dlg").val(fs_msg.r_data[0].fmphone1);
            $("#fs_i_fs_fax1_dlg").val(fs_msg.r_data[0].fmfax1);
            $("#fs_i_fs_fax2_dlg").val(fs_msg.r_data[0].fmfax3);
            $("#fs_i_fs_mail_dlg").val(fs_msg.r_data[0].fmmail);
             $("#fs_i_fs_mailaddr_dlg").val(fs_msg.r_data[0].fmmailaddr);
             $("#fs_i_fs_mailaddrcc_dlg").val(fs_msg.r_data[0].fmmailcc);
             $("#fs_i_fs_ph_dlg").val(fs_msg.r_data[0].fmtime);
             $("#fs_i_fs_ibpa_dlg").val(fs_msg.r_data[0].fmibpa);
        }               
        c_status('fm',0);
    });
    fs_post.fail(function(jqXHR, textStatus) {fs_reset_dlg();c_status('fm',0);});
}