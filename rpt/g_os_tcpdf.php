<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_os="";$htmlos1 = "";$htmlos2 = "";
$htmlos1 = "
    <table width=\"100%\">  
        <tr>
            <td width=\"35%\"><b>{$row_pf["pfname"]}</b></td>
            <td width=\"30%\" align=\"center\"><b>OUSTANDING SETTLEMENT</b><br />{$date}</td>
            <td align=\"right\" width=\"35%\"><b>{$row_pf["fmname"]}</b></td>
        </tr>
    </table><hr /> ";
$htmlos11 = "
    <table width=\"100%\" cellspacing=\"1\">
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\"  width=\"50\"><b>TRAD DATE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\"  width=\"40\"><b>SET DATE</b></td>
            <td  style=\"border-bottom: 1px dotted #969696;\" width=\"35\"><b>ID</b></td>
            <td  style=\"border-bottom: 1px dotted #969696;\" width=\"40\"><b>CODE</b></td>
            <td  style=\"border-bottom: 1px dotted #969696;\" width=\"180\"><b>SECURITY NAME</b></td>
            <td  style=\"border-bottom: 1px dotted #969696;\" width=\"70\"><b>TRANS TYPE</b></td>
            <td  style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>UNITS</b></td>
            <td  style=\"border-bottom: 1px dotted #969696;\" align=\"left\" width=\"45\"><b>&nbsp; CURRENCY</b></td>
            <td  style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"90\"><b>AMOUNT OUTSTANDING</b></td>
        </tr>
        </table>";

if (count($row_ost)>0) {
$htmlos2 = "
<table width=\"100%\" cellspacing=\"1\">";
        
    $t_os=0;$broker="";$tot_os=0;$tot_fi=0;     $gtot=0;
    foreach($row_ost as $xitem) { 
        if($broker!=$xitem['broker_name'])
        {
            if($broker!="")
            {
                $htmlos2.="<tr>
            <td align=\"right\"  colspan=\"8\"><b>Total for {$broker}: &nbsp; </b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_os,2,'.',',') . "</b></td></tr>";
            }
            $broker=$xitem['broker_name'];
            $htmlos2.="<tr>
            <td style=\"border-bottom: 1px dotted #969696;\" colspan=\"2\"><b>{$broker}</b></td>
            <td colspan=\"6\"></td>
        </tr>";
             $t_os=0;
        }
        
        $htmlos2.="<tr>
            <td align=\"left\" width=\"50\">" . (is_object($xitem['contract_date'])?date_format($xitem['contract_date'],'d/m/Y'):'') ."</td>
            <td align=\"left\" width=\"40\">" . (is_object($xitem['settle_date'])?date_format($xitem['settle_date'],'d/m/Y'):'') ."</td>
            <td align=\"left\" width=\"34\">{$xitem['id']}</td>
            <td align=\"left\" width=\"40\">{$xitem['sec_code']}</td>
            <td align=\"left\" width=\"180\">{$xitem['sec_name']}</td>
            <td align=\"left\" width=\"70\">{$xitem['trx_name']}</td>
            <td align=\"right\" width=\"75\">" . number_format($xitem['unit'],2,'.',',') . "</td>
            <td align=\"left\" width=\"45\">&nbsp;&nbsp; {$xitem['cur']}</td>
            <td align=\"right\" width=\"90\">" . number_format($xitem['amount'],2,'.',',') . "</td>
        </tr>";
        $t_os+=$xitem['amount'];
        //$tot_os=$xitem['trx_type']=='OS-SAL'?$xitem['amount']:($xitem['trx_type']=='OS-PUR'?$xitem['amount']*-1:0);
        //$tot_fi=$xitem['trx_type']=='FI-SAL'?$xitem['amount']:($xitem['trx_type']=='FI-PUR'?$xitem['amount']*-1:0);
        $tot_os+=($xitem['trx_type']=='OS-SAL'||$xitem['trx_type']=='OS-PUR'||$xitem['trx_type']=='DIV')?$xitem['amount']:0;
        $tot_fi+=($xitem['trx_type']=='FI-SAL'||$xitem['trx_type']=='FI-PUR'||$xitem['trx_type']=='INT')?$xitem['amount']:0;
        $gtot+=$xitem['amount'];
    }
    if($broker!="")
    {
        $htmlos2.="<tr>
    <td align=\"right\"  colspan=\"8\"><b>Total for {$broker}: &nbsp; </b></td>
    <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_os,2,'.',',') . "</b></td></tr>";
    }
    /*$htmlos2.="<tr><td colspan=\"9\">&nbsp;</td></tr><tr>
        <td align=\"right\"  colspan=\"8\"><b>Total for Equities: &nbsp; </b></td>
        <td align=\"right\" style=\"border-bottom: 1px dotted #969696;\"><b>" . number_format($tot_os,2,'.',',') . "</b></td></tr>
        <tr>
        <td align=\"right\"  colspan=\"8\"><b>Total for Fixed Income: &nbsp; </b></td>
        <td align=\"right\" style=\"border-bottom: 1px dotted #969696;\"><b>" . number_format($tot_fi,2,'.',',') . "</b></td></tr>
        <tr><td colspan=\"9\">&nbsp;</td></tr><tr>
        <td align=\"right\"  colspan=\"8\"><b>Total Amount Outstanding: &nbsp; </b></td>
        <td align=\"right\" style=\"border-bottom: 1px dotted #969696;\"><b>" . number_format($tot_os+$tot_fi,2,'.',',') . "</b></td></tr>";
     */   
     $htmlos2.="<tr><td colspan=\"9\">&nbsp;</td></tr>
        <tr><td colspan=\"9\">&nbsp;</td></tr><tr>
        <td align=\"right\"  colspan=\"8\"><b>Total Amount Outstanding: &nbsp; </b></td>
        <td align=\"right\" style=\"border-bottom: 1px dotted #969696;\"><b>" . number_format($gtot,2,'.',',') . "</b></td></tr>";
    $htmlos2.= "</table>";
}

$html_os .=  $htmlos2 ;
?>