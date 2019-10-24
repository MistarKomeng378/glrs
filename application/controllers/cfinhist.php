<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfinhist extends CI_Controller {      
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
        
                
        $this->load->model("M_rpthist");
        if($param['rn']=='BS')
        {
            $this->load->model("M_rpthist"); 
            $this->data['r_data']=$this->M_rpthist->get_fin_bs($param['pf'],$syear,$dt,$param['rt']); 
            if($param['a']==0)
                $this->load->view('rpt_finbshist_html',$this->data);
            else
                $this->load->view('rpt_finbshist',$this->data);
        }
        else if($param['rn']=='PL')
        {
            $this->load->model("M_rpthist"); 
            $this->data['r_data']=$this->M_rpthist->get_fin_pl($param['pf'],$syear,$sdt,$dt,$param['rt']); 
            if($param['a']==0)
                $this->load->view('rpt_finplhist_html',$this->data);
            else
                $this->load->view('rpt_finplhist',$this->data);
        }
        else if($param['rn']=='VAL')
        {
            $this->load->model("M_rpthist"); 
            $this->data['r_data']=$this->M_rpthist->get_fin_val($param['pf'],$dt); 
            if($param['a']==0)
                $this->load->view('rpt_finvalhist_html',$this->data);
            else
                $this->load->view('rpt_finvalhist',$this->data);
        }
        else if($param['rn']=='MTM')
        {
            $this->load->model("M_rpthist"); 
            $this->data['r_data']=$this->M_rpthist->get_fin_mtm($param['pf'],$dt); 
            if($param['a']==0)
                $this->load->view('rpt_finmtmhist_html',$this->data);
            else
                $this->load->view('rpt_finmtmhist',$this->data);
        }
        else if($param['rn']=='TB')
        {
            $this->load->model("M_rpthist"); 
            $this->data['r_data']=$this->M_rpthist->get_fin_tb($param['pf'],$sdt,$dt); 
            if($param['a']==0)
                $this->load->view('rpt_fintbhist_html',$this->data);
            else
                $this->load->view('rpt_fintbhist',$this->data);
        }
        else if($param['rn']=='NC')
        {
            $this->load->model("M_rpthist"); 
            $this->data['r_data']=$this->M_rpthist->get_fin_nc($param['pf'],$sdt,$dt,$param['rt']); 
            if($param['a']==0)
                $this->load->view('rpt_finnchist_html',$this->data);
            else
                $this->load->view('rpt_finnchist',$this->data);
        }
        else if($param['rn']=='GAM')
        {
            $this->load->model("M_rpthist"); 
            if($param['acc']=='ALL')
                $this->data['r_data']=$this->M_rpthist->get_fin_gam_all($param['pf'],$sdt,$dt); 
            else
                $this->data['r_data']=$this->M_rpthist->get_fin_gam($param['pf'],$param['acc'].'.'.$param['pf'],$sdt,$dt); 
            if($param['a']==0)
            {
                 header("Content-type: application/vnd.ms-excel");            
                header("Content-Disposition: attachment;Filename={$param['pf']}" . date_format(date_create($dt),'Ymd') . ".xls");
                $this->load->view('rpt_fingamhist_html',$this->data);
            }
            else
                $this->load->view('rpt_fingamhist',$this->data);
        }
        else if($param['rn']=='DGB')
        {
            $this->data["map_type"] = array("A"=>"ASSETS","L"=>"LIABILITIES","P"=>"CAPITAL","R"=>"INCOME","E"=>"EXPENSES");
            $this->load->model("M_rpthist"); 
            $this->data['r_data']=$this->M_rpthist->get_fin_dgb($param['pf'],$dt); 
            if($param['a']==0)
                $this->load->view('rpt_findgbhist_html',$this->data);
            else
                $this->load->view('rpt_findgbhist',$this->data);
        }
        else if($param['rn']=='XD11')
        {
            $this->load->model("M_xd1"); 
            $this->data['r_data']=$this->M_xd1->get_xd1_hist($param['pf'],$dt,1); 
            if($param['a']==0)
                $this->load->view('rpt_xd11hist_html',$this->data);
            else
                $this->load->view('rpt_xd11hist',$this->data);
        }
        else if($param['rn']=='XD12')
        {
            $this->load->model("M_xd1"); 
            $this->data['r_data']=$this->M_xd1->get_xd1_hist($param['pf'],$dt,2); 
            if($param['a']==0)
                $this->load->view('rpt_xd12hist_html',$this->data);
            else
                $this->load->view('rpt_xd12hist',$this->data);
        }
        else if($param['rn']=='XD13')
        {
            $this->load->model("M_xd1"); 
            $this->data['r_data']=$this->M_xd1->get_xd1_hist($param['pf'],$dt,3); 
            if($param['a']==0)
                $this->load->view('rpt_xd13hist_html',$this->data);
            else
                $this->load->view('rpt_xd13hist',$this->data);
        }
    }
    /*
    function view_rpt ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
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
        
        $this->load->model("M_rpthist");
        if($param['rn']=='BS')
        {
            if($g_s=='A')
            {
                $this->load->model("M_rpthist"); 
                $this->data['r_data']=$this->M_rpthist->get_fin_bs($param['pf'],$syear,$dt,$param['rt']); 
                if($param['a']==0)
                    $this->load->view('rpt_finbshist_html',$this->data);
                else
                    $this->load->view('rpt_finbshist',$this->data);
            }
            else
                echo 'GL is Not Done!';
        }
        else if($param['rn']=='PL')
        {
            if($g_s=='A')
            {
                $this->load->model("M_rpthist"); 
                $this->data['r_data']=$this->M_rpthist->get_fin_pl($param['pf'],$syear,$smonth,$dt,$param['rt']); 
                if($param['a']==0)
                    $this->load->view('rpt_finplhist_html',$this->data);
                else
                    $this->load->view('rpt_finplhist',$this->data);
            }
            else
                echo 'GL is Not Done!';
        }
        else if($param['rn']=='VAL')
        {
            if($n_s=='A')
            {
                $this->load->model("M_rpthist"); 
                $this->data['r_data']=$this->M_rpthist->get_fin_val($param['pf'],$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_finvalhist_html',$this->data);
                else
                    $this->load->view('rpt_finvalhist',$this->data);
            }
            else
                echo 'NAV is not Approved!';
        }
        else if($param['rn']=='MTM')
        {
            if($n_s=='A')
            {
                $this->load->model("M_rpthist"); 
                $this->data['r_data']=$this->M_rpthist->get_fin_mtm($param['pf'],$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_finmtmhist_html',$this->data);
                else
                    $this->load->view('rpt_finmtmhist',$this->data);
            }
            else
                echo 'NAV is not Approved!';
        }
        else if($param['rn']=='TB')
        {
            if($n_s=='A')
            {
                $this->load->model("M_rpthist"); 
                $this->data['r_data']=$this->M_rpthist->get_fin_tb($param['pf'],$sdt,$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_fintbhist_html',$this->data);
                else
                    $this->load->view('rpt_fintbhist',$this->data);
            }
            else
                echo 'NAV is not Approved!';
        }
        else if($param['rn']=='NC')
        {
            if($g_s=='A')
            {
                $this->load->model("M_rpthist"); 
                $this->data['r_data']=$this->M_rpthist->get_fin_nc($param['pf'],$sdt,$dt,$param['rt']); 
                if($param['a']==0)
                    $this->load->view('rpt_finnchist_html',$this->data);
                else
                    $this->load->view('rpt_finnchist',$this->data);
            }
            else
                 echo 'GL is Not Done!'; 
        }
        else if($param['rn']=='GAM')
        {
            if($n_s=='A')
            {
                $this->load->model("M_rpthist"); 
                if($param['acc']=='ALL')
                    $this->data['r_data']=$this->M_rpthist->get_fin_gam_all($param['pf'],$sdt,$dt); 
                else
                    $this->data['r_data']=$this->M_rpthist->get_fin_gam($param['pf'],$param['acc'].'.'.$param['pf'],$sdt,$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_fingamhist_html',$this->data);
                else
                    $this->load->view('rpt_fingamhist',$this->data);
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
                    $this->load->view('rpt_finnavhist_html',$this->data);
                else
                    $this->load->view('rpt_finnavhist',$this->data);
            }
            else
                 echo 'NAV is not Approved!';
        }
        else if($param['rn']=='DGB')
        {
            if($g_s=='A')
            {
                $this->data["map_type"] = array("A"=>"ASSETS","L"=>"LIABILITIES","P"=>"CAPITAL","R"=>"INCOME","E"=>"EXPENSES");
                $this->load->model("M_rpthist"); 
                $this->data['r_data']=$this->M_rpthist->get_fin_dgb($param['pf'],$dt); 
                if($param['a']==0)
                    $this->load->view('rpt_findgbhist_html',$this->data);
                else
                    $this->load->view('rpt_findgbhist',$this->data);
            }
            else
                 echo 'GL is Not Done!'; 
        }
    }
    */
    
} 
?>
