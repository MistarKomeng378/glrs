<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cnl extends CI_Controller {      
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
    function view_listing ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();         
        if(is_array($param))
            sql_quot_all($param);   
        if(!isset($param['a']))
            $param['a']=0;
        $sdt = change_dt_format(remove_bad_sql(str_sql_string($param["sdt"])),512);     
        $edt = change_dt_format(remove_bad_sql(str_sql_string($param["edt"])),512);     
        $this->data['sdt']=$sdt;
        $this->data['edt']=$edt;
        $this->data['pf']=$param['pf'];
        $this->load->model("M_rpt");        
        
        $this->data['r_data']=$this->M_rpt->get_navlisting($param['pf'],$sdt,$edt); 
        if($param['a']==0)
            $this->load->view('rpt_nl_html',$this->data);
        else
            $this->load->view('rpt_nl',$this->data);
    }
    
} 
?>
