<hr />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf[0]["pfname"];?></b></td>
            <td align="right"><?php echo $r_pf[0]["fmname"];?></td>
        </tr>
        <tr>                                                                 
            <td colspan="2">MTM JOURNAL REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
    <?php 
        $desc='';
    ?>
    <?php foreach ($r_data as $item1): ?>
    <?php 
    if($desc!=$item1["DESCRIPTION"])
    {
        $desc=$item1["DESCRIPTION"]
    ?>
        <tr>
            <td colspan="6"><div><strong><u><?php echo $item1["DESCRIPTION"];?></u></strong></div></td>
        </tr>
    <?php } ?>
        <tr>
            <td width="20">&nbsp;</td>
            <td width="60"><?php echo $item1["REFNO"];?></td>
            <td width="120"><?php echo $item1["ACCOUNTCODE"];?></td>
            <td width="320"><?php echo $item1["ACCOUNTNAME"];?></td>
            <td  width="20"><?php echo $item1["SIGN"];?></td>
            <td><div align="right"><?php echo number_format($item1["AMOUNT"],2,'.',",");?></div></td>
        </tr>
    
    <?php endforeach; ?>    
    </table>
