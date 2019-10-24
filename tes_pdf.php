<?php
    require_once("dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    
    $html =
  '<html><body>'.
  '<p>Put your html here, or generate it with your favourite '.
  'templating system.</p>'.
  '</body></html>';
 
    $dompdf = new DOMPDF(); 
    $dompdf->load_html($html);
    $dompdf->render();
    //if want to downloaded from browser
    //$dompdf->stream("sample.pdf");  
    
    //if want to save to disk
    $pdf = $dompdf->output(); 
    file_put_contents("saved_pdf.pdf", $pdf);
?>