var grid_pf;
var data_pf = []; 
var data_search_pf = []; 

var select_mode_pf = 0;

function pf_initiate()
{
    $("#pf_i_curyear_dlg").datepicker();$("#pf_i_curyear_dlg").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    pf_initiate_grid();
    pf_initiate_dlg_new();
    $("#pf_b_new").click(function(){
        ipt_blank_select_pf(true);
        ipt_pf_load('ALL',$("#pf_s_pfgl_dlg"), 2);
        pf_reset_dlg();
        ipt_blank_select_pf(false)
        ipt_enable($("#pf_i_pf_code_dlg"),true);
        $("#pf_dlg_new").dialog('open');
    });
    $("#pf_b_edit").click(function(){
        var pf_selected_row  = grid_pf.getActiveCell();
        if(pf_selected_row)
        {
            if(pf_selected_row.row>=data_pf.length)
                alert('Choose the portfolio fisrt!');
            else
            {
                ipt_enable($("#pf_i_pf_code_dlg"),false);
                pf_get_data_dlg(data_pf[pf_selected_row.row].pfcode);
                ipt_blank_select_pf(true);
                ipt_pf_load('ALL',$("#pf_s_pfgl_dlg"), 2);
                $("#pf_dlg_new").dialog('open');
                //$("#pf_s_pfgl_dlg").val('');
            }
        }
        else alert('Choose the portfolio fisrt!');
    });
    $("#pf_b_reload").click(function(){
        pf_load_data($("#pf_s_fm").val());
        ipt_pf_set_default(this.value);
    });
    $("#pf_s_fm").change(function(){
        pf_load_data(this.value);
        ipt_fm_set_default(this.value);
    });
    $("#pf_b_search").click(function(){
        pf_search($("#pf_i_pf_search").val());        
    });
    $("#pf_i_pf_search").keyup(function(e){
        if(e.keyCode == 13) 
            pf_search(this.value);
    });
    
    grid_pf.onDblClick.subscribe(function(e) {     
        var pf_selected_cell = grid_pf.getCellFromEvent(e);
        pf_get_data_dlg(data_pf[pf_selected_cell.row].pfcode);
        ipt_enable($("#pf_i_pf_code_dlg"),false);
        ipt_blank_select_pf(true); 
        ipt_pf_load('ALL',$("#pf_s_pfgl_dlg"), 2);
        $("#pf_dlg_new").dialog('open');
        //$("#pf_s_pfgl_dlg").val('');
    });
}
function pf_show()
{
    var  ia_fm ='ALL';
    if (ipt_check_fm()!='_*_M')
        ia_fm=  ipt_check_fm(); 
    ipt_fm_load($("#pf_s_fm"),1,$("#pf_s_fm_dlg"),1);  
    pf_load_data(ia_fm); 
    
}

