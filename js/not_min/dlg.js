
var grid_pf;
var data_src_pf = []; 
var data_pf = [];
var selectedRowIds_pf = [];
var columns_pf = [];
var options_pf = [] ;

function initiate_pf_grid()
{
    columns_pf = [
        {id:"pf_code", name:"PortfolioCode", field:"pf_code"},
        {id:"pf_name", name:"PortfolioName", field:"pf_name",width:320}
    ];
    options_pf = {
        editable: false,
        enableCellNavigation: false,
        asyncEditorLoading: false,
        enableRowNavigation: true,
        autoEdit: false
    };         
    /*dataView_pf = new Slick.Data.DataView();
    grid_pf = new Slick.Grid("#dlg_list_pf_tbl", dataView_pf, columns_pf, options_pf);*/
    grid_pf = new Slick.Grid("#dlg_list_pf_tbl", data_pf, columns_pf, options_pf);
    grid_pf.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
    grid_pf.onDblClick.subscribe(function(e) {     
        var cell = grid_pf.getCellFromEvent(e);
        change_pf_name(data_pf[cell.row].pf_code,1);
        close_dlg_pf();
        if(top_menu_no==3 && leaf_menu_no==2)
        {
            cek_rea_3_2(data_pf[cell.row].pf_code);
        }
        if(top_menu_no==1 && leaf_menu_no==1)
            get_data_1_1(data_pf[cell.row].pf_code,$("#i_1_1_fm_code").val());
        if(top_menu_no==1 && leaf_menu_no==3)
            change_detail_1_3(data_pf[cell.row].pf_code,$("#i_1_3_gl_group").val(),$("#i_1_3_mm_acc_type").val());
        if(top_menu_no==1 && leaf_menu_no==5)
             set_tot_unit_1_5($("#i_1_5_pf_code").val(),$("#i_1_5_date").val());   
        if(top_menu_no==2 && leaf_menu_no==3)
            get_data_2_3(data_pf[cell.row].pf_code);
        if(top_menu_no==4 && leaf_menu_no==3)
            get_tm_4_3(data_pf[cell.row].pf_code);
        if(top_menu_no==3 && leaf_menu_no==1)
            get_tm_3_1(data_pf[cell.row].pf_code);
        if(top_menu_no==2 && leaf_menu_no==4)
            get_data_2_4($("#i_2_4_pf_code").val(),$("#i_2_4_date").val());
        if(top_menu_no==2 && leaf_menu_no==5)
            get_data_2_5($("#i_2_5_pf_code").val(),$("#i_2_5_date").val());
    });
    
    $("#pnl_filter_pf")
                .appendTo(grid_pf.getTopPanel())
                .show();
    $("#filter_list_pf").keyup(function(){
        filter_pf_grid(this.value);
    });
}

function refresh_pf_grid(show_dlg)
{
    state_progress(1);
    grid_pf.hideTopPanel();
    data_pf.length=0;
    data_src_pf.length=0;
    $("#filter_list_pf").val('');  
    var obj_get = $.getJSON(uri+'/index.php/tb/get_portfolio_name/10', function(data) {     
       for (var i=0; i<data.r_num_rows; i++) {
           var d = (data_pf[i] = {});
           d["id"] = i + data.r_sdata[i].PortfolioCode;
           d["pf_code"] = data.r_sdata[i].PortfolioCode;
           d["pf_name"] = data.r_sdata[i].PortfolioName;
           //alert(data.r_sdata[i].PortfolioName);
       }
       data_src_pf = data_pf.slice(0);    
    });
    obj_get.done(function(msg){       
       grid_pf.invalidateAllRows();
       grid_pf.updateRowCount();
       grid_pf.render();
       if(show_dlg)
           if(msg.r_login==false)
                show_dlg_login();
           else 
                $("#dlg_list_pf").dialog("open"); 
       state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        grid_pf.invalidateAllRows();
       grid_pf.updateRowCount();
       grid_pf.render();
       if(show_dlg)     
       { 
            $("#dlg_list_pf").dialog("open"); 
            alert("Getting data error :"+ textStatus);
       }
       state_progress(0);
    });
    
}
function filter_pf_grid(key_filter)
{                     
    var i_item=0;
    data_pf.length=0;
    for (var i=0; i<data_src_pf.length; i++) {
        if(data_src_pf[i]["pf_code"].indexOf(key_filter) != -1)
        {
           var d = (data_pf[i_item] = {});
           d["id"] = data_src_pf[i]["id"];
           d["pf_code"] = data_src_pf[i]["pf_code"];
           d["pf_name"] = data_src_pf[i]["pf_name"];
           i_item++;
        }
    }                         
    grid_pf.invalidateAllRows(); grid_pf.updateRowCount(); grid_pf.render();
}
function create_dlg_pf()
{
    $("#dlg_list_pf").dialog({ 
            title:        'Daftar Portfolio'
        ,    width:        350
        ,    height:        230
        ,    autoOpen:    false
        ,    closeOnEsc:    true
        ,    modal:        true
        
       /* ,    open:        function() {
                            if (!dialogLayout_pf)
                                // init layout *the first time* dialog opens
                                dialogLayout_pf = $("#dlg_list_pf").layout( dialogLayout_settings_pf );
                            else
                                // just in case - probably not required
                                dialogLayout_pf.resizeAll();
                        }
        ,    resize:        function(){ if (dialogLayout_pf) dialogLayout_pf.resizeAll(); }*/
        });
    
}

