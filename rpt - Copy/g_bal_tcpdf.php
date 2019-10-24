<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_bal="";$htmlbal1 = "";$htmlbal2 = "";
$htmlbal1 = "
        <table width=\"100%\">                                         
        <tr>
            <td><b>{$row_pf["pfname"]}</b></td>
            <td align=\"right\">{$row_pf["fmname"]}</td>
        </tr>
        <tr>                                                                 
            <td colspan=\"2\" align=\"center\"><b>ACCOUNT BALANCE</b></td>
        </tr>
        <tr>                                                                 
            <td colspan=\"2\" align=\"center\">{$date}</td>
        </tr>
    </table><hr /> ";

if (count($row_bal)>0) {
$htmlbal2 = "
<table width=\"100%\" id=\"tb_licek\">
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\"><b>CODE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\"><b>ACCOUNT NAME</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\"><b>TERM</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\"><b>RATE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\"><b>BALANCE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\"><b>BALANCE in IDR</b></td>
        </tr>";
        
    $t_bal=0;$t_balidr=0;$bankcode="";
    foreach($row_bal     as $xitem) { 
        if($bankcode!=$xitem['bank_code'])
        {
            if($bankcode!="")
            {
                $htmlbal2.="<tr>
            <td align=\"right\"  colspan=\"4\"><b>Total for {$xitem['bank_name']}: &nbsp; </b></td>
            <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_bal,2,'.',',') . "</b></td>
            <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_balidr,2,'.',',') . "</b></td></tr>
            <tr><td colspan=\"6\">&nbsp;</td></tr>";
            }
            $bankcode=$xitem['bank_code'];            
            $t_bal=0;
            $t_balidr=0;
        }
        $htmlbal2.="<tr>
            <td align=\"left\" >{$xitem['bank_code']}</td>
            <td align=\"left\" >{$xitem['bank_name']}</td>
            <td align=\"left\" >" . (is_object($xitem['due_date'])?date_format($xitem['due_date'],'d/m/Y'):'') ."</td>
            <td align=\"right\" >" . number_format($xitem['rate'],2,'.',',') . "</td>
            <td align=\"right\" >" . number_format($xitem['amount1'],2,'.',',') . "</td>
            <td align=\"right\" >" . number_format($xitem['amount2'],2,'.',',') . "</td>
        </tr>";
        $t_bal=$xitem['amount1'];
        $t_balidr=$xitem['amount1'];
    }
    if($bankcode!="")
    {
        $htmlbal2.="<tr>
    <td align=\"right\"  colspan=\"4\"><b>Total for {$xitem['bank_name']}: &nbsp; </b></td>
    <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_bal,2,'.',',') . "</b></td>
    <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_balidr,2,'.',',') . "</b></td></tr>";
    }
    $bankcode=$xitem['bank_code'];            
    $t_bal=$xitem['amount1'];
    $t_balidr=$xitem['amount1'];

    $htmlbal2.="</table>";
}

$html_bal .=  $htmlbal1 . $htmlbal2 ;
?>