function pf_initiate_grid()
{
    var columns_pf = [];
    var options_pf = [];
    columns_pf = [
        {id:"pfcode", name:"CODE", field:"pfcode",width:50}
        ,{id:"scode", name:"SINVEST", field:"scode",width:110}
        ,{id:"pfname", name:"NAME", field:"pfname",width:240}
        ,{id:"fmname", name:"FM NAME", field:"fmname",width:160}
        ,{id:"curryear_s", name:"CURR YEAR", field:"curryear_s",width:70}
        ,{id:"cur", name:"CUR", field:"cur",cssClass:"cell_center",width:30}
        ,{id:"flag", name:"ACTIVE", field:"flag",cssClass:"cell_center",width:50}
        ,{id:"time", name:"TIME", field:"time",cssClass:"cell_center",width:50}        
        ,{id:"tb", name:"TB Flag", field:"tb",width:50}
        ,{id:"mm", name:"MM FUND", field:"mm",cssClass:"cell_center",width:60}
        ,{id:"t", name:"TYPE ", field:"t",cssClass:"cell_center",width:50}
        ,{id:"pdec", name:"PRICE DEC", field:"pdec",cssClass:"cell_right",width:70}
        ,{id:"ndec", name:"NAV DEC", field:"ndec",cssClass:"cell_right",width:70}
        ,{id:"udec", name:"UNIT DEC", field:"udec",cssClass:"cell_right",width:70}
        ,{id:"ftypename", name:"Orchid Type", field:"ftypename",width:50}
        ,{id:"fkindname", name:"Orchis Kind", field:"fkindname",width:50}
        ,{id:"mail", name:"Mail Flag", field:"mail",width:50}
        ,{id:"mailtb", name:"Mail Flag TB", field:"mailtb",width:50}
        ,{id:"mailval", name:"Mail Flag Val", field:"mailval",width:50}
    ];

    options_pf = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_pf = new Slick.Grid("#pf_slick", data_pf, columns_pf, options_pf);
    grid_pf.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function pf_initiate_dlg_new()
{
    $("#pf_dlg_new").dialog({ 
            title:        'Portfolio'
        ,    width:        560
        ,    height:        450
        ,    autoOpen:    false
        ,   resizable: false
        ,    closeOnEsc:    true
        ,    modal:        true
        ,buttons: {
             "Simpan": function(){pf_save_data();},
             "Batal": function(){ $(this).dialog("close");}
        }
    });
}
function pf_load_data(p_fm)
{
    c_status('pf',1);
    var pf_post = $.post(uri+'/index.php/cportfolio/list_data',{fm:p_fm},function(pf_data) { },'json');
    pf_post.done(function(pf_msg){   
        if(pf_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        data_pf.length=0;
        data_search_pf.length=0;
        for (var i=0; i<pf_msg.r_rows; i++) {
           var d = (data_pf[i] = {});     
           d["pfcode"] = pf_msg.r_data[i].pfcode;          
           d["scode"] = pf_msg.r_data[i].SINVESTCODE;          
           d["pfname"] = pf_msg.r_data[i].pfname; 
           d["fmname"] = pf_msg.r_data[i].fmname; 
           d["curryear_s"] = pf_msg.r_data[i].curryear_s; 
           d["cur"] = pf_msg.r_data[i].cur; 
           d["flag"] = pf_msg.r_data[i].flag; 
           d["time"] = pf_msg.r_data[i].time; 
           d["mm"] = pf_msg.r_data[i].mm; 
           d["t"] = pf_msg.r_data[i].t; 
           d["pdec"] = pf_msg.r_data[i].pdec; 
           d["ndec"] = pf_msg.r_data[i].ndec; 
           d["udec"] = pf_msg.r_data[i].udec;  
           d["mail"] = pf_msg.r_data[i].mail;
           d["mailtb"] = pf_msg.r_data[i].mailtb;
           d["mailval"] = pf_msg.r_data[i].mailval;
           d["ftypename"] = pf_msg.r_data[i].ftypename;
           d["fkindname"] = pf_msg.r_data[i].fkindname;
           d["ftype"] = pf_msg.r_data[i].ftype;
           d["fkind"] = pf_msg.r_data[i].fkind;
           d["tb"] = pf_msg.r_data[i].crpt;
           var e = (data_search_pf[i] = {});     
           e["pfcode"] = pf_msg.r_data[i].pfcode;          
           e["pfname"] = pf_msg.r_data[i].pfname; 
           e["fmname"] = pf_msg.r_data[i].fmname; 
           e["curryear_s"] = pf_msg.r_data[i].curryear_s; 
           e["cur"] = pf_msg.r_data[i].cur; 
           e["flag"] = pf_msg.r_data[i].flag; 
           e["time"] = pf_msg.r_data[i].time; 
           e["mm"] = pf_msg.r_data[i].mm; 
           e["t"] = pf_msg.r_data[i].t; 
           e["pdec"] = pf_msg.r_data[i].pdec; 
           e["ndec"] = pf_msg.r_data[i].ndec; 
           e["udec"] = pf_msg.r_data[i].udec;  
           e["mail"] = pf_msg.r_data[i].mail;
           e["mailtb"] = pf_msg.r_data[i].mailtb;
           e["mailval"] = pf_msg.r_data[i].mailval;
           e["ftypename"] = pf_msg.r_data[i].ftypename;
           e["fkindname"] = pf_msg.r_data[i].fkindname;
           e["ftype"] = pf_msg.r_data[i].ftype;
           e["fkind"] = pf_msg.r_data[i].fkind;
           e["tb"] = pf_msg.r_data[i].crpt;
        }       
        grid_pf.invalidateAllRows();
        grid_pf.updateRowCount();
        grid_pf.render();
        c_status('pf',0);
    });
    pf_post.fail(function(jqXHR, textStatus) {c_status('pf',0);});
}
function pf_save_data()
{
    if(!confirm('Save data?'))
        return 0;
    c_status('pf',1);
    var pfsave_post = $.post(uri+'/index.php/cportfolio/save_data',{
        pf_code:$("#pf_i_pf_code_dlg").val(),
        pf_scode:$("#pf_i_pf_sinvestcode_dlg").val(),
        pf_name:$("#pf_i_pf_name_dlg").val(),
        pf_fm:$("#pf_s_fm_dlg").val(),
        pf_cy:$("#pf_i_curyear_dlg").val(),
        pf_cur:$("#pf_s_cur_dlg").val(),
        pf_active:$("#pf_s_active_dlg").val(),
        pf_ph:$("#pf_i_time_dlg").val(),
        pf_mm:$("#pf_s_mm_dlg").val(),
        pf_type:$("#pf_s_type_dlg").val(),
        pf_pdec:$("#pf_i_pdec_dlg").val(),
        pf_ndec:$("#pf_s_ndec_dlg").val(),
        pf_udec:$("#pf_s_udec_dlg").val(),
        pf_mail:$("#pf_s_mail_dlg").val(),
        pf_mailtb:$("#pf_s_mailtb_dlg").val(),
        pf_mailval:$("#pf_s_mailval_dlg").val(),
        pf_gl:$("#pf_s_pfgl_dlg").val(),
        pf_otype:$("#pf_s_otype_dlg").val(),
        pf_okind:$("#pf_s_okind_dlg").val(),
        pf_tb:$("#pf_s_tb_dlg").val()
    },function(pfsave_data) { });
    pfsave_post.done(function(pfsave_msg){
        $("#pf_s_fm").val($("#pf_s_fm_dlg").val());
        pf_load_data($("#pf_s_fm_dlg").val()); 
        if(pfsave_msg=='0')
            c_nosession();
        else if(pfsave_msg=='1')
        {
            alert('Success saving data!');
            $("#pf_dlg_new").dialog('close');
        }
        else
            alert('error saving data!');
        c_status('pf',0);
    });
    pfsave_post.fail(function(jqXHR, textStatus) {alert('error saving data!');c_status('pf',0);});
}

function pf_reset_dlg()
{    
    $("#pf_i_pf_code_dlg").val('');
    $("#pf_i_pf_sinvestcode_dlg").val('');
    $("#pf_i_pf_name_dlg").val('');
    $("#pf_s_fm_dlg").val($("#pf_s_fm").val());
    $("#pf_i_curyear_dlg").val(start_year_svr_dt);
    $("#pf_s_cur_dlg").val('IDR');
    $("#pf_s_active_dlg").val('Y');
    $("#pf_i_time_dlg").val('00:00');
    $("#pf_s_mm_dlg").val('N');
    $("#pf_s_type_dlg").val('RDN'); 
    $("#pf_i_pdec_dlg").val('3');
    $("#pf_s_ndec_dlg").val('4');
    $("#pf_s_udec_dlg").val('3');
    $("#pf_s_mail_dlg").val('0');
    $("#pf_s_mailtb_dlg").val('0');
    $("#pf_s_mailval_dlg").val('0');
    $("#pf_s_pfgl_dlg").val('')
    $("#pf_s_otype_dlg").val(3);
    $("#pf_s_okind_dlg").val(1);
    $("#pf_s_tb_dlg").val(1);
}
function pf_get_data_dlg(p_pf)
{
    c_status('pf',1);
    var pf_post = $.post(uri+'/index.php/cportfolio/get_data',{pf_code:p_pf},function(pf_data) { },'json');
    pf_post.done(function(pf_msg){ 
        if(pf_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        if(pf_msg.r_rows==0)
            pf_reset_dlg();
        else
        {
            $("#pf_i_pf_code_dlg").val(pf_msg.r_data[0].pfcode);
            $("#pf_i_pf_sinvestcode_dlg").val(pf_msg.r_data[0].SINVESTCODE);
            $("#pf_i_pf_name_dlg").val(pf_msg.r_data[0].pfname);
            $("#pf_s_fm_dlg").val(pf_msg.r_data[0].fmcode);
            $("#pf_i_curyear_dlg").val(pf_msg.r_data[0].curryear_s);
            $("#pf_s_cur_dlg").val(pf_msg.r_data[0].cur);
            $("#pf_s_active_dlg").val(pf_msg.r_data[0].flag);
            $("#pf_i_time_dlg").val(pf_msg.r_data[0].time);
            $("#pf_s_mm_dlg").val(pf_msg.r_data[0].mm);
            $("#pf_s_type_dlg").val(pf_msg.r_data[0].mmtype);
            $("#pf_i_pdec_dlg").val(pf_msg.r_data[0].pdec);
            $("#pf_s_ndec_dlg").val(pf_msg.r_data[0].ndec);
            $("#pf_s_udec_dlg").val(pf_msg.r_data[0].udec);
            $("#pf_s_mail_dlg").val(pf_msg.r_data[0].mail);
            $("#pf_s_mailtb_dlg").val(pf_msg.r_data[0].mailtb);
            $("#pf_s_mailval_dlg").val(pf_msg.r_data[0].mailval);
            $("#pf_s_otype_dlg").val(pf_msg.r_data[0].ftype);
            $("#pf_s_okind_dlg").val(pf_msg.r_data[0].fkind);
            $("#pf_s_tb_dlg").val(pf_msg.r_data[0].crpt);
        }               
        c_status('pf',0);
    });
    pf_post.fail(function(jqXHR, textStatus) {pf_reset_dlg();c_status('pf',0);});
}
function pf_search(p_search)
{
    var spf_search= p_search.toLowerCase();
    data_pf.length=0;
    var irows=0;
    
    for (var i=0; i<data_search_pf.length; i++) {
        if(data_search_pf[i].pfcode.toLowerCase().indexOf(spf_search)!=-1 || data_search_pf[i].pfname.toLowerCase().indexOf(spf_search)!=-1)
        {
           var d = (data_pf[irows++] = {});     
           d["pfcode"] = data_search_pf[i].pfcode;          
           d["scode"] = data_search_pf[i].SINVESTCODE;          
           d["pfname"] = data_search_pf[i].pfname; 
           d["fmname"] = data_search_pf[i].fmname; 
           d["curryear_s"] = data_search_pf[i].curryear_s; 
           d["cur"] = data_search_pf[i].cur; 
           d["flag"] = data_search_pf[i].flag; 
           d["time"] = data_search_pf[i].time; 
           d["mm"] = data_search_pf[i].mm; 
           d["mmtype"] = data_search_pf[i].mmtype;
           d["pdec"] = data_search_pf[i].pdec; 
           d["ndec"] = data_search_pf[i].ndec; 
           d["udec"] = data_search_pf[i].udec;  
           d["mail"] = data_search_pf[i].mail;
           d["mailtb"] = data_search_pf[i].mailtb;
           d["mailval"] = data_search_pf[i].mailval;
           d["ftypename"] = data_search_pf[i].ftypename;
           d["fkindname"] = data_search_pf[i].fkindname;
           d["ftype"] = data_search_pf[i].ftype;
           d["fkind"] = data_search_pf[i].fkind;
           d["tb"] = data_search_pf[i].tb;
        }
    }       
    grid_pf.invalidateAllRows();
    grid_pf.updateRowCount();
    grid_pf.render();
}