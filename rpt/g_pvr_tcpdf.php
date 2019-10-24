<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php

$htmlpvr = "
    <table width=\"100%\">
        <tr>
            <td width=\"35%\"><b>{$row_pf["pfname"]}</b></td>
            <td width=\"30%\" align=\"center\"><b>PORTFOLIO VALUATION REPORT</b><br />{$date}</td>
            <td align=\"right\" width=\"35%\"><b>{$row_pf["fmname"]}</b></td>
        </tr>
    </table><hr /> ";
$gtfv=0;$gtcv=0;$gtmv=0;$gtai=0;$gtpl=0;  $gtprocen=0;
if (count($row_pvr_fi)>0) {
$htmlpvr1="
    <table cellspacing=\"1\"  width=\"100%\">
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"130\"><b>SECURITY NAME</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"30\"><b>COUPON RATE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"42\" align=\"center\"><b>MATURITY DATE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"60\"><b>FACE VALUE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"30\"><b>UNIT COST</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"38\"><b>MARKET PRICE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"65\"><b>COST VALUE</b></td>            
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"65\"><b>MARKET VALUE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"65\"><b>ACCRUED INTEREST</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"65\"><b>UNREALIZED P/L</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"30\"><b>% of Group</b></td>
        </tr>
    </table>";
$htmlpvr11 = "
<table cellspacing=\"1\"  width=\"100%\" >"; 
    $substr="";
    $fv=0;$cv=0;$mv=0;$ai=0;$pl=0;$pvr_row=0; 
    $tfv=0;$tcv=0;$tmv=0;$tai=0;$tpl=0;  
    foreach($row_pvr_fi as $xitem) {$pvr_row++;
        if($substr!=$xitem['jns'])
        {
            if($substr!='')
            {
                $htmlpvr11.="<tr>
                    <td width=\"130\"> </td>
                    <td align=\"right\" width=\"30\"> </td>
                    <td width=\"42\" > </td>
                    <td align=\"right\" width=\"60\" style=\"border-top: 1px dotted #969696;\">" . number_format($fv,0,'.',',') . "</td>
                    <td align=\"right\" width=\"30\"> </td>
                    <td align=\"right\" width=\"38\"> </td>
                    <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($cv,2,'.',',') . "</td>            
                    <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($mv,2,'.',',') . "</td>
                    <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($ai,2,'.',',') . "</td>
                    <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($pl,2,'.',',') . "</td>
                    <td align=\"right\" width=\"30\"> </td>
                </tr>";
            }
            $htmlpvr11.="<tr><td colspan=\"11\"> </td></tr><tr><td colspan=\"11\"><b><u>{$xitem['jns']}</u></b></td></tr>";
            $substr=$xitem['jns'];
            $fv=0;$cv=0;$mv=0;$ai=0;$pl=0;
        }
        $htmlpvr11.="<tr>
            <td width=\"130\">{$xitem['SecurityName']}</td>
            <td align=\"right\" width=\"30\">" . number_format($xitem['COUPONRATE'],4,'.',',') . "</td>
            <td width=\"42\" align=\"center\">" . (is_object($xitem['MATURITY'])?date_format($xitem['MATURITY'],'d/m/Y'):'') ."</td>
            <td align=\"right\" width=\"60\">" . number_format($xitem['Holding'],0,'.',',') . "</td>
            <td align=\"right\" width=\"30\">" . number_format($xitem['TotalCost']/$xitem['Holding']*100,4,'.',',') . "</td>
            <td align=\"right\" width=\"38\">" . number_format($xitem['TotalValue']/$xitem['Holding']*100,6,'.',',') . "</td>
            <td align=\"right\" width=\"65\">" . number_format($xitem['TotalCost'],2,'.',',') . "</td>            
            <td align=\"right\" width=\"65\">" . number_format($xitem['TotalValue'],2,'.',',') . "</td>
            <td align=\"right\" width=\"65\">" . number_format($xitem['AccruedInterest'],2,'.',',') . "</td>
            <td align=\"right\" width=\"65\">" . number_format($xitem['UnrealizedValue'],2,'.',',') . "</td>
            <td align=\"right\" width=\"30\">" . number_format($xitem['procentage']*100,2,'.',',') . "</td>
        </tr>";
        $fv+=$xitem['Holding'];
        $cv+=$xitem['TotalCost'];
        $mv+=$xitem['TotalValue'];
        $ai+=$xitem['AccruedInterest'];
        $pl+=$xitem['UnrealizedValue'];
        
        $tfv+=$xitem['Holding'];
        $tcv+=$xitem['TotalCost'];
        $tmv+=$xitem['TotalValue'];
        $tai+=$xitem['AccruedInterest'];
        $tpl+=$xitem['UnrealizedValue'];
        $gtprocen+=$xitem['procentage'];
    }
    if($pvr_row>0)
    {
        $htmlpvr11.="<tr>
            <td width=\"130\"> </td>
            <td align=\"right\" width=\"30\"> </td>
            <td width=\"42\" > </td>
            <td align=\"right\" width=\"60\" style=\"border-top: 1px dotted #969696;\">" . number_format($fv,0,'.',',') . "</td>
            <td align=\"right\" width=\"30\"> </td>
            <td align=\"right\" width=\"38\"> </td>
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($cv,2,'.',',') . "</td>            
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($mv,2,'.',',') . "</td>
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($ai,2,'.',',') . "</td>
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\">" . number_format($pl,2,'.',',') . "</td>
            <td align=\"right\" width=\"30\"> </td>
        </tr>";
    }
    $htmlpvr11.="<tr><td colspan=\"11\"> </td></tr><tr>
            <td width=\"130\"> </td>
            <td align=\"right\" width=\"30\"> </td>
            <td width=\"42\" > </td>
            <td align=\"right\" width=\"60\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tfv,0,'.',',') . "</b></td>
            <td align=\"right\" width=\"30\"> </td>
            <td align=\"right\" width=\"38\"> </td>
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tcv,2,'.',',') . "</b></td>            
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tmv,2,'.',',') . "</b></td>
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tai,2,'.',',') . "</b></td>
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tpl,2,'.',',') . "</b></td>
            <td align=\"right\" width=\"30\"> </td>
        </tr>";
    $htmlpvr11.="</table>";
    $gtfv+=$tfv;
    $gtcv+=$tcv;
    $gtmv+=$tmv;
    $gtai+=$tai;
    $gtpl+=$tpl;
    
}
if (count($row_pvr_os)>0) {
$htmlpvr2="
    <table cellspacing=\"1\"  width=\"100%\">
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"135\"><b>SECURITY NAME</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"35\"><b>SECURITY CODE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"65\"><b>UNIT HOLDING</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"50\"><b>UNIT COST</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"50\"><b>MARKET PRICE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>COST VALUE</b></td>            
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>MARKET VALUE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>UNREALIZED P/L</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"30\"><b>% of Group</b></td>
        </tr>
    </table>";
$htmlpvr21 = "
<table cellspacing=\"1\"  width=\"100%\" >"; 
    $substr="";
    $cv=0;$mv=0;$pl=0;  
    $tcv=0;$tmv=0;$tpl=0;  $tfv=0;         $osdec=0;
    foreach($row_pvr_os as $xitem) {  $osdec=trim($xitem['GLGroup'])=='100'?4:0;
        if($substr!=$xitem['jns'])
        {
            if($substr!='')
            {
                $htmlpvr21.="<tr>
                    <td width=\"135\"> </td>
                    <td width=\"35\" > </td>
                    <td width=\"65\" > </td>
                    <td width=\"50\" > </td>
                    <td width=\"50\" > </td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($cv,2,'.',',') . "</td>            
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($mv,2,'.',',') . "</td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($pl,2,'.',',') . "</td>
                    <td align=\"right\" width=\"30\"> </td>
                </tr>";
            }
            $htmlpvr21.="<tr><td colspan=\"9\"> </td></tr><tr><td colspan=\"9\"><b><u>{$xitem['jns']}</u></b></td></tr>";
            $substr=$xitem['jns'];
            $cv=0;$mv=0;$pl=0;
        }
        $htmlpvr21.="<tr>
            <td width=\"135\">{$xitem['SecurityName']}</td>
            <td width=\"35\">{$xitem['EXTERNALCODE']}</td>
            <td align=\"right\" width=\"65\">" . number_format($xitem['Holding'],$osdec,'.',',') . "</td>
            <td align=\"right\" width=\"50\">" . number_format($xitem['TotalCost']/$xitem['Holding'],2,'.',',') . "</td>
            <td align=\"right\" width=\"50\">" . number_format($xitem['TotalValue']/$xitem['Holding'],4,'.',',') . "</td>
            <td align=\"right\" width=\"75\">" . number_format($xitem['TotalCost'],2,'.',',') . "</td>            
            <td align=\"right\" width=\"75\">" . number_format($xitem['TotalValue'],0,'.',',') . "</td>
            <td align=\"right\" width=\"75\">" . number_format($xitem['UnrealizedValue'],2,'.',',') . "</td>
            <td align=\"right\" width=\"30\">" . number_format($xitem['procentage']*100,2,'.',',') . "</td>
        </tr>";
        $cv+=$xitem['TotalCost'];
        $mv+=$xitem['TotalValue'];
        $pl+=$xitem['UnrealizedValue'];
        
        $tfv+=$xitem['Holding'];
        $tcv+=$xitem['TotalCost'];
        $tmv+=$xitem['TotalValue'];
        $tpl+=$xitem['UnrealizedValue'];
        $gtprocen+=$xitem['procentage'];
    }
    if($substr!='')
    {
        $htmlpvr21.="<tr>
                    <td width=\"135\"> </td>
                    <td width=\"35\" > </td>
                    <td width=\"65\" > </td>
                    <td width=\"50\" > </td>
                    <td width=\"50\" > </td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($cv,2,'.',',') . "</td>            
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($mv,2,'.',',') . "</td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($pl,2,'.',',') . "</td>
                    <td align=\"right\" width=\"30\"> </td>
                </tr>";
    }
    $htmlpvr21.="<tr><td colspan=\"9\"> </td></tr><tr>
                    <td width=\"135\"> </td>
                    <td width=\"35\" > </td>
                    <td width=\"65\" > </td>
                    <td width=\"50\" > </td>
                    <td width=\"50\" > </td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tcv,2,'.',',') . "</b></td>            
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tmv,2,'.',',') . "</b></td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tpl,2,'.',',') . "</b></td>
                    <td align=\"right\" width=\"70\"> </td>
                </tr>";
    $htmlpvr21.="</table>";
    $gtfv+=$tfv;
    $gtcv+=$tcv;
    $gtmv+=$tmv;
    
    $gtpl+=$tpl;
}

