<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csubred extends CI_Controller {      
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
    
    function upload()
    {
        if($this->data['sess']['uid']=='')
        {
            echo "0";
            return 0;
        } 
        $param=$this->input->post();
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'txt|csv';
        $config['max_size']    = '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        
        $field_name = "subred_f";

        $this->load->library('upload', $config); 

        //$this->data = array("err"=>1,"rows"=>0,"rows_inserted"=>0,"rows_skipped"=>0,"rows_wrong"=>0);
        
        if ( $this->upload->do_upload($field_name))
        {                                           
            $data = array('upload_data' => $this->upload->data());
            $separator = ',';    /** separator used to explode each line */
            $enclosure = '"';    /** enclosure used to decorate each field */
            $max_row_size = 4096;    /** maximum row size to be used for decoding */
            
            
            $content = array();
            $nrow=0;
            $nrow_inserted = 0;
            $nrow_skipped = 0;
            $nrow_wrong = 0;        
            $filehandle = fopen($data["upload_data"]["full_path"], 'r');             
            
            $this->load->model("M_subred");
            $this->M_subred->delete_tmp();
            $this->M_subred->clear_batch_query();
            $irow=0;
            while( ($row = fgetcsv($filehandle, $max_row_size, $separator)) !== false ) {              //     echo count($row); 
            
                if( $row[0] != null && count($row)>=6 && trim($row[0])!='ENTRYDT' && isDate($row[0])) 
                {
                    if(date_create($dt)==date_create(trim($row[0])) && trim($row[5])!='')
                    {
                        $this->M_subred->insert_batch(trim($row[1]),trim($row[0]),trim($row[3]),trim($row[5]),$this->data['sess']['uid']);
                        $irow++;
                    }
                    if($irow%100==0 && $irow!=0)
                    {
                        $this->M_subred->run_batch_query();
                        $irow=0;
                    }
                }
                
            }
            if($irow!=0)
                $this->M_subred->run_batch_query();
            fclose($filehandle);              
        }
    }
    function get_rekon()
    {
        if($this->data['sess']['uid']=='')
        {
            echo "0";
            return 0;
        }
        
        $param=$this->input->post();
        if(!isset($param['dt']))
            $param['dt']=date('d-m-Y');;
        if(!isset($param['a']))
            $param['a']='';
        sql_quot_all($param);   
        $this->data["dt"]=change_dt_format($param['dt'],512);
        
        $this->load->model("M_subred");                        
        $this->data["r_data"] = $this->M_subred->get_rekon($this->data["dt"]);
        if($param['a']=='')
            $this->load->view('rpt_subred_rekon_html',$this->data);
        else
            $this->load->view('rpt_subred_rekon',$this->data);
            
        
    }
} 
?>