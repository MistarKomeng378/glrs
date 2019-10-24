<html>
<head>
<title>navs_<?php echo date_format(date_create($dt),'Ymd');?>_<?php echo $r_par['fm']; ?></title>
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

    <table width="100%">
        <tr>
            <td colspan="3"><b>PORTFOLIO PERCENTAGE REPORT</b></td>
        </tr>
        <tr>
            <td width="120">Invesment Manager</td>
            <td width="5">:</td>
            <td><?php echo isset($r_fm[0]['fmname'])?$r_fm[0]['fmname']:'';?></td>
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

</body>
</html>