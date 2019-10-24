<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuser extends CI_Controller {      
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
    function get_parameter()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $this->load->model("M_user");
        $this->data['r_data']=$this->M_user->get_parameter();
        echo json_encode($this->data);
    }
    function update_parameter()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);   
        $this->load->model("M_user");
        $this->data['r_data']=$this->M_user->update_parameter($param['eld'],$param['epd'],$param['minp'],$param['anp'],$param['ccp'],$param['rtp'],$param['mwp'],$param['minu'],$param['maxu']);
        echo 1;
    }
    function list_data()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $this->load->model("M_user");      
        $this->data['r_rows']=0;
        $this->data['r_data']=$this->M_user->list_data($this->data['sess']['uid']); 
        for($i=0;$i<count($this->data['r_data']);$i++)
        {
            $this->data['r_data'][$i]['ulastlog_s']=is_object($this->data['r_data'][$i]['ulastlog'])?date_format($this->data['r_data'][$i]['ulastlog'],'F d, Y'):"";
            $this->data['r_data'][$i]['ulastpass_s']=is_object($this->data['r_data'][$i]['ulastpass'])?date_format($this->data['r_data'][$i]['ulastpass'],'F d, Y'):"";
        }
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
        if($this->data['sess']['lvl']>=5)
        {
            echo "User don't have rigth to create new user or update existing user!";
            return 0;
        }
        $param=$this->input->post();
        $this->load->model("M_user");
        $err='';
        if($param['a']=='n')
        {
            $r_data = $this->M_user->get_parameter();
             
            
            $c_alpha=preg_match('/[a-z]/',$param['p1']);
            $c_num=preg_match('/[0-9]/',$param['p1']);
            $c_caps=preg_match('/[A-Z]/',$param['p1']);
            
            $isabovemin = strlen($param['p1']) >=$r_data[0]['min_password']?true:false;
            $is_alpha = ($r_data[0]['alphanum_pass']==1 && $c_alpha && $c_num) ||  $r_data[0]['alphanum_pass']==0?true:false;
            $is_caps = ($r_data[0]['caps_pass']==1 && $c_caps) or $r_data[0]['caps_pass']==0?true:false;
            
            
            if(!$isabovemin)
                $err="Minimal password length must {$r_data[0]['min_password']} char!";
            else if(!$is_alpha)
                $err='Password must contains alhpabhet and numeric!';
            else if (!$is_caps)
                $err="Password must contains capitalize char";
            else
            {
                $r_save = $this->M_user->save_data($param['uid'],$param['uname'],md5($param['p1']),$param['ulvl'],1,$param['uenable'],$param['ulock'],$param['a'],$this->data['sess']['uid']);
                if($r_save[0]['err']=='1')
                    $err="you don't have right to create user!";
                else  if($r_save[0]['err']=='2')
                    $err = 'User already exists!';
                else 
                    $err=1;
            }
        } 
        else
        {
            $r_save = $this->M_user->save_data($param['uid'],$param['uname'],'',$param['ulvl'],1,$param['uenable'],$param['ulock'],$param['a'],$this->data['sess']['uid']);
            if($r_save[0]['err']=='3')
                $err = 'User does not exists!';
            else 
                $err=1;
        }
        echo $err;
    }
    function reset_pass()
    {
         if($this->data['sess']['uid']=='')
        {
            echo 0;
            return 0;
        }
        if($this->data['sess']['lvl']>=5)
        {
            echo "User don't have rigth to reset password!";
            return 0;
        }
        $param=$this->input->post();
        $this->load->model("M_user");
        $err='';
        
        $r_data = $this->M_user->get_parameter();
             
        $c_alpha=preg_match('/[a-z]/',$param['p1']);
        $c_num=preg_match('/[0-9]/',$param['p1']);
        $c_caps=preg_match('/[A-Z]/',$param['p1']);
        
        $isabovemin = strlen($param['p1']) >=$r_data[0]['min_password']?true:false;
        $is_alpha = ($r_data[0]['alphanum_pass']==1 && $c_alpha && $c_num) ||  $r_data[0]['alphanum_pass']==0?true:false;
        $is_caps = ($r_data[0]['caps_pass']==1 && $c_caps) or $r_data[0]['caps_pass']==0?true:false;
        
        
        if(!$isabovemin)
            $err="Minimal password length must {$r_data[0]['min_password']} char!";
        else if(!$is_alpha)
            $err='Password must contains alhpabhet and numeric!';
        else if (!$is_caps)
            $err="Password must contains capitalize char";
        else
        {
            $r_save = $this->M_user->reset_pass($param['uid'],md5($param['p1']),$this->data['sess']['uid']);
            if($r_save[0]['err']=='1')
                $err="you don't have right to reset password!";
            else 
                $err=1;
        }
        echo $err;
    }
} 
?>