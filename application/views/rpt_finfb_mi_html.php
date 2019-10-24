<html>
<head>
<title>Financial Book</title>
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
<div style="width: 965px;">
<?php $pfrow=0;foreach($r_pfs as $r_pf) {?>
    <?php if($r_pf['APPROVESTATUS']=='A') {?>
    <?php if($pfrow++>0) {?>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <?php }?>
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>NET ASSET VALUE REPORT</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr >
            <td class="down_line"><b>Descriptions</b></td>
            <td width="150"  class="down_line">&nbsp;</td>
            <td width="150"  class="down_line" align="right"><b>Balance</b></td>
        </tr>
    <?php 
    $str_a=''; $g='';  $str_s='';
    $tot_g=0;
    foreach($sect_A[$r_pf['pfcode']] as $xitem) {
        if($g!=$xitem['NAVREPORTGRP'])    
        {
            if($g!='')
            {
                $str_a.="<tr><td></td><td >&nbsp;</td><td></td></tr>";
                $str_s.="<tr>
            <td colspan=\"2\"><b>{$g}</b></td>
            <td align=\"right\"><b>" . number_format($tot_g,2,'.',',') . "</b></td>
        </tr>" . $str_a;
            }
            $g=$xitem['NAVREPORTGRP'];
            $tot_g=0;
            $str_a='';
        }
        $str_a.="<tr>
            <td> &nbsp; &nbsp; &nbsp; &nbsp;{$xitem['ASSETDESCRIPTION']}</td>
            <td  align=\"right\">" . number_format($xitem['ASSETVALUE'],2,'.',',') ."</td>
            <td  align=\"right\"></td>
        </tr>\n";
        $tot_g+=$xitem['ASSETVALUE'];
    } 
    if($g!='')
    {
        $str_a.="<tr><td></td><td >&nbsp;</td><td></td></tr>";
        $str_s.="<tr>
            <td colspan=\"2\"><b>{$g}</b></td>
            <td align=\"right\"><b>" . number_format($tot_g,2,'.',',') . "</b></td>
        </tr>" . $str_a;
    }
        echo $str_s;
    ?>
    </table>
     <?php
     if(count($sect_A[$r_pf['pfcode']])>0)
     {
        $koma_unit=4;
        $koma_price=4;
        $koma_nav=3;
        if(isset($r_pf[0]))
        {
            $koma_price=0+$r_pf['pdec'];
            $koma_unit=0+$r_pf['udec'];
            $koma_nav=0+$r_pf['ndec'];
        }
    ?>
    <table width="100%"  style="border: 1px solid #000000;"> 
        <tr>
            <td><b>Net Asset Value</b></td>
            <td align="right" width="200"><b><?php echo count($sect_B[$r_pf['pfcode']])>0?number_format($sect_B[$r_pf['pfcode']][0]['VAL'],$koma_nav,'.',','):""; ?></b></td>
        </tr>
        <tr>
            <td><b>Total Unit Issued</b></td>
            <td align="right" width="200"><b><?php echo count($sect_B[$r_pf['pfcode']])>2?number_format($sect_H[$r_pf['pfcode']][0]['U'],$koma_unit,'.',','):""; ?></b></td>
        </tr>
        <tr>
            <td><b>NAV / Unit</b></td>
            <td align="right" width="200"><b><?php echo count($sect_B[$r_pf['pfcode']])>1?number_format($sect_B[$r_pf['pfcode']][0]['VAL']/$sect_H[$r_pf['pfcode']][0]['U'],$koma_price,'.',','):""; ?></b></td>
        </tr>
    </table>   
    <?php }?> 
    <br />
    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#ffffff" valign="top">
            <td width="30%">
                <table width="100%">
                    <tr bgcolor="#E0E0E0">
                        <th>Assets Allocation</th>
                        <th>Min</th>
                        <th>Real</th>
                        <th>Max</th>
                    </tr>
                    <?php foreach($sect_C[$r_pf['pfcode']] as $xitem) { if($xitem['ASSETTYPE']!='SUBSCRIPTION FEE' && $xitem['ASSETTYPE']!='REDEMPTION FEE')  {?>
                    <tr>
                        <td align="left" class="down_line"><?php echo $xitem['ASSETTYPE'];?></td>
                        <td align="center" class="down_line"><?php echo '-';//number_format($xitem['MINPCT'],2,'.',',');?></td>
                        <td align="right" class="down_line"><?php echo number_format($xitem['ACTPCT'],2,'.',',');?></td>
                        <td align="center" class="down_line"><?php echo '-';//number_format($xitem['MAXPCT'],2,'.',',');?></td>
                    </tr>
                    <?php }}?>
                </table>
            </td>
            <td>
                <table width="100%">
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Change / Day</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[$r_pf['pfcode']][0]['CHANGEPERDAYVALUE'],4,'.',','); ?></td>
                    </tr>
                    <!--
                    <tr>
                        <td align="center">&nbsp;0.00</td>
                    </tr>
                    -->
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Change / Day %</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[$r_pf['pfcode']][0]['CHANGEPERDAYPCT'],4,'.',','); ?></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Kurs</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">1.00</td>
                    </tr>
                    <tr >
                        <td>
                            <table width="100%">
                            <tr >
                                <td width="50%" valign="top"><div style="background-color: #E0E0E0;" align="center"><u><b>Processed/Checked</b></u></div></td>
                                <td valign="top" style="border-left: 1px solid   #969696;"><div style="background-color: #E0E0E0;" align="center"><u><b>Approved</b></u></div><br /><br /><br /><br /><br /></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
                
            </td>
            <td width="30%">
                <table width="100%">
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Last NAV per Unit(<?php echo date_format($sect_D[$r_pf['pfcode']][0]['PREVMONTHDATE'],'M d, Y'); ?>)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[$r_pf['pfcode']][0]['PREVMONTHPRICE'],$koma_price,'.',','); ?></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Return(30 days)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[$r_pf['pfcode']][0]['RETURN30DAYS'],4,'.',','); ?>%</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Last NAV per Unit (<?php echo is_object($sect_D[$r_pf['pfcode']][0]['PREVYEARDATE'])?date_format($sect_D[$r_pf['pfcode']][0]['PREVYEARDATE'],'M d, Y'):''; ?>)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[$r_pf['pfcode']][0]['PREVYEARPRICE'],$koma_price,'.',','); ?></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Return 1 Year</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[$r_pf['pfcode']][0]['RETURN1YEAR'],4,'.',','); ?>%</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <th align="center">Return 1 Year Actual (%)</th>
                    </tr>
                    <tr>
                        <td align="center" class="down_line">&nbsp;<?php echo number_format($sect_D[$r_pf['pfcode']][0]['RETURN1YEARACT'],4,'.',','); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php $gtfv=0;$gtcv=0;$gtmv=0;$gtai=0;$gtpl=0;  $gtprocen=0; $gtprocen=0; if(count($r_pvrfi[$r_pf['pfcode']])>0){ ?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>PORTFOLIO VALUATION REPORT</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table cellspacing="1"  width="100%" >
        <tr >
            <td style="border-bottom: 1px dotted #969696;" width="135"><b>SECURITY NAME</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>COUPON RATE</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="40" align="center"><b>MATURITY DATE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>FACE VALUE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>UNIT COST</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>MARKET PRICE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>COST VALUE</b></td>            
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>MARKET VALUE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>ACCRUED INTEREST</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>UNREALIZED P/L</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>% of Group</b></td>
        </tr>
        <?php $substr=""; $pvr_row=0;
                $fv=0;$cv=0;$mv=0;$ai=0;$pl=0;  
                $tfv=0;$tcv=0;$tmv=0;$tai=0;$tpl=0;  
                foreach($r_pvrfi[$r_pf['pfcode']] as $xitem) {  $pvr_row++;
                    if($substr!=$xitem['jns'])
                    {
                        if($substr!='')
                        {
        ?>
        <tr>
            <td width="135"> </td>
            <td align="right" width="30"> </td>
            <td width="40" > </td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($fv,2,'.',',') ;?></td>
            <td align="right" width="30"> </td>
            <td align="right" width="30"> </td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($cv,2,'.',',') ;?></td>            
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($mv,2,'.',',') ;?></td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($ai,2,'.',',') ;?></td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($pl,2,'.',',') ;?></td>
            <td align="right" width="30"> </td>
        </tr>
                    <?php }?>
        <tr><td colspan="11"> </td></tr><tr><td colspan="11"><b><u><?php echo $xitem['jns'];?></u></b></td></tr>
        <?php
                        $substr=$xitem['jns'];
                        $fv=0;$cv=0;$mv=0;$ai=0;$pl=0;
                    }
        ?>
        <tr>
            <td width="135"><?php echo $xitem['SecurityName'];?></td>
            <td align="right" width="30"><?php echo  number_format($xitem['COUPONRATE'],4,'.',',') ;?></td>
            <td width="40" align="center"><?php echo  (is_object($xitem['MATURITY'])?date_format($xitem['MATURITY'],'d/m/Y'):'');?></td>
            <td align="right" width="65"><?php echo  number_format($xitem['Holding'],2,'.',',') ;?></td>
            <td align="right" width="30"><?php echo  number_format($xitem['TotalCost']/$xitem['Holding']*100,2,'.',',') ;?></td>
            <td align="right" width="30"><?php echo  number_format($xitem['TotalValue']/$xitem['Holding']*100,6,'.',',') ;?></td>
            <td align="right" width="65"><?php echo  number_format($xitem['TotalCost'],2,'.',',') ;?></td>            
            <td align="right" width="65"><?php echo  number_format($xitem['TotalValue'],2,'.',',') ;?></td>
            <td align="right" width="65"><?php echo  number_format($xitem['AccruedInterest'],2,'.',',') ;?></td>
            <td align="right" width="65"><?php echo  number_format($xitem['UnrealizedValue'],2,'.',',') ;?></td>
            <td align="right" width="30"><?php echo  number_format($xitem['procentage']*100,2,'.',',') ;?></td>
        </tr>
        <?php 
        $fv+=$xitem['Holding'];
        $cv+=$xitem['TotalCost'];
        $mv+=$xitem['TotalValue'];
        $ai+=$xitem['AccruedInterest'];
        $pl+=$xitem['UnrealizedValue'];
        
        $tfv+=$xitem['Holding'];
        $tcv+=$xitem['TotalCost'];
        $tmv+=$xitem['TotalValue'];
        $tai+=$xitem['AccruedInterest'];
        $tpl+=$xitem['UnrealizedValue'];
        $gtprocen+=$xitem['procentage'];
        }?>
        <?php if($pvr_row>0){ ?>
        <tr>
            <td width="135"> </td>
            <td align="right" width="30"> </td>
            <td width="40" > </td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($fv,2,'.',',') ;?></td>
            <td align="right" width="30"> </td>
            <td align="right" width="30"> </td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($cv,2,'.',',') ;?></td>            
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($mv,2,'.',',') ;?></td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($ai,2,'.',',') ;?></td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><?php echo  number_format($pl,2,'.',',') ;?></td>
            <td align="right" width="30"> </td>
        </tr>
        <?php }?>
        <tr>
            <td colspan="11"> </td></tr><tr>
            <td width="135"> </td>
            <td align="right" width="30"> </td>
            <td width="40" > </td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($tfv,2,'.',',') ;?></b></td>
            <td align="right" width="30"> </td>
            <td align="right" width="30"> </td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($tcv,2,'.',',') ;?></b></td>            
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($tmv,2,'.',',') ;?></b></td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($tai,2,'.',',') ;?></b></td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($tpl,2,'.',',') ;?></b></td>
            <td align="right" width="30"> </td>
        </tr>
    </table>
    <?php $gtcv+=$tcv;
    $gtmv+=$tmv;}?>
    <?php if(count($r_pvros[$r_pf['pfcode']])>0){ ?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>PORTFOLIO VALUATION REPORT</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
     <table cellspacing="1"  width="100%">
        <tr >
            <td style="border-bottom: 1px dotted #969696;" width="135"><b>SECURITY NAME</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="35"><b>SECURITY CODE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>UNIT HOLDING</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="50"><b>UNIT COST</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="50"><b>MARKET PRICE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>COST VALUE</b></td>            
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>MARKET VALUE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>UNREALIZED P/L</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>% of Group</b></td>
        </tr>
        <?php $substr="";
            $cv=0;$mv=0;$pl=0;  
            $tcv=0;$tmv=0;$tpl=0;  $tfv=0;       $osdec=0;
            foreach($r_pvros[$r_pf['pfcode']] as $xitem) {        $osdec=trim($xitem['GLGroup'])=='100'?4:0;
            if($substr!=$xitem['jns'])
            {
                if($substr!='')
                {
        ?>
        <tr>
            <td width="135"> </td>
            <td width="35" > </td>
            <td width="65" > </td>
            <td width="50" > </td>
            <td width="50" > </td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($cv,2,'.',',') ;?></td>            
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($mv,2,'.',',') ;?></td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($pl,2,'.',',') ;?></td>
            <td align="right" width="30"> </td>
        </tr>
        <?php }?>
        <tr><td colspan="9"> </td></tr><tr><td colspan="9"><b><u><?php echo $xitem['jns'];?></u></b></td></tr>
        <?php $substr=$xitem['jns'];$cv=0;$mv=0;$pl=0;
            } ?>
        <tr>
            <td><?php echo $xitem['SecurityName'];?></td>
            <td><?php echo $xitem['EXTERNALCODE'];?></td>
            <td align="right"><?php echo  number_format($xitem['Holding'],$osdec,'.',',') ;?></td>
            <td align="right"><?php echo  number_format($xitem['TotalCost']/$xitem['Holding'],2,'.',',') ;?></td>
            <td align="right"><?php echo  number_format($xitem['TotalValue']/$xitem['Holding'],0,'.',',') ;?></td>
            <td align="right"><?php echo  number_format($xitem['TotalCost'],2,'.',',') ;?></td>            
            <td align="right"><?php echo  number_format($xitem['TotalValue'],0,'.',',') ;?></td>
            <td align="right"><?php echo  number_format($xitem['UnrealizedValue'],2,'.',',') ;?></td>
            <td align="right"><?php echo  number_format($xitem['procentage']*100,2,'.',',') ;?></td>
        </tr>
        <?php $cv+=$xitem['TotalCost'];
        $mv+=$xitem['TotalValue'];
        $pl+=$xitem['UnrealizedValue'];
        
        $tfv+=$xitem['Holding'];
        $tcv+=$xitem['TotalCost'];
        $tmv+=$xitem['TotalValue'];
        $tpl+=$xitem['UnrealizedValue'];
        $gtprocen+=$xitem['procentage'];
            }
            if($substr!='')
            {  ?>  
        <tr>
            <td width="135"> </td>
            <td width="35" > </td>
            <td width="65" > </td>
            <td width="50" > </td>
            <td width="50" > </td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($cv,2,'.',',') ;?></td>            
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($mv,2,'.',',') ;?></td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($pl,2,'.',',') ;?></td>
            <td align="right" width="30"> </td>
        </tr>
            <?php }?>
        <tr><td colspan="9"> </td></tr><tr>
            <td width="135"> </td>
            <td width="35" > </td>
            <td width="65" > </td>
            <td width="50" > </td>
            <td width="50" > </td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tcv,2,'.',',') ;?></b></td>            
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tmv,2,'.',',') ;?></b></td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tpl,2,'.',',') ;?></b></td>
            <td align="right" width="70"> </td>
        </tr>
    </table>
    <?php $gtcv+=$tcv;
    $gtmv+=$tmv;}?>
    <?php if(count($r_pvrri[$r_pf['pfcode']])>0){ ?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>PORTFOLIO VALUATION REPORT</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table cellspacing="1"  width="100%">
        <tr >
            <td style="border-bottom: 1px dotted #969696;" width="135"><b>SECURITY NAME</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="35"><b>SECURITY CODE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>UNIT HOLDING</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="50"><b>UNIT COST</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="50"><b>MARKET PRICE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>TOTAL VALUE AT COST</b></td>            
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>TOTAL VALUE AT MARKET</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>UNREALIZED P/L</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>% of Group</b></td>
        </tr>
        <?php $substr="";
        $cv=0;$mv=0;$pl=0;  
        $tcv=0;$tmv=0;$tpl=0;  $tfv=0;  
        foreach($r_pvrri[$r_pf['pfcode']] as $xitem) { 
            if($substr!=$xitem['jns'])
            {
                if($substr!='')
                { ?>
                <tr>
                    <td width="135"> </td>
                    <td width="35" > </td>
                    <td width="65" > </td>
                    <td width="50" > </td>
                    <td width="50" > </td>
                    <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($cv,2,'.',',') ;?></td>            
                    <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($mv,2,'.',',') ;?></td>
                    <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($pl,2,'.',',') ;?></td>
                    <td align="right" width="30"> </td>
                </tr>
                <?php }?>
                <tr><td colspan="9"> </td></tr><tr><td colspan="9"><b><u><?php echo $xitem['jns'];?></u></b></td></tr>
            <?php $substr=$xitem['jns'];
            $cv=0;$mv=0;$pl=0;}?>
        <tr>
            <td width="135"><?php echo $xitem['SecurityName'];?></td>
            <td width="35"><?php echo $xitem['EXTERNALCODE'];?></td>
            <td align="right" width="65"><?php echo number_format($xitem['Holding'],0,'.',',') ;?></td>
            <td align="right" width="50"><?php echo number_format($xitem['TotalCost']/$xitem['Holding'],2,'.',',') ;?></td>
            <td align="right" width="50"><?php echo number_format($xitem['TotalValue']/$xitem['Holding'],4,'.',',') ;?></td>
            <td align="right" width="75"><?php echo number_format($xitem['TotalCost'],2,'.',',') ;?></td>            
            <td align="right" width="75"><?php echo number_format($xitem['TotalValue'],0,'.',',') ;?></td>
            <td align="right" width="75"><?php echo number_format($xitem['UnrealizedValue'],2,'.',',') ;?></td>
            <td align="right" width="30"><?php echo number_format($xitem['procentage']*100,2,'.',',') ;?></td>
        </tr>
            <?php $cv+=$xitem['TotalCost'];
            $mv+=$xitem['TotalValue'];
            $pl+=$xitem['UnrealizedValue'];
            
            $tfv+=$xitem['Holding'];
            $tcv+=$xitem['TotalCost'];
            $tmv+=$xitem['TotalValue'];
            $tpl+=$xitem['UnrealizedValue'];
            $gtprocen+=$xitem['procentage'];}
            if($substr!=''){?>
        <tr>
            <td width="135"> </td>
            <td width="35" > </td>
            <td width="65" > </td>
            <td width="50" > </td>
            <td width="50" > </td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($cv,2,'.',',') ;?></td>            
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($mv,2,'.',',') ;?></td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><?php echo number_format($pl,2,'.',',') ;?></td>
            <td align="right" width="30"> </td>
        </tr>
            <?php }?>
        <tr><td colspan="9"> </td></tr><tr>
            <td width="135"> </td>
            <td width="35" > </td>
            <td width="65" > </td>
            <td width="50" > </td>
            <td width="50" > </td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tcv,2,'.',',') ;?></b></td>            
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tmv,2,'.',',') ;?></b></td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tpl,2,'.',',') ;?></b></td>
            <td align="right" width="70"> </td>
        </tr>
    </table>
    <?php $gtcv+=$tcv;
    $gtmv+=$tmv;}?>
    <?php if(count($r_pvrzl[$r_pf['pfcode']])>0){ ?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>PORTFOLIO VALUATION REPORT</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table cellspacing="1"  width="100%">
        <tr >
            <td style="border-bottom: 1px dotted #969696;" width="135"><b>SECURITY NAME</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="35"> </td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="65"><b>LOCAL VALUE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>COST VALUE</b></td>            
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>MARKET VALUE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>ACCRUED INTEREST</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>% of Group</b></td>
        </tr>
        <?php $substr="";    
        $tfv=0;$tcv=0;$tmv=0;$tpl=0;  $tai=0;
        foreach($r_pvrzl[$r_pf['pfcode']] as $xitem) {?>
        <tr>
            <td width="135"><?php echo $xitem['SecurityName'];?></td>
            <td width="35"><?php echo $xitem['SecurityCode'];?></td>
            <td align="right" width="65"><?php echo number_format($xitem['Holding'],2,'.',',') ;?></td>
            <td align="right" width="75"><?php echo number_format($xitem['TotalCost'],2,'.',',') ;?></td>            
            <td align="right" width="75"><?php echo number_format($xitem['TotalValue'],2,'.',',') ;?></td>
            <td align="right" width="75"><?php echo number_format($xitem['AccruedInterest'],2,'.',',') ;?></td>
            <td align="right" width="30"><?php echo number_format($xitem['procentage']*100,2,'.',',') ;?></td>
        </tr>
        <?php $tfv+=$xitem['Holding'];
        $tcv+=$xitem['TotalCost'];
        $tmv+=$xitem['TotalValue'];
        $tpl+=$xitem['UnrealizedValue'];
        $tai+=$xitem['AccruedInterest'];
        $gtprocen+=$xitem['procentage'];}?>
        <tr>
            <td width="135"></td>
            <td width="35"></td>
            <td align="right" width="65" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tfv,2,'.',',') ;?></b></td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tcv,2,'.',',') ;?></b></td>            
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tmv,2,'.',',') ;?></b></td>
            <td align="right" width="75" style="border-top: 1px dotted #969696;"><b><?php echo number_format($tai,2,'.',',') ;?></b></td>
            <td align="right" width="30"></td>
        </tr>
    </table>
    <?php $gtcv+=$tcv;
    $gtmv+=$tmv;}?>
    <?php if(count($r_pvrfi[$r_pf['pfcode']])>0 || count($r_pvros[$r_pf['pfcode']])>0 || count($r_pvrri[$r_pf['pfcode']])>0 || count($r_pvrzl[$r_pf['pfcode']])>0){ ?>
    <br /><br />
    <table cellspacing="1"  width="100%">
        <tr>
            <td width="135">&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right" width="65" style="border-bottom: 1px dotted #969696;"><b><span style="font-size:1.1em;">Grand Total</span> </b></td>
            <td align="right" width="160" style="border-bottom: 1px dotted #969696;"><b><span style="font-size:1.1em;"><?php echo number_format($gtcv,2,'.',',') ;?></span></b></td>            
            <td align="right" width="155" style="border-bottom: 1px dotted #969696;"><b><span style="font-size:1.1em;"><?php echo number_format($gtmv,2,'.',',') ;?></span></b></td>
            <td width="135">&nbsp;</td>
            <td align="right" width="30"><b><span style="font-size:1.1em;"><?php echo number_format($gtprocen*100,2,'.',',') ;?></span></b></td>
        </tr>
    </table>
    <?php }?>
