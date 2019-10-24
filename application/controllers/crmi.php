<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crmi extends CI_Controller {      
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
    function view ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();
        if(!isset($param['rn']))
            $param['rn']='NAVB';
        sql_quot_all($param);   
        $this->data["dt"]=change_dt_format($param['dt'],512);
        
        $this->load->model("M_portfolio");                        
        $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
        
        $this->load->model("M_rmi");            
        $this->data['r_data'] = $this->M_rmi->get_data($param["fm"],$param["pf"],$this->data["dt"],$param["rn"]);            
        if($param['rn']=='PP')
            $this->load->view('rpt_rmi_pp',$this->data);
        else if($param['rn']=='NAVS')
            $this->load->view('rpt_rmi_navs',$this->data);
        else if($param['rn']=='NAVB')
            $this->load->view('rpt_rmi_navb',$this->data);
        else if($param['rn']=='NAVD')
            $this->load->view('rpt_rmi_navd',$this->data);
        else if($param['rn']=='NAVD1')
            $this->load->view('rpt_rmi_navd1',$this->data);
        
    }
    function preview ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();
        if(!isset($param['rn']))
            $param['rn']='NAVB';
        if(!isset($param['sbt']))
            $param['sbt']='View for Print';
        sql_quot_all($param);
        $this->data['r_par']=$param;
        $this->data["dt"]=change_dt_format($param['dt'],512);
        
        $this->load->model("M_portfolio");                        
        $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);  
        
        $this->load->model("M_fundmanager");                        
        $this->data["r_fm"] = $this->M_fundmanager->get_data($param["fm"]);  
        
        $this->load->model("M_rmi");            
        $this->data['r_data'] = $this->M_rmi->get_data($param["fm"],$param["pf"],$this->data["dt"],$param["rn"]);            
        if ($param["rn"]=='NAVD' && count($this->data['r_data'])>0)
        {
            $gdesc='';
            $tmpg_array=array();
            $tmpg_key=array();
            $tmpg_val=array();
            $tg=0;
            foreach($this->data['r_data']  as $x)
            {
                if ($x['ANU']==0)
                {
                    if($gdesc!=$x['GDESC'])
                    {
                        if($gdesc!='') {$tmpg_key[]=$gdesc;$tmpg_val[]=$tg;}                        
                        $tg=0;
                        $gdesc=$x['GDESC'];
                    }
                    $tg+=$x['AMOUNT'];
                    
                }
            }
            if($gdesc!='') {$tmpg_key[]=$gdesc;$tmpg_val[]=$tg;}
            if(count($tmpg_key)>0)
               $tmpg_array=array_combine($tmpg_key,$tmpg_val);
            
            $gdesc='';   
            $tmp_arr = array();
            foreach($this->data['r_data']  as $x)
            {
                if ($x['ANU']==0 && $gdesc!=$x['GDESC'])
                {
                    $tmp_arr[]= array('ANU'=>0,'GDESC'=>$x['GDESC'],'PORTFOLIOCODE'=>$x['PORTFOLIOCODE'],'DESC'=>$x['GDESC'],
                    'VALDATE'=>$x['VALDATE'],'URUT'=>$x['URUT'],'AMOUNT'=>$tmpg_array[$x['GDESC']],'CURRYIELD'=>$x['CURRYIELD'],
                    'RETURN1YEAR'=>$x['RETURN1YEAR'],'RETURN1YEARACT'=>$x['RETURN1YEARACT'],'RETURN1YEARVALUE'=>$x['RETURN1YEARVALUE'],
                    'RETURN30DAYS'=>$x['RETURN30DAYS'],'CHANGEPERDAYPCT'=>$x['CHANGEPERDAYPCT'],'NAV'=>$x['NAV'],
                    'UNIT'=>$x['UNIT'],'PRICE'=>$x['PRICE'],'DT'=>$x['DT'],
                    'NAV_PY'=>$x['NAV_PY'],'UNIT_PY'=>$x['UNIT_PY'],'DT_PY'=>$x['DT_PY'],'PRICE_PY'=>$x['PRICE_PY'],
                    'NAV_PD'=>$x['NAV_PD'],'UNIT_PD'=>$x['UNIT_PD'],'DT_PD'=>$x['DT_PD'],'PRICE_PD'=>$x['PRICE_PD'],
                    'NAV_LEY'=>$x['NAV_LEY'],'UNIT_LEY'=>$x['UNIT_LEY'],'DT_LEY'=>$x['DT_LEY'],'PRICE_LEY'=>$x['PRICE_LEY'],
                    'NAV_LEM'=>$x['NAV_LEM'],'UNIT_LEM'=>$x['UNIT_LEM'],'DT_LEM'=>$x['DT_LEM'],'PRICE_LEM'=>$x['PRICE_LEM'],
                    'NAV_LM'=>$x['NAV_LM'],'UNIT_LM'=>$x['UNIT_LM'],'DT_LM'=>$x['DT_LM'],'PRICE_LM'=>$x['PRICE_LM'],
                    'PortfolioName'=>$x['PortfolioName'],'NAVDECIMAL'=>$x['NAVDECIMAL'],
                    'PRICEDECIMAL'=>$x['PRICEDECIMAL'],'UNITDECIMAL'=>$x['UNITDECIMAL']);
                    $gdesc=$x['GDESC'];
                }
                $tmp_arr[]=$x;
            }
            $this->data['r_data']=$tmp_arr;
        }
        if($param['sbt']=='View for Print')
        {
            if($param['rn']=='PP')
                $this->load->view('rpt_rmi_pp_html',$this->data);
            else if($param['rn']=='NAVS')
                $this->load->view('rpt_rmi_navs_html',$this->data);
            else if($param['rn']=='NAVB')
                $this->load->view('rpt_rmi_navb_html',$this->data);
            else if($param['rn']=='NAVD')
                $this->load->view('rpt_rmi_navd_html',$this->data);
            else if($param['rn']=='NAVD1')
                $this->load->view('rpt_rmi_navd1_html',$this->data);
        }
        if($param['sbt']=='Save to Excel')
        {
            header("Content-type: application/vnd.ms-excel");            
            if($param['rn']=='PP')
            {
                header("Content-Disposition: attachment;Filename=pp_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['pf']}.xls");
                $this->load->view('rpt_rmi_pp_html',$this->data);
            }
            else if($param['rn']=='NAVS')
            {
                header("Content-Disposition: attachment;Filename=navs_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['fm']}.xls");
                $this->load->view('rpt_rmi_navs_html',$this->data);
            }
            else if($param['rn']=='NAVB')
            {
                header("Content-Disposition: attachment;Filename=navb_" . date_format(date_create($this->data["dt"]),'Ymd') . ".xls");
                $this->load->view('rpt_rmi_navb_html',$this->data);
            }
            else if($param['rn']=='NAVD')
            {
                header("Content-Disposition: attachment;Filename=navd_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['pf']}.xls");
                $this->load->view('rpt_rmi_navd_excel',$this->data);
            }
            else if($param['rn']=='NAVD1')
            {
                header("Content-Disposition: attachment;Filename=navd1_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['fm']}.xls");
                $this->load->view('rpt_rmi_navd1_excel',$this->data);
            }
        }
        if(substr($param['sbt'],0,12)=='Save to Text')
        {
            if($param['rn']=='PP')
            {
                header("Content-Type: application/csv");
                header("Content-Disposition: attachment;Filename=pp_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['pf']}.csv");
                $this->load->view('rpt_rmi_pp_txt',$this->data);
            }
            else if($param['rn']=='NAVS')
            {
                header('content-type text/plain charset=utf-8');
                header("Content-Disposition: attachment;Filename=navs_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['fm']}.txt");
                $this->load->view('rpt_rmi_navs_txt',$this->data);
            }
            else if($param['rn']=='NAVB')
            {
                header("Content-Type: application/csv");
                header("Content-Disposition: attachment;Filename=navb_" . date_format(date_create($this->data["dt"]),'Ymd') . ".csv");
                $this->load->view('rpt_rmi_navb_txt',$this->data);
            }
            else if($param['rn']=='NAVD')
            {
                header("Content-Type: application/csv");
                header("Content-Disposition: attachment;Filename=navd_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['pf']}.csv");
                $this->load->view('rpt_rmi_navd_txt',$this->data);
            }
            else if($param['rn']=='NAVD1')
            {
                header("Content-Type: application/csv");
                header("Content-Disposition: attachment;Filename=navd1_" . date_format(date_create($this->data["dt"]),'Ymd') . "_{$param['fm']}.csv");
                $this->load->view('rpt_rmi_navd1_txt',$this->data);
            }
        }
    }
    
    
} 
?>
