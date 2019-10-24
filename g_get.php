<?php
define('BASEPATH', 'g_get'); 
include_once("application/config/database.php");

$connectionInfo = array( "UID"=>$db['default']['username'],
                         "PWD"=>$db['default']['password'],
                         "Database"=>$db['default']['database']);
                         
$conn = sqlsrv_connect( $db['default']['hostname'], $connectionInfo);

if( $conn === false )
{
     echo "Unable to connect.</br>";
     die( print_r( sqlsrv_errors(), true));
} 



$tsql = "select * from gw_rpt_param_dir";
$stmt = sqlsrv_query( $conn, $tsql);

$row_mail = sqlsrv_fetch_array($stmt);


sqlsrv_free_stmt( $stmt); 

$arr_dir=array();

if ($handle = opendir($row_mail['source_dir'].'/')) {
    while (false !== ($entry = readdir($handle))) {
        if(is_file($row_mail['source_dir'].'/'.$entry))
        { 
            if(strtoupper(substr($entry,-4))=='.CSV' || strtoupper(substr($entry,-4))=='.TXT')
                $arr_dir[]=array("f1"=>$entry,"f2"=>$row_mail['source_dir'].'/'.$entry);
        }
    }
    closedir($handle);
}
foreach($arr_dir as $item_dir)
{
    $separator = ',';    /** separator used to explode each line */
    $enclosure = '"';    /** enclosure used to decorate each field */
    $max_row_size = 4096;    /** maximum row size to be used for decoding */
    
    
    $handle = fopen($item_dir['f2'], "r"); 
    
    $tsql = "exec gw_up_rpt_clear '1234'";
    $stmt = sqlsrv_query( $conn, $tsql);
    sqlsrv_free_stmt( $stmt); 
    $ada=array('BAL'=>false,'TRX'=>false,'OST'=>false,'BAS'=>false);
    $bas_no1=0;
    $bas_row=array();
    while( ($row = fgetcsv($handle, $max_row_size, $separator, $enclosure)) != false) 
    {
        if($row[0]=='BAL' && count($row)>8)
        {
            list($dt,$bl,$th)=explode("/",$row[5]);    
            $due_date =         strlen($th)==2?"20{$th}":$th;
            $tsql = "insert into gw_up_rpt_bal (ip,client_code, data_date, bank_code, bank_name, due_date, rate, amount1, amount2) values
                    ('1234','{$row[2]}','{$row[1]}','{$row[3]}','{$row[4]}','{$due_date}','{$row[6]}','{$row[7]}','{$row[8]}')";
            $stmt = sqlsrv_query( $conn, $tsql);
            //echo $tsql;
            sqlsrv_free_stmt( $stmt); 
            $ada['BAL']=true;
        }
        else if($row[0]=='TRX')
        {
            $date=$row[8];
            if(trim($row[8])=='')
                $date='1/1/1900';
            $pl=trim($row[14]);
            if(trim($row[14])=='')
                $pl=0;
            $unit=trim($row[10]);
            if(trim($row[10])=='')
                $unit=0;
            $sec_name=str_replace("'","''",$row[6]);
            $tsql = "insert into gw_up_rpt_trx (ip, client_code, data_date, trx_date, trx_type, sec_code, sec_name, id, due_date, rate, unit, cost, int_inc, proceed, pl, notes) values
                    ('1234','{$row[2]}','{$row[1]}','{$row[3]}','{$row[4]}','{$row[5]}','{$sec_name}','{$row[7]}','{$date}','{$row[9]}','{$unit}','{$row[11]}','{$row[12]}','{$row[13]}','{$pl}','{$row[15]}')";            
            $stmt = sqlsrv_query( $conn, $tsql); 
            sqlsrv_free_stmt( $stmt); 
            $ada['TRX']=true;
        }
        else if($row[0]=='OST')
        {
            $tsql = "insert into gw_up_rpt_ost (ip, client_code, data_date, contract_date, settle_date, broker_name,broker_code, id, sec_code, sec_name, trx_type, trx_name, unit, cur, amount) values
                    ('1234','{$row[2]}','{$row[1]}','{$row[3]}','{$row[4]}','{$row[5]}','{$row[6]}','{$row[7]}','{$row['8']}','{$row[9]}','{$row[10]}','{$row[11]}'," . (0+$row[12]) .",'{$row[13]}','{$row[14]}')";
            $stmt = sqlsrv_query( $conn, $tsql);
            sqlsrv_free_stmt( $stmt); 
            $ada['OST']=true;
        }
        else if($row[0]=='BAS')
        {
            if(!array_key_exists(trim($row[2]).'_'.trim($row[3]),$bas_row))
                $bas_row[trim($row[2]).'_'.trim($row[3])]=1;
            $debit=trim($row[8]);
            if(trim($row[8])=='')
                $debit=0;
            $kredit=trim($row[9]);
            if(trim($row[9])=='')
                $kredit=0;
            $bas_no=$bas_row[trim($row[2]).'_'.trim($row[3])]++;
            $bas_no1++;
            $tsql = "insert into gw_up_rpt_bas (ip, client_code, data_date, bank_name, transtype,  id, detail, detail1, debit, kredit, balance,no) values
                    ('1234','{$row[2]}','{$row[1]}','{$row[3]}','{$row[4]}','{$row[5]}','{$row[6]}','{$row[7]}','{$debit}','{$kredit}','{$row[10]}','{$bas_no1}')";            
//            echo $tsql;
            $stmt = sqlsrv_query( $conn, $tsql);
            sqlsrv_free_stmt( $stmt); 
            $ada['BAS']=true;
        }
    }
    $tsql = "exec gw_up_rpt_move '1234'";
    $stmt = sqlsrv_query( $conn, $tsql);
    sqlsrv_free_stmt( $stmt); 
    fclose($handle);
    //$a=@exec("cmd /c copy /Y \"{$row_mail['source_dir_sys']}\*.*\" \"{$row_mail['source_dir_hist_sys']}\"");
    //copy /Y %REKSA_LOCAL%\CUR\%2 %REKSA_LOCAL%\HIS\%Yr%\%Ym%\%Yd%
    //del /F /Q %REKSA_LOCAL%\CUR\%2
}
sqlsrv_close( $conn);     


?>