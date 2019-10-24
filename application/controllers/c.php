<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C extends CI_Controller {      
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
        $err = array("uid"=>"","name"=>'','lvl'=>100,'group'=>100,'lvl_sub'=>0);
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
                $err['lvl_sub']=$r_data[0]['user_lvl_sub'];
            }
        }
        return $err;
    }
    function p($page='')
    {
        if(trim($this->data['sess']['uid'])=='') echo 'nosess';
        if($page=='f_pf')
        {
            $this->load->model("M_portfolio");
            $this->data['r_type']=$this->M_portfolio->list_orchid_type();
            $this->data['r_kind']=$this->M_portfolio->list_orchid_kind();
            $this->data['mm_id']=$this->M_portfolio->list_mm_fund_type();
        }
        $this->load->view($page,$this->data);  
    }
    
} 
?>