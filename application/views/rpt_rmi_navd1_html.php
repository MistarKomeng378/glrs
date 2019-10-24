<html>
<head>
<title>navd_<?php echo date_format(date_create($dt),'Ymd');?>_<?php echo $r_par['fm']; ?></title>
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
            <td colspan="3"><b>PORTFOLIO DETAIL REPORT</b></td>
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
    <table  bgcolor="#000000">
        <tr bgcolor="#F0F0F0">
            <th align="center" width="80">FUND CODE</th>
            <th align="center" width="90">DATE</th>
            <th align="right" width="120">AUM</th>
            <th align="right" width="120">NAV_PERUNIT</th>
            <th align="right" width="120">TOT_UNIT</th>
            <th align="right" width="120">EQUITIES</th>
            <th align="right" width="120">FI_GOV</th>
            <th align="right" width="120">FI_CORP</th>
            <th align="right" width="120">LIQ_CASH</th>
            <th align="right" width="120">LIQ_TD</th>
            <th align="right" width="120">OTHERS_ASET</th>
            <th align="right" width="120">MGT_FEE</th>
            <th align="right" width="120">CUS_FEE</th>
            <th align="right" width="120">AUD_FEE</th> 
            <th align="right" width="120">OTHERS_LIABIl</th>
            <th align="right" width="120">TOT_ASET</th>
            <th align="right" width="120">EQT_PCT_ASSET </th>            
            <th align="right" width="120">EQT_PCT_AUM</th>
            <th align="right" width="120">FI_PCT_ASSET</th>
            <th align="right" width="120">FI_PCT_AUM</th>
            <th align="right" width="120">LIQ_PCT_ASSET</th>
            <th align="right" width="120">LIQ_PCT_AUM</th>
        </tr>
        <?php foreach($r_data as $xitem) {?>
        <tr bgcolor="#ffffff">
            <td align="left"><?php echo $xitem['PortfolioCode'];?></td>
            <td align="left"><?php echo date_format($xitem['VALDATE'],'m/d/Y');?></td>
            <td align="right"><?php echo number_format(0+$xitem['AUM'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['NAV_PER_UNIT'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['TOT_UNIT'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['EQUITIES'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['FI_Govt'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['FI_Corp'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['CASH'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['TD'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['OTHERS_ASET'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['MGT_FEE'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['CUST_FEE'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['AUD_FEE'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['OTHERS_FEE'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['TOT_ASET'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['EQ_PCT_ASET'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['EQ_PCT_AUM'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['FI_PCT_ASET'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['FI_PCT_AUM'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['LIQ_PCT_ASET'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['LIQ_PCT_AUM'],4,'.',',');?></td>
        </tr> 
        <?php } ?>
    </table>

</body>
</html>