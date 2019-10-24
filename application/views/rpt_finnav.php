 <hr />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf[0]["pfname"];?></b></td>
            <td align="right"><?php echo $r_pf[0]["fmname"];?></td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><b>NET ASSET VALUE REPORT</b></td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr >
            <td class="down_line"><b>Descriptions</b></td>
            <td width="150"  class="down_line">&nbsp;</td>
            <td width="150"  class="down_line" align="right"><b>Balance</b></td>
        </tr>
    <?php 
    $str_a=''; $g='';  $str_s='';
    $tot_g=0;
    foreach($sect_A as $xitem) {
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
    ?>
    <table width="100%"  style="border: 1px solid #000000;"> 
        <tr>
            <td><b>Net Asset Value</b></td>
            <td align="right" width="200"><b><?php echo count($sect_B)>0?number_format($sect_B[0]['VAL'],$koma_nav,'.',','):""; ?></b></td>
        </tr>
        <tr>
            <td><b>Total Unit Issued</b></td>
            <td align="right" width="200"><b><?php echo count($sect_B)>2?number_format($sect_H[0]['U'],$koma_unit,'.',','):""; ?></b></td>
        </tr>
        <tr>
            <td><b>NAV / Unit</b></td>
            <td align="right" width="200"><b><?php echo count($sect_B)>1?number_format($sect_B[0]['VAL']/$sect_H[0]['U'],$koma_price,'.',','):""; ?></b></td>
        </tr>
    </table>   
    <?php }?> 
    <br />
    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#ffffff" valign="top">
            <td width="30%">
                <table width="100%">
                    <tr bgcolor="#E0E0E0">
                        <th>Assets Allocation</th>
                        <th>Min</th>
                        <th>Real</th>
                        <th>Max</th>
                    </tr>
                    <?php foreach($sect_C as $xitem) { if($xitem['ASSETTYPE']!='SUBSCRIPTION FEE' && $xitem['ASSETTYPE']!='REDEMPTION FEE')  {?>
                    <tr>
                        <td align="left" class="down_line"><?php echo $xitem['ASSETTYPE'];?></td>
                        <td align="center" class="down_line"><?php echo '-';//number_format($xitem['MINPCT'],2,'.',',');?></td>
                        <td align="right" class="down_line"><?php echo number_format($xitem['ACTPCT'],2,'.',',');?></td>
                        <td align="center" class="down_line"><?php echo '-';//number_format($xitem['MAXPCT'],2,'.',',');?></td>
                    </tr>
                    <?php }}?>
                </table>
            </td>
            <td>
                <table width="100%">
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Change / Day</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[0]['CHANGEPERDAYVALUE'],4,'.',','); ?></td>
                    </tr>
                    <!--
                    <tr>
                        <td align="center">&nbsp;0.00</td>
                    </tr>
                    -->
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Change / Day %</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[0]['CHANGEPERDAYPCT'],4,'.',','); ?></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Kurs</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">1.00</td>
                    </tr>
                </table>
            </td>
            <td width="30%">
                <table width="100%">
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Last NAV per Unit(<?php echo date_format($sect_D[0]['PREVMONTHDATE'],'M d, Y'); ?>)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[0]['PREVMONTHPRICE'],$koma_price,'.',','); ?></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Return(30 days)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[0]['RETURN30DAYS'],4,'.',','); ?>%</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Last NAV per Unit (<?php echo is_object($sect_D[0]['PREVYEARDATE'])?date_format($sect_D[0]['PREVYEARDATE'],'M d, Y'):''; ?>)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[0]['PREVYEARPRICE'],$koma_price,'.',','); ?></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Return 1 Year</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[0]['RETURN1YEAR'],4,'.',','); ?>%</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Return 1 Year Actual (%)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[0]['RETURN1YEARACT'],4,'.',','); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