<!-- for BAS -->
    <?php if(count($r_bas[$r_pf['pfcode']])>0) {
    $bas_debit=0; $bas_kredit=0;$bas_bal =0; $bank_name='!@(#*&^*@!&#*)';
    foreach($r_bas[$r_pf['pfcode']] as $xitem) { 
        if($bank_name!=$xitem['bank_name'])
        {
            if($bank_name!='!@(#*&^*@!&#*)')
            {?>
        <tr>
            <td align="right" width="392" colspan="4" valign="top"><b>Total <?php echo $bank_name;?>  &nbsp; &nbsp;</b></td>
            <td align="right" width="80" style="border-top: 1px dotted #969696;" valign="top"><b><?php echo number_format($bas_debit,2,'.',',') ;?></b></td>
            <td align="right" width="80" style="border-top: 1px dotted #969696;" valign="top"><b><?php echo number_format($bas_kredit,2,'.',',') ;?></b></td>
            <td align="right" width="80" style="border-top: 1px dotted #969696;" valign="top"><b><?php echo number_format($bas_bal,2,'.',',') ;?></b></td>
        </tr>
    </table>
        <?php }?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>BANK ACCOUNT STATEMENT</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    BANK CIMB NIAGA - CUSTODY SERVICES<br />
    BANK ACCOUNT STATEMENT<br />
    <table width="100%" >
        <tr >
            <td width="80">Client Name</td>
            <td width="8">:</td>
            <td width="545"  align="left"><?php echo $r_pf["pfname"];?></td>
        </tr>
        <tr>
            <td>Bank</td>
            <td width="8">:</td>
            <td  align="left"><?php echo $xitem['bank_name'];?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td width="8">:</td>
            <td  align="left"><?php echo date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><br /><br />
    <table width="100%"> 
        <tr>
            <td width="50" style="border-bottom: 1px dotted #969696;"><b>DATE</b></td>
            <td width="75" style="border-bottom: 1px dotted #969696;"><b>TRANS TYPE</b></td>
            <td width="40" style="border-bottom: 1px dotted #969696;"><b>ID</b></td>
            <td width="227" style="border-bottom: 1px dotted #969696;"><b>DETAIL</b></td>
            <td width="80" align="right" style="border-bottom: 1px dotted #969696;"><b>DEBIT</b></td>
            <td width="80" align="right" style="border-bottom: 1px dotted #969696;"><b>KREDIT</b></td>
            <td width="80" align="right" style="border-bottom: 1px dotted #969696;"><b>BALANCE</b></td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td></tr><tr>
            <td align="left" colspan="2" width="125" ><b>OPEN BALANCE</b></td>
            <td align="left" width="40"></td>
            <td align="left" width="227"></td>
            <td align="right" width="80"></td>
            <td align="right" width="80"></td>
            <td align="right" width="80"><b><?php echo number_format(($xitem['balance']-$xitem['kredit']+$xitem['debit']),2,'.',',') ;?></b></td>
        </tr>
        <?php $bank_name=$xitem['bank_name'];
            $bas_debit=0; $bas_kredit=0;$bas_bal =0;
        }?>
        <tr>
            <td align="left"  width="50" valign="top"><?php echo (is_object($xitem['data_date'])?date_format($xitem['data_date'],'d/m/Y'):'') ;?></td>
            <td align="left" width="75"  valign="top"><?php echo $xitem['transtype'];?></td>
            <td align="left" width="40"  valign="top"> <?php echo$xitem['id'];?></td>
            <td align="left" width="227"  valign="top"><?php echo "{$xitem['detail']}" . (trim($xitem['detail1'])==''?'':"<br />{$xitem['detail1']}") ;?></td>
            <td align="right" width="80"  valign="top"><?php echo ($xitem['debit']==0?'':number_format($xitem['debit'],2,'.',',')) ;?></td>
            <td align="right" width="80"  valign="top"><?php echo ($xitem['kredit']==0?'':number_format($xitem['kredit'],2,'.',',')) ;?></td>
            <td align="right" width="80"  valign="top"><?php echo ($xitem['balance']==0?'':number_format($xitem['balance'],2,'.',',')) ;?></td>
        </tr>
        <?php $bas_debit+=$xitem['debit'];
        $bas_kredit+=$xitem['kredit'];
        $bas_bal=$xitem['balance'];
            
        }
        if($bank_name!='!@(#*&^*@!&#*)')
        {?>
        <tr>
            <td align="right" width="392" colspan="4"><b>Total <?php echo $xitem['bank_name'];?>  &nbsp; &nbsp;</b></td>
            <td align="right" width="80" style="border-top: 1px dotted #969696;"><b><?php echo number_format($bas_debit,2,'.',',') ;?></b></td>
            <td align="right" width="80" style="border-top: 1px dotted #969696;"><b><?php echo number_format($bas_kredit,2,'.',',') ;?></b></td>
            <td align="right" width="80" style="border-top: 1px dotted #969696;"><b><?php echo number_format($bas_bal,2,'.',',') ;?></b></td>
        </tr>
    </table>
        <?php }?>
    <?php }?>
