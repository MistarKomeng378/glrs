<hr />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf[0]["pfname"];?></b></td>
            <td align="right"><?php echo $r_pf[0]["fmname"];?></td>
        </tr>
        <tr>                                                                 
            <td colspan="2">VALUATION ACCRUED INTEREST REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr >
            <td class="down_line">SEC CODE</td>
            <td class="down_line">SEC NAME</td>
            <td align="right" class="down_line">HOLDING</td>
            <td align="right" class="down_line">TOTAL COST</td>
            <td align="right" class="down_line">TOTAL VALUE</td>
            <td align="right" class="down_line">ACCRUED INTEREST</td>
        </tr>
    <?php 
        $tot_holding=0;
        $tot_cost=0;
        $tot_val=0;
        $tot_accr=0;
    ?>
    <?php $sec_cat='';foreach ($r_data as $item1): ?>
    <?php if($sec_cat!=$item1['SecurityCategory']) {?>
        <?php if($sec_cat!=''){?>
        <tr>
            <td></td>
            <td></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_holding,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_cost,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_val,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_accr,2,'.',",");?></strong></div></td>
        </tr>
        <?php $tot_holding=0;$tot_cost=0;$tot_val=0;$tot_accr=0;}?>
        <tr bgcolor="#F0F0F0">
            <td colspan="6"><b><?php echo $item1['SecurityCategory']=='FI'?'FIX INCOME':'LIQUIDITY';?></b></td>
        </tr>
    <?php $sec_cat=$item1['SecurityCategory'];}?>
        <tr>
            <td>&nbsp;&nbsp;<?php echo $item1["SecurityCode"];?></td>
            <td><?php echo $item1["SecurityName"];?></td>
            <td><div align="right"><?php echo number_format($item1["Holding"],2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format($item1["TotalCost"],2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format($item1["TotalValue"],2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format($item1["AccruedInterest"],2,'.',",");?></div></td>
        </tr>
    <?php
        $tot_holding+=$item1["Holding"];
        $tot_cost+=$item1["TotalCost"];
        $tot_val+=$item1["TotalValue"];
        $tot_accr+=$item1["AccruedInterest"];
    ?>
    <?php endforeach; ?>   
    <?php if(count($r_data)>0) {?>
        <tr>
            <td></td>
            <td></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_holding,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_cost,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_val,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_accr,2,'.',",");?></strong></div></td>
        </tr>
    <?php }?> 
    </table> 