function show_dlg_pf()
{
    
    refresh_pf_grid(true);
    //$("#dlg_list_pf").dialog("open"); 
}

function close_dlg_pf()
{
    $("#dlg_list_pf").dialog("close");
}
function toggleFilterRow_pf() {
    if ($(grid_pf.getTopPanel()).is(":visible"))
        grid_pf.hideTopPanel();
    else
        grid_pf.showTopPanel();
}


var dataView_fm;
var grid_fm;
var data_fm = [];
var selectedRowIds_fm = [];
var columns_fm = [];
var options_fm = [] ;

function initiate_fm_grid()
{
    columns_fm = [
        {id:"fm_code", name:"PortfolioCode", field:"fm_code"},
        {id:"fm_name", name:"PortfolioName", field:"fm_name",width:320}
    ];
    options_fm = {
        editable: false,
        enableCellNavigation: false,
        asyncEditorLoading: false,
        enableRowNavigation: true,
        autoEdit: false
    };         
   /*dataView_fm = new Slick.Data.DataView();
    grid_fm = new Slick.Grid("#dlg_list_fm_tbl", dataView_fm, columns_fm, options_fm);*/
    grid_fm = new Slick.Grid("#dlg_list_fm_tbl", data_fm, columns_fm, options_fm);
    grid_fm.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
    grid_fm.onDblClick.subscribe(function(e) {   
        var cell = grid_fm.getCellFromEvent(e);
        if(top_menu_no==1 && leaf_menu_no==2)
            change_fm_maintenance_1_2(data_fm[cell.row].fm_code);
        else
            change_fm_name(data_fm[cell.row].fm_code,1);
            
        //if(top_menu_no==1 && leaf_menu_no==1)
        //    get_data_1_1($("#i_1_1_pf_code").val(),data_fm[cell.row].fm_code);
        close_dlg_fm();
    });
}