<!--for TRX-->
    <?php if(count($r_trx)>0) { ?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>TRANSACTION LISTING</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table cellspacing="1"  width="100%" >
        <tr >
            <td style="border-bottom: 1px dotted #969696;" width="35" ><b>TRX DATE</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="32"><b>CODE</b></td>
            <td style="border-bottom: 1px dotted #969696;"><b>SECURITY NAME</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="30"><b>ID</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="35"><b>MATURITY</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="30"><b>COUPON</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="56"><b>UNITS</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="56"><b>TOTAL COST</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="56"><b>INTEREST</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="56"><b>PROCEEDS</b></td>
            <td style="border-bottom: 1px dotted #969696;"  align="right" width="56"><b>PROFIT/LOSS</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="95"><b>NOTES</b></td>
        </tr>
    <?php $t_unit=0;$t_cost=0;$t_int=0;$t_proc=0;$t_pl=0;$trx_type="";
    foreach($r_trx[$r_pf['pfcode']] as $xitem) { 
        if($trx_type!=$xitem['trx_type'])
        {
            if($trx_type!="")
            { ?>
        <tr>
            <td align="right"  colspan="6"><b>Total <?php echo $trx_type;?>:&nbsp; </b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($t_unit,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($t_cost,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($t_int,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($t_proc,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo  number_format($t_pl,2,'.',',') ;?></b></td>
            <td align="left" ></td>
        </tr><tr><td colspan="12"></td></tr>
        <?php }$trx_type=$xitem['trx_type'];?>
        <tr>
            <td style="border-bottom: 1px dotted #969696;" colspan="3"><b><?php echo $trx_type;?></b></td><td colspan="9">&nbsp; </td>
        </tr>
    <?php $t_unit=0;$t_cost=0;$t_int=0;$t_proc=0;$t_pl=0;
        }?>
        <tr>
            <td align="left" width="35"><?php echo   (is_object($xitem['trx_date'])?date_format($xitem['trx_date'],'d/m/Y'):'') ;?></td>
            <td align="left" width="32"><?php echo  $xitem['sec_code'];?></td>
            <td align="left" width="85"><?php echo  $xitem['sec_name'];?></td>
            <td align="left" width="30"><?php echo  $xitem['id'];?></td>
            <td align="left" width="35"><?php echo   (is_object($xitem['due_date'])?(date_format($xitem['due_date'],'d/m/Y')=='01/01/1900'?'':date_format($xitem['due_date'],'d/m/Y')):'') ;?></td>
            <td align="right" width="30"><?php echo   number_format($xitem['rate'],2,'.',',') ;?></td>
            <td align="right" width="56"><?php echo   number_format($xitem['unit'],2,'.',',') ;?></td>
            <td align="right" width="56"><?php echo   number_format($xitem['cost'],2,'.',',') ;?></td>
            <td align="right" width="56"><?php echo   number_format($xitem['int_inc'],2,'.',',') ;?></td>
            <td align="right" width="56"><?php echo   number_format($xitem['proceed'],2,'.',',') ;?></td>
            <td align="right" width="56"><?php echo   number_format($xitem['pl'],2,'.',',') ;?></td>
            <td align="left" width="95"><?php echo  $xitem['notes'];?></td>
        </tr>
    <?php $t_unit+=$xitem['unit'];
        $t_cost+=$xitem['cost'];
        $t_int+=$xitem['int_inc'];
        $t_proc+=$xitem['proceed'];
        $t_pl+=$xitem['pl'];
    }?>
    <?php if($trx_type!=""){?>
        <tr>
            <td align="right"  colspan="6"><b>Total <?php echo $trx_type;?>:&nbsp; </b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_unit,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_cost,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_int,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_proc,2,'.',',') ;?></b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_pl,2,'.',',') ;?></b></td>
            <td align="left" ></td>
        </tr><tr><td colspan="12"></td></tr>";
     <?php    }?>
    </table>
    <?php }?>
<!--for OS-->
    <?php if(count($r_ost[$r_pf['pfcode']])>0) {?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>OUTSTANDING SETTLEMENT</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%" cellspacing="1">
        <tr >
            <td style="border-bottom: 1px dotted #969696;"  width="50"><b>TRAD DATE</b></td>
            <td style="border-bottom: 1px dotted #969696;"  width="40"><b>SET DATE</b></td>
            <td  style="border-bottom: 1px dotted #969696;" width="35"><b>ID</b></td>
            <td  style="border-bottom: 1px dotted #969696;" width="40"><b>CODE</b></td>
            <td  style="border-bottom: 1px dotted #969696;" width="180"><b>SECURITY NAME</b></td>
            <td  style="border-bottom: 1px dotted #969696;" width="70"><b>TRANS TYPE</b></td>
            <td  style="border-bottom: 1px dotted #969696;" align="right" width="75"><b>UNITS</b></td>
            <td  style="border-bottom: 1px dotted #969696;" align="left" width="45"><b>&nbsp; CURRENCY</b></td>
            <td  style="border-bottom: 1px dotted #969696;" align="right" width="90"><b>AMOUNT OUTSTANDING</b></td>
        </tr>
    <?php $t_os=0;$broker="";$tot_os=0;$tot_fi=0;     $gtot=0;
    foreach($r_ost[$r_pf['pfcode']] as $xitem) { 
        if($broker!=$xitem['broker_name'])
        {
            if($broker!="")
            {?>
        <tr>
            <td align="right"  colspan="8"><b>Total for <?php echo $broker;?>: &nbsp; </b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_os,2,'.',',') ;?></b></td>
        </tr>
        <?php }$broker=$xitem['broker_name']; ?>
        <tr>
            <td style="border-bottom: 1px dotted #969696;" colspan="2"><b><?php echo $broker;?></b></td>
            <td colspan="6"></td>
        </tr>
        <?php $t_os=0;}?>
        <tr>
            <td align="left" width="50"><?php echo (is_object($xitem['contract_date'])?date_format($xitem['contract_date'],'d/m/Y'):'') ;?></td>
            <td align="left" width="40"><?php echo (is_object($xitem['settle_date'])?date_format($xitem['settle_date'],'d/m/Y'):'') ;?></td>
            <td align="left" width="34"><?php echo $xitem['id'];?></td>
            <td align="left" width="40"><?php echo $xitem['sec_code'];?></td>
            <td align="left" width="180"><?php echo $xitem['sec_name'];?></td>
            <td align="left" width="70"><?php echo $xitem['trx_name'];?></td>
            <td align="right" width="75"><?php echo number_format($xitem['unit'],2,'.',',') ;?></td>
            <td align="left" width="45">&nbsp;&nbsp; <?php echo $xitem['cur'];?></td>
            <td align="right" width="90"><?php echo  number_format($xitem['amount'],2,'.',',') ;?></td>
        </tr>
    <?php $t_os+=$xitem['amount'];  $tot_os+=($xitem['trx_type']=='OS-SAL'||$xitem['trx_type']=='OS-PUR'||$xitem['trx_type']=='DIV')?$xitem['amount']:0;
        $tot_fi+=($xitem['trx_type']=='FI-SAL'||$xitem['trx_type']=='FI-PUR'||$xitem['trx_type']=='INT')?$xitem['amount']:0;
        $gtot+=$xitem['amount'];
    }if($broker!="")
    {?>
        <tr>
            <td align="right"  colspan="8"><b>Total for <?php echo $broker;?>: &nbsp; </b></td>
            <td align="right" style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_os,2,'.',',') ;?></b></td>
        </tr>
    <?php }?>
        <tr><td colspan="9">&nbsp;</td></tr>
        <tr><td colspan="9">&nbsp;</td></tr>
        <tr>
            <td align="right"  colspan="8"><b>Total Amount Outstanding: &nbsp; </b></td>
            <td align="right" style="border-bottom: 1px dotted #969696;"><b><?php echo number_format($gtot,2,'.',',') ;?></b></td>
        </tr>
    </table>
    <?php }?>
