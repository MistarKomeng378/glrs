
var grid_1_4;
var data_1_4 = [];
var selectedRowIds_1_4 = [];
var columns_1_4 = [];
var options_1_4 = [] ;
var activeRow_1_4 = 0;

function initiate_form_1_4()
{
     $("#i_1_4_pf_code").keyup(function(e){
        if(is_not_tabenter(e.keyCode))
            change_pf_name(this.value,2);
        if(e.keyCode==112){
            show_dlg_pf();
        }
    });   
    $("#i_1_4_rc").keyup(function(e){
        if(e.keyCode==112){
            show_dlg_rc($("#i_1_4_rt").val());
        }
    }); 
    $("#i_1_4_l01_code").keyup(function(e){ 
        change_lvl_desc_1_4(1,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),this.value);
        //if(e.keyCode!=112)
            clear_form_1_4(1);
        if(e.keyCode==112)             
            show_dlg_lvl(1,$("#i_1_4_rc").val(),$("#i_1_4_rt").val());
    });
    $("#i_1_4_l02_code").keyup(function(e){
        change_lvl_desc_1_4(2,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),$("#i_1_4_l01_code").val(),this.value);
       // if(e.keyCode!=112)
            clear_form_1_4(2);
         if(e.keyCode==112)
            show_dlg_lvl(2,$("#i_1_4_rc").val(),$("#i_1_4_rt").val(),$("#i_1_4_l01_code").val());
    });
    $("#i_1_4_l03_code").keyup(function(e){
        change_lvl_desc_1_4(3,$("#i_1_4_rt").val(),$("#i_1_4_rc").val(),$("#i_1_4_l01_code").val(),$("#i_1_4_l02_code").val(),this.value);
        //if(e.keyCode!=112)
            clear_form_1_4(3);
         if(e.keyCode==112)
            show_dlg_lvl(3,$("#i_1_4_rc").val(),$("#i_1_4_rt").val(),$("#i_1_4_l01_code").val(),$("#i_1_4_l02_code").val());
    });
    
    $("#b_1_4_save").click(function(){
        //alert($.toJSON(data_1_4));
        if(confirm("Are you want to save?"))
            post_1_4();
    });     
    $("#b_1_4_view").click(function(){
         refresh_grid_1_4();
    });
    $("#b_1_4_refresh").click(function(){
        clear_form_1_4(0);
        clear_grid();
    });
    clear_form_1_4(0);
    initiate_grid_1_4();
}

function change_lvl_desc_1_4(act,rt,rc,lvl1_code,lvl2_code,lvl3_code)
{                                                                  
    var ada = false;
    var div_name = '#i_1_4_l0'+act+'_desc';
    var urinya = '';
    if(act==1)
        urinya = uri+'/index.php/tb/get_level_desc/'+ act +'/'+ decodeurl(rt)+'/'+ decodeurl(rc) + '/'+ decodeurl(lvl1_code);       
    else if(act==2)
        urinya = uri+'/index.php/tb/get_level_desc/'+ act +'/'+ decodeurl(rt)+'/'+ decodeurl(rc) + '/'+ decodeurl(lvl1_code) +'/'+decodeurl(lvl2_code);   
    else
        urinya = uri+'/index.php/tb/get_level_desc/'+ act +'/'+ decodeurl(rt)+'/'+ decodeurl(rc) + '/'+ decodeurl(lvl1_code) +'/'+decodeurl(lvl2_code)+ '/' + decodeurl(lvl3_code);
    
    //alert(urinya);
    var obj_get = $.getJSON(urinya, function(data) {
      if(data.r_num_rows>=1)
      {
        $(div_name).val(data.r_sdata[0].LevelDesc);
        ada =true;
      }
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
                show_dlg_login();
        else if(!ada)
            $(div_name).val('');
    });
    obj_get.fail(function(jqXHR, textStatus) {
        $(div_name).val('');
        alert("Error getting data :" + textStatus);
    });
}
function clear_form_1_4(no)
{
    if(no==0)
    {
        $("#i_1_4_rc").val('');
        $("#i_1_4_pf_code").val('');
        $("#i_1_4_pf_name").val('');
    }
    var div_code='';
    var div_desc='';
    for(var i=1;i<4;i++)
    {
        if(i>no)
        {
            //alert(i);
            //alert(no);
            div_code = '#i_1_4_l0' + i +'_code';
            div_desc = '#i_1_4_l0' + i +'_desc';
            $(div_code).val('');
            $(div_desc).val('');
        }
    }
}

