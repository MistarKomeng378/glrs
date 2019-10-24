<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crpt extends CI_Controller {      
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
    function view_rmi ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();
        sql_quot_all($param);   
        $this->data["dt"]=change_dt_format($param['dt'],512);
        
        $this->load->model("M_portfolio");                        
        $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
        
        $this->load->model("M_rmi");            
        $this->data['r_data'] = $this->M_xd1->get_xd1($param["pf"],$this->data["dt"],$param["no"]);            
        if($param["no"]==1)
            $this->load->view('rpt_xd11',$this->data);
        else if($param["no"]==2)
            $this->load->view('rpt_xd12',$this->data);
        else if($param["no"]==3)
            $this->load->view('rpt_xd13',$this->data);
        else 
            echo "No formulir number!";
        
    }
    function preview ()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        $param=$this->input->post();
        sql_quot_all($param);   
        if(!isset($param['a']))
            $param['a']='0';
        $this->data["dt"]=change_dt_format($param['dt'],512);
        
        if (trim($param["pf"])=='')
            echo "Please choose the Portfolio";
        else
        {
            $this->load->model("M_portfolio");                        
            $this->data["r_pf"] = $this->M_portfolio->get_data($param["pf"]);
            
            $this->load->model("M_xd1");            
            $this->data['r_data'] = $this->M_xd1->get_xd1($param["pf"],$this->data["dt"],$param["no"]);            
            if($param['a']=='0')
            {
                if($param["no"]==1)
                    $this->load->view('rpt_xd11_html',$this->data);
                else if($param["no"]==2)
                    $this->load->view('rpt_xd12_html',$this->data);
                else if($param["no"]==3)
                    $this->load->view('rpt_xd13_html',$this->data);
                else 
                    echo "No formulir number!";
            }
            else
            {
                if($param["no"]==1)
                    $this->load->view('rpt_xd11_pdf',$this->data);
                else if($param["no"]==2)
                    $this->load->view('rpt_xd12_pdf',$this->data);
                else if($param["no"]==3)
                    $this->load->view('rpt_xd13_pdf',$this->data);
                else 
                    echo "No formulir number!";
                $html = $this->output->get_output();
        
                // Load library
                $this->load->library('dompdf_gen');
                
                // Convert to PDF
                $this->dompdf->load_html($html);
                $this->dompdf->render();
                $this->dompdf->stream("report_xd1-{$param['no']}.pdf");
            }
        }
        /*$html = $this->output->get_output();
        
        // Load library
        $this->load->library('dompdf_gen');
        
        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf");*/
    }
    
    
} 
?>
