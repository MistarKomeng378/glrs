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
require_once('tcpdf_min/tcpdf.php');
    // Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    private $gw_header_text = '';
    private $gw_header_text1 = '';
    private $gw_header_text_size = 0;
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'cimbniaga.jpg';
        $this->Image($image_file, 16, 7, 25, 3.39, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        //$this->SetFont('helvetica', 'B', 20);
        // Titleif()
        //$headerdata = $this->getHeaderData(); 
        //$this->SetLineStyle(array('width' => 0.85 / $this->k, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $headerdata['line_color']));
        $this->SetFont('helvetica', '', 8); 
        $this->SetXY(16,12.5);
        $this->writeHTMLCell(0, 0, '', '', $this->gw_header_text, 0, 1, 0, true, '', true);
        $this->SetXY(16,20); 
        if($this->gw_header_text_size!=0)
            $this->SetFont('helvetica', '', $this->gw_header_text_size); 
        if($this->gw_header_text1!='')
            $this->writeHTMLCell(0, 0, '', '', $this->gw_header_text1, 0, 1, 0, true, '', true);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    public function gw_set_header_text($gw_text='',$gw_text1='',$gw_text_size=0)
    {
        $this->gw_header_text=$gw_text;
        $this->gw_header_text1=$gw_text1;
        $this->gw_header_text_size=$gw_text_size;
    }
    
}
    
$row_all=array();
$tsql = "select distinct a.portfoliocode,a.valuationdate,a.approve_by,approve_date ,
    case when b.portfoliocode IS null then 0 else 1 end flag,b.rcount,c.PortfolioName,
    c.mailflagxls_tb,mailflagxls_val
from gw_rpt_pdf_ready a left outer join 
(
    select portfoliocode,valuationdate, count(*) rcount from gw_rpt_pdf_log 
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
    /*              GET PVR               */
    /**************************************/
    $row_pvr_fi=array();
    $row_pvr_os=array();
    $row_pvr_ri=array();
    $row_pvr_zl=array();
    $tsql = "EXEC gw_rpt_pvr_get  '{$pf}','{$dt}'";
    $stmt = sqlsrv_query( $conn, $tsql);

    while($row= sqlsrv_fetch_array($stmt))
    {
        if($row['SecurityCategory']=='FI')        
            $row_pvr_fi[] = $row;
        if($row['SecurityCategory']=='OS')        
            $row_pvr_os[] = $row;
        if($row['SecurityCategory']=='RI')        
            $row_pvr_ri[] = $row;
        if($row['SecurityCategory']=='ZL')        
            $row_pvr_zl[] = $row;
    }
    sqlsrv_free_stmt( $stmt);
    /**************************************/

    /**************************************/
    /*              GET BAS               */
    /**************************************/
    $row_bas=array();
    $tsql = "EXEC gw_rpt_bas_get  '{$pf}','{$dt}'";
    $stmt = sqlsrv_query( $conn, $tsql);

    while($row= sqlsrv_fetch_array($stmt))
        $row_bas[] = $row;
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

    /**************************************/
    /*            GET XD1-1               */
    /**************************************/


    

    //require_once("g_pdf.php");

    

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Guruh Widoyoko');
    $pdf->SetTitle('TCPDF Example 003');
    $pdf->SetSubject('Financial Report');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    //include('rpt/g_html.php'); 

    // ---------------------------------------------------------

    // set font
    include('rpt/g_nav_tcpdf.php');
    $pdf->SetFont('helvetica', '', 8); 
    $pdf->gw_set_header_text($htmlnav1);
    $pdf->AddPage();
    $pdf->writeHTMLCell(0, 0, '', '', $html_nav, 0, 1, 0, true, '', true);


    include('rpt/g_pvr_tcpdf.php');
    if (count($row_pvr_fi)>0) { 
        $pdf->gw_set_header_text($htmlpvr,$htmlpvr1,5);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 5);    
        $pdf->writeHTMLCell(0, 0, '', '', $htmlpvr11, 0, 1, 0, true, '', true);
    }
    if (count($row_pvr_os)>0) { 
        $pdf->gw_set_header_text($htmlpvr,$htmlpvr2,5);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 5);    
        $pdf->writeHTMLCell(0, 0, '', '', $htmlpvr21, 0, 1, 0, true, '', true);
    }
