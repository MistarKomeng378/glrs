<html>
<head>
<title>Tax Accrued Interest</title>
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
    border-top: 1px dotted  #969696;
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
            <td colspan="2">TAX ACCRUED INTEREST REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#ACACAC">
        <thead>
        <tr bgcolor="#E0E0E0">
            <th>TXN NO</th>
            <th>RATE</th>
            <th>LAST CPN</th>
            <th>SETTLE DATE</th>
            <th>DAYS</th>
            <th>BALANCE</th>
            <th>ACCRUED INT</th>
            <th>DAILY TAX</th>
            <th>ACCRUED TAX</th>
            <th>NET ACCRUED INT</th>
        </tr>
        </thead>
        <tbody>
<?php
$sec="";
$totg=0;
$totb=0;                           
$tot_accint=0;
$tot_net_accint=0;
$tot=0;
$tot1=0;
$tot2=0;
$tot3=0;
$irow=0;
foreach($r_tax  as $item1){
?>
<?php 
    if($sec!=$item1["SECURITYCODE"])
    {
        if($sec!="")
        {?>
        <tr bgcolor="#ffffff">
            <td align="right" colspan="5"><b>Sub Total :</b></td>
            <td align="right"><b><?php echo number_format($totb,2,".",',');?></b></td>
            <td align="right"><b><?php echo number_format($tot_accint,2,".",',');?></b></td>
            <td align="right"></td>
            <td align="right"><b><?php echo number_format($totg,2,".",',');?></b></td>
            <td align="right"><b><?php echo number_format($tot_net_accint,2,".",',');?></b></td>
        </tr>
<?php
        }?>
        <tr bgcolor="#C0C0FF">
            <td colspan="10"><b><?php echo strtoupper($item1["SECURITYCODE"]);?></b></td>
        </tr>
<?php
        $sec= $item1["SECURITYCODE"];
        $totg=0;
        $totb=0;
        $irow=0;
        $tot_accint=0;
        $tot_net_accint=0;
    }?>
        <tr bgcolor="<?php echo ($irow%2==0?"#ffffff":"#F0F0F0");?>">
            <td><?php echo $item1["TXNNO"];?></td>       
            <td align="right"><?php echo $item1["COUPONRATE"] . '%';?></td>
            <td align="center"><?php echo is_object($item1["LASTCOUPON"])?date_format($item1["LASTCOUPON"],'M d, Y'):'';?></td>
            <td align="center"><?php echo is_object($item1["SETTLEDATE"])?date_format($item1["SETTLEDATE"],'M d, Y'):'';?></td>
            <td align="right"><?php echo $item1["TOTALDAYS"];?></td>
            <td align="right"><?php echo number_format($item1["BALANCE"],2,'.',',');?></td>
            <td align="right"><?php echo number_format($item1["ACCRUEDINTEREST"],2,'.',',');?></td>
            <td align="right"><?php echo number_format($item1["DAILYTAX"],2,'.',',');?></td>
            <td align="right"><?php echo number_format($item1["TAXACCRUEDAMOUNT"],2,'.',',');?></td>
            <td align="right"><?php echo number_format($item1["NETACCRUEDINT"],2,'.',',');?></td>
        </tr>
<?php 
    $totg=$totg + $item1["TAXACCRUEDAMOUNT"];
    $totb=$totb + $item1["BALANCE"];
    $tot=$tot + $item1["TAXACCRUEDAMOUNT"];
    $tot_accint=$tot_accint + $item1["ACCRUEDINTEREST"];
    $tot_net_accint=$tot_net_accint + $item1["NETACCRUEDINT"];
    $tot1=$tot1 + $item1["ACCRUEDINTEREST"];
    $tot2=$tot2 + $item1["NETACCRUEDINT"];
    $tot3=$tot3 + $item1["BALANCE"];
    $irow++;
    }
if($sec!="")
{?>
        <tr bgcolor="#ffffff">
            <td align="right" colspan="5"><b>Sub Total :</b></td>
            <td align="right"><b><?php echo number_format($totb,2,".",',');?></b></td>
            <td align="right"><b><?php echo number_format($tot_accint,2,".",',');?></b></td>
            <td align="right"></td>
            <td align="right"><b><?php echo number_format($totg,2,".",',');?></b></td>
            <td align="right"><b><?php echo number_format($tot_net_accint,2,".",',');?></b></td>
        </tr>
        <tr bgcolor="#000058">
            <td align="right" colspan="5"><b><font color="#ffffff">TOTAL ALL :</font></b></td>
            <td align="right"><b><font color="#ffffff"><?php echo number_format($tot3,2,".",',');?></font></b></td>
            <td align="right"><b><font color="#ffffff"><?php echo number_format($tot1,2,".",',');?></font></b></td>
            <td align="right"></td>
            <td align="right"><b><font color="#ffffff"><?php echo number_format($tot,2,".",',');?></font></b></td>
            <td align="right"><b><font color="#ffffff"><?php echo number_format($tot2,2,".",',');?></font></b></td>
        </tr>
<?php }
?>
        </tbody>
    </table>
    <br /> 
    
    <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#ACACAC">
        <thead>
        <tr bgcolor="#E0E0E0">
            <td>TXNNO</td>
            <td>TXN TYPE</td>
            <td>SECURITY CODE</td>
            <td>TRADE DATE</td>
            <td>SETTLE DATE</td>
            <td>FACE VALUE</td>
            <td>ACCRUED INT</td>
        </tr>
        </thead>
        <tbody>
