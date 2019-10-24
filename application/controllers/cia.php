<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cia extends CI_Controller {      
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
            $param['fm']='';
        if (!isset($param['pf']))
            $param['t']='';
        $this->load->model("M_ia");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_ia->list_data($param['fm'],$param['pf']); 
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
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
        if (!isset($param['pf']))
            $param['pf']='';
       $this->load->model("M_ia");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_ia->get_data($param['pf']); 
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
        
        
        $this->load->model("M_ia");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_ia->save_data($param['pf'],$param['a_min'],$param['a_max'],$param['fi_min'],$param['fi_max'],
            $param['mm_min'],$param['mm_max'],$param['c_min'],$param['c_max'],$param['sub_min'],$param['red_min']); 
        echo 1;
    } 
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