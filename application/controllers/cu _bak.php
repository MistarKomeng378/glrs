<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cu extends CI_Controller {      
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
    function dup()
    {
        if($this->data['sess']['uid']=='')
        {   
            $this->data['upload']=0;
            echo json_encode($this->data);
            return 0;
        }
        $this->data['upload']=1;
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'txt|csv';
        $config['max_size']    = '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        
        
        $param = $this->input->post(); 
        
        sql_quot_all($param);
        $pf=!isset($param['pf'])?'':$param['pf'];
        $dt= !isset($param['dt'])?'': change_dt_format($param['dt']);
        $startdt= !isset($param['sdt'])?'': change_dt_format($param['sdt']);
        
        
        
        $this->load->model("M_nav");      
        $r_data=$this->M_nav->check_status($param['pf'],$dt);
        $nav_stat=1;
        $gl_stat=1;
        if(count($r_data)>0)
        {
            $nav_stat=$r_data[0]['APPROVESTATUS'];
            $gl_stat=$r_data[0]['APPROVESTATUS']==''?0:$r_data[0]['GLDONESTATUS'];
        } else
        {
            $nav_stat=0;
            $gl_stat=0;
        }
        
        $this->load->library('upload', $config);        
        /*       
        $this->data['u_fisec']=0;
        $this->data['u_fisecrows']=array('count'=>0,'inserted'=>0);
        if ( $this->upload->do_upload('f_fisec'))
        {
            $this->data['u_fisec']=1;
            $this->data['u_fisecrows']=$this->_upload_fi_sec($this->upload->data(),$this->data['sess']['uid']);
        }
        $this->data['u_fitrx']=0;
        $this->data['u_fitrxrows']=array('count'=>0,'inserted'=>0);
        if ( $this->upload->do_upload('f_fitrx') && $nav_stat==0 )
        {
            $this->data['u_fitrx']=1;
            $this->data['u_fitrxrows']=$this->_upload_fi_trx($this->upload->data(),$pf,$dt,$this->data['sess']['uid']);
        }
        */
        $this->data['u_val']=0;
        $this->data['u_valrows']=array('count'=>0,'inserted'=>0);
        if ( $this->upload->do_upload('f_val') && $nav_stat==0)
        {
            $this->data['u_val']=1;
            $this->data['u_valrows']=$this->_upload_val($this->upload->data(),$pf,$dt,$this->data['sess']['uid']);
        }
        $this->data['u_jur']=0;
        $this->data['u_jurrows']=array('count'=>0,'inserted'=>0);
        if ( $this->upload->do_upload('f_jur'))
        {
            $this->data['u_jur']=1;
            $this->data['u_jurrows']=$this->_upload_jurnal($this->upload->data(),$pf,$startdt,$dt,$this->data['sess']['uid']);
        }
        
        echo json_encode($this->data);
    }
    function fiup()
    {
        if($this->data['sess']['uid']=='')
        {   
            $this->data['upload']=0;
            echo json_encode($this->data);
            return 0;
        }
        $this->data['upload']=1;
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'txt|csv';
        $config['max_size']    = '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        
        
        $param = $this->input->post(); 
        $pf=!isset($param['pf'])?'ALL':$param['pf']; 
        $a=!isset($param['a'])?'0':$param['a']; 
        if($pf=='') $pf='ALL';
        sql_quot_all($param);
        $dt= !isset($param['dt'])?'': change_dt_format($param['dt']);

        
        $this->load->library('upload', $config);               
        $this->data['u_fisec']=0;
        $this->data['u_fisecrows']=array('count'=>0,'inserted'=>0);
        if ( $this->upload->do_upload('f_fisec'))
        {
            $this->data['u_fisec']=1;
            $this->data['u_fisecrows']=$this->_upload_fi_sec($this->upload->data(),$this->data['sess']['uid']);
        }
        $this->data['u_fitrx']=0;
        $this->data['u_fitrxrows']=array('count'=>0,'inserted'=>0);
        if ( $this->upload->do_upload('f_fitrx') )
        {
           $this->data['u_fitrx']=1;
           $this->data['u_fitrxrows']=$this->_upload_fi_trx($this->upload->data(),$pf,$dt,$this->data['sess']['uid']);
        } 
        
        if($a=='1')
        {
            $this->load->model("M_fi");
            $this->M_fi->process($pf,$dt,$this->data['sess']['uid']);
        }
        echo json_encode($this->data);
    }
    function _upload_fi_sec($fname,$uid)
    {
        $this->load->model("M_fi");              
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        
        $handle = fopen($fname["full_path"], "r");
        $row_count=0;
        $row_insert=0;    
        $this->M_fi->up_sec_delete($uid);
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines
                $row_count++;
                if(count($row)==10)
                {
                    sql_quot_all($row);
                    $this->M_fi->up_sec_insert($row[0],$row[1],$row[2],0+$row[3],0+$row[4],$row[5],$row[6],$row[7],0+$row[8],0+$row[9],$uid);
                }
            }
        }
        fclose($handle);
        $rows = $this->M_fi->up_sec_move($uid);
        if(count($rows)>0)
            $row_insert=$rows[0]['nrows'];
        return array('count'=>$row_count,'inserted'=>$row_insert);
    }
    function _upload_fi_trx($fname,$pf,$dt,$uid)
    {
        $this->load->model("M_fi");              
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        
        
        $handle = fopen($fname["full_path"], "r");
        $row_count=0;
        $row_insert=0;    
        $tmp = $this->M_fi->up_trx_delete($uid);
        
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines
                $row_count++;
                if(count($row)>=18)
                {
                    sql_quot_all($row);
                    if( date_create($row[5])==date_create($dt)    && (strtoupper(trim($row[1]))==strtoupper(trim($pf)) || strtoupper(trim($pf))=='ALL' ))
                    {
                        $this->M_fi->up_trx_insert($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],0.000+$row[7],0+$row[8],0+$row[9],0+$row[10],0+$row[11],0+$row[12],$row[13],$row[14],$row[15],0+$row[16],0+$row[17],$uid);
                        
                    }
                }
            }
        }
        fclose($handle);
        $rows = $this->M_fi->up_trx_move($pf,$dt,$uid);
        if(count($rows)>0)
            $row_insert=$rows[0]['nrows'];
        return array('count'=>$row_count,'inserted'=>$row_insert);
    }
    function _upload_val($fname,$pf,$dt,$uid)
    {
        $this->load->model("M_val");              
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        $sdt=date_create($dt);
        
        $handle = fopen($fname["full_path"], "r");
        $row_count=0;
        $row_insert=0;    
        $tmp = $this->M_val->up_delete($uid);
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines
                $row_count++;
                if(count($row)>=16)
                {
                    sql_quot_all($row);
                    if(date_create($row[0])==date_create($dt) && strtoupper(trim($row[2]))==strtoupper(trim($pf)))
                    {
                        if(!isset($row[16]))
                            $row[16]='';
                        $this->M_val->up_insert($row[0],$row[1],$row[2],$row[3],$row[4],(trim($row[5])==''?"":$row[5]) ,(trim($row[6])==''?"":$row[6]),$row[7],(trim($row[8])==''?0:0+$row[8]),(trim($row[9])==''?0:0+$row[9]),(trim($row[10])==''?0:0+$row[10]),(trim($row[11])==''?0:0+$row[11]), (trim($row[12])==''?0:0+$row[12]),$row[13],$row[14],$row[15],$uid,$row[16]);
                    }
                }
            }
        }
        fclose($handle);
        $rows = $this->M_val->up_move($pf,$dt,$uid);
        if(count($rows)>0)
            $row_insert=$rows[0]['nrows'];
        return array('count'=>$row_count,'inserted'=>$row_insert);
    }
    function _upload_jurnal($fname,$pf,$psdt,$dt,$uid)
    {
        $this->load->model("M_jur");              
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        $sdt=date_create($dt);
        
        $handle = fopen($fname["full_path"], "r");
        $row_count=0;
        $row_insert=0;    
        $tmp = $this->M_jur->up_delete($uid);
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines
                $row_count++;
                if(count($row)==8)
                {
                    sql_quot_all($row);
                    if( (date_create($row[1])>=date_create($psdt) && date_create($row[1])<=date_create($dt)) && strtoupper(trim($row[0]))==strtoupper(trim($pf)))
                    {
                        $this->M_jur->up_insert($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$uid);
                        //$row_insert++;
                    }
                }
            }
        }
        fclose($handle);
        $rows = $this->M_jur->up_move($pf,$psdt,$dt,$uid);
        if(count($rows)>0)
            $row_insert=$rows[0]['nrows'];
        return array('count'=>$row_count,'inserted'=>$row_insert);
    }    
    function dupmi()
    {
        if($this->data['sess']['uid']=='')
        {   
            $this->data['upload']=0;
            echo json_encode($this->data);
            return 0;
        }
        $this->data['upload']=1;
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'txt|csv';
        $config['max_size']    = '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        
        
        $param = $this->input->post(); 
        
        sql_quot_all($param);
        $fm=!isset($param['fm'])?'':$param['fm'];
        $dt= !isset($param['dt'])?'': change_dt_format($param['dt']);
        $startdt= !isset($param['sdt'])?'': change_dt_format($param['sdt']);
        
        
        
        
        $this->load->library('upload', $config);        
        
        $str_desc='';
        $str_desc .= "Valuation: \n";
        if ( $this->upload->do_upload('f_val'))
        {echo "asasa";
            $this->load->model("M_val"); 
            $this->M_val->up_delete($this->data['sess']['uid']); 
            $this->_upload_val_mi($this->upload->data(),$fm,$dt,$this->data['sess']['uid']);
            $r_data=$this->M_val->up_move_mi($fm,$dt,$this->data['sess']['uid']);  
            if(count($r_data)>0)
            {
                foreach($r_data as $xitem1)
                    $str_desc .= "  {$xitem1['pf']} ({$xitem1['nrows']}), ";
            }
        }
         
        
        $this->load->model("M_jur");              
        $this->M_jur->up_delete($this->data['sess']['uid']);
        
        if ($this->upload->do_upload('f_jur1'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur2'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur3'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur4'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur5'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur6'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur7'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur8'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur9'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur10'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        if ($this->upload->do_upload('f_jur11'))  $this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        $r_data= $this->M_jur->up_move_mi($fm,$startdt,$dt,$this->data['sess']['uid']);
        $str_desc .= "\nJournal: \n";
            
        if(count($r_data)>0)
        {
            foreach($r_data as $xitem1)
                $str_desc .= "  {$xitem1['pf']} ({$xitem1['nrows']}), ";
        }
    
        echo $str_desc;
    }
    function _upload_val_mi($fname,$fm,$dt,$uid)
    {
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        $sdt=date_create($dt);
        
        $handle = fopen($fname["full_path"], "r");
        $row_count=0;
        $row_insert=0;            
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines
                $row_count++;
                if(count($row)>=16)
                {
                    sql_quot_all($row);
                    if(date_create($row[0])==date_create($dt))
                    {
                        if(!isset($row[16]))
                            $row[16]='';
                        $this->M_val->up_insert($row[0],$row[1],$row[2],$row[3],$row[4],(trim($row[5])==''?"":$row[5]) ,(trim($row[6])==''?"":$row[6]),$row[7],(trim($row[8])==''?0:0+$row[8]),(trim($row[9])==''?0:0+$row[9]),(trim($row[10])==''?0:0+$row[10]),(trim($row[11])==''?0:0+$row[11]), (trim($row[12])==''?0:0+$row[12]),$row[13],$row[14],$row[15],$uid,$row[16]);
                    }
                }
            }
        }
        fclose($handle);
    }
    function _upload_jurnal_mi($fname,$psdt,$dt,$uid)
    {
                   
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        $sdt=date_create($dt);
        
        $handle = fopen($fname["full_path"], "r");
        $row_count=0;
        $row_insert=0;    
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines
                $row_count++;
                if(count($row)==8)
                {
                    sql_quot_all($row);
                    if( (date_create($row[1])>=date_create($psdt) && date_create($row[1])<=date_create($dt)))
                    {
                        $this->M_jur->up_insert($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$uid);
                        //$row_insert++;
                    }
                }
            }
        }
        fclose($handle);
    }
} 
?>