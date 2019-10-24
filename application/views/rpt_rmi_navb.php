    <div align="center"><b>ALL NAV CIMB NIAGA - KUSTODIAN<br /><?php echo date_format(date_create($dt),'F d, Y');?></b></div>
    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#E0E0E0">
            <th align="center" width="80">Date</th>
            <th align="left">Name</th>
            <th align="right" width="100">NAV per Unit</th>
            <th align="right" width="90">Return 30 Days</th>
            <th align="right" width="80">Return Year</th>
            <th align="right" width="70">Yield</th>
        </tr>
        <?php $rtr =''; $irow=1;foreach($r_data as $xitem) {?>
        <?php if($rtr!=$xitem['JENIS']) { $rtr=$xitem['JENIS'];$irow=1;?>
        <tr bgcolor="#F0F0F0">
            <td colspan="6" align="center"><b><?php echo $xitem['JENIS']; ?></b></td>
        </tr>
        <?php }?>
        <tr bgcolor="#ffffff">
            <td align="center"><?php echo date_format(date_create($dt),'m/d/Y');?></td>
            <td align="left"><?php echo $xitem['PortfolioName'];?></td>
            <td align="right"><?php echo number_format((0+$xitem['CURRENTPRICE']),4,'.',',');?></td>
            <td align="right"><?php echo number_format((0+$xitem['RETURN30DAYS']),4,'.',',');?></td>
            <td align="right"><?php echo number_format((0+$xitem['RETURN1YEAR']),4,'.',',');?></td>
            <td align="right"><?php echo number_format((0+$xitem['RETURN1YEARACT']),4,'.',',');?></td>
        </tr> 
        <?php } ?>
    </table>

    