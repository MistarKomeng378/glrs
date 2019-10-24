//var var_form_number = ({});
var top_menu_no = 0;
var leaf_menu_no = 0;
                                        
function hide_all_form()
{
    for(var i=1;i<7;i++)
        for(var j=1;j<20;j++)
        {
            var frm_name = '#frm_' + i + '_' + j;
            if($(frm_name))
                $(frm_name).hide();
        }
    $(".img_hide").hide();
}

function show_form(i_top,i_leaf)
{
    //hide_all_form();
    if(i_top && i_leaf && !(top_menu_no==i_top && leaf_menu_no==i_leaf))
    {
        if(i_leaf)
        {
            var frm_name = '#frm_' + i_top + '_' + i_leaf;      
            var frm_old_name = '#frm_' + top_menu_no + '_' + leaf_menu_no;
            if($(frm_name))
            {
                if(top_menu_no!=0) 
                    $(frm_old_name).fadeOut("fast",function(){
                        hide_all_form();
                        clear_all_input(top_menu_no,leaf_menu_no);
                        $(frm_name).show("slide" ,function(){ $(frm_name + " :input[type='text']:first").focus();});
                    });
                else
                    $(frm_name).show("slide",function(){ $(frm_name + " :input[type='text']:first").focus();});
                
                top_menu_no = i_top;
                leaf_menu_no = i_leaf;  
                eval('clear_form_' + top_menu_no + '_'+leaf_menu_no+'(1);');
            }
        }
        else
        {
            top_menu_no = 0;
            leaf_menu_no = 0;
            for(var i=1;i<10;i++)
            {
                var frm_name = '#frm_' + i_top + '_' + i;
                if($(frm_name))
                    $(frm_name).show();
            }
            eval('clear_form_' + top_menu_no + '_'+leaf_menu_no);
        }
    }
}

function is_not_tabenter(nokey)
{              
    if( nokey !=9 && nokey !=13)
        return true;
    else
        return false;
    
}      
function set_status(s_status,e)
{
    var status_panel = $("#status_panel");
    status_panel.removeClass("hijau");
    status_panel.removeClass("merah");
    if(e==1)
        status_panel.addClass("merah");
    else
        status_panel.addClass("hijau");
    status_panel.html(s_status)
} 
function clear_status()
{
    var status_panel = $("#status_panel");
    status_panel.removeClass("hijau");
    status_panel.removeClass("merah");
    status_panel.html("") ;
}

function clear_all_input(top_menu_no,leaf_menu_no)
{
    var frm_name = '#frm_' + top_menu_no + '_' + leaf_menu_no;     
    $(frm_name + " :input[type=text]").not(".i_dtpicker").val("");
    $(frm_name + " :input[type=file]").val("");
    //$(frm_name + " :input[class=i_dtpicker]").val(open_svr_dt);
    $("#span_1_5_tot_unit").html('');
    //if(top_menu_no==1 && leaf_menu_no==1)
        //$("#i_1_1_cur_year").val($("#i_1_1_start_year").val());
}

function change_pf_name(pf_code,pf_a)
{                                                                             
    var i_pf_code = '#i_' + top_menu_no + '_' + leaf_menu_no + '_pf_code';
    var i_pf_name = '#i_' + top_menu_no + '_' + leaf_menu_no + '_pf_name';
    var i_pf_name_up = '#i_' + top_menu_no + '_' + leaf_menu_no + '_pf_name_up';      
    var i_pf_code_up = '#i_' + top_menu_no + '_' + leaf_menu_no + '_pf_code_up';
    var ada = false;                
    $(i_pf_code).val(trim(pf_code));
    //alert(uri+'/index.php/tb/get_portfolio_name/1/'+decodeurl(pf_code));
    var obj_get = $.getJSON(uri+'/index.php/tb/get_portfolio_name/1/'+decodeurl(pf_code), function(data) {
      if(data.r_num_rows>=1)
      {
        $(i_pf_name).val(data.r_sdata[0].PortfolioName);
        $(i_pf_name_up).val(data.r_sdata[0].PortfolioName);
        ada =true;    
      }          
    });
     obj_get.done(function(msg){                                
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else  if(!ada)
        {
            $(i_pf_name).val('');  
            $(i_pf_name_up).val('');  
        }
        if(pf_a==1)
        {
            $(i_pf_code).val(trim(pf_code));   
            $(i_pf_code_up).val(trim(pf_code));   
        }
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $(i_pf_name).val('');
        $(i_pf_name_up).val('');  
        alert("Getting data error :" + textStatus);  
    });       
}

function change_fm_name(fm_code,fm_a)
{                                                                             
    var i_fm_code = '#i_' + top_menu_no + '_' + leaf_menu_no + '_fm_code';
    var i_fm_name = '#i_' + top_menu_no + '_' + leaf_menu_no + '_fm_name';
    var ada = false;
    $(i_fm_code).val(trim(fm_code));
    //alert(uri+'/index.php/tb/get_portfolio_name/'+pf_code);
    var obj_get = $.getJSON(uri+'/index.php/tb/get_fundmanager_name/1/'+decodeurl(fm_code), function(data) {
      if(data.r_num_rows>=1)
      {
        $(i_fm_name).val(data.r_sdata[0].FundManagerName);
        ada =true;
        if(fm_a==1)
            $(i_fm_code).val(trim(fm_code));
      } 
    });
    obj_get.done(function(msg){
        if(!msg.r_login)                                                     
            show_dlg_login();                                                                            
        else if(!ada)
            $(i_fm_name).val('');
    });
    obj_get.fail(function(jqXHR, textStatus) {    
        $(i_fm_name).val('');
        alert("Getting data error :" + textStatus);  
    });
}
Number.prototype.formatMoney = function(c, d, t){
var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };
function strtomoney(amount)
{
    var sign_money = '';
    var val_money = trim(''+amount);
    if(val_money[0])
        if (val_money[0]=='-')
        {
            sign_money='-';
            val_money= val_money.substr(1);
        }
    // alert(val_money);       
    var i = parseFloat(val_money);
    if(isNaN(i)) { i = 0.00; }   
    return  sign_money + i.formatMoney(2,'.',',');
}

function state_progress(state)
{
    var nm_div= '#progress_' + top_menu_no + '_' + leaf_menu_no;
    if(state==1)
        $(nm_div).show();
    else
        $(nm_div).hide();
}
function make_read_only(nm_obj,state)
{
    $(nm_obj).removeClass('read_only');
    if(state==1)
        $(nm_obj).addClass('read_only');
}

function change_acc_name(acc_no,acc_name)
{                                                                             
    var i_acc_no = '#i_' + top_menu_no + '_' + leaf_menu_no + '_acc_no';
    var i_acc_name = '#i_' + top_menu_no + '_' + leaf_menu_no + '_acc_name';
    $(i_acc_no).val(trim(acc_no));
    $(i_acc_name).val(trim(acc_name));
}