<?php 
    $total_acc=0;
    foreach($r_utrx as $item1){
    $irow=0;
    $total_acc=$total_acc+$item1["ACCRUEDINTEREST"];
?>
        <tr bgcolor="<?php echo ($irow%2==0?"#ffffff":"#F0F0F0");?>">
            <td><?php echo $item1["TXNNO"];?></td>       
            <td align="right"><?php echo $item1["TXNTYPE"];?></td>
            <td align="center"><?php echo $item1["SECURITYCODE"];?></td>
            <td align="center"><?php echo is_object($item1["TRADEDATE"])?date_format($item1["TRADEDATE"],'M d, Y'):'';?></td>
            <td align="center"><?php echo is_object($item1["SETTLEDATE"])?date_format($item1["SETTLEDATE"],'M d, Y'):'';?></td>
            <td align="right"><?php echo number_format($item1["FACEVALUE"],2,'.',',');?></td>
            <td align="right"><?php echo number_format($item1["ACCRUEDINTEREST"],2,'.',',');?></td>
        </tr>
<?php } 
if(count($r_utrx)>0) {
?>
        <tr bgcolor="#580058">
            <td colspan="6" align="right"><b><font color="#ffffff">TOTAL</font></b></td>
            <td align="right"><b><font color="#ffffff"><?php echo number_format($total_acc,2,'.',',');?></font></b></td>
        </tr>
<?php } ?>
        </tbody>
    </table>
    <?php 
$totval=0;
if(count($r_usal)>0) { ?>
<br />
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#ACACAC">
        <thead>
        <tr bgcolor="#E0E0E0">
            <td>VALUATION DATE</td>
            <td>TXNNO</td>
            <td>TRADE DATE</td>
            <td>SETTLE DATE</td>
            <td>SECURITYCODE</td>
            <td>FACEVALUE</td>
            <td>PRICE</td>
            <td>TAXPAID</td>
        </tr>
        </thead>
<?php foreach($r_adj1 as $item3) { ?>
    <tr bgcolor="<?php echo ($irow%2==0?"#ffffff":"#F0F0F0");?>">
            <td><?php echo is_object($item3["VALUATIONDATE"])?date_format($item3["VALUATIONDATE"],'M d, Y'):'';?></td>       
            <td align="right"><?php echo $item3["TXNNO"];?>%</td>            
            <td align="center"><?php echo is_object($item3["TRADEDATE"])?date_format($item3["TRADEDATE"],'M d, Y'):'';?></td>
            <td align="center"><?php echo is_object($item3["SETTLEDATE"])?date_format($item3["SETTLEDATE"],'M d, Y'):'';?></td>
            <td align="right"><?php echo $item3["SECURITYCODE"];?></td>
            <td align="right"><?php echo number_format($item3["FACEVALUE"],2,'.',',');?></td>
            <td align="right"><?php echo number_format($item3["PRICE"],2,'.',',');?></td>
            <td align="right"><?php echo number_format($item3["TAXPAID"],2,'.',',');?></td>
        </tr>
<?php
$totval+=  $item3["TAXPAID"];
} ?>     
        <tr bgcolor="#FF0000">
            <td colspan="7" align="right"><b><font color="#ffffff">TOTAL</font></b></td>
            <td align="right"><b><font color="#ffffff"><?php echo number_format($totval,2,'.',','); ?></font></b></td>
        </tr>
        </tbody>
</table>
<?php }?>
    <br />
    <table width="100%" border="0" cellspacing="2" cellpadding="2" bgcolor="#000000">
        <tr bgcolor="#ffffff">
        <td align="right"><b>TOTAL NET ACCRUED INT</b></td>
        <td width="1%" align="right"><b><?php echo number_format($total_acc+$tot2+$totval,2,'.',',');?></b></td>
        </tr>
    </table> 
    <br />
  <b>Unsettle FI Transaction Adjustment Inquiry</b> 
    
    <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#ACACAC">
        <thead>
        <tr bgcolor="#E0E0E0">
            <td>TXN NO</td>
            <td>TXN TYPE</td>
            <td>SECURITY</td>
            <td>TRADE DATE</td>
            <td>SETTLE DATE</td>
            <td>NEXT CPN</td>
            <td>ADJUSTMENT</td>
        </tr>
        </thead>
        <tbody>
<?php
$sec="";
$tot=0;
$irow=0;
foreach($r_adj as $item4){
    $sec= $item4["SECURITYCODE"];
?>

       <tr bgcolor="<?php echo ($irow%2==0?"#ffffff":"#F0F0F0");?>">
            <td><?php echo $item4["TXNNO"];?></td>       
            <td align="center"><?php echo $item4["TXNTYPE"];?></td>
            <td align="center"><?php echo $item4["SECURITYCODE"];?></td>
            <td align="center"><?php echo is_object($item4["TRADEDATE"])?date_format($item4["TRADEDATE"],'M d, Y'):'';?></td>
            <td align="center"><?php echo is_object($item4["SETTLEDATE"])?date_format($item4["SETTLEDATE"],'M d, Y'):'';?></td>
            <td align="center"><?php echo is_object($item4["NEXTCOUPON"])?date_format($item4["NEXTCOUPON"],'M d,Y'):'';?></td>
            <td align="right"><?php echo number_format($item4["ADJUSTMENTAMT"],2,'.',',');?></td>
        </tr>
<?php 
    $tot=$tot + $item4["ADJUSTMENTAMT"];
    $irow++;
}
if($sec!="")
{?>
        <tr bgcolor="#ffffff">
            <td align="right" colspan="6"><b>Total :</b></td>
            <td align="right"><b><?php echo number_format($tot,2,".",',');?></b></td>
        </tr>
<?php }
?>
        </tbody>
    </table>
</div>
</body>
</html>