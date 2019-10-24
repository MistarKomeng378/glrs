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
        $this->data['u_valrows']=array('count'=>0,'val'=>0,'bas'=>0,'bal'=>0,'trx'=>0,'ost'=>0);
        if ( $this->upload->do_upload('f_val') && $nav_stat==0)
        {
            $this->data['u_val']=1;
            $arr_upval=$this->_upload_val($this->upload->data(),$pf,$dt,$this->data['sess']['uid']);
            $this->data['u_valrows']['count']=$arr_upval['count'];
            $this->data['u_valrows']['val']=$arr_upval['inserted']['val'];
            $this->data['u_valrows']['bas']=$arr_upval['inserted']['bas'];
            $this->data['u_valrows']['bal']=$arr_upval['inserted']['bal'];
            $this->data['u_valrows']['trx']=$arr_upval['inserted']['trx'];
            $this->data['u_valrows']['ost']=$arr_upval['inserted']['ost'];
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
        $this->load->model("M_val_lampiran");              
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        $sdt=date_create($dt);
        
        $handle = fopen($fname["full_path"], "r");
        
        $arr_insert=array("val"=>0,"bas"=>0,"bal"=>0,"trx"=>0,"ost"=>0);
        $row_count=0;
        $this->M_val_lampiran->up_delete($uid);
        $bas_no1=0;
        $bas_row=array();
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines            
                $row_count++;
                if(count($row)>=16 &&(
                        trim($row[0])!='BAS' && trim($row[0])!='BAL' && trim($row[0])!='TRX' && trim($row[0])!='OST' 
                    ))
                {
                    sql_quot_all($row);
                    if(date_create($row[0])==date_create($dt) && strtoupper(trim($row[2]))==strtoupper(trim($pf)))
                    {
                        $arr_insert['val']++;
                        if(!isset($row[16]))
                            $row[16]='';
                        $this->M_val_lampiran->val_insert($row[0],$row[1],$row[2],$row[3],$row[4],(trim($row[5])==''?"":$row[5]) ,(trim($row[6])==''?"":$row[6]),$row[7],(trim($row[8])==''?0:0+$row[8]),(trim($row[9])==''?0:0+$row[9]),(trim($row[10])==''?0:0+$row[10]),(trim($row[11])==''?0:0+$row[11]), (trim($row[12])==''?0:0+$row[12]),$row[13],$row[14],$row[15],$uid,$row[16]);
                    }
                }
                if(count($row)>=11 && trim($row[0])=='BAS')
                {
                    sql_quot_all($row); //echo "{$row[1]} {$dt} {$row[2]} {$pf} ";
                    if(date_create($row[1])==date_create($dt) && strtoupper(trim($row[2]))==strtoupper(trim($pf)))
                    {
                        $arr_insert['bas']++;
                        if(!array_key_exists(trim($row[2]).'_'.trim($row[3]),$bas_row))
                            $bas_row[trim($row[2]).'_'.trim($row[3])]=1;
                        $bas_no=$bas_row[trim($row[2]).'_'.trim($row[3])]++;
                        $bas_no1++;
                        $this->M_val_lampiran->bas_insert($row[2],$row[1],$row[3],$row[4],$row[5],$row[6],$row[7],(trim($row[8])==''?0:trim($row[8])),(trim($row[9])==''?0:trim($row[9])),$row[10],$bas_no1,$uid);
                    }
                }
                if(count($row)>=8 && trim($row[0])=='BAL')
                {
                    sql_quot_all($row);
                    if(date_create($row[1])==date_create($dt) && strtoupper(trim($row[2]))==strtoupper(trim($pf)))
                    {
                        $arr_insert['bal']++;
                        list($tgl,$bl,$th)=explode("/",$row[5]);    
                        $due_date = "{$bl}/{$tgl}/" . (strlen($th)==2?"20{$th}":$th);
                        $this->M_val_lampiran->bal_insert($row[2],$row[1],$row[3],$row[4],$due_date,$row[6],$row[7],$row[8],$uid);
                    }
                }
                if(count($row)>=16 && trim($row[0])=='TRX')
                {
                    sql_quot_all($row);
                    if(date_create($row[1])==date_create($dt) && strtoupper(trim($row[2]))==strtoupper(trim($pf)))
                    {
                        $arr_insert['trx']++;
                        $this->M_val_lampiran->trx_insert($row[2],$row[1],$row[3],$row[4],$row[5],str_replace("'","''",$row[6]),$row[7],(trim($row[8])==''?'1/1/1900':trim($row[8])),$row[9],(trim($row[10])==''?0:trim($row[10])),$row[11],$row[12],$row[13],(trim($row[14])==''?0:trim($row[14])),$row[15],$uid);
                    }
                }
                if(count($row)>=14 && trim($row[0])=='OST')
                {
                    sql_quot_all($row);
                    if(date_create($row[1])==date_create($dt) && strtoupper(trim($row[2]))==strtoupper(trim($pf)))
                    {
                        $arr_insert['ost']++;   $row[14]=trim($row[14])==''?0:$row[14];  
                        $this->M_val_lampiran->ost_insert($row[2],$row[1],$row[3],$row[4],$row[5],$row[6],$row[7],$row['8'],$row[9],$row[10],$row[11], (0+$row[12]) ,$row[13],$row[14],$uid);
                    }
                }
            }
        }
        fclose($handle);
        $rows = $this->M_val_lampiran->up_move($pf,$dt,$uid);
        return array('count'=>$row_count,'inserted'=>$arr_insert);
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
                        $refno=(trim($row[2])==''?'0':$row[2]);
                        $this->M_jur->up_insert($row[0],$row[1],$refno,$row[3],$row[4],$row[5],$row[6],$row[7],$uid);
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
        
        
        $r_s= date('i:s');
        
        $this->load->library('upload', $config);        
        
        $str_desc='';
        $str_desc .= "Valuation: \n"; 
        if ( $this->upload->do_upload('f_val'))
        {//  echo "asasa";
            $r_val=$this->_upload_val_mi($this->upload->data(),$dt,$this->data['sess']['uid']);
        }
         
        if ($this->upload->do_upload('f_jur'))  
        {
            $r_jur=$this->_upload_jurnal_mi($this->upload->data(),$startdt,$dt,$this->data['sess']['uid']);
        }
        $r_e = date('i:s');
        list($r_s_m,$r_s_s)=explode(":",$r_s);
        list($r_e_m,$r_e_s)=explode(":",$r_e);
        $m=$r_e_m-$r_s_m; $s=$r_e_s-$r_s_s;
        if($m<0)
            $m=60+$m;
        if ($s<0)
        {
            $s=60+$s;
            $m--;
        }
        echo "Upload data done in {$m} minutes and {$s} seconds";
        if(isset($r_jur)){
            if (count($r_jur)>0)
            {
                echo "<br />Journal data:";
                echo "<table bgcolor=\"#000000\">
                    <tr bgcolor=\"#F0F0F0\">
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                        <td><b>Fund</b></td>
                        <td align=\"right\"><b>Rows</b></td>
                    </tr>";
                $irows=0;
                foreach($r_jur as $xitem)
                {
                    if($irows%8==0)
                        echo "<tr bgcolor=\"#ffffff\">";
                    if($irows%8==0 && $irows!=0)
                       echo "</tr><tr bgcolor=\"#ffffff\">";
                    echo "<td>{$xitem['pf']}</td><td align=\"right\">{$xitem['nrows']}</td>";
                    $irows++;
                }   
                if($irows%8==0 && $irows!=0)
                    echo "</tr><tr bgcolor=\"#ffffff\">";
                echo "</table>";
            }
        }
        if(isset($r_val)){
            if (count($r_val)>0)
            {
                echo "<br />Valuation &amp; lampiran data:";
                echo "<table bgcolor=\"#000000\">
                    <tr bgcolor=\"#F0F0F0\">
                        <td><b>Portfolio</b></td>
                        <td align=\"right\"><b>Valuation</b></td>
                        <td align=\"right\"><b>Bank Account Statement</b></td>
                        <td align=\"right\"><b>Account Balance</b></td>
                        <td align=\"right\"><b>Transaction Listing</b></td>
                        <td align=\"right\"><b>Outstanding</b></td>
                    </tr>";
                foreach($r_val as $xitem)
                    echo "<tr bgcolor=\"#ffffff\">
                            <td align=\"right\">{$xitem['PortfolioCode']}</td>
                            <td align=\"right\">{$xitem['nrows_val']}</td>
                            <td align=\"right\">{$xitem['nrows_bas']}</td>
                            <td align=\"right\">{$xitem['nrows_bal']}</td>
                            <td align=\"right\">{$xitem['nrows_trx']}</td>
                            <td align=\"right\">{$xitem['nrows_ost']}</td>
                   </tr>";
                echo "</table>";
            }
        }
    }
    function _upload_val_mi($fname,$dt,$uid)
    {
       $this->load->model("M_val_lampiran");              
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        $sdt=date_create($dt);
        
        $handle = fopen($fname["full_path"], "r");
        
        $arr_insert=array("val"=>0,"bas"=>0,"bal"=>0,"trx"=>0,"ost"=>0);
        $row_count=0;
        $this->M_val_lampiran->up_delete($uid);
        $bas_no1=0;
        $bas_row=array(); 
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines            
                $row_count++;
                if(count($row)>=16 && trim($row[0])!='BAS' && trim($row[0])!='BAL' && trim($row[0])!='TRX' && trim($row[0])!='OST' )
                {
                    sql_quot_all($row); 
                    if(date_create($row[0])==$sdt )
                    {                        
                        if(!isset($row[16]))
                            $row[16]='';
                        $this->M_val_lampiran->up_q_insert_val($row[0],$row[1],$row[2],$row[3],$row[4],(trim($row[5])==''?"":$row[5]) ,(trim($row[6])==''?"":$row[6]),$row[7],(trim($row[8])==''?0:0+$row[8]),(trim($row[9])==''?0:0+$row[9]),(trim($row[10])==''?0:0+$row[10]),(trim($row[11])==''?0:0+$row[11]), (trim($row[12])==''?0:0+$row[12]),$row[13],$row[14],$row[15],$uid,$row[16]);
                    }
                }
                if(count($row)>=11 && trim($row[0])=='BAS')
                {
                    sql_quot_all($row);
                    if(date_create($row[1])==$sdt )
                    {
                        if(!array_key_exists(trim($row[2]).'_'.trim($row[3]),$bas_row))
                            $bas_row[trim($row[2]).'_'.trim($row[3])]=1;
                        $bas_no=$bas_row[trim($row[2]).'_'.trim($row[3])]++;
                        $bas_no1++;
                        $this->M_val_lampiran->up_q_insert_bas($row[2],$row[1],$row[3],$row[4],$row[5],$row[6],$row[7],(trim($row[8])==''?0:trim($row[8])),(trim($row[9])==''?0:trim($row[9])),$row[10],$bas_no1,$uid);
                    }
                }
                if(count($row)>=8 && trim($row[0])=='BAL')
                {
                    sql_quot_all($row);
                    if(date_create($row[1])==$sdt )
                    {   
                        list($tgl,$bl,$th)=explode("/",$row[5]);    
                        $due_date = "{$bl}/{$tgl}/" . (strlen($th)==2?"20{$th}":$th);
                        $this->M_val_lampiran->up_q_insert_bal($row[2],$row[1],$row[3],$row[4],$due_date,$row[6],$row[7],$row[8],$uid);
                    }
                }
                if(count($row)>=16 && trim($row[0])=='TRX')
                {
                    sql_quot_all($row);
                    if(date_create($row[1])==$sdt )
                    {
                        $this->M_val_lampiran->up_q_insert_trx($row[2],$row[1],$row[3],$row[4],$row[5],str_replace("'","''",$row[6]),$row[7],(trim($row[8])==''?'1/1/1900':trim($row[8])),$row[9],(trim($row[10])==''?0:trim($row[10])),$row[11],$row[12],$row[13],(trim($row[14])==''?0:trim($row[14])),$row[15],$uid);
                    }
                }
                if(count($row)>=14 && trim($row[0])=='OST')
                {
                    sql_quot_all($row);
                    if(date_create($row[1])==$sdt )
                    {
                        $this->M_val_lampiran->up_q_insert_ost($row[2],$row[1],$row[3],$row[4],$row[5],$row[6],$row[7],$row['8'],$row[9],$row[10],$row[11], (0+$row[12]) ,$row[13],$row[14],$uid);
                    }
                }
            }
        }
        $this->M_val_lampiran->up_q_run();
        fclose($handle); 
        
        return $this->M_val_lampiran->up_q_move($dt,$uid); 
        
        //$rows = $this->M_val_lampiran->up_move($pf,$dt,$uid);
        //return array('count'=>$row_count,'inserted'=>$arr_insert);
    }
    function _upload_jurnal_mi($fname,$psdt,$dt,$uid)
    {
                   
        $separator = ',';    /** separator used to explode each line */
        $enclosure = '"';    /** enclosure used to decorate each field */
        $max_row_size = 4096;    /** maximum row size to be used for decoding */
        $sdt=date_create($dt);
        
        $handle = fopen($fname["full_path"], "r");
        $this->load->model("M_jur");              
        $this->M_jur->up_delete($this->data['sess']['uid']);
        
        while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) {            
            if( $row[0] != null ) { // skip empty lines
                if(count($row)==8)
                {
                    sql_quot_all($row);
                    if( (date_create($row[1])>=date_create($psdt) && date_create($row[1])<=date_create($dt)))                    
                    {
                        $refno=(trim($row[2])==''?'0':$row[2]);
                        $this->M_jur->up_q_insert($row[0],$row[1],$refno,$row[3],$row[4],$row[5],$row[6],$row[7],$uid);
                    }
                }
            }
        }
        $this->M_jur->up_q_run();
        fclose($handle); 
        
        return $this->M_jur->up_q_move($psdt,$dt,$uid);
        
    }
} 
?>