if (count($row_pvr_ri)>0) { 
        $pdf->gw_set_header_text($htmlpvr,$htmlpvr3,5);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 5);    
        $pdf->writeHTMLCell(0, 0, '', '', $htmlpvr31, 0, 1, 0, true, '', true);
    }
    if (count($row_pvr_zl)>0) { 
        $pdf->gw_set_header_text($htmlpvr,$htmlpvr4,5);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 5);    
        $pdf->writeHTMLCell(0, 0, '', '', $htmlpvr41, 0, 1, 0, true, '', true);
    }
    if (count($row_pvr_fi)>0 || count($row_pvr_os)>0 || count($row_pvr_zl)>0) { 
        $pdf->writeHTMLCell(0, 0, '', '', $htmlpvrg, 0, 1, 0, true, '', true);
    }
    include('rpt/g_bas_tcpdf.php'); //print_r($arr_bas); echo "asas";
    foreach ($arr_bas as $xitem_c)
    {
        
        $pdf->gw_set_header_text($htmlbas1,'',6);
        $pdf->SetFont('helvetica', '', 6);
        $pdf->AddPage();
        $pdf->writeHTMLCell(0, 0, '', '', $xitem_c, 0, 1, 0, true, '', true);
    }
          
    include('rpt/g_trx_tcpdf.php');
    $pdf->gw_set_header_text($htmltrx1,$htmltrx11,5);
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 5);    
    $pdf->writeHTMLCell(0, 0, '', '', $html_trx, 0, 1, 0, true, '', true);

    include('rpt/g_os_tcpdf.php');
    $pdf->gw_set_header_text($htmlos1,$htmlos11,5); 
    $pdf->SetFont('helvetica', '', 5);    
    $pdf->AddPage();
    $pdf->writeHTMLCell(0, 0, '', '', $html_os, 0, 1, 0, true, '', true);

    include('rpt/g_bal_tcpdf.php');
    $pdf->gw_set_header_text($htmlbal1,$htmlbal11,6);
    $pdf->SetFont('helvetica', '', 6);
    $pdf->AddPage();
    $pdf->writeHTMLCell(0, 0, '', '', $html_bal, 0, 1, 0, true, '', true);

    include('rpt/g_disclaimer_tcpdf.php'); //print_r($arr_bas); echo "asas";
    $pdf->gw_set_header_text('','',6);
    $pdf->SetFont('helvetica', '', 6);
    $pdf->AddPage();
    $pdf->writeHTMLCell(0, 0, '', '', $htmldisc, 0, 1, 0, true, '', true);
    // ---------------------------------------------------------
    // ---------------------------------------------------------

    //Close and output PDF document
    ob_clean();
    if($xitemall['flag']==0)
        $pdf->Output("{$dirglrs}\\PDF\\{$pf}_{$dtf}_{$fundname}.pdf", 'F');
    else
        $pdf->Output("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_rev{$xitemall['rcount']}.pdf", 'F');

    //============================================================+
    // END OF FILE
    //============================================================+
    $tsql = "delete from gw_rpt_pdf_ready where portfoliocode='{$pf}' and valuationdate='{$dt}'"; // echo $tsql;
    $stmt = sqlsrv_query( $conn, $tsql);
    sqlsrv_free_stmt( $stmt);
    
    $tsql = "insert into gw_rpt_pdf_log(portfoliocode,valuationdate,approve_by,create_date)
            values('{$pf}','{$dt}','{$xitemall['approve_by']}',getdate())"; // echo $tsql;
    $stmt = sqlsrv_query( $conn, $tsql);
    sqlsrv_free_stmt( $stmt);
    
    //create xls_file
    if($xitemall['mailflagxls_val']==1)
   {
        $row_val=array();
        $tsql = "EXEC GETMTMREPORTSP  '{$pf}','{$dt}'";
        $stmt = sqlsrv_query( $conn, $tsql);
        $row_val[]=array("PFCODE","SECCODE","SECNAME","HOLDING","TOTALCOST","TOTALVALUE");
        while($row= sqlsrv_fetch_array($stmt))
            $row_val[] = array($row["PORTFOLIOCODE"],$row["SECURITYCODE"],$row["SECURITYNAME"],
                    number_format($row["HOLDING"],4,'.',''),number_format($row["TOTALCOST"],4,'.',''),number_format($row["TOTALVALUE"],4,'.',''));
        sqlsrv_free_stmt( $stmt);
        if(count($row_val)>0)
        {
            if($xitemall['flag']==0)
                $fp = fopen("{$dirglrs}\\PDF\\{$pf}_{$dtf}_{$fundname}_valuation.csv", 'w');
            else
                $fp = fopen("{$dirglrs}\\REV\\{$pf}_{$dtf}_{$fundname}_valuation_rev{$xitemall['rcount']}.csv", 'w');
            //$fp = fopen("{$dirglrs}\\GWTES\\{$pf}_{$dtf}_{$fundname}_valuation.csv", 'w');
            foreach ($row_val as $fields) {
                fputcsv($fp, $fields,',','"');
            }

            fclose($fp);
        }
   }
}
sqlsrv_close( $conn); 
?>