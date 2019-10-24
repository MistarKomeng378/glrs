<html>
<head>
<title>navb_<?php echo date_format(date_create($dt),'Ymd');?></title>
<style type="text/css">
    BODY, TD,TH {
  padding:0;
  margin:0;
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size:   11px;
}

.up_line{
    border-top: 1px solid #969696;
}

.down_line{
    border-bottom: 1px dotted #969696;    
}

.up_down_line{
    border-top: 1px dotted  #969696;
    border-bottom: 1px dotted #969696;    
}
</style>
</head>
<body>
    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#E0E0E0">
            <td colspan="6" align="center"><b>ALL NAV <?php echo date_format(date_create($dt),'d.m.Y');?> CIMB NIAGA - KUSTODIAN</b></td>
        </tr>
        <tr bgcolor="#E0E0E0">
            <th align="center" width="80">DATE</th> 
            <th align="left">NAME</th>
            <th align="right" width="100">NAV PER UNIT</th>
            <th align="right" width="90">RETURN 30 DAYS</th>
            <th align="right" width="80">RETURN YEAR</th>
            <th align="right" width="70">YIELD</th>
        </tr>
          <?php $rtr =''; $irow=1;foreach($r_data as $xitem) {?>
        <?php if($rtr!=$xitem['JENIS']) { $rtr=$xitem['JENIS'];$irow=1;?>
        <tr bgcolor="#F0F0F0">
            <td colspan="6" align="center"><b><?php echo strtoupper($xitem['JENIS']); ?></b></td>  
        </tr>
        <?php }?>
        <tr bgcolor="#ffffff">
            <td align="center"><?php echo date_format(date_create($dt),'m/d/Y');?></td>
            <td align="left"><?php echo strtoupper($xitem['PortfolioName']);?></td>
            <td align="right"><?php echo number_format((0+$xitem['CURRENTPRICE']),$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format((0+$xitem['RETURN30DAYS']),4,'.',',');?></td>
            <td align="right"><?php echo number_format((0+$xitem['RETURN1YEAR']),4,'.',',');?></td>
            <td align="right"><?php echo number_format((0+$xitem['RETURN1YEARACT']),4,'.',',');?></td>
        </tr> 
        <?php } ?>
    </table>

</body>
</html>