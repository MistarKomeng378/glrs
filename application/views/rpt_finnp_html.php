<html>
<head>
<title>Net Asset Value Report</title>
<style type="text/css">
  BODY, TD, TH {
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
<div style="width: 765px;">
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf[0]["pfname"];?></b></td>
            <td align="right"><?php echo $r_pf[0]["fmname"];?></td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><b>NAV PERFORMANCE HISTORY</b></td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($sdt),'F d, Y') . " to " . date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%" >
        <tr >
            <td class="down_line"><b>Trade Date</b></td>
            <td width="130"  class="down_line" align="right"><b>NAV</b></td>
            <td width="80"  class="down_line" align="right"><b>NAV/Unit</b></td>
            <td width="80"  class="down_line" align="right"><b>Change/Day</b></td>
            <td width="110"  class="down_line" align="right"><b>Return 30 Days</b></td>
            <td width="110"  class="down_line" align="right"><b>Return 365 Days</b></td>
            <td width="130"  class="down_line" align="right"><b>Return 365 Days Actual</b></td>
        </tr>
    <?php foreach($r_data as $xitem) { ?>
        <tr>
            <td ><?php echo date_format($xitem['VALUATIONDATE'],'m/d/Y');?></td>
            <td align="right"><?php echo number_format($xitem['NAVINVESTMENT'],$xitem['NAVDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format($xitem['CURRENTPRICE'],$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format($xitem['CHANGEPERDAYVALUE'],$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format($xitem['RETURN30DAYS'],$xitem['NAVDECIMAL'],'.',',');?>%</td>
            <td align="right"><?php echo number_format($xitem['RETURN1YEAR'],$xitem['NAVDECIMAL'],'.',',');?>%</td>
            <td align="right"><?php echo number_format($xitem['RETURN1YEARACT'],$xitem['NAVDECIMAL'],'.',',');?>%</td>
        </tr>
    <?php }?>
        <tr>
            <td class="up_line">&nbsp;</td>
            <td class="up_line">&nbsp;</td>
            <td class="up_line">&nbsp;</td>
            <td class="up_line">&nbsp;</td>
            <td class="up_line">&nbsp;</td>
            <td class="up_line">&nbsp;</td>
            <td class="up_line">&nbsp;</td>
        </tr>
    </table>
</div>
</body>
</html>