function refresh_fm_grid(show_dlg)
{
    state_progress(1);
    data_fm.length=0;
    var obj_get = $.getJSON(uri+'/index.php/tb/get_fundmanager_name/10', function(data) {
       for (var i=0; i<data.r_num_rows; i++) {
           var d = (data_fm[i] = {});
           d["id"] = i + data.r_sdata[i].FundManagerCode;
           d["fm_code"] = data.r_sdata[i].FundManagerCode;
           d["fm_name"] = data.r_sdata[i].FundManagerName;
       }                
    });
    obj_get.done(function(msg){     
        grid_fm.invalidateAllRows();
        grid_fm.updateRowCount();
        grid_fm.render();  
        if(show_dlg)      
        if(msg.r_login==false)
                show_dlg_login();
            else
                $("#dlg_list_fm").dialog("open"); 
        state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {   
        grid_fm.invalidateAllRows();
        grid_fm.updateRowCount();
        grid_fm.render();  
        if(show_dlg)      
        {
            $("#dlg_list_fm").dialog("open");  
            alert("Getting data error :"+textStatus);
        }
        state_progress(0);
    });
}

function create_dlg_fm()
{
    $("#dlg_list_fm").dialog({ 
            title:        'Daftar Fund Manager'
        ,    width:        350
        ,    height:        230
        ,    autoOpen:    false
        ,    closeOnEsc:    true
        ,    modal:        true
        
       /* ,    open:        function() {
                            if (!dialogLayout_pf)
                                // init layout *the first time* dialog opens
                                dialogLayout_pf = $("#dlg_list_pf").layout( dialogLayout_settings_pf );
                            else
                                // just in case - probably not required
                                dialogLayout_pf.resizeAll();
                        }
        ,    resize:        function(){ if (dialogLayout_pf) dialogLayout_pf.resizeAll(); }*/
        });
    
}

function show_dlg_fm()
{
    refresh_fm_grid(true);
    //$("#dlg_list_fm").dialog("open"); 
}

function close_dlg_fm()
{
    $("#dlg_list_fm").dialog("close");
}

var dataView_rc;
var grid_rc;
var data_rc = [];
var selectedRowIds_rc = [];
var columns_rc = [];
var options_rc = [] ;
var pos_rc = 1;

var pos_level =1;

function initiate_rc_grid()
{
    columns_rc = [
        {id:"ReportCode", name:"Report Code", field:"ReportCode",width:'330'},
    ];
    options_rc = {
        editable: false,
        enableCellNavigation: false,
        asyncEditorLoading: false,
        enableRowNavigation: true,
        autoEdit: false
    };         
    //dataView_rc = new Slick.Data.DataView();
    //grid_rc = new Slick.Grid("#dlg_list_rc_tbl", dataView_rc, columns_rc, options_rc);
    grid_rc = new Slick.Grid("#dlg_list_rc_tbl", data_rc, columns_rc, options_rc);
    grid_rc.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
    grid_rc.onDblClick.subscribe(function(e) {
        var cell = grid_rc.getCellFromEvent(e);
        var cur_code = $("#i_1_4_rc_code").val();
        $("#i_1_4_rc").val(data_rc[cell.row].ReportCode);
        close_dlg_rc();
    });
}

function refresh_rc_grid(tp,show_dlg)
{
    data_rc.length=0;
    var urinya = '';           
    urinya = uri+'/index.php/tb/get_distinct_rc/'+ decodeurl(tp);
    //alert(urinya);
    var obj_get = $.getJSON(urinya, function(data) {  
           for (var i=0; i<data.r_num_rows; i++) {
               var d = (data_rc[i] = {});
               d["id"] = i+data.r_sdata[i].LevelCode;
               d["ReportCode"] = data.r_sdata[i].ReportCode;
           }                
    });
    obj_get.done(function(msg){   
        grid_rc.invalidateAllRows();
        grid_rc.updateRowCount();
        grid_rc.render();
        if(show_dlg)      
            if(!msg.r_login)
                    show_dlg_login();
                else
                    $("#dlg_list_rc").dialog("open"); 
    });
    obj_get.fail(function(jqXHR, textStatus) {   
        grid_rc.invalidateAllRows();
        grid_rc.updateRowCount();
        grid_rc.render();
        if(show_dlg)      
        {
            $("#dlg_list_rc").dialog("open"); 
            alert("Getting data error :"+textStatus);
        }
    });
}             

function create_dlg_rc()
{
    $("#dlg_list_rc").dialog({ 
            title:        'Daftar Report Code'
        ,    width:        350
        ,    height:        230
        ,    autoOpen:    false
        ,    closeOnEsc:    true
        ,    modal:        true
                                        
        });
    
}

function show_dlg_rc(tp)
{                       
    refresh_rc_grid(tp,true);
}

function close_dlg_rc()
{
    $("#dlg_list_rc").dialog("close");
}


var dataView_lvl;
var grid_lvl;
var data_lvl = [];
var selectedRowIds_lvl = [];
var columns_lvl = [];
var options_lvl = [] ;
var pos_lvl = 1;

var pos_level =1;

function initiate_lvl_grid()
{
    columns_lvl = [
        {id:"LevelCode", name:"LevelCode", field:"LevelCode"},
        {id:"LevelDesc", name:"LevelDesc", field:"LevelDesc",width:320}
    ];
    options_lvl = {
        editable: false,
        enableCellNavigation: false,
        asyncEditorLoading: false,
        enableRowNavigation: true,
        autoEdit: false
    };         
    //dataView_rc = new Slick.Data.DataView();
    //grid_rc = new Slick.Grid("#dlg_list_rc_tbl", dataView_rc, columns_rc, options_rc);
    grid_lvl = new Slick.Grid("#dlg_list_lvl_tbl", data_lvl, columns_lvl, options_lvl);
    grid_lvl.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
    grid_lvl.onDblClick.subscribe(function(e) {
        var cell = grid_lvl.getCellFromEvent(e);
        var div_code ='#i_1_4_l0' + pos_level + '_code';
        var div_desc ='#i_1_4_l0' + pos_level + '_desc';
        var cur_code = $(div_code).val();
        //if(cur_code != data_rc[cell.row].LevelCode)
        //    clear_grid();
        $(div_code).val(data_lvl[cell.row].LevelCode);
        $(div_desc).val(data_lvl[cell.row].LevelDesc);
        /*if(pos_level==1)
            change_lvl_desc_1_4(1,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),data_rc[cell.row].LevelCode,$("#i_1_4_l02_code").val(),$("#i_1_4_l03_code").val());
        else if(pos_level==2)
            change_lvl_desc_1_4(2,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),$("#i_1_4_l01_code").val(),data_rc[cell.row].LevelCode.val(),$("#i_1_4_l03_code").val());
        else if(pos_level==3)
            change_lvl_desc_1_4(3,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),$("#i_1_4_l01_code").val(),$("#i_1_4_l02_code").val(),data_rc[cell.row].LevelCode);
        */
        close_dlg_lvl();
    });
}

function refresh_lvl_grid(act,rc,rt,lvl1,lvl2,show_dlg)
{
    data_lvl.length=0;
    var urinya = '';
    //alert(uri+'/index.php/tb/get_rc/'+ act +'/'+rt+'/'+rc);

    if(act==1)
        urinya = uri+'/index.php/tb/get_level_rc/'+ act +'/'+decodeurl(rt)+'/'+decodeurl(rc);
    else if(act==2)
        urinya = uri+'/index.php/tb/get_level_rc/'+ act +'/'+decodeurl(rt)+'/'+decodeurl(rc) + '/'+decodeurl(lvl1);
    else
        urinya = uri+'/index.php/tb/get_level_rc/'+ act +'/'+decodeurl(rt)+'/'+decodeurl(rc) + '/'+decodeurl(lvl1) +'/'+decodeurl(lvl2);
    //alert(urinya);
    //data_rc=[];
    var obj_get = $.getJSON(urinya, function(data) {  
           for (var i=0; i<data.r_num_rows; i++) {
               var d = (data_lvl[i] = {});
               d["id"] = data.r_sdata[i].LevelCode;
               d["LevelCode"] = data.r_sdata[i].LevelCode;
               d["LevelDesc"] = data.r_sdata[i].LevelDesc;
           }                
    });
    obj_get.done(function(msg){   
        grid_lvl.invalidateAllRows();
        grid_lvl.updateRowCount();
        grid_lvl.render();
        if(show_dlg)      
            if(msg.r_login==false)
                    show_dlg_login();
                else
                    $("#dlg_list_lvl").dialog("open"); 
    });
    obj_get.fail(function(jqXHR, textStatus) {   
        grid_lvl.invalidateAllRows();
        grid_lvl.updateRowCount();
        grid_lvl.render();
        if(show_dlg)      
        {
            $("#dlg_list_lvl").dialog("open"); 
            alert("Getting data error :"+textStatus);
        }
    });
}             

function create_dlg_lvl()
{
    $("#dlg_list_lvl").dialog({ 
            title:        'Daftar Level Code'
        ,    width:        350
        ,    height:        230
        ,    autoOpen:    false
        ,    closeOnEsc:    true
        ,    modal:        true
        
       /* ,    open:        function() {
                            if (!dialogLayout_pf)
                                // init layout *the first time* dialog opens
                                dialogLayout_pf = $("#dlg_list_pf").layout( dialogLayout_settings_pf );
                            else
                                // just in case - probably not required
                                dialogLayout_pf.resizeAll();
                        }
        ,    resize:        function(){ if (dialogLayout_pf) dialogLayout_pf.resizeAll(); }*/
        });
    
}

function show_dlg_lvl(act,rc,rt,lvl1,lvl2)
{
    pos_level=act;
    refresh_lvl_grid(act,rc,rt,lvl1,lvl2,true);
}

function close_dlg_lvl()
{
    $("#dlg_list_lvl").dialog("close");
}

var data_src_acc=[];
var grid_acc;
var data_acc = [];
var selectedRowIds_acc = [];
var columns_acc = [];
var options_acc = [] ;
function initiate_acc_grid()
{
    columns_acc = [
        {id:"AccNumber", name:"Account number", field:"AccNumber",width:100},
        {id:"AccName", name:"Account name", field:"AccName",width:280}
    ];
    options_acc = {
        editable: false,
            enableAddRow: false,
            enableCellNavigation: false,
            asyncEditorLoading: true,
            autoEdit: false

    };         
    grid_acc = new Slick.Grid("#dlg_list_acc_tbl", data_acc, columns_acc, options_acc);
    grid_acc.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
    $("#pnl_filter_acc")
                .appendTo(grid_acc.getTopPanel())
                .show();
    
    grid_acc.onDblClick.subscribe(function(e) {
        var cell = grid_acc.getCellFromEvent(e);
        if(trim(data_acc[cell.row].AccNo)!='')
        {
            if(top_menu_no==1 && leaf_menu_no==4)
                change_det_grid_1_4(data_acc[cell.row].AccNumber,data_acc[cell.row].AccName,data_acc[cell.row].AccType,false)
            else
                change_acc_name(data_acc[cell.row].AccNo,data_acc[cell.row].AccName);
        }
        //$(div_code).val(data_rc[cell.row].LevelCode);
        //$(div_desc).val(data_rc[cell.row].LevelDesc);
        /*if(pos_level==1)
            change_lvl_desc_1_4(1,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),data_rc[cell.row].LevelCode,$("#i_1_4_l02_code").val(),$("#i_1_4_l03_code").val());
        else if(pos_level==2)
            change_lvl_desc_1_4(2,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),$("#i_1_4_l01_code").val(),data_rc[cell.row].LevelCode.val(),$("#i_1_4_l03_code").val());
        else if(pos_level==3)
            change_lvl_desc_1_4(3,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),$("#i_1_4_l01_code").val(),$("#i_1_4_l02_code").val(),data_rc[cell.row].LevelCode);
        */
        close_dlg_acc();
    });
    $("#filter_list_acc").keyup(function(){
        filter_acc_grid(this.value);
    });
}

function refresh_acc_grid(pf_code,rc,rt,lvl1,lvl2,lvl3,show_dlg)
{
    state_progress(1);
    data_acc.length=0;
    data_src_acc.length=0;
    var urinya = '';
    
    $("#filter_list_acc").val('');
    urinya = uri+'/index.php/tb/get_gl_account/'+decodeurl(pf_code)+'/'+decodeurl(rc) +'/'+decodeurl(rt) + '/'+decodeurl(lvl1) +'/'+decodeurl(lvl2)+'/'+decodeurl(lvl3);
    //alert(urinya);
    
     var obj_get = $.getJSON(urinya, function(data) {
        //alert(data.r_num_rows);
    //alert('b');
       for (var i=0; i<data.r_num_rows; i++) {
           var d = (data_acc[i] = {});
           d["id"] = data.r_sdata[i].AccountNo + i;
           d["AccNumber"] = data.r_sdata[i].Number;
           d["AccNo"] = data.r_sdata[i].AccountNo;
           d["AccName"] = data.r_sdata[i].AccountName;
       }
       data_src_acc = data_acc.slice(0);
     });
     obj_get.done(function(msg){
    //alert('c');
       grid_acc.invalidateAllRows();
       grid_acc.updateRowCount();
       grid_acc.render(); 
       if(show_dlg)      
            if(msg.r_login==false)
                    show_dlg_login();
                else
                    $("#dlg_list_acc").dialog("open");
       state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {
    //alert('d');
        grid_acc.invalidateAllRows();
       grid_acc.updateRowCount();
       grid_acc.render(); 
       if(show_dlg)      
        {
            $("#dlg_list_acc").dialog("open"); 
            alert("Getting data error :"+textStatus);
        }
        state_progress(0);
    });
}
function filter_acc_grid(key_filter)
{
    //var key_filter = $("#filter_list_acc").val();
    var i_item=0;
    data_acc.length=0;
    for (var i=0; i<data_src_acc.length; i++) {
        if(data_src_acc[i]["AccNumber"].indexOf(key_filter) != -1)
        {
           var d = (data_acc[i_item] = {});
           d["id"] = data_src_acc[i]["id"];
           d["AccNumber"] = data_src_acc[i]["AccNumber"];
           d["AccNo"] = data_src_acc[i]["AccNo"];
           d["AccName"] = data_src_acc[i]["AccName"];
           i_item++;
        }
    }
    //alert(data_acc.length);
    grid_acc.invalidateAllRows();
    grid_acc.updateRowCount();
    grid_acc.render();
}
function create_dlg_acc()
{
    $("#dlg_list_acc").dialog({ 
            title:        'Daftar Account Code'
        ,    width:        360
        ,    height:        230
        ,    autoOpen:    false
        ,    closeOnEsc:    true
        ,    modal:        true
        , resizeable : false
        });
    
}

function show_dlg_acc(pf_code,rc,rt,lvl1,lvl2,lvl3)
{              
    refresh_acc_grid(pf_code,rc,rt,lvl1,lvl2,lvl3,true);
}

function close_dlg_acc()
{
    $("#dlg_list_acc").dialog("close");
}

function toggleFilterRow_acc() {
    if ($(grid_acc.getTopPanel()).is(":visible"))
        grid_acc.hideTopPanel();
    else
        grid_acc.showTopPanel();
}



