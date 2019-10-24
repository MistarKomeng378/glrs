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

//include('rpt/g_html.php'); 
include('rpt/g_nav_tcpdf.php');
include('rpt/g_trx_tcpdf.php');
include('rpt/g_os_tcpdf.php');
include('rpt/g_bal_tcpdf.php');

//require_once("g_pdf.php");


require_once('tcpdf_min/tcpdf.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    private $gw_header_text = '';
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'cimbniaga.jpg';
        $this->Image($image_file, 15, 5, 25, 3.39, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        //$this->SetFont('helvetica', 'B', 20);
        // Titleif()
        //$headerdata = $this->getHeaderData(); 
        //$this->SetLineStyle(array('width' => 0.85 / $this->k, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $headerdata['line_color']));
        
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
    public function gw_set_header_text($gw_text='')
    {
        $this->gw_header_text=$gw_text;
    }
}

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

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 8); 

// add a page
$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html_nav, 0, 1, 0, true, '', true);
$pdf->SetFont('helvetica', '', 4.5);    

$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html_trx, 0, 1, 0, true, '', true);
$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html_os, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', '', 6);
$pdf->AddPage();
$pdf->writeHTMLCell(0, 0, '', '', $html_bal, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("E:\\MAILDATA\\GLRS\\CUR\\{$pf}.pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+

?>