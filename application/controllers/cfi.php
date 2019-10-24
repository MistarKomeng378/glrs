<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfi extends CI_Controller {      
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
    function list_sectrx_select ()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }
        $param=$this->input->post();
        if(is_array($param))
            sql_quot_all($param);   
        if(!isset($param['pf']))
            $param['pf']='';
        
        $this->load->model("M_fi");
        $r_data=$this->M_fi->get_sectrx($param['pf']); 
        foreach($r_data as $xitem)
            echo "<option value=\"{$xitem['seccode']}\">{$xitem['seccode']} - {$xitem['secname']}</option>";
    }
    
    
} 
?>
