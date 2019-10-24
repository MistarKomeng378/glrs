<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfia extends CI_Controller {      
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
    function get_tax ()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }
        $param=$this->input->post();
        if(is_array($param))
            sql_quot_all($param);   
        if(!isset($param['a']))
            $param['a']=0;
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->load->model("M_fi");
        $this->data['r_fi']=$this->M_fi->get_tax($param['pf'],$dt); 
        $this->data['r_rows']=count($this->data['r_fi']);
        for($i=0;$i<count($this->data['r_fi']);$i++)
        {
            $this->data['r_fi'][$i]['LASTCOUPON_s']=is_object($this->data['r_fi'][$i]['LASTCOUPON'])?date_format($this->data['r_fi'][$i]['LASTCOUPON'],'d-m-Y'):"";
            $this->data['r_fi'][$i]['SETTLEDATE_s']=is_object($this->data['r_fi'][$i]['SETTLEDATE'])?date_format($this->data['r_fi'][$i]['SETTLEDATE'],'d-m-Y'):"";
        }
        $this->data['r_finet']=$this->M_fi->get_tax_net($param['pf'],$dt);    
        echo json_encode($this->data);
    }
    function view_tax ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();
        if(is_array($param))
            sql_quot_all($param);   
        
        $this->load->model("M_portfolio");
        $this->data['r_pf']=$this->M_portfolio->get_data($param['pf']); 
                
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->data['dt']=$dt;
        $this->data['pf']=$param['pf'];
        
        $this->load->model("M_nav");
        $r_data=$this->M_nav->check_status_cur($param['pf'],$dt); 
        $n_s ='';
        $g_s ='';
        if(count($r_data)>0)
        {
            $n_s=$r_data[0]['APPROVESTATUS'];
            $g_s=$r_data[0]['GLDONESTATUS'];
            
        }
        //if($n_s=='A')
        //{
            $this->load->model("M_fi");
            $this->data['r_tax']=$this->M_fi->get_tax($param['pf'],$dt);
             $this->data['r_utrx']=$this->M_fi->get_unset_trans($param['pf'],$dt);
             $this->data['r_usal']=$this->M_fi->get_acc_sales_unset($param['pf'],$dt);
             $this->data['r_adj1']=$this->M_fi->get_fiunsettle_tax_adjust1($param['pf'],$dt);
             $this->data['r_adj']=$this->M_fi->get_fiunsettle_txn_adjust($param['pf'],$dt);
            $this->load->view('rpt_finfia_html',$this->data);
        //}
        //else
        //    echo "NAV is not approved!";
    }
    
} 
?>
