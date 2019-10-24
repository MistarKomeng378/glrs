var arrFM=new Array();
var arrPF=new Array();
var curr_fm = '_*_M';
var curr_pf = '';
var ipt_startdt = start_year_svr_dt;
var ipt_curdt = open_svr_dt;
var blank_pf=false;

function ipt_enable(obj_input,p_ena)
{
    if(obj_input)
    {
        if(!p_ena)
            obj_input.attr("disabled", "disabled");
        else
            obj_input.removeAttr("disabled");

            //untuk speisifikasi number MK
            $('#ock_i_ock_code_dlg').val("-1");
    }
}
function ipt_show(obj_input,p_ena)
{
    if(obj_input)
    {
        if(!p_ena)
            obj_input.hide();
        else
            obj_input.show();
    }
}
function ipt_fm_load(obj_input1,opt_all1,obj_input2,opt_all2,obj_input3,opt_all3)
{                      
    arrFM.length=0;
    var fm_post = $.post(uri+'/index.php/cfundmanager/list_data',{t:'1'},function(fm_data) { },'json');
    fm_post.done(function(fm_msg){
        arrFM.length=0;
        for (var i=0; i<fm_msg.r_rows; i++) 
        {
            var d={fmcode:fm_msg.r_data[i].fmcode,fmname:fm_msg.r_data[i].fmname};
            arrFM[i]=d;
        }        
        if(obj_input1)
            ipt_fm_load_select(obj_input1,opt_all1);
        if(obj_input2)
            ipt_fm_load_select(obj_input2,opt_all2);
        if(obj_input3)
            ipt_fm_load_select(obj_input3,opt_all3);
    });
    fm_post.fail(function(jqXHR, textStatus) {
        arrFM.length=0;
        if(obj_input1)
            ipt_fm_load_select(obj_input1,opt_all1);
        if(obj_input2)
            ipt_fm_load_select(obj_input2,opt_all2);
        if(obj_input3)
            ipt_fm_load_select(obj_input3,opt_all3);
    });
}
function ipt_fm_load_select(obj_input,opt_all)
{
    obj_input.html('');
    var tmp_str_data='';
    if(opt_all==1) tmp_str_data="<option value='ALL'>ALL</option>";
    if(opt_all==2) tmp_str_data="<option value=''></option>";
    for (var i=0; i<arrFM.length; i++) {
        if(opt_all==0 && (curr_fm=='_*_M' || curr_fm=='' || curr_fm=='ALL') && i==0)
            curr_fm=arrFM[i].fmcode;
        if(arrFM[i].fmcode==curr_fm)
            tmp_str_data= tmp_str_data + "<option value=\"" + arrFM[i].fmcode + "\" selected>" +arrFM[i].fmcode+" - " + arrFM[i].fmname + "</option>";
        else
            tmp_str_data= tmp_str_data + "<option value=\"" + arrFM[i].fmcode + "\">" +arrFM[i].fmcode+" - " + arrFM[i].fmname + "</option>";
    }        
    obj_input.html(tmp_str_data);//          alert(curr_fm); alert(opt_all);
}
function ipt_fm_set_default(p_fm)
{
    curr_fm = p_fm;
}
function ipt_check_fm()
{
    return curr_fm;
}
function ipt_pf_load(p_fm,obj_input1,opt_all1,obj_input2,opt_all2,obj_input3,opt_all3)
{                      
    arrPF.length=0;
    var pf_post = $.post(uri+'/index.php/cportfolio/list_data',{fm:p_fm,t:'1'},function(pf_data) { },'json');
    pf_post.done(function(pf_msg){
        arrPF.length=0;
        for (var i=0; i<pf_msg.r_rows; i++) 
        {
            var d={pfcode:pf_msg.r_data[i].pfcode,pfname:pf_msg.r_data[i].pfname,fmcode:pf_msg.r_data[i].fmcode};
            arrPF[i]=d;
        }        
        if(obj_input1)
            ipt_pf_load_select(obj_input1,opt_all1,p_fm);
        if(obj_input2)
            ipt_pf_load_select(obj_input2,opt_all2,p_fm);
        if(obj_input3)
            ipt_pf_load_select(obj_input3,opt_all3,p_fm);
    });
    pf_post.fail(function(jqXHR, textStatus) {
        arrPF.length=0;
        if(obj_input1)
            ipt_pf_load_select(obj_input1,opt_all1,p_fm);
        if(obj_input2)
            ipt_pf_load_select(obj_input2,opt_all2,p_fm);
        if(obj_input3)
            ipt_pf_load_select(obj_input3,opt_all3,p_fm);
    });
}
function ipt_pf_load_select(obj_input,opt_all,p_fm)
{
    obj_input.html('');
    var tmp_str_data='';
    if(opt_all==1) tmp_str_data="<option value='ALL'>ALL</option>";
    if(opt_all==2) tmp_str_data="<option value=''></option>";
    var tmp_fm='_*_M';
    var tmp_terus=true;   
    var tmpfmcode = p_fm;
    if (p_fm=='_*_M')
        tmpfmcode =   curr_fm;
    for (var i=0; i<arrPF.length && tmp_terus; i++) {
        if(arrPF[i].fmcode==tmpfmcode || tmpfmcode=='ALL' || tmpfmcode=='_*_M')
        {
            if(tmpfmcode=='_*_M' && tmp_fm!='_*_M' && tmp_fm!=arrPF[i].fmcode)
                break;
            if(tmpfmcode!='_*_M')
            {
                if(arrPF[i].pfcode==curr_pf && !blank_pf)
                    tmp_str_data= tmp_str_data + "<option value=\"" + arrPF[i].pfcode + "\" selected>" +arrPF[i].pfcode+" - " + arrPF[i].pfname + "</option>";
                else
                    tmp_str_data= tmp_str_data + "<option value=\"" + arrPF[i].pfcode + "\">" +arrPF[i].pfcode+" - " + arrPF[i].pfname + "</option>";
            }
            else if(tmp_fm=='_*_M'|| tmp_fm==arrPF[i].fmcode)
            {
                if(arrPF[i].pfcode==curr_pf && !blank_pf)
                    tmp_str_data= tmp_str_data + "<option value=\"" + arrPF[i].pfcode + "\" selected>" +arrPF[i].pfcode+" - " + arrPF[i].pfname + "</option>";
                else
                    tmp_str_data= tmp_str_data + "<option value=\"" + arrPF[i].pfcode + "\">" +arrPF[i].pfcode+" - " + arrPF[i].pfname + "</option>";
            }
            
            tmp_fm=arrPF[i].fmcode;
        }
    }
    
    obj_input.html(tmp_str_data);
    blank_pf=false;
}
function ipt_pf_set_default(p_pf)
{
    curr_pf =p_pf;
}
function ipt_check_nav_status(p_pf,p_dt,obj_navdt,obj_navstatus,obj_gldt,obj_glstatus,obj_urs,obj_year,id_caller,loadfunc,obj_yearstatus,obj_gleoy)
{
    c_status(id_caller,1);
    var nav_post = $.post(uri+'/index.php/cnav/check_status',{pf:p_pf,dt:p_dt},function(nav_data) { },'json');
    nav_post.done(function(nav_msg){
        if(obj_navdt)
            if(obj_navdt.prop('tagName').toLowerCase()=='input')
                obj_navdt.val(nav_msg.r_data['n_d']);
            else if(obj_navdt.prop('tagName').toLowerCase()=='span')
                obj_navdt.html(nav_msg.r_data['n_d']);
        if(obj_navstatus)
        {
            if(obj_navstatus.prop('tagName').toLowerCase()=='input')
                obj_navstatus.val(nav_msg.r_data['c_n']=='null'?'Not Approved':(nav_msg.r_data['c_n']=='A'?'Approved':'Not Approved'));
            else if(obj_navstatus.prop('tagName').toLowerCase()=='span')
                obj_navstatus.html(nav_msg.r_data['c_n']=='null'?'Not Approved':(nav_msg.r_data['c_n']=='A'?'Approved':'Not Approved'));
            if(nav_msg.r_data['c_n']=='null' || nav_msg.r_data['c_n']!='A')
                obj_navstatus.css('color','red');
            else
                obj_navstatus.css('color','#005800');
        }
        if(obj_gldt)
            if(obj_gldt.prop('tagName').toLowerCase()=='input')
                obj_gldt.val(nav_msg.r_data['g_d']);
            else if(obj_gldt.prop('tagName').toLowerCase()=='span')
                obj_gldt.html(nav_msg.r_data['g_d']);
        if(obj_glstatus)
        {
            if(obj_glstatus.prop('tagName').toLowerCase()=='input')
                obj_glstatus.val(nav_msg.r_data['c_g']=='null'?'UnDone':(nav_msg.r_data['c_g']=='A'?'Done':'UnDone'));
            else if(obj_glstatus.prop('tagName').toLowerCase()=='span')
                obj_glstatus.html(nav_msg.r_data['c_g']=='null'?'UnDone':(nav_msg.r_data['c_g']=='A'?'Done':'UnDone'));
            if(nav_msg.r_data['c_g']=='null' || nav_msg.r_data['c_g']!='A')
                obj_glstatus.css('color','red');
            else
                obj_glstatus.css('color','#005800');
        }
        if(obj_urs)
            if(obj_urs.prop('tagName').toLowerCase()=='input')
                obj_urs.val(nav_msg.r_data['u_d']);
            else if(obj_urs.prop('tagName').toLowerCase()=='span')
                obj_urs.html(nav_msg.r_data['u_d']);
        if(obj_year)
            if(obj_year.prop('tagName').toLowerCase()=='input')
                obj_year.val(nav_msg.r_data['c_y']);
            else if(obj_year.prop('tagName').toLowerCase()=='span')
                obj_year.html(nav_msg.r_data['c_y']);
        if(obj_yearstatus)
            if(obj_yearstatus.prop('tagName').toLowerCase()=='input')
                obj_yearstatus.val(nav_msg.r_data['c_ys']);
            else if(obj_yearstatus.prop('tagName').toLowerCase()=='span')
                obj_yearstatus.html(nav_msg.r_data['c_ys']);
        if(obj_gleoy)
            if(obj_gleoy.prop('tagName').toLowerCase()=='input')
                obj_gleoy.val(nav_msg.r_data['g_eoy']);
            else if(obj_gleoy.prop('tagName').toLowerCase()=='span')
                obj_gleoy.html(nav_msg.r_data['g_eoy']);
        c_status(id_caller,0);
        if (typeof window[loadfunc] === 'function')
                eval(loadfunc+"('" + nav_msg.r_data['n_s'] + "','" + nav_msg.r_data['g_s']  + "','" + nav_msg.r_data['c_n']  + "','" + nav_msg.r_data['c_g'] +"','"+ nav_msg.r_data['c_y'] +"','"+ nav_msg.r_data['c_u'] +"','"+ nav_msg.r_data['c_ad'] +"','"+ nav_msg.r_data['c_ys'] +"','"+ nav_msg.r_data['g_eoy'] +"');");
        
        
    });
    nav_post.fail(function(jqXHR, textStatus) {
        alert('error checking nav status!');
        c_status(id_caller,0);
    });
}

