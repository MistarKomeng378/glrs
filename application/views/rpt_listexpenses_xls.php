<html>
<head>
<title>Parameter fee</title>
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
<b>DATA MASTER</b>
<table width="100%" bgcolor="#808080" border="1">
     <tr bgcolor="#E0E0E0">
        <th><b>PFCODE</b></th>
        <th><b>PFNAME</b></th>
        <th><b>FEECODE</b></th>
        <th><b>FEENAME</b></th>
        <th><b>PCT</b></th>
        <th><b>VALUE</b></th>
        <th><b>FEEBASE</b></th>
        <th><b>YEARBASE</b></th>
        <th><b>RATE</b></th>
        <th><b>SAVEACCRUED</b></th>
        <th><b>TAXRATE</b></th>
        <th><b>INCTAX</b></th>
        <th><b>FIRSTNAV</b></th>
        <th><b>STATUS</b></th>   
    </tr>
<?php $irow=0; foreach ($r_datam as $xitem1) { if($irow++ %2==0 ) $bg="#ffffff"; else $bg="#F0F0F0";; ?>
    <tr bgcolor="<?php echo $bg;?>">
        <td align="left"><?php echo $xitem1['pfcode'];?></td>
        <td align="left"><?php echo $xitem1['pfname'];?></td>
        <td align="left"><?php echo $xitem1['feecode'];?></td>
        <td align="left"><?php echo $xitem1['feename'];?></td>
        <td align="left"><?php echo $xitem1['pct'];?></td>
        <td align="left"><?php echo $xitem1['value'];?></td>
        <td align="left"><?php echo $xitem1['navbase'];?></td>
        <td align="left"><?php echo $xitem1['yearbase'];?></td>
        <td align="left"><?php echo $xitem1['rate'];?></td>
        <td align="left"><?php echo $xitem1['saveaccrual'];?></td>
        <td align="left"><?php echo $xitem1['taxrate'];?></td>
        <td align="left"><?php echo $xitem1['inctax'];?></td>
        <td align="left"><?php echo $xitem1['firstnav'];?></td>
        <td align="left"><?php echo $xitem1['status'];?></td>
    </tr>
<?php } ?>
</table>
<b>DATA TIERING</b>
<table width="100%" bgcolor="#808080" border="1">
     <tr bgcolor="#E0E0E0">
        <th><b>PFCODE</b></th>
        <th><b>PFNAME</b></th>
        <th><b>FEECODE</b></th>
        <th><b>FEENAME</b></th>
        <th><b>VALUE</b></th>
        <th><b>ENDRANGE</b></th>
        <th><b>SEQNO</b></th>
    </tr>
<?php $irow=0; foreach ($r_datat as $xitem1) { if($irow++ %2==0 ) $bg="#ffffff"; else $bg="#F0F0F0";; ?>
    <tr bgcolor="<?php echo $bg;?>">
        <td align="left"><?php echo $xitem1['pfcode'];?></td>
        <td align="left"><?php echo $xitem1['pfname'];?></td>
        <td align="left"><?php echo $xitem1['feecode'];?></td>
        <td align="left"><?php echo $xitem1['feename'];?></td>
        <td align="left"><?php echo $xitem1['value'];?></td>
        <td align="left"><?php echo $xitem1['endrange'];?></td>
        <td align="left"><?php echo $xitem1['seqno'];?></td>
    </tr>
<?php } ?>
</table>
</body>
</html>
