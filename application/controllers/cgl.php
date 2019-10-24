<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cgl extends CI_Controller {      
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
            $param['fm']='ALL';
        if (!isset($param['pf']))
            $param['pf']='ALL';
        $this->load->model("M_gl");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_gl->list_data($param['fm'],$param['pf']); 
        for($i=0;$i<count($this->data['r_data']);$i++)
        {
            $this->data['r_data'][$i]['glname']=utf8_encode($this->data['r_data'][$i]['glname']);
        }
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    function list_data_select()
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
        if (!isset($param['pf']))
            $param['pf']='';
        
        $this->load->model("M_gl");      
        $r_data=$this->M_gl->list_data($param['fm'],$param['pf']); 
        $str_opt='';
        foreach($r_data as $xitem1)
            $str_opt.="<option value=\"{$xitem1['glno']}\">{$xitem1['glno']}.{$param['pf']} - " . utf8_encode($xitem1['glname']) . "</option>";
        echo $str_opt;
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
        if(!isset($param['']))                
        $this->load->model("M_gl");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_gl->save_data($param['fm_code'],$param['pf_code'],$param['gl_no'],$param['gl_name'],$param['gl_sign'],
            $param['gl_type'],$param['gl_cur'],$param['gl_cur1']); 
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
            $param['fm_code']='ALL';
        if (!isset($param['pf_code']))
            $param['pf_code']='ALL';
        $this->load->model("M_gl");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_gl->get_data($param['fm_code'],$param['pf_code'],$param['glno'],$param['glcur'],$param['glcur1']); 
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    function view_nav()
    {
        if($this->data['sess']['uid']=='')
        {
            //echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);   
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        
        $r_section=array();
        $this->load->model("M_nav");
        $r_data=$this->M_nav->check_status($param['pf'],$dt); 
        $r_section['n_a']='NAV Un Approved';
        $r_section['n_g']='GL Un Done';
        if(count($r_data)>0)
        {
            if($r_data[0]['APPROVESTATUS_CUR']=='A')
                $r_section['n_a']='NAV Approved';
            if($r_data[0]['GLDONESTATUS_CUR']=='A')
                $r_section['n_g']='GL Done';
        }
        $r_nav=$this->M_nav->get_detail($param['pf'],$dt); 
        $this->data['r_det']=array('invest'=>number_format($r_nav[0]['NAV_INVEST'],4,'.',','),'gl'=>number_format($r_nav[0]['NAV_GL'],4,'.',','),'diff'=>number_format($r_nav[0]['DIFF'],4,'.',','));
                
        echo json_encode($this->data);
    }
} 
?>