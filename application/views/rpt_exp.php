<hr />
    <table width="100%">
        <tr>
            <td colspan="3"><b>NAV ENXPESE</b></td>
        </tr>
        <tr>
            <td width="120">Invesment Manager</td>
            <td width="5">:</td>
            <td><?php echo $r_pf[0]['fmname'];?></td>
        </tr>
        <tr>
            <td>Mutual Fund</td>
            <td>:</td>
            <td><?php echo $r_pf[0]['pfname'];?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>:</td>
            <td><?php echo date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table>
    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#F0F0F0">
            <th align="center" width="100">Date</th>
            <th align="left" >Description</th>
            <th align="right" width="130">Amount</th>
        </tr>
<?php foreach($r_data as $xitem) { ?>
        <tr bgcolor="#ffffff">
            <td align="center"><?php echo date_format($xitem['DATE'],'F d, Y');?></td>
            <td align="left"><?php echo $xitem['DESCRIPTION'];?></td> 
            <td align="right"><?php echo number_format(0+$xitem['AMOUNT'],4,'.',',');?></td>
        </tr>         
<?php } ?>
    </table> 