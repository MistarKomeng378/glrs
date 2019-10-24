
<div align="center"><b>CAPITAL GAIN BY FIFO</b></div>
<HR />
<b><?php echo "Portfolio: {$par['pf']} &nbsp; &nbsp; Unit Sold: " . number_format(0+$par['u'],2,'.',','). "&nbsp; &nbsp; Proceed: " . number_format(0+$par['p'],2,'.',',');?></b>
<hr />
<table width="100%" bgcolor="#585858">
    <tr bgcolor="#800080" style="color:#ffffff;">
        <th>Sett Date</th>
        <th>Type</th>
        <th align="right">Unit Purchase</th>
        <th align="right">Cost Purchase</th>
        <th align="right">Unit Sold</th>
        <th align="right">Proceed</th>
        <th align="right">Cost on Purchase</th>
        <th align="right">Gain</th>
        <th align="right">Fifo Holding</th>
        <th>Price (%)</th>
    </tr>
<?php 
    $resss=0;
    $sec=''; 
    $irows=0; $irows_s=0;$irows_end=0;    
    $rdp=0;
    foreach($r_data as $xitem1){
?>
<?php if($sec!=$xitem1['SECURITYCODE']){ ?>
<?php if($sec!=''){?>
    <tr bgcolor="#F0F0F0">
        <td colspan="7"></td>
        <td align="right"><b><?php echo number_format($tot_pl,2,'.',',');?></b></td>
        <td align="right"><b><?php echo number_format($tot_hold,2,'.',',');?></b></td>
        <td></td>
    </tr>
<!---- Simulation Section -->
 <?php 
    if(0+$par['u']>0 && (($par['sec']=='ALL' && $rdp>0) || $par['sec']!='ALL')) {  $rdp=0;
        echo "<tr><td colspan=\"10\" style=\"padding:2px;\" bgcolor=\"#FF0000\">";
        $unit=0+$par['u'];
        $cost=0+$par['p'];
 ?>
    <table width="100%" bgcolor="#0000FF">
        <tr>
            <td colspan="10" align="center" bgcolor="#FFFFC0"><b>FIFO Selling Simulation for   <?php echo strtoupper($sec);?></b></td>
        </tr>
        <tr bgcolor="#C0FFFF">
            <th>Sett Date</th>
            <th>Type</th>
            <th align="right">Unit Purchase</th>
            <th align="right">Cost Purchase</th>
            <th align="right">Unit Sold</th>
            <th align="right">Proceed</th>
            <th align="right">Cost on Purchase</th>
            <th align="right">Gain</th>
            <th align="right">Fifo Holding</th> 
            <th>Price (%)</th> 
        </tr>
 <?php
        $u=$unit; 
        $c=$cost;
        $cu=$c/$u;
        $cp=0;
        $tu=0;$tc=0;$tp=0;
        for($i=$irows_s;$i<$irows && $unit!=0;$i++)
        {
            if($r_data[$i]['RES']>0 && trim($r_data[$i]['TXNTYPE'])=='P')
            {
                if($r_data[$i]['RES']>=$unit)
                {
                    $u=$unit;
                    $c=$unit*$cu;
                    $cp=$unit*$r_data[$i]['COST']/$r_data[$i]['FACEVALUE'];
                    $r_data[$i]['RES']-=$unit;
                    $unit=0;
                    
                }
                else
                {
                    $u=$r_data[$i]['RES'];
                    $c=$r_data[$i]['RES']*$cu;
                    $cp=$r_data[$i]['RES']*$r_data[$i]['COST']/$r_data[$i]['FACEVALUE'];
                    $unit=$unit-$r_data[$i]['RES'];
                    $r_data[$i]['RES']=0;
                }
                $tu+=$u;$tc+=$c;$tp+=$cp;
 ?>

        <tr bgcolor="#FFFFFF">
            <td align="center"><?php echo date_format($r_data[$i]['SETTLEDATE'],'m/d/Y');?></td>
            <td align="center"><?php echo $r_data[$i]['TXNTYPE'];?></td>
            <td align="right"><?php echo number_format($r_data[$i]['FACEVALUE'],2,'.',',');?></td>
            <td align="right"><?php echo number_format($r_data[$i]['COST'],2,'.',',');?></td>
            <td align="right"><?php echo number_format($u,2,'.',',');?></td>
            <td align="right"><?php echo number_format($c,2,'.',',');?></td>
            <td align="right"><?php echo number_format($cp,2,'.',',');?></td>
            <td align="right"><?php echo number_format($c-$cp,2,'.',',');?></td>
            <td align="right"><?php echo number_format($r_data[$i]['RES'],2,'.',',');?></td>
            <td align="center"><?php echo number_format($r_data[$i]['PRICE'],2,'.',',');?></td>
        </tr>
 
 <?php
            }
        }
        if($tu>0){
 ?>
        <tr bgcolor="#C0FFFF">
            <td colspan="4"></td>
            <td align="right"><b><?php echo number_format($tu,2,'.',',');?></b></td>
            <td align="right"><b><?php echo number_format($tc,2,'.',',');?></b></td>
            <td align="right"><b><?php echo number_format($tp,2,'.',',');?></b></td>
            <td align="right"><b><?php echo number_format($tc-$tp,2,'.',',');?></b></td>
            <td colspan="2" align="center"><b>Last Holding: <?php echo number_format($tot_hold-$tu,2,'.',',');?></b></td>
        </tr>
 <?php
        }
 ?>

    </table>
 <?php
        echo "</td></tr><tr bgcolor=\"#ffffff\"><td colspan=\"10\">&nbsp;</td></tr>";
    }
?>
 <!-- End Simulation Section-->  
<?php $rdp=0;} ?>
    <tr bgcolor="#C0C0FF">
        <td colspan="10" align="center"><b><?php echo $xitem1['SECURITYCODE'];?></b></td>
    </tr>
<?php $tot_pl=0;$tot_hold=0;$irows_s=$irows;} ?>
 <?php  if($xitem1['TXNTYPE']=='P') $resss =$xitem1['RES'];
 if( ($resss!=0 && $par['sec']=='ALL' && $xitem1['TXNTYPE']=='P') || $par['sec']!='ALL' ) {    $rdp++;
 ?> 
    <tr bgcolor="#ffffff">
        <td align="center"><?php echo date_format($xitem1['SETTLEDATE'],'m/d/Y');?></td>
        <td align="center"><?php echo $xitem1['TXNTYPE'];?></td>
        <td align="right"><?php echo trim($xitem1['TXNTYPE'])=='P'?number_format($xitem1['FACEVALUE'],2,'.',','):'';?></td>
        <td align="right"><?php echo trim($xitem1['TXNTYPE'])=='P'?number_format($xitem1['COST'],2,'.',','):'';?></td>
        <td align="right"><?php echo trim($xitem1['TXNTYPE'])=='S'?number_format($xitem1['FACEVALUE'],2,'.',','):'';?></td>
        <td align="right"><?php echo trim($xitem1['TXNTYPE'])=='S'?number_format($xitem1['COST'],2,'.',','):'';?></td>
        <td align="right"><?php echo trim($xitem1['TXNTYPE'])=='S'?number_format($xitem1['COST_PUR_FIFO'],2,'.',','):'';?></td>
        <td align="right"><?php echo trim($xitem1['TXNTYPE'])=='S'?number_format($xitem1['PL'],2,'.',','):'';?></td>
        <td align="right"><?php echo trim($xitem1['TXNTYPE'])=='P'?number_format($xitem1['RES'],2,'.',','):'';?></td>
        <td align="center"><?php echo number_format($xitem1['PRICE'],2,'.',',');?></td>
    </tr>
 <?php } ?> 
<?php $sec=$xitem1['SECURITYCODE']; $tot_pl+=$xitem1['PL'];$tot_hold+=trim($xitem1['TXNTYPE'])=='P'?$xitem1['RES']:0;$irows++;}?>
<?php if($sec!=''){?>
    <tr bgcolor="#F0F0F0">
        <td colspan="7"></td>
        <td align="right"><b><?php echo number_format($tot_pl,2,'.',',');?></b></td>
        <td align="right"><b><?php echo number_format($tot_hold,2,'.',',');?></b></td>
        <td></td>
    </tr>
<?php } ?>

