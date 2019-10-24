<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cui extends CI_Controller {      
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
    function get_last_date()
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
        $this->load->model("M_ui");      
        $this->data['r_data']=$this->M_ui->get_last_date($param['pf']); 
        if(count($this->data['r_data'])>0)
        {
            $this->data['r_data'][0]['dt']=date_format($this->data['r_data'][0]['ProcessDate'],"F d, Y");
            $this->data['r_data'][0]['amount']=number_format($this->data['r_data'][0]['TotalUnitIssued'],4,'.',',');
        }
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
        if (!isset($param['dt']))
            $param['dt']='01-01-1900';
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->load->model("M_ui");      
        $this->data['r_data']=$this->M_ui->get_data($param['pf'],$dt); 
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    function upd_data()
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
        if (!isset($param['dt']))
            $param['dt']='01-01-1900';
        if (!isset($param['nml']))
            $param['nml']=0;
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->load->model("M_ui");      
        $this->data['r_data']=$this->M_ui->upd_data($param['pf'],$dt,0+$param['nml'],$this->data['sess']['uid']); 
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    
} 
?>