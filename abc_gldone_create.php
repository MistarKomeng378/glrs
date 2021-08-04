<?php
// $argv[1]='D:/MAILDATA_GL/GLRS';
if(!isset($argv[1]))
    die('No Argument specified!');
$dirglrs=$argv[1];

define('BASEPATH', 'g_get'); 
$html='';
include("application/config/database.php");

$connectionInfo = array( "UID"=>$db['default']['username'],
                         "PWD"=>$db['default']['password'],
                         "Database"=>$db['default']['database']);
                         
$conn = sqlsrv_connect( $db['default']['hostname'], $connectionInfo);

if( $conn === false )
{
     echo "Unable to connect database.";
     die( '');
}
    
$row_all=array();
$tsql = "select distinct a.portfoliocode,a.valuationdate,a.approve_by,approve_date ,
    case when b.portfoliocode IS null then 0 else 1 end flag,b.rcount,c.PortfolioName,
    c.mailflagxls_tb,mailflagxls_val,c.MAILFLAGXLS_GL_TB,c.MAILFLAGXLS_GL_BS,c.MAILFLAGXLS_GL_XD1,c.MAILFLAGXLS_GL_PL
from gw_rpt_gl_ready a left outer join 
(
    select portfoliocode,valuationdate, count(*) rcount from gw_rpt_gl_log 
    group by portfoliocode,valuationdate
)b
on a.portfoliocode=b.portfoliocode and a.valuationdate=b.valuationdate
left outer join portfoliotb c on a.portfoliocode=c.PortfolioCode"; 

