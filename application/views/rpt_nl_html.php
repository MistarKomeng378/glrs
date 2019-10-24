<html>
<head>
<title>NAV Listing</title>
<style type="text/css">
body{background-color: #ffffff;}
body,td,th{font-size: 12px;}
</style>
</head>
<body>
   NAV Listing (<?php echo $pf;?>) : <?php echo date_format(date_create($sdt),'d M Y'); ?> - <?php echo date_format(date_create($edt),'d M Y'); ?>
<table width="100%" bgcolor="#808080">
    <tr bgcolor="#E0E0E0">
        <th align="center">DATE</th>
        <th width="18%" align="right">ASSET</th>
        <th width="18%" align="right">LIABILITY</th>
        <th width="18%" align="right">NAV</th>
        <th width="18%" align="right">UNIT ISSUED</th>
        <th width="18%" align="right">NAV PRICE</th>
    </tr>
<?php $irow=0; foreach ($r_data as $xitem1) {  ?>
    <tr bgcolor="<?php echo $irow%2==0?"#FFFFFF":"#F8F8F8";?>">
        <td align="center"><?php echo is_object($xitem1['NAVDate'])?date_format($xitem1['NAVDate'],'d M Y'):'';?></td>
        <td align="right"><?php echo number_format($xitem1['TotalAsset'],4,'.',',');?></td>  
        <td align="right"><?php echo number_format($xitem1['TotalLiabilities'],4,'.',',');?></td>  
        <td align="right"><?php echo number_format($xitem1['TotalNAV'],4,'.',',');?></td>  
        <td align="right"><?php echo number_format($xitem1['TotalUnitIssued'],4,'.',',');?></td>  
        <td align="right"><?php echo number_format($xitem1['Price'],4,'.',',');?></td>  
    </tr>
<?php $irow++; } ?>
</table>
</body>
</html>