<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cs extends CI_Controller {      
    var $data;
    function __construct()
    {
        parent::__construct();       
        $this->load->helper('url');
        $this->load->library('session');      
        $this->data=array("url"=>base_url());
    }
    function index()
    {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
        {        
            $this->data['sess']= $this->_get_login_info();
            $this->data['uid']=$this->data['sess']['uid'];
            if($this->data['sess']['uid']!='')
                $this->load->view('main',$this->data);  
            else
                $this->load->view('user_login',$this->data);  
        }
        else
        {
            $this->load->view('error_browser',$this->data);  
        }
    }
    function check_session()
    {
        echo $this->session->userdata('uid');
    }
    function _get_login_info()
    {
        $err = array("uid"=>"","name"=>'','lvl'=>100,'group'=>100,'lvl_sub'=>0);
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
                $err['lvl_sub']=$r_data[0]['user_lvl_sub'];
            }
        }
        return $err;
    }
    function _get_login($userid='',$password='')
    {
        $this->load->model("M_user");      
        $r_data=$this->M_user->get_info($userid); 
        $err = array("no"=>0,"wrong"=>0,"wrong_max"=>0,"exp_login"=>0,"exp_password"=>0,"name"=>'','lvl'=>100,'group'=>100,"user"=>"");
        if(count($r_data)>0)
        {
            $err['exp_login']=$r_data[0]['expired_login'];
            $err['exp_password']=$r_data[0]['expired_password'];
            $err['wrong']=$r_data[0]['user_wrong_pass']; 
            $err['wrong_max']=$r_data[0]['wrong_pass']; 
            $err['name']=$r_data[0]['user_name']; 
            $err['lvl']=$r_data[0]['user_lvl']; 
            $err['group']=$r_data[0]['user_group']; 
            $err['user']=$userid;
            $err['min_pass']=$r_data[0]['min_password']; 
            $err['alphanum']=$r_data[0]['alphanum_pass']; 
            $err['caps']=$r_data[0]['caps_pass']; 
            $err['recycle']=$r_data[0]['recycle_pass']; 
            
            if($r_data[0]['user_enable']==1)
            {
                if($r_data[0]['user_locked']==0)   
                {
                    if($r_data[0]['user_password']==md5($password))
                    {
                        if($r_data[0]['user_lvl']==-1)
                            $err['no']=0;
                        else if($r_data[0]['day_last_login']<=$r_data[0]['expired_login'])
                        {
                            if($r_data[0]['day_last_change']>$r_data[0]['expired_password'])
                                $err['no']=6; // expired password
                        }
                        else                    
                            $err['no']=5; // expired login
                    }
                    else
                        $err['no']=4; // Wrong Password
                }
                else
                    $err['no']=3; // user Locked
            }
            else
                $err['no']=2; // wrong Disabled
        }
        else
            $err['no']=1; // user does not exists
        return $err;        
    }
    
    function do_login()
    {
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $err_login = $this->_get_login($param['g_ud'],$param['g_up']);
        $this->load->model("M_user");
        if($err_login['no']==4 && $err_login['lvl']!=-1)
        {
            $this->M_user->set_wrong_pass_count($param['g_ud'],$err_login['wrong']+1);
            if($err_login['wrong']+1==$err_login['wrong_max'])
                $this->M_user->lock($param['g_ud'],1);
        }
        else if($err_login['no']>4)
            $this->M_user->set_wrong_pass_count($param['g_ud'],0);
        if($err_login['no']==5)
            $this->M_user->lock($param['g_ud'],1);
        if($err_login['no']==0)
            $this->M_user->reset_last_login($param['g_ud']);
        $this->data['err_login']=$err_login;
        if($err_login['no']==0)
        {
            $arr_sesion= array("uid"=>"");
            $this->session->unset_userdata($arr_sesion);
            $arr_sesion= array("uid"=>trim($param['g_ud']));
            $this->session->set_userdata($arr_sesion);
            $this->M_user->set_wrong_pass_count($param['g_ud'],0);
            header("location: {$this->data['url']}");
        }
        else if($err_login['no']==6)
        {
            $this->data['uid']=$param['g_ud'];
            $this->M_user->set_wrong_pass_count($param['g_ud'],0);
            $this->load->view('user_change',$this->data);  
        }
        else
            $this->load->view('user_login',$this->data);  
    }
    function do_logout()
    {
        $arr_sesion= array("uid"=>"");
        $this->session->unset_userdata($arr_sesion);
        header("location: " . base_url() );
    }
    function change_pass()
    {
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);   // print_r($param);
        $this->load->model("M_user");
        $err_login = $this->_get_login($param['g_ud'],$param['g_up1']);
        $err_change=0;
        if($err_login['no']==4)
            $err_change=1; /// wrong old password
        else if($err_login['no']>5 || $err_login['no']==0)
        {
            if($param['g_up2']==$param['g_up3'])
            {
                $c_alpha=preg_match('/[a-z]/',$param['g_up2']);
                $c_num=preg_match('/[0-9]/',$param['g_up2']);
                $c_caps=preg_match('/[A-Z]/',$param['g_up2']);
                
                $c_p=$err_login['alphanum'];
                if($err_login['min_pass']<=strlen($param['g_up2']))
                {
                    if( ($c_p==0 && $c_alpha==1 ) || ($c_p==1 && $c_alpha==1 && $c_num==1) )
                    {
                        if( ($err_login['caps']==1 && $c_caps==1) || $err_login['caps']==0)
                            $err_change=0;
                        else
                            $err_change=7; // not contain caps lock
                    }
                    else if($c_p==0)
                        $err_change=5; // Not contain alpha
                    else 
                        $err_change=6; // Not contain alpha numeric
                }
                else
                    $err_change = 4; // password min lentgh error
            }
            else
                $err_change=3; //password not matchx            
        }
        else
            $err_change=2; // disabled, lock, expired login
         $this->data['uid']=$param['g_ud'];  
         $this->data['err_change']=$err_change;  
         $this->data['err_change_min']=$err_login['min_pass'];  
         $this->data['err_change_am']=$err_login['alphanum'];  
         $this->data['err_change_caps']=$err_login['caps'];  
         if($err_change==0)
         {
             $this->M_user->change_password($param['g_ud'],md5($param['g_up2']));
         }
         $this->load->view('user_change',$this->data);          
    }
    function show_change_pass()
    {
        $this->data["sess"]=$this->_get_login_info();
        $this->data['uid']=$this->data["sess"]['uid'];
        if( $this->data['uid']=='')
            header("location: {$this->data['url']}");
        else
            $this->load->view('user_change',$this->data);       
    }
} 
?>