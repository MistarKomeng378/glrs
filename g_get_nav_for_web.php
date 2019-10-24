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


$today=date('m/d/Y');
$tsql = "exec gw_rpt_web_get_nav '{$today}'";
$stmt = sqlsrv_query( $conn, $tsql);

$irow=0;
$dts=date('Ymd');
$filename="D:/BAT/webfin/TMP/OLNAV_{$dts}.txt";
if ($handle = fopen($filename, 'w')) {
    while($row= sqlsrv_fetch_array($stmt))
    { 
        $somecontent='';
        if($irow++!=0)
            $somecontent.="\r\n";
        $somecontent.= date_format($row[0],'d/m/Y').",";      //valuation_date
        $somecontent.= strfixblank($row[1],6) . ",";          //fund_code
        $somecontent.= numberfixzero($row[2],2,25) . ",";     //Total Nav
        $somecontent.= numberfixzero($row[3],2,25) . ",";     //Total Unit Issue
        $somecontent.= numberfixzero($row[4],4,20) . ",";     //Price
        $somecontent.= (is_object($row[5])?date_format($row[5],'m/d/Y'):'          ').",";      //Prev Date
        $somecontent.= numberfixzero($row[6],4,20) . ",";     //Prev Price
        $somecontent.= numberfixzero($row[7],2,9) . ",";     //Return 30 Days
        $somecontent.= (is_object($row[8])?date_format($row[8],'m/d/Y'):'          ').",";      //Prev Year
        $somecontent.= numberfixzero($row[9],4,20) . ",";     //Prev Year Price
        $somecontent.= numberfixzero($row[10],2,9) . ",";           //Return 1 Year 
        $somecontent.= numberfixzero($row[11],2,9);           //Return 1 Year Act
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