<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_os="<div style=\"page-break-before:always;\"></div>";$htmlos1 = "";$htmlos2 = "";
$htmlos1 = "
    <img src=\"img/cimbniaga.jpg\" alt=\"\"> <br />
    <table width=\"100%\">                                         
        <tr>
            <td><b>{$row_pf["pfname"]}</b></td>
            <td align=\"right\">{$row_pf["fmname"]}</td>
        </tr>
        <tr>                                                                 
            <td colspan=\"2\" align=\"center\"><b>OUSTANDING SETTLEMENT</b></td>
        </tr>
        <tr>                                                                 
            <td colspan=\"2\" align=\"center\">{$date}</td>
        </tr>
    </table><hr /> ";

if (count($row_ost)>0) {
$htmlos2 = "
<table width=\"100%\" id=\"tb_licek\">
        <tr >
            <td class=\"down_line\" ><b>TRAD DATE</b></td>
            <td class=\"down_line\" ><b>SET DATE</b></td>
            <td class=\"down_line\"><b>ID</b></td>
            <td class=\"down_line\"><b>CODE</b></td>
            <td class=\"down_line\"><b>SECURITY NAME</b></td>
            <td class=\"down_line\"><b>TRANS TYPE</b></td>
            <td class=\"down_line\" align=\"right\"><b>UNITS</b></td>
            <td class=\"down_line\" align=\"left\"><b>CURRENCY</b></td>
            <td class=\"down_line\" align=\"right\"><b>AMOUNT OUTSTANDING</b></td>
        </tr>";
        
    $t_os=0;$broker="";$tot_os=0;$tot_fi=0;
    foreach($row_ost as $xitem) { 
        if($broker!=$xitem['broker_name'])
        {
            if($broker!="")
            {
                $htmlos2.="<tr>
            <td align=\"right\"  colspan=\"8\"><b>Total for {$broker}: &nbsp; </b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_os,2,'.',',') . "</b></td></tr>";
            }
            $broker=$xitem['broker_name'];
            $htmlos2.="<tr>
            <td class=\"down_line\" colspan=\"2\"><b>{$broker}</b></td>
            <td colspan=\"6\"></td>
        </tr>";
             $t_os=0;
        }
        $htmlos2.="<tr>
            <td align=\"left\" >" . (is_object($xitem['contract_date'])?date_format($xitem['contract_date'],'d/m/Y'):'') ."</td>
            <td align=\"left\" >" . (is_object($xitem['settle_date'])?date_format($xitem['settle_date'],'d/m/Y'):'') ."</td>
            <td align=\"left\" >{$xitem['id']}</td>
            <td align=\"left\" >{$xitem['sec_code']}</td>
            <td align=\"left\" >{$xitem['sec_name']}</td>
            <td align=\"left\" >{$xitem['trx_name']}</td>
            <td align=\"right\" >" . number_format($xitem['unit'],2,'.',',') . "</td>
            <td align=\"left\" >{$xitem['cur']}</td>
            <td align=\"right\" >" . number_format($xitem['amount'],2,'.',',') . "</td>
        </tr>";
        $t_os+=$xitem['amount'];
        $tot_os=$xitem['trx_type']=='OS-SAL'?$xitem['amount']:($xitem['trx_type']=='OS-PUR'?$xitem['amount']*-1:0);
        $tot_fi=$xitem['trx_type']=='FI-SAL'?$xitem['amount']:($xitem['trx_type']=='FI-PUR'?$xitem['amount']*-1:0);
    }
   if($broker!=$xitem['broker_name'])
        {
            if($broker!="")
            {
                $htmlos2.="<tr>
            <td align=\"right\"  colspan=\"8\"><b>Total for {$broker}: &nbsp; </b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_os,2,'.',',') . "</b></td></tr>";
            }            
             $t_os=0;
        }
   $htmlos2.="<tr><td colspan=\"9\">&nbsp;</td></tr><tr>
        <td align=\"right\"  colspan=\"8\"><b>Total for Equities: &nbsp; </b></td>
        <td align=\"right\" class=\"down_line\"><b>" . number_format($tot_os,2,'.',',') . "</b></td></tr>
        <tr>
        <td align=\"right\"  colspan=\"8\"><b>Total for Fixed Income: &nbsp; </b></td>
        <td align=\"right\" class=\"down_line\"><b>" . number_format($tot_fi,2,'.',',') . "</b></td></tr>
        <tr><td colspan=\"9\">&nbsp;</td></tr><tr>
        <td align=\"right\"  colspan=\"8\"><b>Total Amount Outstanding: &nbsp; </b></td>
        <td align=\"right\" class=\"down_line\"><b>" . number_format($tot_os+$tot_fi,2,'.',',') . "</b></td></tr>";
        
    $htmlos2.= "</table>";
}

$html_os .=  $htmlos1 . $htmlos2 ;
?>