<!---- Simulation Section -->
 <?php 
    if(0+$par['u']>0  && (($par['sec']=='ALL' && $rdp>0) || $par['sec']!='ALL')) {
        echo "<tr><td colspan=\"10\" style=\"padding:2px;\" bgcolor=\"#FF0000\">";
        $unit=0+$par['u'];
        $cost=0+$par['p'];
 ?>
    <table width="100%" bgcolor="#0000FF">
        <tr>
            <td colspan="10" align="center" bgcolor="#FFFFC0"><b>FIFO Selling Simulation for   <?php echo strtoupper($sec);?></b></td>
        </tr>
        <tr bgcolor="#C0FFFF">
            <th>Sett Date</th>
            <th>Type</th>
            <th align="right">Unit Purchase</th>
            <th align="right">Cost Purchase</th>
            <th align="right">Unit Sold</th>
            <th align="right">Proceed</th>
            <th align="right">Cost on Purchase</th>
            <th align="right">Gain</th>
            <th align="right">Fifo Holding</th> 
            <th>Price (%)</th> 
        </tr>
 <?php
        $u=$unit; 
        $c=$cost;
        $cu=$c/$u;
        $cp=0;
        $tu=0;$tc=0;$tp=0;
        for($i=$irows_s;$i<$irows && $unit!=0;$i++)
        {
            if($r_data[$i]['RES']>0 && trim($r_data[$i]['TXNTYPE'])=='P')
            {
                if($r_data[$i]['RES']>=$unit)
                {
                    $u=$unit;
                    $c=$unit*$cu;
                    $cp=$unit*$r_data[$i]['COST']/$r_data[$i]['FACEVALUE'];
                    $r_data[$i]['RES']-=$unit;
                    $unit=0;
                    
                }
                else
                {
                    $u=$r_data[$i]['RES'];
                    $c=$r_data[$i]['RES']*$cu;
                    $cp=$r_data[$i]['RES']*$r_data[$i]['COST']/$r_data[$i]['FACEVALUE'];
                    $unit=$unit-$r_data[$i]['RES'];
                    $r_data[$i]['RES']=0;
                }
                $tu+=$u;$tc+=$c;$tp+=$cp;
 ?>
        <tr bgcolor="#FFFFFF">
            <td align="center"><?php echo date_format($r_data[$i]['SETTLEDATE'],'m/d/Y');?></td>
            <td align="center"><?php echo $r_data[$i]['TXNTYPE'];?></td>
            <td align="right"><?php echo number_format($r_data[$i]['FACEVALUE'],2,'.',',');?></td>
            <td align="right"><?php echo number_format($r_data[$i]['COST'],2,'.',',');?></td>
            <td align="right"><?php echo number_format($u,2,'.',',');?></td>
            <td align="right"><?php echo number_format($c,2,'.',',');?></td>
            <td align="right"><?php echo number_format($cp,2,'.',',');?></td>
            <td align="right"><?php echo number_format($c-$cp,2,'.',',');?></td>
            <td align="right"><?php echo number_format($r_data[$i]['RES'],2,'.',',');?></td>
            <td align="center"><?php echo number_format($r_data[$i]['PRICE'],2,'.',',');?></td>
        </tr>
 <?php
            }
        }
        if($tu>0){
 ?>
        <tr bgcolor="#C0FFFF">
            <td colspan="4"></td>
            <td align="right"><b><?php echo number_format($tu,2,'.',',');?></b></td>
            <td align="right"><b><?php echo number_format($tc,2,'.',',');?></b></td>
            <td align="right"><b><?php echo number_format($tp,2,'.',',');?></b></td>
            <td align="right"><b><?php echo number_format($tc-$tp,2,'.',',');?></b></td>
            <td colspan="2" align="center"><b>Last Holding: <?php echo number_format($tot_hold-$tu,2,'.',',');?></b></td>
        </tr>
 <?php
        }
 ?>

    </table>
 <?php
        echo "</td></tr>";
    }
?>
 <!-- End Simulation Section-->   
</table>
