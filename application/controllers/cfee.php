<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfee extends CI_Controller {      
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
    function list_code()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }
        $this->load->model("M_fee");      
        $r_data=$this->M_fee->list_code();
        $str_data="";
        foreach($r_data as $xitem)
            $str_data.="<option value=\"{$xitem['FEECODE']}\">{$xitem['FEEDESCRIPTION']}</option>";
        echo $str_data;
    }
    function list_master()
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
            $param['pf']='';
        $this->load->model("M_fee");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_fee->list_master($param['fm'],$param['pf']); 
        /*for($i=0;$i<count($this->data['r_data']);$i++)
        {
                $this->data['r_data'][$i]['from_s']=is_object($this->data['r_data'][$i]['STARTDATE'])?date_format($this->data['r_data'][$i]['STARTDATE'],'d-m-Y'):"";
                $this->data['r_data'][$i]['to_s']=is_object($this->data['r_data'][$i]['ENDATE'])?date_format($this->data['r_data'][$i]['ENDATE'],'d-m-Y'):"";
                $this->data['r_data'][$i]['from_s1']=is_object($this->data['r_data'][$i]['STARTDATE'])?date_format($this->data['r_data'][$i]['STARTDATE'],'m/d/Y'):"";
                $this->data['r_data'][$i]['to_s1']=is_object($this->data['r_data'][$i]['ENDATE'])?date_format($this->data['r_data'][$i]['ENDATE'],'m/d/Y'):"";
        } */
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    
    function save_data()
    {
        if($this->data['sess']['uid']=='')
        {
            echo 0;
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);   
        //$sdt = change_dt_format(remove_bad_sql(str_sql_string($param["fem_from"])),512);
        //$edt = change_dt_format(remove_bad_sql(str_sql_string($param["fem_to"])),512);
        $this->load->model("M_fee");      
        $this->M_fee->save_data($param['pf_code'],$param['fem_code'],$param['fem_pct'],$param['fem_val'],$param['fem_year'],$param['fem_flat'],$param['fem_daily'],$param['fem_enable'],$param['fem_inc'],$param['fem_tax'],$param['fem_base'],$param['fem_fnav']); 
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
        if (!isset($param['pf_code']))
            $param['pf_code']='';
        $this->load->model("M_portfolio");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_portfolio->get_data($param['pf_code']); 
        for($i=0;$i<count($this->data['r_data']);$i++)
            $this->data['r_data'][$i]['curryear_s']=is_object($this->data['r_data'][$i]['curryear'])?date_format($this->data['r_data'][$i]['curryear'],'d-m-Y'):"";
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    function list_master_detail()
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
        if (!isset($param['code']))
            $param['code']='';
        $this->load->model("M_fee");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_fee->list_master_detail($param['pf'],$param['code']); 
        $this->data['r_rows']=count($this->data['r_data']);
        echo json_encode($this->data);
    }
    function save_data_detail()
    {
        if($this->data['sess']['uid']=='')
        {
            echo 0;
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $this->load->model("M_fee");      
        $this->M_fee->save_data_detail($param['pf_code'],$param['fem_code'],$param['fem_pct'],$param['fem_end'],$param['fem_no']); 
        echo 1;
    }
    function delete_data_detail()
    {
        if($this->data['sess']['uid']=='')
        {
            echo 0;
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $this->load->model("M_fee");      
        $this->M_fee->delete_data_detail($param['pf_code'],$param['fem_code'],$param['fem_no']); 
        echo 1;
    }
    function view_exp()
    {
        if($this->data['sess']['uid']=='')
        {
            echo "Seesion Expired!";
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->data['dt']=$dt;
        $this->load->model("M_portfolio");                        
        $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
        $this->load->model("M_fee");      
        $this->data['r_data']=$this->M_fee->get_expense($param['pf'],$dt); 
        $this->load->view('rpt_expenses',$this->data);
    }
    function preview()
    {
        if($this->data['sess']['uid']=='')
        {
            echo "Seesion Expired!";
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->data['dt']=$dt;
        $this->load->model("M_portfolio");                        
        $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
        $this->load->model("M_fee");      
        $this->data['r_data']=$this->M_fee->get_expense($param['pf'],$dt); 
        $this->load->view('rpt_expenses_html',$this->data);
    }
    function udata()
    {
        if($this->data['sess']['uid']=='')
        {
            echo "Seesion Expired!";
            return 0;
        }
        $this->load->model("M_fee");      
        $this->data['r_datam']=$this->M_fee->get_master(); 
        $this->data['r_datat']=$this->M_fee->get_detail(); 
        header("Content-type: application/vnd.ms-excel");            
        header("Content-Disposition: attachment;Filename=parameter_fee.xls");
        $this->load->view('rpt_listexpenses_xls',$this->data);
    }
} 
?>