function post_1_4()
{
    state_progress(1);            
    var obj_post = $.post(uri+"/index.php/tb_save/save_report_param", 
        { pf_code:$("#i_1_4_pf_code").val(), 
        rep_type:$("#i_1_4_rt").val(),
        rep_code:$("#i_1_4_rc").val(),
        code01:$("#i_1_4_l01_code").val(), desc01:$("#i_1_4_l01_desc").val(),
        code02:$("#i_1_4_l02_code").val(), desc02:$("#i_1_4_l02_desc").val(),
        code03:$("#i_1_4_l03_code").val(), desc03:$("#i_1_4_l03_desc").val(),
        data_account:$.toJSON(data_1_4)},function(data) {
            
        //alert(data);
        //if(data.r_success==1)
        clear_form_1_5();               
        //else  
        //set_status("Data total unit issued gagal disimpan! Error koneksi ke database/ hilangkan tanda petik ' !",1);
    },"json");
    obj_post.done(function(msg){
        //alert(msg);
        if(!msg.r_login)                                                     
                show_dlg_login();
        else
             alert("Saving data success!");
        state_progress(0);
        refresh_grid_1_4();
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        alert("Saving data error :" + textStatus);
        state_progress(0);
    });
}

//var dataView_1_4;   

function requiredFieldValidator_1_4(value) {
            if (value == null || value == undefined || !value.length)
                return {valid:false, msg:"This is a required field"};
            else
                return {valid:true, msg:null};
        }

function TextCellEditor_1_4(args) {
    var $input;
    var defaultValue;
    var scope = this;

    this.init = function() {
        $input = $("<INPUT type=text class='editor-text' />")
            .appendTo(args.container)
            .bind("keydown.nav",scope.handleKeyDown)
            .focus()
            .select();  
    };

     this.handleKeyDown = function(e) {
         if(e.keyCode==112)
         {
            var cell = grid_1_4.getCellFromEvent(e);
            activeRow_1_4 = cell.row;
            show_dlg_acc($("#i_1_4_pf_code").val(),$("#i_1_4_rc").val(),$("#i_1_4_rt").val(),$("#i_1_4_l01_code").val(),$("#i_1_4_l02_code").val(),$("#i_1_4_l03_code").val());
         }
         
         if (e.keyCode == $.ui.keyCode.LEFT || e.keyCode == $.ui.keyCode.RIGHT || e.keyCode == $.ui.keyCode.TAB) {
            e.stopImmediatePropagation();
         }
     };
    
    this.destroy = function() {
        $input.remove();
    };

    this.focus = function() {
        $input.focus();
    };

    this.getValue = function() {
        return $input.val();
    };

    this.setValue = function(val) {
        $input.val(val);
    };

    this.loadValue = function(item) {
        defaultValue = item[args.column.field] || "";
        $input.val(defaultValue);
        $input[0].defaultValue = defaultValue;
        $input.select();
    };

    this.serializeValue = function() {
        return $input.val();
    };

    this.applyValue = function(item,state) {
        item[args.column.field] = state;
    };

    this.isValueChanged = function() {
        return (!($input.val() == "" && defaultValue == null)) && ($input.val() != defaultValue);
    };

    this.validate = function() {
        if (args.column.validator) {
            var validationResults = args.column.validator($input.val());
            if (!validationResults.valid)
                return validationResults;
        }

        return {
            valid: true,
            msg: null
        };
    };

    this.init();
}
 /*function DCSelectCellEditor(args) {
    var $select;
    var defaultValue;
    var scope = this;

    this.init = function() {
        $select = $("<SELECT tabIndex='0' class='editor-yesno'><OPTION value='D'>Debet</OPTION><OPTION value='C'>Credit</OPTION></SELECT>");
        $select.appendTo(args.container);
        $select.focus();
    };

    this.destroy = function() {
        $select.remove();
    };

    this.focus = function() {
        $select.focus();
    };

    this.loadValue = function(item) {
        //select.val((defaultValue = item[args.column.field]) ? "D" : "C");
        $select.val(defaultValue = item[args.column.field]);
        $select.select();
    };

    this.serializeValue = function() {
        //return ($select.val() == "D");
        return $select.val();
    };

    this.applyValue = function(item,state) {
        item[args.column.field] = state;
    };
   
    this.isValueChanged = function() {
        return ($select.val() != defaultValue);
    };

    this.validate = function() {
        return {
            valid: true,
            msg: null
        };
    };

    this.init();
}
*/
function CenterCellFormatter(row, cell, value, columnDef, dataContext) {
    return value=='D' ? "<center>D</center>" : "<center>C</center>";
}  
function initiate_grid_1_4()
{
    columns_1_4 = [
        {id:"AccNo", name:"Account no", field:"AccNo",editor:TextCellEditor_1_4, validator:requiredFieldValidator_1_4},
        {id:"AccName", name:"Account name", field:"AccName",width:240,editor:TextCellEditor_1_4, validator:requiredFieldValidator_1_4},
        {id:"AccType", name:"Account type", field:"AccType",editor:TextCellEditor_1_4, validator:requiredFieldValidator_1_4,formatter:CenterCellFormatter},
        //{id:"AccSign", name:"Normal Sign", field:"AccSign",editor:DCSelectCellEditor, formatter:DCCellFormatter,validator:requiredFieldValidator_1_4},
        //{id:"AccCurr", name:"Currency", field:"AccCurr",editor:TextCellEditor, validator:requiredFieldValidator_1_4},
        {id:"AddCheck", name:"Add",cssClass:"cell_add_check", field:"AddCheck",  formatter:BoolCellFormatter,editor:YesNoCheckboxCellEditor}
    ];
    options_1_4 = {
        editable: true,
            enableAddRow: true,
            enableCellNavigation: true,
            asyncEditorLoading: false,
            autoEdit: false

    };         
    /*dataView_1_4 = new Slick.Data.DataView();
    grid_1_4 = new Slick.Grid("#list_1_4", dataView_1_4, columns_1_4, options_1_4);*/
    grid_1_4 = new Slick.Grid("#list_1_4", data_1_4, columns_1_4, options_1_4);
    //grid_1_4.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));
    grid_1_4.setSelectionModel(new Slick.CellSelectionModel());
//    /$("#list_1_4").show();
    grid_1_4.onAddNewRow.subscribe(function(e, args) {
        var item = args.item;
        var column = args.column;
        grid_1_4.invalidateRow(data_1_4.length);
        data_1_4.push(item);
        grid_1_4.updateRowCount();
        grid_1_4.render();
    });

}

