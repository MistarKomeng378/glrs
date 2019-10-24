<table width="100%" bgcolor="#585858">
    <tr bgcolor="#F0F0F0">
        <th width="30" align="center">NO</th>
        <th width="70" align="center">PF CODE</th>
        <th>PF NAME</th>
        <th width="70" align="center">GL DONE</th>
        <th width="120" align="right">NAV INVEST</th>
        <th width="120" align="right">NAV GL</th>
        <th width="120" align="right">DIFF</th> 
    </tr>
    <?php 
    $irow=1;foreach($r_data as $xitem1){ 
        $bg="#FFFFFF";
        if($xitem1['GLDONESTATUS']=='A') $bg="#C0FFC0";
        else if ($xitem1['NAVDIFFERENCE']>5 or $xitem1['NAVDIFFERENCE']<-5) $bg="#FFC0C0";
    ?>
    <tr bgcolor="<?php echo $bg;?>">
        <td align="center"><?php echo $irow++;?></td>
        <td align="center"><?php echo $xitem1['PORTFOLIOCODE'];?></td>
        <td align="left"><?php echo $xitem1['PortfolioName'];?></td>
        <td align="center"><?php echo ($xitem1['GLDONESTATUS']=='A'?'YES':'NO');?></td>
        <td align="right"><?php echo number_format($xitem1['NAVINVESTMENT'],$xitem1['NAVDECIMAL'],'.',',');?></td>
        <td align="right"><?php echo number_format($xitem1['NAVGL'],$xitem1['NAVDECIMAL'],'.',',');?></td>
        <td align="right"><?php echo number_format($xitem1['NAVDIFFERENCE'],$xitem1['NAVDECIMAL'],'.',',');?></td>
    </tr>
    <?php }?>
</table>
