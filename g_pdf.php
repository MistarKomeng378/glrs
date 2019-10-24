<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
function render($html,$filename,$papersize='a4',$orientation='portrait')
{
    require_once("dompdf/dompdf_config.inc.php");
    $old_limit = ini_set("memory_limit", "100M"); 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper($papersize,$orientation);
    
    $dompdf->render();
    $pdf = $dompdf->output(); 
    file_put_contents("{$filename}.pdf", $pdf);
}
?>