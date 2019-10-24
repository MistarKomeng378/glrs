<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cupload extends CI_Controller {      
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
    
    function upload()
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
    
    
} 
?>