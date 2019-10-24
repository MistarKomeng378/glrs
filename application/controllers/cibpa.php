<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cibpa extends CI_Controller {      
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
    function list_file()
    {
        if($this->data['sess']['uid']=='')
        {
            echo "0";
            return 0;
        } 
        $param=$this->input->post(); 
        list($tgl,$bln,$th)=explode("-",$param['dt']);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->load->model("M_ibpa");
        $arr_data=$this->M_ibpa->get_setting(); 
        $base_dir=$arr_data[0]['base_dir'];
        $base_dir_sys=$arr_data[0]['base_dir_sys'];
        if(is_dir("{$base_dir}/{$th}/{$bln}/{$tgl}"))
        {
            if ($handle = opendir("{$base_dir}/{$th}/{$bln}/{$tgl}")) {
                echo "<b>List of ibpa files on " . date_format(date_create($dt),'F d, Y') . "</b><br /> <br />";
                echo "<table width=\"90%\" cellpadding=\"3\" border=\"0\">";
                $icol=0;
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if ($icol % 4 ==0)
                        {
                            if($icol!=0)
                                echo "</tr>";
                            echo "<tr>";
                        }
                        echo "<td align=\"center\"><a href=\"{$this->data["url"]}index.php/cibpa/get_file/{$th}/{$bln}/{$tgl}/{$file}\">{$file}</a></td>";
                        $icol++;
                    }
                }
                if($icol!=0)
                    echo "</tr>";
                    echo "</table>";
                closedir($handle);
            }
        }
    }
    function get_file($th,$bln,$tgl,$fname)
    {
        header("Content-Type: text/csv; ");
        header("Content-disposition: attachment; filename={$fname}");
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->load->model("M_ibpa");
        $arr_data=$this->M_ibpa->get_setting(); 
        $base_dir=$arr_data[0]['base_dir'];
        $base_dir_sys=$arr_data[0]['base_dir_sys'];
        if(file_exists("{$base_dir}/{$th}/{$bln}/{$tgl}/{$fname}"))
        {
            $handle = @fopen("{$base_dir}/{$th}/{$bln}/{$tgl}/{$fname}", "r");
            if ($handle) {
                while (!feof($handle)) {
                    $buffer = fgets($handle, 4096);
                    echo $buffer;
                }
                fclose($handle);
            }  
        }
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
        
        $field_name = "ibpa_f";

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
            
            $this->load->model("M_ibpa");
            $arr_data=$this->M_ibpa->get_setting(); 
            $base_dir=$arr_data[0]['base_dir'];
            $base_dir_sys=$arr_data[0]['base_dir_sys'];
            $arr_data=$this->M_ibpa->get_mi_ph(); 
            $arr_file_token = array();
            $cur_mi_code=''; 
            list($tgl,$bln,$th)=explode("-",$param['dt']);
            
            
            

            @exec("cmd /c mkdir {$base_dir_sys}\\{$th}\\{$bln}\\{$tgl}");
            @exec("cmd /c del /q {$base_dir_sys}\\{$th}\\{$bln}\\{$tgl}\\*.*");
            
            
            
            $header = array();
            
                            //   echo $data["upload_data"]["full_path"];
            if( ($row = fgetcsv($filehandle, $max_row_size, $separator)) !== false )
                $header = $row;
            $tglbenar=true;
            while( ($row = fgetcsv($filehandle, $max_row_size, $separator)) !== false && $tglbenar ) {              //     echo count($row); 
                if( $row[0] != null || count($row)>7 ) 
                {
                    $tg= substr(trim($row[1]),6,2) . "-" . substr(trim($row[1]),4,2) . "-" . substr(trim($row[1]),0,4); 
                    if ($tg!=trim($param['dt']))
                    {
                        echo "Tanggal data salah!";
                        $tglbenar=false;
                    }
                    if($cur_mi_code!=strtoupper(trim($row[2])))
                    { 
                        $cur_mi_code=strtoupper(trim($row[2]));
                        $ada=false;
                        $irow=0;
                        while($irow<count($arr_file_token) && !$ada)
                        {
                            if($arr_file_token[$irow]['mi_ibpa_code']==$cur_mi_code )
                                $ada=true;
                            else 
                                $irow++;
                        }
                        if(!$ada)
                        {
                            $ph='';
                            $mi_code=trim($cur_mi_code); 
                            foreach($arr_data as $xitem1)
                            {
                                if(  $xitem1['mi_code'] == substr(trim($cur_mi_code),0,strlen($xitem1['mi_code'])))
                                {
                                   $ph=trim($xitem1['mi_pricing_hour']);
                                   $ph=str_replace(":","",$ph);
                                    $arr_file_token[]=array('mi_ibpa_code'=>$cur_mi_code,'filetoken'=>fopen("{$base_dir}//{$th}//{$bln}//{$tgl}//{$ph}{$tgl}{$bln}.csv", 'w+'));
                                }
                            }
                        }
                    }
                    if($irow<count($arr_file_token)  && trim($row[6])!='')
                    {
                        $rows=strtoupper(trim($row[3])) . "," . trim($row[6]) . "," . trim($row[6]) .",".trim($row[6])."\n";
                        fwrite($arr_file_token[$irow]["filetoken"],$rows);
                    }
                }
                
            }
            fclose($filehandle);  
            
            foreach($arr_file_token as $xitem)
                fclose($xitem['filetoken']);
            $upl_sys = str_replace("/","\\",$data["upload_data"]["full_path"]);
             @exec("cmd /c copy " . $upl_sys . " {$base_dir_sys}\\RAW\\{$th}_{$bln}_{$tgl}.csv");
        }
    }
    function recon()
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
        
        $field_name = "ibpar_f";

        $this->load->library('upload', $config); 
        $this->load->model("M_ibpa");
        $arr_data=$this->M_ibpa->delete_tmp($_SERVER['REMOTE_ADDR']); 
        $arr_ibpa=array();
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
         
        
        if ( $this->upload->do_upload($field_name))
        {
            $data = array('upload_data' => $this->upload->data());
            $filehandle = fopen($data["upload_data"]["full_path"], 'r'); 
            $header = array();            
            if( ($row = fgetcsv($filehandle, $max_row_size, $separator)) !== false )
                $header = $row;
            
            $cur_mi_code='';                                    
            $arr_tmp_mi=array();
            $this->M_ibpa->clear_batch_query();
            $irow=0;
            while( ($row = fgetcsv($filehandle, $max_row_size, $separator)) !== false ) {              //     echo count($row); 
                if( ($row[0] != null || count($row)>7) && trim($row[0])!='' ) 
                {
                    if(trim($row[6])!='')
                    {
                        $str_dt=substr(trim($row[1]),4,2) . "/" . substr(trim($row[1]),6,2) . "/" . substr(trim($row[1]),0,4);
                        $this->M_ibpa->insert_batch_ibpa_price($_SERVER['REMOTE_ADDR'],$str_dt,trim($row[2]),trim($row[3]),trim($row[6]),trim($row[4])); 
                        if($irow++>100)
                        {
                            $this->M_ibpa->run_batch_query();
                            $this->M_ibpa->clear_batch_query();
                            $irow=0;
                        }
                    }
                }
                
            }
            $this->M_ibpa->run_batch_query();
            //print_r($arr_ibpa);
            fclose($filehandle);  
        }
        
        
        $field_name = "ibpar_f_hp";
        if ( $this->upload->do_upload($field_name))
        {
            $data = array('upload_data' => $this->upload->data());
            $filehandle = fopen($data["upload_data"]["full_path"], 'r');       
            $header = array();  
            
            $cur_mi_code=''; 
            
            //$asu=array('19:20'=>'asdasd');print_r($asu);
            $arr_tmp_mi=array();
            $this->M_ibpa->clear_batch_query();
            $irow=0;
            while( ($row = fgetcsv($filehandle, $max_row_size, $separator)) !== false ) {              //     echo count($row); 
                if( $row[0] != null || count($row)>=4 ) 
                {
                    if(trim($row[0])!='')
                    {
                        list($tg,$bl,$th) =explode("/",$row[0]);
                        $str_dt="{$bl}/{$tg}/{$th}";
                        $this->M_ibpa->insert_batch_hiport_price($_SERVER['REMOTE_ADDR'],$str_dt,trim($row[1]),trim($row[2]),trim($row[3])); 
                        if($irow++>100)
                        {
                            $this->M_ibpa->run_batch_query();
                            $this->M_ibpa->clear_batch_query();
                            $irow=0;
                        }
                    }
                }
                
            }
            $this->M_ibpa->run_batch_query();
            //print_r($arr_ibpa);
            fclose($filehandle);  
        }
        
        list($tg,$bl,$th) =explode("-",trim($param['dt']));
        $str_dt="{$bl}/{$tg}/{$th}";
        $this->data['arr_rekon'] = $this->M_ibpa->get_rekon($str_dt,$_SERVER['REMOTE_ADDR']); 
        $this->data['dt']=date_format(date_create($param['dt']),'M d,Y');
        $this->data['sign']="Rekoncile IBP vs Hiport : " . date('F d,Y') . " " . date('h:i') . " by " . strtoupper(trim($this->data['sess']['name'])); 
        
        $this->load->view('rpt_ibpa_rekon_html',$this->data);
        
    }
} 
?>