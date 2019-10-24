<?php
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
    c.mailflagxls_tb,mailflagxls_val
from gw_rpt_gl_ready a left outer join 
(
    select portfoliocode,valuationdate, count(*) rcount from gw_rpt_gl_log 
    group by portfoliocode,valuationdate
)b
on a.portfoliocode=b.portfoliocode and a.valuationdate=b.valuationdate
left outer join portfoliotb c on a.portfoliocode=c.PortfolioCode"; // echo $tsql;
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
   if($xitemall['mailflagxls_tb']==1)
   {
        $row_tb=array();
        $tsql = "EXEC gw_rpt_tb_daily  '{$pf}','{$dt}'";
        $stmt = sqlsrv_query( $conn, $tsql);
        $row_tb[]=array("PFCODE","ACCTYPE","ACCDESC","ACCCODE","OPENINGBAL","DEBIT","CREDIT","ENDINGBAL");
        while($row= sqlsrv_fetch_array($stmt))
        {            
            $row_tb[] = array($row["portfoliocode"],$row["GROUPPFDESC"],$row["ACCOUNTNAME"],$row["ACCOUNTCODE"],number_format($row["STARTBALANCE"],2,'.',''),
                                number_format($row["DEBET"],2,'.',''),number_format($row["KREDIT"],2,'.',''),number_format($row["ENDBALANCE"],2,'.',''));
        }
        sqlsrv_free_stmt( $stmt);
        if(count($row_tb)>0)
        {
            if($xitemall['flag']==0)
                $fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            else
                $fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb_rev{$xitemall['rcount']}.csv", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_tb.csv", 'w');
            foreach ($row_tb as $fields) {
                fputcsv($fp, $fields,',','"');
            }

            fclose($fp);
        }
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
?>