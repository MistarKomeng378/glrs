<html>
<head>
<title>IBPA vs HIPORT Rekonsiliation</title>
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
<div style="width: 100%;">
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <?php echo $sign;?>
<table bgcolor="#969696" width="100%">
    <tr  bgcolor="#F0F0F0">
        <th align="center" width="1" rowspan="2">No</th>
        <th align="left" width="70" rowspan="2">Date</th>
        <th align="left" width="80" rowspan="2">Sec Code</th>
        <th align="left" rowspan="2">Sec Name</th>
        <th align="center"  colspan="2">Hiport</th>
        <th align="center"  colspan="4">IBPA</th>
        <th align="center" width="40" rowspan="2">Status</th>
    </tr>
    <tr bgcolor="#F0F0F0">        
        <th align="center" width="40">Time</th>
        <th align="right" width="70">Price</th>
        <th align="center" width="40">Time</th>
        <th align="right" width="70">Price</th>
        <th align="center" width="40">Profil MI Code</th>
        <th align="left">Profil MI Name</th>        
    </tr>
<?php $mi='*()@&#@()'; $baris=1; foreach($arr_rekon as $xitem1){ ?>
<!--
<?php if($mi!=$xitem1['mi_hiport_code']) { $mi=$xitem1['mi_hiport_code']; ?>
    <tr bgcolor="#F0F0F0">
         <td align="center" colspan="11"><b><?php echo $xitem1['mi_name']; ?><br />(<?php echo $xitem1['mi_hiport_code']; ?> vs <?php echo $xitem1['mi_code']; ?>)</b></td>
    </tr>
<?php } ?>
-->
    <tr bgcolor="<?php echo $xitem1['unmatch']==0?"#ffffff":"#FFC0FF"; ?>"> 
        <td align="center"><?php echo $baris++;?></td>        
         <td align="left"><?php echo $dt; ?></td>
         <td align="left"><?php echo $xitem1['hiport_sec_code']; ?></td>
         <td align="left"><?php echo $xitem1['ibpa_sec_name']; ?></td>
         <td align="center"><?php echo $xitem1['hiport_ph']; ?></td>
         <td align="right"><?php echo number_format($xitem1['hiport_price']+0,6,'.',','); ?></td>
         <td align="center"><?php echo $xitem1['PricingHour']; ?></td>
         <td align="right"><?php echo number_format($xitem1['ibpa_price']+0,6,'.',','); ?></td>
         <td align="left"><?php echo $xitem1['ibpa_mi_code']; ?></td> 
         <td align="left"><?php echo $xitem1['FundManagerName']; ?></td> 
         <td align="center" width="70"><?php echo $xitem1['unmatch']==0?"Matched":"Unmatched"; ?></td>
    </tr>
<?php }?>
</table>
</div>
</body>
</html>