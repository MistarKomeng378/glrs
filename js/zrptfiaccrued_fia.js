var grid_fia;
var data_fia = []; 
var data_fia_tmp = []; 
var select_mode_fia = 0;

function fia_initiate()
{
    $("#fia_i_date").datepicker();$("#fia_i_date").datepicker( "option", "dateFormat", 'dd-mm-yy' ); 
    $("#fia_s_fm").change(function(){
        ipt_pf_load_select($("#fia_s_pf"),2,this.value);
        fia_reset();
    });
    $("#fia_s_pf").change(function(){
        ipt_check_nav_status(this.value,$("#fia_i_date").val(),$("#fia_s_last_dt"),$("#fia_s_ns"),$("#fia_s_last_gl_dt"),$("#fia_s_gs"),false,false,'','');
    });        
    $("#fia_i_date").change(function(){
        ipt_check_nav_status($("#fia_s_pf").val(),this.value,$("#fia_s_last_dt"),$("#fia_s_ns"),$("#fia_s_last_gl_dt"),$("#fia_s_gs"),false,false,'','');
    });        
    $("#fia_b_view").click(function(){
        if(  $("#fia_s_pf").val()=='')
            alert('Please choose the portfolio!');
        //else if($("#fia_s_ns").html()!='Approved')
        //    alert('NAV is not approved!');
        else
            fia_get_tax($("#fia_s_pf").val(),$("#fia_i_date").val());
    });
    $("#fia_s_sec").change(function(){
        fia_filter_sec(this.value);
    });
    $("#fia_b_preview").click(function(){
        if(  $("#fia_s_pf").val()=='')
            alert('Please choose the portfolio!');
        //else if($("#fia_s_ns").html()!='Approved')
        //    alert('NAV is not approved!');
        else
            $("#fia_frm").submit();
    });
    fia_initiate_grid();
}
function fia_initiate_grid()
{
    var columns_fia = [];
    var options_fia = [];
    columns_fia = [
        {id:"txnno", name:"TXN No.", field:"txnno",width:80}
        ,{id:"sec", name:"Security", field:"sec",width:100}
        ,{id:"rate", name:"Rate", field:"rate",width:80,cssClass:"cell_right"}
        ,{id:"cpn", name:"Last Coupon", field:"cpn",width:120}
        ,{id:"dt", name:"Settle Date", field:"dt",width:100}
        ,{id:"days", name:"Days", field:"days",width:80,cssClass:"cell_right"}
        ,{id:"bal", name:"Balance", field:"bal",width:200,cssClass:"cell_right"}
        ,{id:"tax", name:"Tax Accrued", field:"tax",width:120,cssClass:"cell_right"}
    ];

    options_fia = {
        editable: false
        , enableCellNavigation: true
        , asyncEditorLoading: false
        , enableRowNavigation: true
        , autoEdit: false
        , multiSelect: false
    };
    grid_fia = new Slick.Grid("#fia_slick", data_fia, columns_fia, options_fia);
    grid_fia.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow:true}));    
}
function fia_show()
{
    $("#fia_i_date").val(open_svr_dt);
    ipt_fm_load($("#fia_s_fm"),2);
    ipt_pf_load('_*_M',$("#fia_s_pf"),2);
    fia_reset();
}
function fia_reset()
{    
    
    $("#fia_s_last_dt").html('');
    $("#fia_s_ns").html('');
    $("#fia_s_last_gl_dt").html('');
    $("#fia_s_gs").html('');
    $("#fia_s_cyear").html('');
    
    $("#fia_s_gross").html('');
    $("#fia_s_sale").html('');
    $("#fia_s_txn").html('');
    $("#fia_s_net").html('');
    data_fia.length=0;  
    grid_fia.invalidateAllRows();
        grid_fia.updateRowCount();
        grid_fia.render();
}
function fia_get_tax(p_pf,p_dt)
{
    c_status('fia',1);
    var fia_post = $.post(uri+'/index.php/cfia/get_tax',{pf:p_pf,dt:p_dt,a:1},function(fia_data) { },'json');
    fia_post.done(function(fia_msg){
        if(fia_msg.sess['uid']=='')
        {
            c_nosession();
            return 0;
        }
        var fia_sec_select = "<option value='ALL'>ALL</option>"; 
        var fia_sec='';
        var fia_tax_tot=0;
        data_fia.length=0;
        data_fia_tmp.length=0;
        for (var i=0; i<fia_msg.r_rows; i++) {
           var d = (data_fia[i] = {});     
           d["txnno"] = fia_msg.r_fi[i].TXNNO; 
           d["sec"] = fia_msg.r_fi[i].SECURITYCODE; 
           d["rate"] = fia_msg.r_fi[i].COUPONRATE; 
           d["cpn"] =fia_msg.r_fi[i].LASTCOUPON_s;
           d["dt"] = fia_msg.r_fi[i].SETTLEDATE_s;
           d["days"] = fia_msg.r_fi[i].TOTALDAYS; 
           d["bal"] = strtomoney(fia_msg.r_fi[i].BALANCE); 
           d["tax"] = strtomoney(fia_msg.r_fi[i].TAXACCRUEDAMOUNT);
           d["tax1"] = fia_msg.r_fi[i].TAXACCRUEDAMOUNT;
           if(fia_sec!=fia_msg.r_fi[i].SECURITYCODE)
           {
               fia_sec=fia_msg.r_fi[i].SECURITYCODE;
               fia_sec_select += "<option value='"+fia_msg.r_fi[i].SECURITYCODE+"'>"+fia_msg.r_fi[i].SECURITYCODE+"</option>";  
           }
           fia_tax_tot+=(1*fia_msg.r_fi[i].TAXACCRUEDAMOUNT);
        } 
        data_fia_tmp = data_fia.slice(0);
        $("#fia_i_tot").val(fia_tax_tot.formatMoney());
        grid_fia.invalidateAllRows();
        grid_fia.updateRowCount();
        grid_fia.render();
        $("#fia_s_sec").html(fia_sec_select);
        
        $("#fia_s_gross").html(strtomoney(fia_msg.r_finet[0].gross));
        $("#fia_s_sale").html(strtomoney(fia_msg.r_finet[0].sale));
        $("#fia_s_txn").html(strtomoney(fia_msg.r_finet[0].txn));
        $("#fia_s_net").html(strtomoney(fia_msg.r_finet[0].net));
        c_status('fia',0);
    });
    fia_post.fail(function(jqXHR, textStatus) {c_status('fia',0);});
}

function fia_filter_sec(p_sec)
{
    var fia_tax_tot=0;    
    var j=0;
    data_fia.length=0;                        
    for (var i=0; i<data_fia_tmp.length; i++) {
       var e = data_fia_tmp[i]; 
       if(e['sec']==p_sec || p_sec=='ALL')
       {
           var d = (data_fia[j++] = {});
           d["txnno"] = e['txnno'];
           d["sec"] = e['sec'];
           d["rate"] = e["rate"];          
           d["cpn"] = e["cpn"];
           d["dt"] = e["dt"];
           d["days"] = e["days"];
           d["bal"] = e['bal'];
           d["tax"] = e['tax'];
           fia_tax_tot += (1*e['tax1']);
       }
    }
    $("#fia_i_tot").val(fia_tax_tot.formatMoney());
    grid_fia.invalidateAllRows();
    grid_fia.updateRowCount();
    grid_fia.render();
    
   // $("#i_5_5_amount").val(strtomoney(total));
}