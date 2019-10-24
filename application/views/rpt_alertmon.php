<hr />
Mutual Fund NAV Alert Monitoring: <?php echo date_format(date_create($dt),'d M Y'); ?>
<table width="100%" bgcolor="#808080">
    <tr bgcolor="#E0E0E0">
        <th width="5" align="center">NO</th>
        <th width="50" align="center">PF CODE</th>
        <th align="left">PF NAME</th>
        <th width="40" align="right">PREV PRICE</th>
        <th width="40" align="right">CURR PRICE</th>
        <th width="40" align="right">CHANGEPERDAYS %</th>
        <th width="40" align="right">MIN %</th>
        <th width="40" align="right">MAX %</th>
        <th width="40" align="center">ALERT</th>
    </tr>
<?php $irow=0; $t='';  foreach ($r_data as $xitem1) { 
    if($irow%2==0) $bg="#FFC0FF"; else $bg="#FF90FF"; 
    if($xitem1['ALERT']==0) $t=''; else $t="style=\"color:#FF0000;\""; 
    if($xitem1['ALERT']==0 && $xitem1['THRESHOLDMIN']==0 && $xitem1['THRESHOLDMAX']==0)    $t="style=\"color:#005800;\""; 
?>
    
    <tr bgcolor="<?php echo $irow%2==0?"#FFFFFF":"#F8F8F8";?>" <?php echo $t;?>>
        <td align="center"><?php echo $irow+1;?></td>
        <td align="center"><?php echo $xitem1['PORTFOLIOCODE'];?></td>
        <td align="left"><?php echo $xitem1['PortfolioName'];?></td>
        <td align="right"><?php echo is_numeric($xitem1['PREVIOUSPRICE'])?number_format($xitem1['PREVIOUSPRICE'],$xitem1['PRICEDECIMAL'],'.',','):'';?></td>
        <td align="right"><?php echo is_numeric($xitem1['CURRENTPRICE'])?number_format($xitem1['CURRENTPRICE'],$xitem1['PRICEDECIMAL'],'.',','):'';?></td>
        <td align="right"><?php echo is_numeric($xitem1['CHANGEPERDAYPCT'])?number_format($xitem1['CHANGEPERDAYPCT'],$xitem1['PRICEDECIMAL'],'.',','):'';?></td>
        <td align="right"><?php echo is_numeric($xitem1['THRESHOLDMIN'])?number_format($xitem1['THRESHOLDMIN'],$xitem1['PRICEDECIMAL'],'.',','):'';?></td>
        <td align="right"><?php echo is_numeric($xitem1['THRESHOLDMAX'])?number_format($xitem1['THRESHOLDMAX'],$xitem1['PRICEDECIMAL'],'.',','):'';?></td>
        <td align="center"><?php echo $xitem1['ALERT']==0?"NO":"YES"; ?></td>        
    </tr>
<?php $irow++;  } ?>
</table>
