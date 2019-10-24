 <table width="100%">       
    <tr>
        <td align="center"><b><?php echo (count($r_pf)>0?"{$r_pf[0]['pfcode']}<br />{$r_pf[0]['pfname']}<br />":'') .  date_format(date_create($dt_nav),'d M Y'); ?></b></td>
    </tr>
 </table>
<table width="100%">
    <tr >
        <td style="border-bottom: 1px solid #000000;"><b>Descriptions</b></td>
        <td width="150" style="border-bottom: 1px solid #000000;"></td>
        <td width="150" style="border-bottom: 1px solid #000000;" align="right"><b>Balance</b></td>
    </tr>
<?php 
$str_a=''; $g='';  $str_s='';
$tot_g=0;
foreach($sect_A as $xitem) {
    if($g!=$xitem['NAVREPORTGRP'])    
    {
        if($g!='')
        {
            $str_a.="<tr><td></td><td style=\"border-top: 1px solid #000000;\">&nbsp;</td><td></td></tr>";
            $str_s.="<tr>
        <td colspan=\"2\"><b>{$g}</b></td>
        <td align=\"right\">" . number_format($tot_g,2,'.',',') . "</td>
    </tr>" . $str_a;
        }
        $g=$xitem['NAVREPORTGRP'];
        $tot_g=0;
        $str_a='';
    }
    $str_a.="<tr>
        <td> &nbsp; &nbsp;{$xitem['ASSETDESCRIPTION']}</td>
        <td  align=\"right\">" . number_format($xitem['ASSETVALUE'],2,'.',',') ."</td>
        <td  align=\"right\"></td>
    </tr>\n";
    $tot_g+=$xitem['ASSETVALUE'];
} 
if($g!='')
{
    $str_a.="<tr><td></td><td style=\"border-top: 1px solid #000000;\">&nbsp;</td><td></td></tr>";
    $str_s.="<tr>
        <td colspan=\"2\"><b>{$g}</b></td>
        <td align=\"right\">" . number_format($tot_g,2,'.',',') . "</td>
    </tr>" . $str_a;
}
    echo $str_s;
?>
</table>
 <?php
 if(count($sect_A)>0)
 {
    $koma_unit=4;
    $koma_price=4;
    $koma_nav=3;
    if(isset($r_pf[0]))
    {
        $koma_price=0+$r_pf[0]['pdec'];
        $koma_unit=0+$r_pf[0]['udec'];
        $koma_nav=0+$r_pf[0]['ndec'];
    }
    $tunit =0;
    if(count($sect_H)>0)
        $tunit=$sect_H[0]['U'];
    else
    {
        $tunit=$r_pf[0]["fkind"]==5?$sect_B[0]['VAL']/1000:$sect_B[0]['VAL']/1000;
    }
?>
<table width="100%"  style="border: 1px solid #000000;"> 
    <tr>
        <td><b>Net Asset Value</b></td>
        <td align="right" width="200"><b><?php echo count($sect_B)>0?number_format($sect_B[0]['VAL'],$koma_nav,'.',','):""; ?></b></td>
    </tr>
    <tr>
        <td><b>Total Unit Issued</b></td>
        <td align="right" width="200"><b><?php echo count($sect_B)>2?number_format($tunit,$koma_unit,'.',','):""; ?></b></td>
    </tr>
    <tr>
        <td><b>NAV / Unit</b></td>
        <td align="right" width="200"><b><?php echo count($sect_B)>1?number_format($sect_B[0]['VAL']/$tunit,$koma_price,'.',','):""; ?></b></td>
    </tr>
</table>   
<?php }?> 