function refresh_grid_1_4()
{
    state_progress(1);
    data_1_4.length=0;
    var urinya = '';
    //function get_param_account($pf_code,$rc,$rt,$lvl1="",$lvl2="",$lvl3="")
    urinya = uri+'/index.php/tb/get_param_account/'+ decodeurl($("#i_1_4_pf_code").val()) +'/'+ decodeurl($("#i_1_4_rc").val()) +'/'+decodeurl($("#i_1_4_rt").val())+'/'+decodeurl($("#i_1_4_l01_code").val())+'/'+decodeurl($("#i_1_4_l02_code").val())+'/'+decodeurl($("#i_1_4_l03_code").val());
    //alert(uri+'/index.php/tb/get_rc/'+ act +'/'+rt+'/'+rc);
//alert(urinya);
    //data_rc=[];
     var obj_get = $.getJSON(urinya, function(data) {
        //alert(data.r_num_rows);
       for (var i=0; i<data.r_num_rows; i++) {
           var d = (data_1_4[i] = {});
           d["id"] = data.r_sdata[i].Account + i;
           d["AccNo"] = data.r_sdata[i].Account;
           d["AccName"] = data.r_sdata[i].AccountName;  
           d["AccType"] = data.r_sdata[i].AccountType;
           //d["AccSign"] = data.r_sdata[i].NormalSign;
           //d["AccCurr"] = data.r_sdata[i].Currency;
           d["AddCheck"] = (data.r_sdata[i].Flag=='Y');
       }
     });
     obj_get.done(function(msg){
       /*dataView_rc.beginUpdate();
       dataView_rc.setItems(data_rc);
       dataView_rc.endUpdate();    */
       
       //grid_rc.invalidateRow(data_rc.length);
       grid_1_4.invalidateAllRows();
       grid_1_4.updateRowCount();
       grid_1_4.render(); 
       state_progress(0);
    });
    obj_get.fail(function(jqXHR, textStatus) {
        grid_1_4.invalidateAllRows();
       grid_1_4.updateRowCount();
       grid_1_4.render(); 
       state_progress(0);
    });
}
function clear_grid()
{
    data_1_4.length=0;
    grid_1_4.invalidateAllRows();
    grid_1_4.updateRowCount();
    grid_1_4.render();
}

function save_number()
{
    
}
function change_det_grid_1_4(accno,accname,acctype,acccheck)
{                
    var i = activeRow_1_4;
    var d = (data_1_4[i] = {});
       d["id"] = accno + i;
       d["AccNo"] = accno;
       d["AccName"] = accname;
       d["AccType"] = acctype;
       d["AddCheck"] = acccheck;
    
     grid_1_4.invalidateAllRows();
     grid_1_4.updateRowCount();
     grid_1_4.render();
}