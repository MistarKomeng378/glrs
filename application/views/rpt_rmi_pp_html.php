<html>
<head>
<title>pp_<?php echo date_format(date_create($dt),'Ymd');?>_<?php echo $r_par['pf']; ?></title>
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
  <?php $fcode='';foreach($r_data as $xitem) {?>    
<?php if($fcode!=$xitem['PortfolioCode'])  {?>
<?php if($fcode!='') echo "</table><div style=\"page-break-before:always;\"></div>"; ?>    
    <table width="100%">
        <tr>
            <td colspan="3"><b>PORTFOLIO PERCENTAGE REPORT</b></td>
        </tr>
        <tr>
            <td width="120">Invesment Manager</td>
            <td width="5">:</td>
            <td><?php echo $xitem['FundManagerName'];?></td>
        </tr>
        <tr>
            <td>Mutual Fund</td>
            <td>:</td>
            <td><?php echo $xitem['PortfolioName'];?></td>
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
            <th align="right" width="80">%</th>
        </tr>
<?php $fcode=$xitem['PortfolioCode'];}?>
        <tr bgcolor="#ffffff">
            <td align="center"><?php echo $xitem['nrow'];?></td>
            <td align="left"><?php echo $xitem['securitycode'];?></td>
            <td align="left"><?php echo $xitem['SecurityName'];?></td>
            <td align="right"><?php echo number_format((0+$xitem['procentage'])*100,4,'.',',');?></td>
        </tr>         
<?php } ?>
<?php if($fcode!='') echo "</table>"; ?>
</body>
</html>