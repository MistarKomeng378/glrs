<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_bal="";$htmlbal1 = "";$htmlbal2 = "";
$htmlbal1 = "
    <table width=\"100%\"> 
        <tr>
            <td width=\"35%\"><b>{$row_pf["pfname"]}</b></td>
            <td width=\"30%\" align=\"center\"><b>ACCOUNT BALANCE</b><br />{$date}</td>
            <td align=\"right\" width=\"35%\"><b>{$row_pf["fmname"]}</b></td>
        </tr>
    </table><hr /> ";
$htmlbal11 = "
    <table width=\"100%\">
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"65\"><b>CODE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"233\"><b>ACCOUNT NAME</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"65\"><b>TERM</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"70\"><b>RATE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"100\"><b>BALANCE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"100\"><b>BALANCE in {$row_pf["cur"]}</b></td>
        </tr>
    </table>";

if (count($row_bal)>0) {
$htmlbal2 = "
<table width=\"100%\" > ";
        
    $t_bal=0;$t_balidr=0;$bankcode=""; $bankname="";
    $gt_bal=0;$gt_balidr=0;
    foreach($row_bal     as $xitem) { 
        if($bankcode!=$xitem['bank_code'])
        {
            if($bankcode!="")
            {
                $htmlbal2.="<tr>
            <td align=\"right\"  colspan=\"4\"><b>Total for {$bankname}: &nbsp; </b></td>
            <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_bal,2,'.',',') . "</b></td>
            <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_balidr,2,'.',',') . "</b></td></tr>
            <tr><td colspan=\"6\">&nbsp;</td></tr>";
            }
            $bankcode=$xitem['bank_code'];            
            $bankname=$xitem['bank_name'];            
            $t_bal=0;
            $t_balidr=0;
        }
        $htmlbal2.="<tr>
            <td align=\"left\"  width=\"65\">{$xitem['bank_code']}</td>
            <td align=\"left\"  width=\"233\">{$xitem['bank_name']}</td>
            <td align=\"left\"  width=\"65\">" . (is_object($xitem['due_date'])?date_format($xitem['due_date'],'d/m/Y'):'') ."</td>
            <td align=\"right\"  width=\"70\">" . number_format($xitem['rate'],2,'.',',') . "</td>
            <td align=\"right\"  width=\"100\">" . number_format($xitem['amount1'],2,'.',',') . "</td>
            <td align=\"right\"  width=\"100\">" . number_format($xitem['amount2'],2,'.',',') . "</td>
        </tr>";
        $t_bal+=$xitem['amount1'];
        $t_balidr+=$xitem['amount1'];
        $gt_bal+=$xitem['amount1'];
        $gt_balidr+=$xitem['amount1'];
    }
    if($bankcode!="")
    {
        $htmlbal2.="<tr>
    <td align=\"right\"  colspan=\"4\"><b>Total for {$xitem['bank_name']}: &nbsp; </b></td>
    <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_bal,2,'.',',') . "</b></td>
    <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_balidr,2,'.',',') . "</b></td></tr>";
    }

    $htmlbal2.="</table>";
    $htmlbal2.="<br /><br /><table width=\"100%\">
        <tr >
            <td width=\"65\"></td>
            <td width=\"233\"></td>
            <td width=\"65\"></td>
            <td style=\"border-bottom: 1px dotted #969696;border-top: 1px dotted #969696;\" align=\"right\" width=\"70\"><b>Grand Total : </b></td>
            <td style=\"border-bottom: 1px dotted #969696;border-top: 1px dotted #969696;\" align=\"right\" width=\"100\"><b>" . number_format($gt_bal,2,'.',',') . "</b></td>
            <td style=\"border-bottom: 1px dotted #969696;border-top: 1px dotted #969696;\" align=\"right\" width=\"100\"><b>" . number_format($gt_balidr,2,'.',',') . "</b></td>
        </tr>
    </table>";
}

$html_bal .=  $htmlbal2 ;
?>