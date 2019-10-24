<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cnagl extends CI_Controller {      
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
    function pre_nagl()
    {
        if($this->data['sess']['uid']=='')
            echo "Session is expired!";
        $param=$this->input->post();
        sql_quot_all($param);
        $this->data['dt']=change_dt_format($param['dt'],512);
        $this->load->model("M_jur");
        $this->M_jur->mtm_process_all($this->data['dt']);
        
        $this->load->model("M_nav");
        $this->data['r_data']=$this->M_nav->pre_gldone_all($this->data['dt']);
        $this->load->view('rpt_nagl_pre',$this->data);
    }
    function nagl_done()
    {
        if($this->data['sess']['uid']=='')
        {
            echo 0; return 0;
        }
        $param=$this->input->post();
        sql_quot_all($param);
        $dt=change_dt_format($param['dt'],512);
        
        $this->load->model("M_nav");
        $this->M_nav->gldone_all($dt,$this->data['sess']['uid']);
        
        echo 1;
    }
} 
?>