<!--for BAL-->
    <?php if(count($r_bal[$r_pf['pfcode']])>0) {?>
    <div style="page-break-before:always;"></div>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><b><?php echo $r_pf["fmname"];?></b></td>
        </tr>
        <tr>            
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="60" align="left"><?php echo $r_pf["pfcode"];?></td>
                        <td align="center"><b>ACCOUNT BALANCE</b></td>
                        <td width="60" align="right"><?php echo $r_pf["time"];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>                                                                 
            <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr >
            <td style="border-bottom: 1px dotted #969696;" width="65"><b>CODE</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="233"><b>ACCOUNT NAME</b></td>
            <td style="border-bottom: 1px dotted #969696;" width="65"><b>TERM</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="70"><b>RATE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="100"><b>BALANCE</b></td>
            <td style="border-bottom: 1px dotted #969696;" align="right" width="100"><b>BALANCE in <?php echo $r_pf["cur"];?></b></td>
        </tr>
        <?php $t_bal=0;$t_balidr=0;$bankcode="";   $bankname='';
    $gt_bal=0;$gt_balidr=0;
    foreach($r_bal[$r_pf['pfcode']]     as $xitem) { 
        if($bankcode!=$xitem['bank_code'])
        {
            if($bankcode!="")
            { ?>
        <tr>
            <td align="right"  colspan="4"><b>Total for <?php echo $bankname;?>: &nbsp; </b></td>
            <td align="right"style="border-top: 1px dotted #969696;"><b><?php echo  number_format($t_bal,2,'.',',') ;?></b></td>
            <td align="right"style="border-top: 1px dotted #969696;"><b><?php echo  number_format($t_balidr,2,'.',',') ;?></b></td></tr>
            <tr><td colspan="6">&nbsp;</td>
        </tr>
        <?php }
            $bankcode=$xitem['bank_code'];            
            $bankname=$xitem['bank_name'];            
            $t_bal=0;
            $t_balidr=0;
        }?>        
        <tr>
            <td align="left"  width="65"><?php echo $xitem['bank_code'];?></td>
            <td align="left"  width="233"><?php echo $xitem['bank_name'];?></td>
            <td align="left"  width="65"><?php echo  (is_object($xitem['due_date'])?date_format($xitem['due_date'],'d/m/Y'):'') ;?></td>
            <td align="right"  width="70"><?php echo  number_format($xitem['rate'],2,'.',',') ;?></td>
            <td align="right"  width="100"><?php echo  number_format($xitem['amount1'],2,'.',',') ;?></td>
            <td align="right"  width="100"><?php echo  number_format($xitem['amount2'],2,'.',',') ;?></td>
        </tr>
    <?php $t_bal+=$xitem['amount1'];
        $t_balidr+=$xitem['amount1'];
        $gt_bal+=$xitem['amount1'];
        $gt_balidr+=$xitem['amount1'];
    } if($bankcode!="")
    {?>
        <tr>
            <td align="right"  colspan="4"><b>Total for <?php echo $xitem['bank_name'];?>: &nbsp; </b></td>
            <td align="right"style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_bal,2,'.',',') ;?></b></td>
            <td align="right"style="border-top: 1px dotted #969696;"><b><?php echo number_format($t_balidr,2,'.',',') ;?></b></td>
        </tr>
    <?php }?>
        <tr><td colspan="6">&nbsp;</td></tr>
        <tr >
            <td width="65"></td>
            <td width="233"></td>
            <td width="65"></td>
            <td style="border-bottom: 1px dotted #969696;border-top: 1px dotted #969696;" align="right" width="70"><b>Grand Total : </b></td>
            <td style="border-bottom: 1px dotted #969696;border-top: 1px dotted #969696;" align="right" width="100"><b><?php echo number_format($gt_bal,2,'.',',');?></b></td>
            <td style="border-bottom: 1px dotted #969696;border-top: 1px dotted #969696;" align="right" width="100"><b><?php echo number_format($gt_balidr,2,'.',',') ;?></b></td>
        </tr>
    </table>
