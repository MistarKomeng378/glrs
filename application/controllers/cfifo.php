<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfifo extends CI_Controller {      
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
        sql_quot_all($param);   
        $this->data['par']=$param;
        if (trim($param["pf"])=='')
            echo "Please choose the Portfolio";
        else
        {
            $this->load->model("M_portfolio");                        
            $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
            
            $this->load->model("M_fi");            
            $this->data['r_data'] = $this->M_fi->get_fifo_trx($param["pf"],$param['sec'],0+$param['u'],0+$param['p']);
            $this->load->view('fifo_sale',$this->data);            
        }
    }
    function preview ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();
        sql_quot_all($param);   
        $this->data['par']=$param;
        if (trim($param["pf"])=='')
            echo "Please choose the Portfolio";
        else
        {
            $this->load->model("M_portfolio");                        
            $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
            
            $this->load->model("M_fi");            
            $this->data['r_data'] = $this->M_fi->get_fifo_trx($param["pf"],$param['sec'],0+$param['u'],0+$param['p']);
            $this->load->view('fifo_sale_html',$this->data);            
        }
    }
    
} 
?>