if (count($row_pvr_ri)>0) {
$htmlpvr3="
    <table cellspacing=\"1\"  width=\"100%\">
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"135\"><b>SECURITY NAME</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"35\"><b>SECURITY CODE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"65\"><b>UNIT HOLDING</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"50\"><b>UNIT COST</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"50\"><b>MARKET PRICE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>TOTAL VALUE AT COST</b></td>            
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>TOTAL VALUE AT MARKET</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>UNREALIZED P/L</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"30\"><b>% of Group</b></td>
        </tr>
    </table>";
$htmlpvr31 = "
<table cellspacing=\"1\"  width=\"100%\" >"; 
    $substr="";
    $cv=0;$mv=0;$pl=0;  
    $tcv=0;$tmv=0;$tpl=0;  $tfv=0;  
    foreach($row_pvr_ri as $xitem) { 
        if($substr!=$xitem['jns'])
        {
            if($substr!='')
            {
                $htmlpvr31.="<tr>
                    <td width=\"135\"> </td>
                    <td width=\"35\" > </td>
                    <td width=\"65\" > </td>
                    <td width=\"50\" > </td>
                    <td width=\"50\" > </td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($cv,2,'.',',') . "</td>            
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($mv,2,'.',',') . "</td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($pl,2,'.',',') . "</td>
                    <td align=\"right\" width=\"30\"> </td>
                </tr>";
            }
            $htmlpvr31.="<tr><td colspan=\"9\"> </td></tr><tr><td colspan=\"9\"><b><u>{$xitem['jns']}</u></b></td></tr>";
            $substr=$xitem['jns'];
            $cv=0;$mv=0;$pl=0;
        }
        $htmlpvr31.="<tr>
            <td width=\"135\">{$xitem['SecurityName']}</td>
            <td width=\"35\">{$xitem['EXTERNALCODE']}</td>
            <td align=\"right\" width=\"65\">" . number_format($xitem['Holding'],0,'.',',') . "</td>
            <td align=\"right\" width=\"50\">" . number_format($xitem['TotalCost']/$xitem['Holding'],2,'.',',') . "</td>
            <td align=\"right\" width=\"50\">" . number_format($xitem['TotalValue']/$xitem['Holding'],0,'.',',') . "</td>
            <td align=\"right\" width=\"75\">" . number_format($xitem['TotalCost'],2,'.',',') . "</td>            
            <td align=\"right\" width=\"75\">" . number_format($xitem['TotalValue'],0,'.',',') . "</td>
            <td align=\"right\" width=\"75\">" . number_format($xitem['UnrealizedValue'],2,'.',',') . "</td>
            <td align=\"right\" width=\"30\">" . number_format($xitem['procentage']*100,2,'.',',') . "</td>
        </tr>";
        $cv+=$xitem['TotalCost'];
        $mv+=$xitem['TotalValue'];
        $pl+=$xitem['UnrealizedValue'];
        
        $tfv+=$xitem['Holding'];
        $tcv+=$xitem['TotalCost'];
        $tmv+=$xitem['TotalValue'];
        $tpl+=$xitem['UnrealizedValue'];
        $gtprocen+=$xitem['procentage'];
    }
    if($substr!='')
    {
        $htmlpvr31.="<tr>
                    <td width=\"135\"> </td>
                    <td width=\"35\" > </td>
                    <td width=\"65\" > </td>
                    <td width=\"50\" > </td>
                    <td width=\"50\" > </td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($cv,2,'.',',') . "</td>            
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($mv,2,'.',',') . "</td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\">" . number_format($pl,2,'.',',') . "</td>
                    <td align=\"right\" width=\"30\"> </td>
                </tr>";
    }
    $htmlpvr31.="<tr><td colspan=\"9\"> </td></tr><tr>
                    <td width=\"135\"> </td>
                    <td width=\"35\" > </td>
                    <td width=\"65\" > </td>
                    <td width=\"50\" > </td>
                    <td width=\"50\" > </td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tcv,2,'.',',') . "</b></td>            
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tmv,2,'.',',') . "</b></td>
                    <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tpl,2,'.',',') . "</b></td>
                    <td align=\"right\" width=\"70\"> </td>
                </tr>";
    $htmlpvr31.="</table>";
    $gtfv+=$tfv;
    $gtcv+=$tcv;
    $gtmv+=$tmv;
    
    $gtpl+=$tpl;
}

