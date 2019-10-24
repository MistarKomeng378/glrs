<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfundmanager extends CI_Controller {      
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
        $this->load->model("M_fundmanager");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_fundmanager->list_data($param['t']); 
        //for($i=0;$i<count($this->data['r_data']);$i++)
        //{
        //    $this->data['r_data'][$i]['curryear_s']=is_object($this->data['r_data'][$i]['curryear'])?date_format($this->data['r_data'][$i]['curryear'],'Y-m-d'):"";
        //}
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
                
        $this->load->model("M_fundmanager");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_fundmanager->save_data($param['fm_code'],$param['fm_name'],$param['fm_addr1'],$param['fm_addr2'],$param['fm_addr3'],
            $param['fm_city'],$param['fm_country'],$param['fm_postal'],$param['fm_phone1'],$param['fm_phone2'],$param['fm_fax1'],$param['fm_fax2']
            ,$param['fm_mail'],$param['fm_mailaddr'],$param['fm_mailcc'],$param['fm_time'],$param['fm_ibpa']); 
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
        if (!isset($param['fm_code']))
            $param['fm_code']='';
        $this->load->model("M_fundmanager");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_fundmanager->get_data($param['fm_code']); 
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
} 
?>