<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crsinvest extends CI_Controller {      
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
    function g()
    {
        if($this->data['sess']['uid']=='')
        {                                 
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->load->model("M_rsinvest");
        if($param['rn']=='NAVK' || $param['rn']=='NAVP')
        {
            $r_data=$this->M_rsinvest->get_nav($dt,$param['rn']); 
            header('content-type text/plain charset=utf-8');
            header("Content-Disposition: attachment;Filename=sinvest_navp_" . date_format(date_create($param["dt"]),'Ymd') . ".txt");
            echo "\r\n";
            foreach($r_data as $xitem1)
            {
                echo date_format($xitem1['NAVDate'],'Ymd') . "|";
                echo trim($xitem1['BCODE']) . "|";
                echo trim($xitem1['SINVESTCODE']) . "|";
                echo number_format($xitem1['Price'],4,'.','') . "|";
                echo number_format($xitem1['TotalNAV'],2,'.','') . "|";
                echo number_format($xitem1['RETURN30DAYS'],2,'.','') . "|";
                echo number_format($xitem1['RETURN1YEARACT'],2,'.','') . "|";
                echo number_format($xitem1['RETURN1YEAR'],2,'.','') . "|";
                echo number_format($xitem1['TotalUnitIssued'],4,'.','') . "||\r\n";
            }
        }
    }
} 
?>