$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_all[] = $row;
sqlsrv_free_stmt( $stmt);
foreach($row_all as $xitemall)
{
    $fundname = preg_replace(array('/,/','/\//','/\\\/','/\'/'),array(' ',' ',' ',' '),$xitemall['PortfolioName']);  
    $pf=$xitemall['portfoliocode'];
    $dt=date_format($xitemall['valuationdate'],'m/d/Y');
    $dtf=date_format($xitemall['valuationdate'],'Ymd');
    
    $date = date_format(date_create($dt),'F d, Y') ;
     /**************************************/
    /*          GET PORTFOLIO             */
    /**************************************/
    $tsql = "EXEC gw_portfolio_get '{$pf}'"; 
    $stmt = sqlsrv_query( $conn, $tsql);
    $row_pf = sqlsrv_fetch_array($stmt);
    sqlsrv_free_stmt( $stmt); 
    /**************************************/

    /**************************************/
    /*          GET NAV SHEET             */
    /**************************************/
    // $dtm = change_dt_format(remove_bad_sql(str_sql_string($dtm)),512);
    // if(isset($dtf))
    //     $sdt = change_dt_format(remove_bad_sql(str_sql_string($dtf)),512);     
    // else
    //     $sdt = date_format(date_create($dtm),'1/1/Y');
    $data = [];
    $data['sdt']=$dtf;
    $data['dt']=$dt;
    $data['pf']=$pf;
    $data['r_pf']=$row_pf;
    $syear=date_format(date_create($dt),'1/1/Y');
    $rt ='All';
    // echo $pf.'|'.$syear.'|'.$dt.'|'.'|'.$dt.'|'.$rt;
    // die();
   if($xitemall['MAILFLAGXLS_GL_TB']==1)
   {
    $tbsql = "EXEC gw_rpt_tb '{$pf}','{$dt}','{$dt}'"; 
    $stmt_tb = sqlsrv_query( $conn, $tbsql);
    while($row= sqlsrv_fetch_array($stmt_tb))
    $row_tb[] = $row;
    sqlsrv_free_stmt( $stmt_tb);
    $data['r_data']=$row_tb;

    include_once('rpt/gldone_tb.php');
    if($xitemall['flag']==0)
    
                $fp = fopen("{$dirglrs}\\XLS\\{$pf}_{$dtf}_{$fundname}_tb.xls", 'w');
            else
                $fp = fopen("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_tb_rev{$xitemall['rcount']}.xls", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            fwrite($fp,getcontent($data));

            fclose($fp);
   }
   if($xitemall['MAILFLAGXLS_GL_BS']==1)
   {
    $bssql = "EXEC GETBSREPORTSP '{$pf}','{$syear}','{$dt}','{$rt}'"; 
    $stmt_bs = sqlsrv_query( $conn, $bssql);
    while($row= sqlsrv_fetch_array($stmt_bs))
    $row_bs[] = $row;
    sqlsrv_free_stmt( $stmt_bs);
    $data['r_data']=$row_bs;

    include_once('rpt/gldone_bs.php');
    if($xitemall['flag']==0)
    
                $fp = fopen("{$dirglrs}\\XLS\\{$pf}_{$dtf}_{$fundname}_bs.xls", 'w');
            else
                $fp = fopen("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_bs_rev{$xitemall['rcount']}.xls", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            fwrite($fp,getcontentbs($data));

            fclose($fp);
   }
   if($xitemall['MAILFLAGXLS_GL_PL']==1)
   {
    
    $plsql = "EXEC GETPLREPORTSP '{$pf}','{$syear}','{$dt}','{$dt}','{$rt}'"; 
    $stmt_pl = sqlsrv_query( $conn, $plsql);
    while($row= sqlsrv_fetch_array($stmt_pl))
    $row_pl[] = $row;
    sqlsrv_free_stmt( $stmt_pl);
    $data['r_data']=$row_pl;

    include_once('rpt/gldone_pl.php');
    if($xitemall['flag']==0)
    
                $fp = fopen("{$dirglrs}\\XLS\\{$pf}_{$dtf}_{$fundname}_pl.xls", 'w');
            else
                $fp = fopen("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_pl_rev{$xitemall['rcount']}.xls", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            fwrite($fp,getcontentpl($data));

            fclose($fp);
   }
   if($xitemall['MAILFLAGXLS_GL_XD1']==1)
   {
    // xd11
    $xd11sql = "EXEC gw_get_bapepam11 '{$dt}','{$pf}'"; 
    $stmt_xd11 = sqlsrv_query( $conn, $xd11sql);
    while($row= sqlsrv_fetch_array($stmt_xd11))
    $row_xd11[] = $row;
    sqlsrv_free_stmt( $stmt_xd11);
    $data['r_dataxd11']=$row_xd11;
    include_once('rpt/gldone_xd11.php');
    if($xitemall['flag']==0)
    
                $fp = fopen("{$dirglrs}\\XLS\\{$pf}_{$dtf}_{$fundname}_xd11.xls", 'w');
            else
                $fp = fopen("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_xd11_rev{$xitemall['rcount']}.xls", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            fwrite($fp,getcontentxd11($data));

            fclose($fp);
    // end xd11
    //xd12 3 juni 2020
    $xd12sql = "EXEC gw_get_bapepam12 '{$dt}','{$pf}'"; 
    $stmt_xd12 = sqlsrv_query( $conn, $xd12sql);
    while($row= sqlsrv_fetch_array($stmt_xd12))
    $row_xd12[] = $row;
    sqlsrv_free_stmt( $stmt_xd12);
    $data['r_dataxd12']=$row_xd12;
    include_once('rpt/gldone_xd12.php');
    if($xitemall['flag']==0)
    
                $fp = fopen("{$dirglrs}\\XLS\\{$pf}_{$dtf}_{$fundname}_xd12.xls", 'w');
            else
                $fp = fopen("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_xd12_rev{$xitemall['rcount']}.xls", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            fwrite($fp,getcontentxd12($data));

            fclose($fp);
    //end xd12

    // xd13 3 juni 2020
    $xd13sql = "EXEC gw_get_bapepam13 '{$dt}','{$pf}'"; 
    $stmt_xd13 = sqlsrv_query( $conn, $xd13sql);
    while($row= sqlsrv_fetch_array($stmt_xd13))
    $row_xd13[] = $row;
    sqlsrv_free_stmt( $stmt_xd13);
    $data['r_dataxd13']=$row_xd13;
    include_once('rpt/gldone_xd13.php');
    if($xitemall['flag']==0)
    
                $fp = fopen("{$dirglrs}\\XLS\\{$pf}_{$dtf}_{$fundname}_xd13.xls", 'w');
            else
                $fp = fopen("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_xd13_rev{$xitemall['rcount']}.xls", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            fwrite($fp,getcontentxd13($data));

            fclose($fp);
    // end xd13
   }
    //
    $tsql = "delete from gw_rpt_gl_ready where portfoliocode='{$pf}' and valuationdate='{$dt}'"; // echo $tsql;
    $stmt = sqlsrv_query( $conn, $tsql);
    sqlsrv_free_stmt( $stmt);
    
    $tsql = "insert into gw_rpt_gl_log(portfoliocode,valuationdate,approve_by,create_date)
            values('{$pf}','{$dt}','{$xitemall['approve_by']}',getdate())"; // echo $tsql;
    $stmt = sqlsrv_query( $conn, $tsql);
    sqlsrv_free_stmt( $stmt);
    
}
sqlsrv_close( $conn); 
$base_dir = $dirglrs;
// move file to folder cur from xls
$arr_file=array();
if ($handle = opendir($base_dir.'/XLS/')) {
    while (false !== ($entry = readdir($handle))) {
        if(is_file($base_dir.'/XLS/'.$entry))
        {   $filename = $base_dir.'/XLS/'.$entry;
            if(strlen($entry)>5)
            {
                $arr_file[]=array("nm_file"=>$filename,"code"=>substr($entry,0,6),'nf'=>$entry);
            }
        }
    }
    closedir($handle);
}
foreach($arr_file as $itemfile){
    $a=@exec("cmd /c move /Y  \"{$base_dir}\\XLS\\{$itemfile["nf"]}\" \"{$base_dir}\\CUR\"");
}
// end move file to folder cur from xls

// move file to folder cur from rev
$arr_filerev=array();
if ($handlerev = opendir($base_dir.'/REV/')) {
    while (false !== ($entryrev = readdir($handlerev))) {
        if(is_file($base_dir.'/REV/'.$entryrev))
        {   $filenamerev = $base_dir.'/REV/'.$entryrev;
            if(strlen($entryrev)>5)
            {
                $arr_filerev[]=array("nm_file"=>$filenamerev,"code"=>substr($entryrev,0,6),'nf'=>$entryrev);
            }
        }
    }
    closedir($handlerev);
}
foreach($arr_filerev as $itemfilerev){
    $arev=@exec("cmd /c move /Y  \"{$base_dir}\\REV\\{$itemfilerev["nf"]}\" \"{$base_dir}\\CUR\"");
}
// end move file to folder cur from rev

// echo "<pre>";
// print_r($arr_file);
// echo "</pre>";
// die();
?>