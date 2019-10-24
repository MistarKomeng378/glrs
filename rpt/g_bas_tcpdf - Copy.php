<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_bas="";$htmlbas1 = "";$htmlbas2 = "";
$htmlbas1 = "
    <table width=\"100%\"> 
        <tr>
            <td width=\"35%\"><b>{$row_pf["pfname"]}</b></td>
            <td width=\"30%\" align=\"center\"><b>BANK ACCOUNT STATEMENT</b><br />{$date}</td>
            <td align=\"right\" width=\"35%\"><b>{$row_pf["fmname"]}</b></td>
        </tr>
    </table><hr /> ";

if (count($xitem_c)>0) {
$htmlbas2 = "
    BANK CIMB NIAGA - CUSTODY SERVICES<br />
    BANK ACCOUNT STATEMENT<br />
    <table width=\"100%\" >
        <tr >
            <td width=\"80\">Client Name</td>
            <td width=\"8\">:</td>
            <td width=\"545\"  align=\"left\">{$row_pf["pfname"]}</td>
        </tr>
        <tr>
            <td>Bank</td>
            <td width=\"8\">:</td>
            <td  align=\"left\">{$xitem_c[0]['bank_name']}</td>
        </tr>
        <tr>
            <td>Acc Type</td>
            <td width=\"8\">:</td>
            <td  align=\"left\">";
$bas_bank_name=trim($xitem_c[0]['bank_name']);
if(substr($bas_bank_name,-9)=='CURNT.ACC')
    $htmlbas2.="CURRENT ACCOUNTS";
if(substr($bas_bank_name,0,12)=='SUBSCRIPTION')
    $htmlbas2.="SUBSCRIPTION ACCOUNTS";
if(substr($bas_bank_name,-11)=='TAX PAYABLE')
    $htmlbas2.="EXPENSES PAYABLE";
$htmlbas2.="</td>
        </tr>
        <tr>
            <td>Date</td>
            <td width=\"8\">:</td>
            <td  align=\"left\">{$date}</td>
        </tr>
    </table><br /><br />";
$htmlbas2.="<table width=\"100%\"> 
    <tr>
        <td width=\"50\" style=\"border-bottom:1px dashed #808080\"><b>DATE</b></td>
        <td width=\"75\" style=\"border-bottom:1px dashed #808080\"><b>TRANS TYPE</b></td>
        <td width=\"40\" style=\"border-bottom:1px dashed #808080\"><b>ID</b></td>
        <td width=\"227\" style=\"border-bottom:1px dashed #808080\"><b>DETAIL</b></td>
        <td width=\"80\" align=\"right\" style=\"border-bottom:1px dashed #808080\"><b>DEBIT</b></td>
        <td width=\"80\" align=\"right\" style=\"border-bottom:1px dashed #808080\"><b>KREDIT</b></td>
        <td width=\"80\" align=\"right\" style=\"border-bottom:1px dashed #808080\"><b>BALANCE</b></td>
    </tr>";
                                          
    $bas_debit=0; $bas_kredit=0;$bas_bal =0; $bank_name='!@(#*&^*@!&#*)';
    foreach($xitem_c as $xitem) { 
        if($bank_name!=$xitem['bank_name'])
        {
            if($bank_name!='!@(#*&^*@!&#*)')
            {
                 $htmlbas2.="<tr>
    <td align=\"right\" width=\"392\" colspan=\"4\">Total {$xitem['bank_name']}  &nbsp; &nbsp;</td>
    <td align=\"right\" width=\"80\" style=\"border-top:1px dashed #808080\">" . number_format($bas_debit,2,'.',',') . "</td>
    <td align=\"right\" width=\"80\" style=\"border-top:1px dashed #808080\">" . number_format($bas_kredit,2,'.',',') . "</td>
    <td align=\"right\" width=\"80\" style=\"border-top:1px dashed #808080\">" . number_format($bas_bal,2,'.',',') . "</td>
</tr>";
            }
            $htmlbas2.="<tr><td colspan=\"7\">&nbsp;</td></tr><tr>
            <td align=\"left\" colspan=\"2\" width=\"125\" >OPEN BALANCE</td>
            <td align=\"left\" width=\"40\"></td>
            <td align=\"left\" width=\"227\"></td>
            <td align=\"right\" width=\"80\"></td>
            <td align=\"right\" width=\"80\"></td>
            <td align=\"right\" width=\"80\">" . number_format(($xitem['balance']-$xitem['kredit']+$xitem['debit']),2,'.',',') . "</td>
        </tr>";
            $bank_name=$xitem['bank_name'];
            $bas_debit=0; $bas_kredit=0;$bas_bal =0;
        }
        $htmlbas2.="<tr>
            <td align=\"left\"  width=\"50\">" . (is_object($xitem['data_date'])?date_format($xitem['data_date'],'d/m/Y'):'') ."</td>
            <td align=\"left\" width=\"75\" >{$xitem['transtype']}</td>
            <td align=\"left\" width=\"40\" >{$xitem['id']}</td>
            <td align=\"left\" width=\"227\" >{$xitem['detail']}" . (trim($xitem['detail1'])==''?'':"<br />{$xitem['detail1']}") . "</td>
            <td align=\"right\" width=\"80\" >" . ($xitem['debit']==0?'':number_format($xitem['debit'],2,'.',',')) . "</td>
            <td align=\"right\" width=\"80\" >" . ($xitem['kredit']==0?'':number_format($xitem['kredit'],2,'.',',')) . "</td>
            <td align=\"right\" width=\"80\" >" . ($xitem['balance']==0?'':number_format($xitem['balance'],2,'.',',')) . "</td>
        </tr>";
        $bas_debit+=$xitem['debit'];
        $bas_kredit+=$xitem['kredit'];
        $bas_bal=$xitem['balance'];
        
    }
    if($bank_name!='!@(#*&^*@!&#*)')
    {
         $htmlbas2.="<tr>
    <td align=\"right\" width=\"392\" colspan=\"4\">Total {$xitem['bank_name']}  &nbsp; &nbsp;</td>
    <td align=\"right\" width=\"80\" style=\"border-top:1px dashed #808080\">" . number_format($bas_debit,2,'.',',') . "</td>
    <td align=\"right\" width=\"80\" style=\"border-top:1px dashed #808080\">" . number_format($bas_kredit,2,'.',',') . "</td>
    <td align=\"right\" width=\"80\" style=\"border-top:1px dashed #808080\">" . number_format($bas_bal,2,'.',',') . "</td>
</tr>";
    }
    /*
    
    if($bankcode!="")
    {
        $htmlbas2.="<tr>
    <td align=\"right\"  colspan=\"4\"><b>Total for {$xitem['bank_name']}: &nbsp; </b></td>
    <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_bal,2,'.',',') . "</b></td>
    <td align=\"right\"style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_balidr,2,'.',',') . "</b></td></tr>";
    }
    $bankcode=$xitem['bank_code'];            
    $t_bal=$xitem['amount1'];
    $t_balidr=$xitem['amount1'];       */

    $htmlbas2.="</table>";
}

$html_bas .=  $htmlbas2 ;
?>