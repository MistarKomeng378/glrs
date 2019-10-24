<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfin extends CI_Controller {      
    var $data;
    function __construct()
    {
        parent::__construct();       
        $this->load->helper('url');
        $this->load->library('session');      
        $this->data=array("url"=>base_url(),"sess"=>$this->_get_login_info());
    }
    function index()
    {  
    }
    function _get_login_info()
    {
        $err = array("uid"=>"","name"=>'','lvl'=>100,'group'=>100);
        if($this->session->userdata('uid')!='')
        {
            $this->load->model("M_user");      
            $r_data=$this->M_user->get_info($this->session->userdata('uid'));
            if(count($r_data)>0)
            {
                $err['name']=$r_data[0]['user_name']; 
                $err['lvl']=$r_data[0]['user_lvl']; 
                $err['group']=$r_data[0]['user_group'];
                $err['uid']=$this->session->userdata('uid'); 
            }
        }
        return $err;
    }
    function view_rpt ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $p=$this->input->post();
        if(!isset($p['v']))
            $p['v']=0;
        
        if($p['v']=='1')
            $this->_view_rpt_mi();
        else
            $this->_view_rpt();
    }
    function _view_rpt ()
    {
        
        $param=$this->input->post();
        if(is_array($param))
            sql_quot_all($param);   
        if(!isset($param['a']))
            $param['a']=0;
        if(!isset($param['rn']))
            $param['rn']='BS';
        $this->load->model("M_portfolio");
        $this->data['r_pf']=$this->M_portfolio->get_data($param['pf']); 
                
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        if(isset($param['sdt']))
            $sdt = change_dt_format(remove_bad_sql(str_sql_string($param["sdt"])),512);     
        else
            $sdt = date_format(date_create($dt),'1/1/Y');
        $syear=date_format(date_create($dt),'1/1/Y');
        $smonth=date_format(date_create($dt),'m/1/Y');
        $this->data['sdt']=$sdt;
        $this->data['dt']=$dt;
        $this->data['pf']=$param['pf'];
        
        $this->load->model("M_nav");
        $r_data=$this->M_nav->check_status_cur($param['pf'],$dt); 
        $n_s ='';
        $g_s ='';
        if(count($r_data)>0)
        {
            $n_s=$r_data[0]['APPROVESTATUS'];
            $g_s=$r_data[0]['GLDONESTATUS'];
            
        }
        
        $this->load->model("M_rpt");
        if($param['rn']=='BS')
        {
            if($g_s=='A')
            {
                $this->load->model("M_rpt"); 
                $this->data['r_data']=$this->M_rpt->get_fin_bs($param['pf'],$syear,$dt,$param['rt']); 
                if($param['a']==0)
                    $this->load->view('rpt_finbs_html',$this->data);
                else
                    $this->load->view('rpt_finbs',$this->data);
            }
            else
                echo 'GL is Not Done!';
        }
        else if($param['rn']=='PL')
        {
            if($g_s=='A')
            {
                $this->load->model("M_rpt"); 
                $this->data['r_data']=$this->M_rpt->get_fin_pl($param['pf'],$syear,$sdt,$dt,$param['rt']); 
                if($param['a']==0)
                    $this->load->view('rpt_finpl_html',$this->data);
                else
                    $this->load->view('rpt_finpl',$this->data);
            }
            else
                echo 'GL is Not Done!';
        }
        else if($param['rn']=='VAL')
        {
            if($n_s=='A')
            {
                $this->load->model("M_rpt"); 
                $this->data['r_data']=$this->M_rpt->get_fin_val($param['pf'],$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_finval_html',$this->data);
                else
                    $this->load->view('rpt_finval',$this->data);
            }
            else
                echo 'NAV is not Approved!';
        }
        else if($param['rn']=='MTM')
        {
            //if($n_s=='A')
            //{
                $this->load->model("M_rpt"); 
                $this->data['r_data']=$this->M_rpt->get_fin_mtm($param['pf'],$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_finmtm_html',$this->data);
                else
                    $this->load->view('rpt_finmtm',$this->data);
            //}
            //else
                //echo 'NAV is not Approved!';
        }
        else if($param['rn']=='TB')
        {
            if($n_s=='A')
            {
                $this->load->model("M_rpt"); 
                $this->data['r_data']=$this->M_rpt->get_fin_tb($param['pf'],$sdt,$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_fintb_html',$this->data);
                else
                    $this->load->view('rpt_fintb',$this->data);
            }
            else
                echo 'NAV is not Approved!';
        }
        else if($param['rn']=='NC')
        {
            if($g_s=='A')
            {
                $this->load->model("M_rpt"); 
                $this->data['r_data']=$this->M_rpt->get_fin_nc($param['pf'],$sdt,$dt,$param['rt']); 
                if($param['a']==0)
                    $this->load->view('rpt_finnc_html',$this->data);
                else
                    $this->load->view('rpt_finnc',$this->data);
            }
            else
                 echo 'GL is Not Done!'; 
        }
        else if($param['rn']=='GAM')
        {
            if($n_s=='A')
            {
                $this->load->model("M_rpt"); 
                if($param['acc']=='ALL')
                    $this->data['r_data']=$this->M_rpt->get_fin_gam_all($param['pf'],$sdt,$dt); 
                else
                    $this->data['r_data']=$this->M_rpt->get_fin_gam($param['pf'],$param['acc'].'.'.$param['pf'],$sdt,$dt); 
                if($param['a']==0)
                {
                     header("Content-type: application/vnd.ms-excel");            
                header("Content-Disposition: attachment;Filename={$param['pf']}" . date_format(date_create($dt),'Ymd') . ".xls");
                    $this->load->view('rpt_fingam_html',$this->data);
                }
                else
                    $this->load->view('rpt_fingam',$this->data);
            }
            else
                 echo 'NAV is not Approved!';
        }
        else if($param['rn']=='NAV')
        {
            if($n_s=='A')
            {
                $this->load->model("M_nav"); 
                $this->data['sect_A']=$this->M_nav->get_section($param['pf'],$dt,'A'); 
                if(count($this->data['sect_A'])>0)
                {
                    $this->data['sect_B']=$this->M_nav->get_section($param['pf'],$dt,'B'); 
                    $this->data['sect_C']=$this->M_nav->get_section($param['pf'],$dt,'C'); 
                    $this->data['sect_D']=$this->M_nav->get_section($param['pf'],$dt,'D'); 
                    $this->data['sect_H']=$this->M_nav->get_section($param['pf'],$dt,'H'); 
                    
                }
                if($param['a']==0)
                    $this->load->view('rpt_finnav_html',$this->data);
                else
                    $this->load->view('rpt_finnav',$this->data);
            }
            else
                 echo 'NAV is not Approved!';
        }
        else if($param['rn']=='DGB')
        {
            if($g_s=='A')
            {
                $this->data["map_type"] = array("A"=>"ASSETS","L"=>"LIABILITIES","P"=>"CAPITAL","R"=>"INCOME","E"=>"EXPENSES");
                $this->load->model("M_rpt"); 
                $this->data['r_data']=$this->M_rpt->get_fin_dgb($param['pf'],$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_findgb_html',$this->data);
                else
                    $this->load->view('rpt_findgb',$this->data);
            }
            else
                 echo 'GL is Not Done!'; 
        }
        else if($param['rn']=='XD11' || $param['rn']=='XD12' || $param['rn']=='XD13')
        {
            if($g_s=='A')
            {
                $this->load->model("M_portfolio");                        
                $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
                
                $this->load->model("M_xd1");            
                if($param['rn']=='XD11')
                {
                    $this->data['r_data'] = $this->M_xd1->get_xd1($param["pf"],$dt,1);
                    if($param['a']==0)
                        $this->load->view('rpt_xd11_html',$this->data);
                    else
                        $this->load->view('rpt_xd11',$this->data);
                }
                else if($param['rn']=='XD12')
                {
                    $this->data['r_data'] = $this->M_xd1->get_xd1($param["pf"],$dt,2);
                    if($param['a']==0)
                        $this->load->view('rpt_xd12_html',$this->data);
                    else
                        $this->load->view('rpt_xd12',$this->data);
                }
                else if($param['rn']=='XD13')
                {
                    $this->data['r_data'] = $this->M_xd1->get_xd1($param["pf"],$dt,3);
                    if($param['a']==0)
                        $this->load->view('rpt_xd13_html',$this->data);
                    else
                        $this->load->view('rpt_xd13',$this->data);
                }
            }
            else
                 echo 'GL is Not Done!'; 
        }
        else if($param['rn']=='NP')
        {                
            $this->load->model("M_rpt"); 
            $this->data['r_data']=$this->M_rpt->get_fin_nav_performance($param['pf'],$sdt,$dt); 
            if($param['a']==0)
                $this->load->view('rpt_finnp_html',$this->data);
            else
                $this->load->view('rpt_finnp',$this->data);
       
        }
        else if($param['rn']=='FB')
        {                
            if($n_s=='A')
            {
                $this->load->model("M_nav"); 
                $this->data['sect_A']=$this->M_nav->get_section($param['pf'],$dt,'A'); 
                if(count($this->data['sect_A'])>0)
                {
                    $this->data['sect_B']=$this->M_nav->get_section($param['pf'],$dt,'B'); 
                    $this->data['sect_C']=$this->M_nav->get_section($param['pf'],$dt,'C'); 
                    $this->data['sect_D']=$this->M_nav->get_section($param['pf'],$dt,'D'); 
                    $this->data['sect_H']=$this->M_nav->get_section($param['pf'],$dt,'H'); 
                    
                }
                $this->load->model("M_rpt"); 
                $r_pvr=$this->M_rpt->get_fin_fb_pvr($param['pf'],$dt); 
                $this->data['r_pvrfi']=array();
                $this->data['r_pvros']=array();
                $this->data['r_pvrri']=array();
                $this->data['r_pvrzl']=array();
                foreach($r_pvr as $xitem)
                {
                    if($xitem['SecurityCategory']=='FI') $this->data['r_pvrfi'][]=$xitem;
                    if($xitem['SecurityCategory']=='OS') $this->data['r_pvros'][]=$xitem;
                    if($xitem['SecurityCategory']=='RI') $this->data['r_pvrri'][]=$xitem;
                    if($xitem['SecurityCategory']=='ZL') $this->data['r_pvrzl'][]=$xitem;
                }
                $this->data['r_bas']=$this->M_rpt->get_fin_fb_bas($param['pf'],$dt); 
                $this->data['r_bal']=$this->M_rpt->get_fin_fb_bal($param['pf'],$dt); 
                $this->data['r_trx']=$this->M_rpt->get_fin_fb_trx($param['pf'],$dt); 
                $this->data['r_ost']=$this->M_rpt->get_fin_fb_ost($param['pf'],$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_finfb_html',$this->data);
            }
            else
                echo 'NAV is not Approved!'; 
       
        }
    }
    function _view_rpt_mi ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();
        if(is_array($param))
            sql_quot_all($param);   
        if(!isset($param['rn']))
            $param['rn']='BS';
            
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        if(isset($param['sdt']))
            $sdt = change_dt_format(remove_bad_sql(str_sql_string($param["sdt"])),512);     
        else
            $sdt = date_format(date_create($dt),'1/1/Y');
        $syear=date_format(date_create($dt),'1/1/Y');
        $smonth=date_format(date_create($dt),'m/1/Y');
            
        $this->load->model("M_portfolio");
        $this->data['r_pfs']=$this->M_portfolio->get_data_approved($param['fm'],$dt); 
                             
        
        $syear=date_format(date_create($dt),'1/1/Y');
        $smonth=date_format(date_create($dt),'m/1/Y');
        $this->data['sdt']=$sdt;
        $this->data['dt']=$dt;
        $this->data['pf']=$param['pf'];
      
        $this->load->model("M_rpt");
        /*if($param['rn']=='BS')
        {
            if($rpf['APPROVESTATUS']=='A')
                $this->data['r_data'][$rpf['pfcode']]=$this->M_rpt->get_fin_bs($rpf['pfcode'],$syear,$dt,$param['rt']);
            $this->load->view('rpt_finbs_mi_html',$this->data);
        }
        else if($param['rn']=='PL')
        {
            foreach($this->data['r_pfs'] as $rpf)
            {
                if($rpf['APPROVESTATUS']=='A')
                    $this->data['r_data'][$rpf['pfcode']]=$this->M_rpt->get_fin_pl($rpf['pfcode'],$syear,$sdt,$dt,$param['rt']); 
                $this->load->view('rpt_finpl_mi_html',$this->data);
            }            
        }
        else*/ if($param['rn']=='VAL')
        {
            header("Content-type: application/vnd.ms-excel");            
            header("Content-Disposition: attachment;Filename=" . date_format(date_create($this->data["dt"]),'Ymd') . ".xls"); 
            
            foreach($this->data['r_pfs'] as $rpf)
            {
                $this->data['r_data'][$rpf['pfcode']]=array();
                if($rpf['APPROVESTATUS']=='A')
                    $this->data['r_data'][$rpf['pfcode']]=$this->M_rpt->get_fin_val($rpf['pfcode'],$dt); 
                
            }
            $this->load->view('rpt_finval_mi_xls',$this->data);
        }
        else if($param['rn']=='PL')
        {
            header("Content-type: application/vnd.ms-excel");            
            header("Content-Disposition: attachment;Filename=" . date_format(date_create($this->data["dt"]),'Ymd') . ".xls");
            foreach($this->data['r_pfs'] as $rpf)
            {
                $this->data['r_data'][$rpf['pfcode']]=array();
                if($rpf['APPROVESTATUS']=='A')
                    $this->data['r_data'][$rpf['pfcode']]=$this->M_rpt->get_fin_pl($rpf['pfcode'],$syear,$sdt,$dt,$param['rt']);
            }
            $this->load->view('rpt_finpl_mi_xls',$this->data); 
        }
        else if($param['rn']=='TB')
        {
            header("Content-type: application/vnd.ms-excel");            
            header("Content-Disposition: attachment;Filename=" . date_format(date_create($this->data["dt"]),'Ymd') . ".xls");
            foreach($this->data['r_pfs'] as $rpf)
            {
                if($rpf['APPROVESTATUS']=='A')
                    $this->data['r_data'][$rpf['pfcode']]=$this->M_rpt->get_fin_tb($rpf['pfcode'],$sdt,$dt); 
                
            }
            $this->load->view('rpt_fintb_mi_html',$this->data);
        }
        else if($param['rn']=='GAM')
        {
            header("Content-type: application/vnd.ms-excel");            
            header("Content-Disposition: attachment;Filename=" . date_format(date_create($this->data["dt"]),'Ymd') . ".xls");
        
        
            foreach($this->data['r_pfs'] as $rpf)
            {
                if($rpf['APPROVESTATUS']=='A')
                    if($param['acc']=='ALL')
                        $this->data['r_data'][$rpf['pfcode']]=$this->M_rpt->get_fin_gam_all($rpf['pfcode'],$sdt,$dt); 
                    else
                        $this->data['r_data'][$rpf['pfcode']]=$this->M_rpt->get_fin_gam($rpf['pfcode'],$param['acc'].'.'.$param['pf'],$sdt,$dt); 
                
            }
            $this->load->view('rpt_fingam_mi_html',$this->data);                
        }        
        else if($param['rn']=='FB')
        {       
            $this->load->model("M_nav");          
            $this->load->model("M_rpt"); 
            header("Content-type: application/vnd.ms-excel");            
            header("Content-Disposition: attachment;Filename=" . date_format(date_create($this->data["dt"]),'Ymd') . ".xls");
        
            foreach($this->data['r_pfs'] as $rpf)
            {
                if($rpf['APPROVESTATUS']=='A')
                {
                    $this->data['sect_A'][$rpf['pfcode']]=$this->M_nav->get_section($rpf['pfcode'],$dt,'A'); 
                    if(count($this->data['sect_A'][$rpf['pfcode']])>0)
                    {
                        $this->data['sect_B'][$rpf['pfcode']]=$this->M_nav->get_section($rpf['pfcode'],$dt,'B'); 
                        $this->data['sect_C'][$rpf['pfcode']]=$this->M_nav->get_section($rpf['pfcode'],$dt,'C'); 
                        $this->data['sect_D'][$rpf['pfcode']]=$this->M_nav->get_section($rpf['pfcode'],$dt,'D'); 
                        $this->data['sect_H'][$rpf['pfcode']]=$this->M_nav->get_section($rpf['pfcode'],$dt,'H'); 
                        
                    }                        
                    $r_pvr=$this->M_rpt->get_fin_fb_pvr($rpf['pfcode'],$dt); 
                    $this->data['r_pvrfi'][$rpf['pfcode']]=array();
                    $this->data['r_pvros'][$rpf['pfcode']]=array();
                    $this->data['r_pvrri'][$rpf['pfcode']]=array();
                    $this->data['r_pvrzl'][$rpf['pfcode']]=array();
                    foreach($r_pvr as $xitem)
                    {
                        if($xitem['SecurityCategory']=='FI') $this->data['r_pvrfi'][$rpf['pfcode']][]=$xitem;
                        if($xitem['SecurityCategory']=='OS') $this->data['r_pvros'][$rpf['pfcode']][]=$xitem;
                        if($xitem['SecurityCategory']=='RI') $this->data['r_pvrri'][$rpf['pfcode']][]=$xitem;
                        if($xitem['SecurityCategory']=='ZL') $this->data['r_pvrzl'][$rpf['pfcode']][]=$xitem;
                    }
                    $this->data['r_bas'][$rpf['pfcode']]=$this->M_rpt->get_fin_fb_bas($rpf['pfcode'],$dt); 
                    $this->data['r_bal'][$rpf['pfcode']]=$this->M_rpt->get_fin_fb_bal($rpf['pfcode'],$dt); 
                    $this->data['r_trx'][$rpf['pfcode']]=$this->M_rpt->get_fin_fb_trx($rpf['pfcode'],$dt); 
                    $this->data['r_ost'][$rpf['pfcode']]=$this->M_rpt->get_fin_fb_ost($rpf['pfcode'],$dt); 
                    
                }
            }
            $this->load->view('rpt_finfb_mi_html',$this->data);
        } 
    }
    
} 
?>