<?php } ?>
<div style="page-break-before:always;"></div>
<img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
<div style="text-align: justify;">  <br /> <br />
<b>Disclaimer :</b> <br /><br />
"Nilai pasar portfolio telah dihitung berdasarkan data yang diberikan oleh bursa efek atau apabila data dari bursa efek tidak tersedia, berdasarkan data yang
dihasilkan oleh sistem kami, sesuai transaksi Pelanggan. Setiap informasi atau data yang tersedia dalam laporan ini dimaksudkan khusus untuk kepentingan
internal dan tidak untuk kepentingan eksternal Pelanggan. Kami tidak bertanggung jawab terhadap penggunaan yang tidak benar atas informasi atau data
dalam laporan ini. Harap memeriksa informasi atau data dalam laporan ini karena kami tidak bertanggung jawab terhadap informasi atau data yang tidak
lengkap atau salah"</br />
<i>"Market value of the portfolio has been valuate from data provided by stock exchanges or if is not available, from data generate by our system in accordance
with the customer transaction. Any information or data provided herein is intended exclusively for your internal purposes and not for external purposes.
We are not responsible and liable for any inappropriate use of information or data herein. Please review this information or data for accuracy as we cannot
be responsible for omitted or misstated data".</i>
</div>
    <?php }?>
<?php }?>
</div>
</body>
</html>