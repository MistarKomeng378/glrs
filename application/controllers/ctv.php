<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ctv extends CI_Controller {      
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
    function getrpt ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();         
        if(is_array($param))
            sql_quot_all($param);;
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->data['dt']=$dt;
        $this->load->model("M_rpt");        
        
        $data=$this->M_rpt->get_tv($dt); 
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment;Filename=totalvalue_" . date_format(date_create($this->data["dt"]),'Ymd') . ".csv");
        echo "\"PortfolioCode\",\"portfolioname\",\"EQUITY\",\"CORPORATE BONDS\",\"GOVERNMENT BONDS\",\"INVESTMENT FUNDS\",\"MEDIUM TERM NOTES\",\"LAIN2\",\"ASSET\"\r\n";
        foreach($data as $xitem1)
        {
            $t=$xitem1['E']+$xitem1['CB']+$xitem1['GB']+$xitem1['MF']+$xitem1['MTN']+$xitem1['O'];
            echo "\"{$xitem1['PortfolioCode']}\",\"{$xitem1['PortfolioName']}\",{$xitem1['E']},{$xitem1['CB']},{$xitem1['GB']},{$xitem1['MF']},{$xitem1['MTN']},{$xitem1['O']},{$t} \r\n";
        }
    }
    
} 
?>
