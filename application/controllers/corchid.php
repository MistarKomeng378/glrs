<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Corchid extends CI_Controller {      
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
        if (!isset($param['t']))
            $param['t']=0;
        $this->load->model("M_orchid");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_orchid->list_data($param['t']); 
        
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
                
        $this->load->model("M_orchid");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_orchid->save_data($param['oc_code'],$param['oc_name']); 
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
        if (!isset($param['oc_code']))
            $param['oc_code']='';
        $this->load->model("M_orchid");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_orchid->get_data($param['oc_code']); 
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    
} 
?>