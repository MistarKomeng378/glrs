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
            <td>Mutual Fund</td>
            <td>:</td>
            <td><?php echo isset($r_pf[0]['pfname'])?$r_pf[0]['pfname']:'';?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>:</td>
            <td><?php echo date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table>
    <table  bgcolor="#000000">
        <tr bgcolor="#F0F0F0">
            <th align="left" width="200">DESC</th>
            <th align="left" width="90">NAVDATE</th>
            <th align="right" width="120">AMOUNT</th>
            <th align="right" width="120">NAV</th>
            <th align="right" width="120">PRICE</th>
            <th align="right" width="120">TOTALUNIT</th>
            <th align="right" width="120">YIELD</th>
            <th align="right" width="120">RETURN1YEAR</th>
            <th align="right" width="120">RETURN30DAYS</th>
            <th align="left" width="90">LASTYEARDT</th>
            <th align="right" width="120">NAV</th>
            <th align="right" width="120">PRICE</th>
            <th align="right" width="120">TOTALUNIT</th>
            <th align="left" width="90">LASTMONTHDT</th>
            <th align="right" width="120">NAV</th>
            <th align="right" width="120">PRICE</th>
            <th align="right" width="120">TOTALUNIT</th>
            <th align="left" width="90">PREVDAYDT</th>
            <th align="right" width="120">NAV</th>
            <th align="right" width="120">PRICE</th>
            <th align="right" width="120">TOTALUNIT</th>            
            <th align="left" width="90">PREVENDYEARDT</th>
            <th align="right" width="120">NAV</th>
            <th align="right" width="120">PRICE</th>
            <th align="right" width="120">TOTALUNIT</th>
        </tr>
        <?php foreach($r_data as $xitem) {?>
        <tr bgcolor="#ffffff">
            <td align="left"><?php echo $xitem['DESC'];?></td>
            <td align="left"><?php echo date_format($xitem['VALDATE'],'m/d/Y');?></td>
            <td align="right"><?php echo number_format(0+$xitem['AMOUNT'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['NAV'],0+$xitem['NAVDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['PRICE'],0+$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['UNIT'],0+$xitem['UNITDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['RETURN1YEARACT'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['RETURN1YEAR'],4,'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['RETURN30DAYS'],4,'.',',');?></td>
            <td align="left"><?php echo date_format($xitem['DT_PY'],'m/d/Y');?></td>
            <td align="right"><?php echo number_format(0+$xitem['NAV_PY'],0+$xitem['NAVDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['PRICE_PY'],0+$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['UNIT_PY'],0+$xitem['UNITDECIMAL'],'.',',');?></td> 
            <td align="left"><?php echo date_format($xitem['DT_LM'],'m/d/Y');?></td>
            <td align="right"><?php echo number_format(0+$xitem['NAV_LM'],0+$xitem['NAVDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['PRICE_LM'],0+$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['UNIT_LM'],0+$xitem['UNITDECIMAL'],'.',',');?></td> 
            <td align="left"><?php echo date_format($xitem['DT_PD'],'m/d/Y');?></td>
            <td align="right"><?php echo number_format(0+$xitem['NAV_PD'],0+$xitem['NAVDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['PRICE_PD'],0+$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['UNIT_PD'],0+$xitem['UNITDECIMAL'],'.',',');?></td> 
            <td align="left"><?php echo date_format($xitem['DT_LEY'],'m/d/Y');?></td>
            <td align="right"><?php echo number_format(0+$xitem['NAV_LEY'],0+$xitem['NAVDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['PRICE_LEY'],0+$xitem['PRICEDECIMAL'],'.',',');?></td>
            <td align="right"><?php echo number_format(0+$xitem['UNIT_LEY'],0+$xitem['UNITDECIMAL'],'.',',');?></td> 
        </tr> 
        <?php } ?>
    </table>
     