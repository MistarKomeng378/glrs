<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cportfolio extends CI_Controller {      
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
    function list_data()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        if (!isset($param['fm']))
            $param['fm']='ALL';
        if (!isset($param['t']))
            $param['t']='0';
        $this->load->model("M_portfolio");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_portfolio->list_data($param['fm'],$param['t']); 
        for($i=0;$i<count($this->data['r_data']);$i++)
        {
            if($param['t']!='1')
                $this->data['r_data'][$i]['curryear_s']=is_object($this->data['r_data'][$i]['curryear'])?date_format($this->data['r_data'][$i]['curryear'],'d-m-Y'):"";
        }
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    
    function save_data()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);   
        if($param['pf_fm']=='ALL')
            $param['pf_fm']='';
        $filecode = preg_replace("/0+/",'',$param['pf_code'],1);
        $pf_cy = change_dt_format(remove_bad_sql(str_sql_string($param["pf_cy"])),512);     
        $this->load->model("M_portfolio");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_portfolio->save_data($param['pf_code'],$param['pf_name'],$param['pf_fm'],$pf_cy,$param['pf_cur'],$param['pf_active'],$param['pf_ph'],$param['pf_mm'],
                $param['pf_type'],$param['pf_pdec'],$param['pf_ndec'],$param['pf_udec'],$param['pf_mail'],$filecode,$param['pf_gl'],$param['pf_otype'],$param['pf_okind'],$param['pf_scode'],$param['pf_tb'],$param['pf_mailtb'],$param['pf_mailval']); 
        echo 1;
    }
    function get_data()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        if (!isset($param['pf_code']))
            $param['pf_code']='';
        $this->load->model("M_portfolio");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_portfolio->get_data($param['pf_code']); 
        for($i=0;$i<count($this->data['r_data']);$i++)
            $this->data['r_data'][$i]['curryear_s']=is_object($this->data['r_data'][$i]['curryear'])?date_format($this->data['r_data'][$i]['curryear'],'d-m-Y'):"";
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    // Edit By MistarKomeng
    function tes()
    {
         $this->load->model("M_portfolio");      
        $dtr=$this->M_portfolio->list_data('ALL',1); 
        foreach($dtr as $xitem1)
        {
            $pfcode=$xitem1['pfcode'];
            echo "update portfoliotb set filecode='";
            echo preg_replace("/0+/",'',$xitem1['pfcode'],1);
            echo "' where portfoliocode='{$pfcode}';\n";
        }
    }
} 
?>