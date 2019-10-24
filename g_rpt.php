<?php
define('BASEPATH', 'g_get'); 
$html='';
include_once("application/config/database.php");

$connectionInfo = array( "UID"=>$db['default']['username'],
                         "PWD"=>$db['default']['password'],
                         "Database"=>$db['default']['database']);
                         
$conn = sqlsrv_connect( $db['default']['hostname'], $connectionInfo);

if( $conn === false )
{
     echo "Unable to connect database.";
     die( '');
}

$pf='0D10AQ';
$dt='12/7/2015';
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
$row_nav_sect_A=array();
$row_nav_sect_B=array();
$row_nav_sect_C=array();
$row_nav_sect_D=array();
$row_nav_sect_H=array();
$tsql = "EXEC gw_nav_get_section  '{$pf}','{$dt}','A'";
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_nav_sect_A[] = $row;
sqlsrv_free_stmt( $stmt);

$tsql = "EXEC gw_nav_get_section  '{$pf}','{$dt}','B'";
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_nav_sect_B[] = $row;
sqlsrv_free_stmt( $stmt); 

$tsql = "EXEC gw_nav_get_section  '{$pf}','{$dt}','C'";
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_nav_sect_C[] = $row;
sqlsrv_free_stmt( $stmt); 

$tsql = "EXEC gw_nav_get_section  '{$pf}','{$dt}','D'";
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_nav_sect_D[] = $row;
sqlsrv_free_stmt( $stmt); 

$tsql = "EXEC gw_nav_get_section  '{$pf}','{$dt}','H'";     
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_nav_sect_H[] = $row;
sqlsrv_free_stmt( $stmt); 
/**************************************/


/**************************************/
/*          GET TRX LISTING           */
/**************************************/
$row_trx=array();
$tsql = "EXEC gw_rpt_trx_get  '{$pf}','{$dt}'";
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_trx[] = $row;
sqlsrv_free_stmt( $stmt);
/**************************************/

/**************************************/
/*     GET OUSTANDING SETTLEMENT      */
/**************************************/
$row_ost=array();
$tsql = "EXEC gw_rpt_ost_get  '{$pf}','{$dt}'";
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_ost[] = $row;
sqlsrv_free_stmt( $stmt);
/**************************************/

/**************************************/
/*       GET ACCOUNT BALANCE          */
/**************************************/
$row_bal=array();
$tsql = "EXEC gw_rpt_bal_get  '{$pf}','{$dt}'";
$stmt = sqlsrv_query( $conn, $tsql);
while($row= sqlsrv_fetch_array($stmt))
    $row_bal[] = $row;
sqlsrv_free_stmt( $stmt);
/**************************************/

sqlsrv_close( $conn);

include('rpt/g_html.php'); 
include('rpt/g_nav.php');
include('rpt/g_trx.php');
include('rpt/g_os.php');
include('rpt/g_bal.php');

require_once("g_pdf.php");


$html = $html_head . $html_nav . $html_trx . $html_os . $html_bal . $html_leg;
echo $html;
render($html,'asu');
?>