function ipt_gl_load_select(obj_input,opt_all,p_pf)
{                      
    obj_input.html('');
    var tmp_str_data='';
    if(opt_all==1) tmp_str_data="<option value='ALL'>ALL</option>";
    if(opt_all==2) tmp_str_data="<option value=''></option>";
    
    var gl_post = $.post(uri+'/index.php/cgl/list_data_select',{pf:p_pf},function(gl_data) { });
    gl_post.done(function(gl_msg){
        tmp_str_data += gl_msg;
        obj_input.html(tmp_str_data);
    });
    gl_post.fail(function(jqXHR, textStatus) {
        obj_input.html(tmp_str_data);
    });
}
function ipt_sectrx_load_select(obj_input,opt_all,p_pf)
{                      
    obj_input.html('');
    var tmp_str_data='';
    if(opt_all==1) tmp_str_data="<option value='ALL'>ALL</option>";
    if(opt_all==2) tmp_str_data="<option value=''></option>";
    
    var gl_post = $.post(uri+'/index.php/cfi/list_sectrx_select',{pf:p_pf},function(gl_data) { });
    gl_post.done(function(gl_msg){
        tmp_str_data += gl_msg;
        obj_input.html(tmp_str_data);
    });
    gl_post.fail(function(jqXHR, textStatus) {
        obj_input.html(tmp_str_data);
    });
}
function ipt_check_pf()
{
    return curr_pf;
}
function ipt_blank_select_pf(pblank)
{
    blank_pf=pblank;
}