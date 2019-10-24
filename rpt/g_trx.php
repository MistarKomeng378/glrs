<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_trx="<div style=\"page-break-before:always;\"></div>";$htmltrx1 = "";$htmltrx2 = "";
$htmltrx1 = "
    <img src=\"img/cimbniaga.jpg\" alt=\"\"> <br />
    <table width=\"100%\">                                         
        <tr>
            <td><b>{$row_pf["pfname"]}</b></td>
            <td align=\"right\">{$row_pf["fmname"]}</td>
        </tr>
        <tr>                                                                 
            <td colspan=\"2\" align=\"center\"><b>TRANSACTION LISTING</b></td>
        </tr>
        <tr>                                                                 
            <td colspan=\"2\" align=\"center\">{$date}</td>
        </tr>
    </table><hr /> ";

if (count($row_trx)>0) {
$htmltrx2 = "
<table width=\"100%\" id=\"tb_licek\">
        <tr >
            <td class=\"down_line\" ><b>TRX DATE</b></td>
            <td class=\"down_line\" ><b>CODE</b></td>
            <td class=\"down_line\" ><b>SECURITY NAME</b></td>
            <td class=\"down_line\"><b>ID</b></td>
            <td class=\"down_line\"><b>MATURITY</b></td>
            <td class=\"down_line\" align=\"right\"><b>COUPON</b></td>
            <td class=\"down_line\" align=\"right\"><b>UNITS</b></td>
            <td class=\"down_line\" align=\"right\"><b>TOTAL COST</b></td>
            <td class=\"down_line\" align=\"right\"><b>INTEREST/INCOME</b></td>
            <td class=\"down_line\" align=\"right\"><b>PROCEEDS</b></td>
            <td class=\"down_line\"  align=\"right\"><b>PROFIT/LOSS</b></td>
            <td class=\"down_line\"><b>NOTES</b></td>
        </tr>";
        
    $t_unit=0;$t_cost=0;$t_int=0;$t_proc=0;$t_pl=0;$trx_type="";
    foreach($row_trx as $xitem) { 
        if($trx_type!=$xitem['trx_type'])
        {
            if($trx_type!="")
            {
                $htmltrx2.="<tr>
            <td align=\"right\"  colspan=\"6\"><b>Total {$trx_type}:&nbsp; </b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_unit,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_cost,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_int,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_proc,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_pl,2,'.',',') . "</b></td>
            <td align=\"left\" ></td>
        </tr><tr><td colspan=\"12\"></td></tr>";
            }
            $trx_type=$xitem['trx_type'];
            $htmltrx2.="<tr>
            <td class=\"down_line\" colspan=\"3\"><b>{$trx_type}</td><td colspan=\"8\"></b></td>
        </tr>";
             $t_unit=0;$t_cost=0;$t_int=0;$t_proc=0;$t_pl=0;
        }
        $htmltrx2.="<tr>
            <td align=\"left\" >" . (is_object($xitem['trx_date'])?date_format($xitem['trx_date'],'d/m/Y'):'') ."</td>
            <td align=\"left\" >{$xitem['sec_code']}</td>
            <td align=\"left\" >{$xitem['sec_name']}</td>
            <td align=\"left\" >{$xitem['id']}</td>
            <td align=\"left\" >" . (is_object($xitem['due_date'])?(date_format($xitem['due_date'],'d/m/Y')=='01/01/1900'?'':date_format($xitem['due_date'],'d/m/Y')):'') ."</td>
            <td align=\"right\" >" . number_format($xitem['rate'],2,'.',',') . "</td>
            <td align=\"right\" >" . number_format($xitem['unit'],2,'.',',') . "</td>
            <td align=\"right\" >" . number_format($xitem['cost'],2,'.',',') . "</td>
            <td align=\"right\" >" . number_format($xitem['int_inc'],2,'.',',') . "</td>
            <td align=\"right\" >" . number_format($xitem['proceed'],2,'.',',') . "</td>
            <td align=\"right\" >" . number_format($xitem['pl'],2,'.',',') . "</td>
            <td align=\"left\" >{$xitem['notes']}</td>
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
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_unit,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_cost,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_int,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_proc,2,'.',',') . "</b></td>
            <td align=\"right\" class=\"up_down_line\"><b>" . number_format($t_pl,2,'.',',') . "</b></td>
            <td align=\"left\" ></td>
        </tr>";
            }
    $htmltrx2.="</table>";
}

$html_trx .=  $htmltrx1 . $htmltrx2 ;
?>