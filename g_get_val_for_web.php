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

//$today='5/4/2017';
$today=date('m/d/Y');
$tsql = "exec gw_rpt_web_get_pvr '{$today}'";
$stmt = sqlsrv_query( $conn, $tsql);

$irow=0;
$dts=date('Ymd');
$filename="D:/BAT/webfin/TMP/OLVAL_{$dts}.txt";
if ($handle = fopen($filename, 'w')) {
    while($row= sqlsrv_fetch_array($stmt))
    {
        $somecontent='';
        if($irow++!=0)
            $somecontent.="\r\n";
        $somecontent.= date_format($row[0],'d/m/Y').",";      //valuation_date
        $somecontent.= strfixblank($row[1],6) . ",";           //fund_code
        $somecontent.= strfixblank($row[12],50) . ",";        //fund_name
        $somecontent.= strfixblank($row[2],30) . ",";         //security_type
        $somecontent.= strfixblank($row[3],8) . ",";          //security_code
        $somecontent.= strfixblank($row[4],30) . ",";         //security_name
        $somecontent.= numberfixzero($row[5],2,25) . ",";     //holding
        $somecontent.= numberfixzero($row[6],6,19) . ",";     //cost
        $somecontent.= numberfixzero($row[7],6,19) . ",";     //market_price
        $somecontent.= numberfixzero($row[8],2,25) . ",";     //total
        $somecontent.= numberfixzero($row[9],2,25) . ",";     //value
        $somecontent.= numberfixzero($row[10],2,25) . ",";     //unrealized
        $somecontent.= numberfixzero($row[11],2,25);           //accrued
        fwrite($handle, $somecontent);
    }
    fclose($handle);
}

sqlsrv_free_stmt( $stmt); 


sqlsrv_close( $conn);     


function strfixzero($str,$strl)
{
    return substr("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000".trim($str),0,$strl);
}
function strfixblank($str,$strl)
{
    return substr(trim($str)."                                                                                                                 ",0,$strl);
}
function numberfixzero($no,$decl,$nol)
{   
    
    $dec2=$no<0?$no*-1:$no;
    $min=$no<0?'-':'';
    $nol=$no<0?$nol-1:$nol;
    return $min.substr("0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000".number_format($dec2,$decl,'.',''),$nol*-1);
}
?>
