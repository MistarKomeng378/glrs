<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_nav="";$htmlnav1 = "";$htmlnav2 = "";$htmlnav3 = "";$htmlnav4 = "";
$htmlnav1 = "
    <table width=\"100%\">                                         
        <tr>
            <td width=\"35%\"><b>{$row_pf["pfname"]}</b></td>
            <td width=\"30%\" align=\"center\"><b>NET ASSET VALUE REPORT</b><br />{$date}</td>
            <td align=\"right\" width=\"35%\">{$row_pf["fmname"]}</td>
        </tr>
    </table><hr /> ";

if (count($row_nav_sect_A)>0) {
$htmlnav2 = "
<table width=\"100%\">
        <tr>
            <td style=\"border-bottom: 1px dotted #969696;\"><b>Descriptions</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\">&nbsp;</td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\"><b>Balance</b></td>
        </tr>";
        
    $str_a=''; $g='';  $str_s='';
    $tot_g=0;
    foreach($row_nav_sect_A as $xitem) {
        if($g!=$xitem['NAVREPORTGRP'])    
        {
            if($g!='')
            {
                $str_a.="<tr><td></td><td >&nbsp;</td><td></td></tr>";
                $str_s.="<tr>
            <td colspan=\"2\"><b>{$g}</b></td>
            <td align=\"right\"><b>" . number_format($tot_g,2,'.',',') . "</b></td>
        </tr>" . $str_a;
            }
            $g=$xitem['NAVREPORTGRP'];
            $tot_g=0;
            $str_a='';
        }
        $str_a.="<tr>
            <td> &nbsp; &nbsp; &nbsp; &nbsp;{$xitem['ASSETDESCRIPTION']}</td>
            <td  align=\"right\">" . number_format($xitem['ASSETVALUE'],2,'.',',') ."</td>
            <td  align=\"right\"></td>
        </tr>\n";
        $tot_g+=$xitem['ASSETVALUE'];
    } 
    if($g!='')
    {
        $str_a.="<tr><td></td><td >&nbsp;</td><td></td></tr>";
        $str_s.="<tr>
            <td colspan=\"2\"><b>{$g}</b></td>
            <td align=\"right\"><b>" . number_format($tot_g,2,'.',',') . "</b></td>
        </tr>" . $str_a;
    }
$htmlnav2 .= $str_s . "</table>";
  if(count($row_nav_sect_A)>0)
  {
    $koma_unit=4;
    $koma_price=4;
    $koma_nav=3;
    if(isset($row_pf))
    {
        $koma_price=0+$row_pf['pdec'];
        $koma_unit=0+$row_pf['udec'];
        $koma_nav=0+$row_pf['ndec'];
    }
    
    $htmlnav3 =  "
    <table width=\"100%\"  style=\"border: 1px solid #000000;\"> 
        <tr>
            <td><b>Net Asset Value</b></td>
            <td align=\"right\" ><b>" . (count($row_nav_sect_B)>0?number_format($row_nav_sect_B[0]['VAL'],$koma_nav,'.',','):"") . "</b></td>
        </tr>
        <tr>
            <td><b>Total Unit Issued</b></td>
            <td align=\"right\"><b>" . (count($row_nav_sect_B)>2?number_format($row_nav_sect_H[0]['U'],$koma_unit,'.',','):"") . "</b></td>
        </tr>
        <tr>
            <td><b>NAV / Unit</b></td>
            <td align=\"right\"><b>" . (count($row_nav_sect_B)>1?number_format($row_nav_sect_B[0]['VAL']/$row_nav_sect_H[0]['U'],$koma_price,'.',','):"") ."</b></td>
        </tr>
    </table><br />  ";
  }
$htmlnav4 ="
<table width=\"100%\" bgcolor=\"#000000\">
        <tr bgcolor=\"#ffffff\" valign=\"top\">
            <td width=\"35%\">
                <table width=\"100%\">
                    <tr bgcolor=\"#E0E0E0\">
                        <th>Assets Allocation</th>
                        <th>Min</th>
                        <th>Real</th>
                        <th>Max</th>
                    </tr>";
                    foreach($row_nav_sect_C as $xitem) { if($xitem['ASSETTYPE']!='SUBSCRIPTION FEE' && $xitem['ASSETTYPE']!='REDEMPTION FEE')  {
                    $htmlnav4.="<tr>
                        <td align=\"left\" style=\"border-bottom: 1px dotted #969696;\">{$xitem['ASSETTYPE']}</td>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">-</td>
                        <td align=\"right\" style=\"border-bottom: 1px dotted #969696;\">" . number_format($xitem['ACTPCT'],2,'.',',') . "</td>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">-</td>
                    </tr>";
                    }}
                $htmlnav4.="</table>
            </td>
            <td width=\"30%\">
                <table width=\"100%\">
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Change / Day</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">&nbsp;" . number_format($row_nav_sect_D[0]['CHANGEPERDAYVALUE'],4,'.',',') . "</td>
                    </tr>
                    <!--
                    <tr>
                        <td align=\"center\">&nbsp;0.00</td>
                    </tr>
                    -->
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Change / Day %</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">&nbsp;" . number_format($row_nav_sect_D[0]['CHANGEPERDAYPCT'],4,'.',',') . "</td>
                    </tr>
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Kurs</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">1.00</td>
                    </tr>
                </table>
            </td>
            <td width=\"35%\">
                <table width=\"100%\">
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Last NAV per Unit(" . date_format($row_nav_sect_D[0]['PREVMONTHDATE'],'M d, Y') . ")</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">&nbsp;" . number_format($row_nav_sect_D[0]['PREVMONTHPRICE'],$koma_price,'.',',') . "</td>
                    </tr>
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Return(30 days)</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">&nbsp;" . number_format($row_nav_sect_D[0]['RETURN30DAYS'],4,'.',',') . "%</td>
                    </tr>
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Last NAV per Unit (" . date_format($row_nav_sect_D[0]['PREVYEARDATE'],'M d, Y') . ")</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">&nbsp;" . number_format($row_nav_sect_D[0]['PREVYEARPRICE'],$koma_price,'.',',') . "</td>
                    </tr>
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Return 1 Year</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">&nbsp;" . number_format($row_nav_sect_D[0]['RETURN1YEAR'],4,'.',',') . "%</td>
                    </tr>
                    <tr bgcolor=\"#E0E0E0\">
                        <th align=\"center\">Return 1 Year Actual (%)</th>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"border-bottom: 1px dotted #969696;\">&nbsp;" . number_format($row_nav_sect_D[0]['RETURN1YEARACT'],4,'.',',') . "</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>";
}

$html_nav .=   $htmlnav2 . $htmlnav3 . $htmlnav4;
?>