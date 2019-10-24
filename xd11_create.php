<?php

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
        $this->SetXY(16,23); 
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

// ---------------------------------------------------------

$dt=date("m/d/Y"); //$dt='7/19/2016';
$dt_s=date("Ydm");
//$dt = "10/17/2018" ;
//$dt_s = "20181017" ;
//$dt='6/8/2016';
//$dt_s='20160608';
$date = date_format(date_create($dt),'F d, Y') ;
/**************************************/
/*             GET XD11               */
/**************************************/

// testing get filenya
//$tsql = "EXEC [GW_GET_BAPEPAM11] '{$dt}'";
$tsql = "EXEC [GW_GET_BAPEPAM11] '2018-05-07'";
$stmt = sqlsrv_query( $conn, $tsql); 

while($row_xd11= sqlsrv_fetch_array($stmt))
{
    if( !($row_xd11['26']==0 && $row_xd11['27']==0) )
    {
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
        
        $tsql = "select a.*, b.fundmanagername
                from 
                (
                    select portfoliocode,portfolioname,fundmanagercode from PortfolioTB 
                    where portfoliocode='{$row_xd11['2']}'
                )a left outer join FundManagerTB b
                on a.FundManagerCode=b.FundManagerCode"; 
        $stmt1 = sqlsrv_query( $conn, $tsql);
        $row_pf= sqlsrv_fetch_array($stmt1);
        sqlsrv_free_stmt( $stmt1);  

        include('rpt/g_xd11_tcpdf.php');
        
        $pdf->gw_set_header_text($htmlxd111,'',6);
        $pdf->SetFont('helvetica', '', 6);
        $pdf->AddPage();
        $pdf->writeHTMLCell(0, 0, '', '', $html_xd11, 0, 1, 0, true, '', true);
echo $row_pf['portfoliocode'];
        //Close and output PDF document
        $pdf->Output("D:/MAILDATA/GLRS/XD11/CUR/xd11_{$row_pf['portfoliocode']}_{$dt_s}.pdf", 'F');
    }
    //============================================================+
}
sqlsrv_free_stmt( $stmt); 


// END OF FILE
//============================================================+
sqlsrv_close( $conn);

?>