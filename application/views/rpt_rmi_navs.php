    <table width="100%">
        <tr>
            <td colspan="3"><b>PORTFOLIO PERCENTAGE REPORT</b></td>
        </tr>
        <tr>
            <td width="120">Invesment Manager</td>
            <td width="5">:</td>
            <td><?php echo isset($r_pf[0]['fmname'])?$r_pf[0]['fmname']:'';?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>:</td>
            <td><?php echo date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table>
    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#F0F0F0">
            <th align="center" width="40">No</th>
            <th align="left" width="80">Code</th>
            <th align="left">Name</th>
            <th align="right" width="220">NAV</th>
        </tr>
        <?php $irow=1;foreach($r_data as $xitem) {?>
        <tr bgcolor="#ffffff">
            <td align="center"><?php echo $irow++;?></td>
            <td align="left"><?php echo $xitem['PortfolioCode'];?></td>
            <td align="left"><?php echo $xitem['PortfolioName'];?></td>
            <td align="right"><?php echo number_format((0+$xitem['NAVINVESTMENT']),4,'.',',');?></td>
        </tr> 
        <?php } ?>
    </table>

    