if (count($row_pvr_zl)>0) {
$htmlpvr4="
    <table cellspacing=\"1\"  width=\"100%\">
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"135\"><b>SECURITY NAME</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"35\"> </td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"65\"><b>LOCAL VALUE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>COST VALUE</b></td>            
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>MARKET VALUE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"75\"><b>ACCRUED INTEREST</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"30\"><b>% of Group</b></td>
        </tr>
    </table>";
$htmlpvr41 = "
<table cellspacing=\"1\"  width=\"100%\" >"; 
    $substr="";
    
    $tfv=0;$tcv=0;$tmv=0;$tpl=0;  $tai=0;
    foreach($row_pvr_zl as $xitem) {         
        $htmlpvr41.="<tr>
            <td width=\"135\">{$xitem['SecurityName']}</td>
            <td width=\"35\">{$xitem['SecurityCode']}</td>
            <td align=\"right\" width=\"65\">" . number_format($xitem['Holding'],2,'.',',') . "</td>
            <td align=\"right\" width=\"75\">" . number_format($xitem['TotalCost'],2,'.',',') . "</td>            
            <td align=\"right\" width=\"75\">" . number_format($xitem['TotalValue'],2,'.',',') . "</td>
            <td align=\"right\" width=\"75\">" . number_format($xitem['AccruedInterest'],2,'.',',') . "</td>
            <td align=\"right\" width=\"30\">" . number_format($xitem['procentage']*100,2,'.',',') . "</td>
        </tr>";
        $tfv+=$xitem['Holding'];
        $tcv+=$xitem['TotalCost'];
        $tmv+=$xitem['TotalValue'];
        $tpl+=$xitem['UnrealizedValue'];
        $tai+=$xitem['AccruedInterest'];
        $gtprocen+=$xitem['procentage'];
    }
   $htmlpvr41.="<tr>
            <td width=\"135\"></td>
            <td width=\"35\"></td>
            <td align=\"right\" width=\"65\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tfv,2,'.',',') . "</b></td>
            <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tcv,2,'.',',') . "</b></td>            
            <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tmv,2,'.',',') . "</b></td>
            <td align=\"right\" width=\"75\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($tai,2,'.',',') . "</b></td>
            <td align=\"right\" width=\"30\"></td>
        </tr>";
    $htmlpvr41.="</table>";
    $gtfv+=$tfv;
    $gtcv+=$tcv;
    $gtmv+=$tmv;
    $gtai+=$tai;
    $gtpl+=$tpl;
}
$htmlpvrg="<br /><br /><table cellspacing=\"1\"  width=\"100%\">
        <tr>
            <td width=\"135\"></td>
            <td width=\"35\"></td>
            <td align=\"right\" width=\"55\" style=\"border-bottom: 1px dotted #969696;\"><b><span style=\"font-size:1.1em;\">Grand Total</span> </b></td>
            <td align=\"right\" width=\"85\" style=\"border-bottom: 1px dotted #969696;\"><b><span style=\"font-size:1.1em;\">" . number_format($gtcv,2,'.',',') . "</span></b></td>            
            <td align=\"right\" width=\"85\" style=\"border-bottom: 1px dotted #969696;\"><b><span style=\"font-size:1.1em;\">" . number_format($gtmv,2,'.',',') . "</span></b></td>
            <td align=\"right\" width=\"65\"></td>
            <td align=\"right\" width=\"35\"><b><span style=\"font-size:1.1em;\">" . number_format($gtprocen*100,2,'.',',') . "</span></b></td>
        </tr></table>";
?>
