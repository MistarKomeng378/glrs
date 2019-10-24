<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_trx="";$htmltrx1 = "";$htmltrx2 = "";
$htmltrx1 = "
    <table width=\"100%\">
        <tr>
            <td width=\"35%\"><b>{$row_pf["pfname"]}</b></td>
            <td width=\"30%\" align=\"center\"><b>TRANSACTION LISTING</b><br />{$date}</td>
            <td align=\"right\" width=\"35%\"><b>{$row_pf["fmname"]}</b></td>
        </tr>
    </table><hr /> ";
$htmltrx11="
    <table cellspacing=\"1\"  width=\"100%\" >
        <tr >
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"35\" ><b>TRX DATE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"32\"><b>CODE</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"85\"><b>SECURITY NAME</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"30\"><b>ID</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"35\"><b>MATURITY</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"30\"><b>COUPON</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"56\"><b>UNITS</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"56\"><b>TOTAL COST</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"56\"><b>INTEREST</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" align=\"right\" width=\"56\"><b>PROCEEDS</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\"  align=\"right\" width=\"56\"><b>PROFIT/LOSS</b></td>
            <td style=\"border-bottom: 1px dotted #969696;\" width=\"95\"><b>NOTES</b></td>
        </tr>
    </table>";

if (count($row_trx)>0) {
$htmltrx2 = "
<table cellspacing=\"1\"  width=\"100%\" >
        "; 
        
    $t_unit=0;$t_cost=0;$t_int=0;$t_proc=0;$t_pl=0;$trx_type="";
    foreach($row_trx as $xitem) { 
        if($trx_type!=$xitem['trx_type'])
        {
            if($trx_type!="")
            {
                $htmltrx2.="<tr>
            <td align=\"right\"  colspan=\"6\"><b>Total {$trx_type}:&nbsp; </b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_unit,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_cost,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_int,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_proc,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_pl,2,'.',',') . "</b></td>
            <td align=\"left\" ></td>
        </tr><tr><td colspan=\"12\"></td></tr>";
            }
            $trx_type=$xitem['trx_type'];
            $htmltrx2.="<tr>
            <td style=\"border-bottom: 1px dotted #969696;\" colspan=\"3\"><b>{$trx_type}</b></td><td colspan=\"9\">&nbsp; </td>
        </tr>";
             $t_unit=0;$t_cost=0;$t_int=0;$t_proc=0;$t_pl=0;
        }
        $htmltrx2.="<tr>
            <td align=\"left\" width=\"35\">" . (is_object($xitem['trx_date'])?date_format($xitem['trx_date'],'d/m/Y'):'') ."</td>
            <td align=\"left\" width=\"32\">{$xitem['sec_code']}</td>
            <td align=\"left\" width=\"85\">{$xitem['sec_name']}</td>
            <td align=\"left\" width=\"30\">{$xitem['id']}</td>
            <td align=\"left\" width=\"35\">" . (is_object($xitem['due_date'])?(date_format($xitem['due_date'],'d/m/Y')=='01/01/1900'?'':date_format($xitem['due_date'],'d/m/Y')):'') ."</td>
            <td align=\"right\" width=\"30\">" . number_format($xitem['rate'],2,'.',',') . "</td>
            <td align=\"right\" width=\"56\">" . number_format($xitem['unit'],2,'.',',') . "</td>
            <td align=\"right\" width=\"56\">" . number_format($xitem['cost'],2,'.',',') . "</td>
            <td align=\"right\" width=\"56\">" . number_format($xitem['int_inc'],2,'.',',') . "</td>
            <td align=\"right\" width=\"56\">" . number_format($xitem['proceed'],2,'.',',') . "</td>
            <td align=\"right\" width=\"56\">" . number_format($xitem['pl'],2,'.',',') . "</td>
            <td align=\"left\" width=\"95\">{$xitem['notes']}</td>
        </tr>";
        $t_unit+=$xitem['unit'];
        $t_cost+=$xitem['cost'];
        $t_int+=$xitem['int_inc'];
        $t_proc+=$xitem['proceed'];
        $t_pl+=$xitem['pl'];
    }
    if($trx_type!="")
            {
                  $htmltrx2.="<tr>
            <td align=\"right\"  colspan=\"6\"><b>Total {$trx_type}:&nbsp; </b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_unit,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_cost,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_int,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_proc,2,'.',',') . "</b></td>
            <td align=\"right\" style=\"border-top: 1px dotted #969696;\"><b>" . number_format($t_pl,2,'.',',') . "</b></td>
            <td align=\"left\" ></td>
        </tr><tr><td colspan=\"12\"></td></tr>";
            }
    $htmltrx2.="</table>";
}

$html_trx .=  $htmltrx2 ;
?>
