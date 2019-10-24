<html>
<head>
<title>NAV & TB Monitoring</title>
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
NAV &amp; TB Process Monitoring: <?php echo date_format(date_create($dt),'d M Y'); ?>
<table width="100%" bgcolor="#808080">
    <tr bgcolor="#E0E0E0">
        <th rowspan="2" width="6" align="center" valign="middle">NO</th>
        <th rowspan="2" width="60" align="center" valign="middle">PF CODE</th>
        <th rowspan="2" valign="middle" align="left">PF NAME</th>
        <th colspan="2">NAV</th>
        <th colspan="2">GL</th>
        <th rowspan="2" valign="middle" width="40" align="right">NAV DIFF</th>
        <th rowspan="2" width="40" align="center">URS POSTED</th>
        <th rowspan="2" align="center">LAST NAV APPROVED</th>
        <th rowspan="2" align="center">LAST GL DONE</th>
        <th rowspan="2" align="center">LAST URS POST</th> 
        <th rowspan="2" align="center">CURRENT YEAR</th>
        <th rowspan="2" align="center">APPROVE DATE</th>
        <th rowspan="2" align="center">GL DONE DATE</th>
        <th rowspan="2" align="center">URS POST DATE</th>
    </tr>
    <tr bgcolor="#E0E0E0">
        <th align="center" width="40">STATUS</th>
        <th width="50" align="left">BY</th>
        <th align="center" width="40">STATUS</th>
        <th width="50" align="left">BY</th>
    </tr>
<?php $irow=0; $t='';  foreach ($r_data as $xitem1) { if($irow%2==0) $bg="#FFC0FF"; else $bg="#FF90FF"; ?>
    <?php if($t!=$xitem1['pftype']) { ?>
    <tr bgcolor="#C0C0FF">  
        <td colspan="16" align="center"><b><?php echo $xitem1['pftype']=='RDN'?'REKSADANA':($xitem1['pftype']=='LNK'?'UNIT LINK':'OTHERS');?></b></td>
    </tr>
    <?php } ?>
    <tr bgcolor="<?php echo $irow%2==0?"#FFFFFF":"#F8F8F8";?>">
         <td align="center"><?php echo $irow+1;?></td>
         <td align="center"><?php echo $xitem1['pf'];?></td>
        <td align="left"><?php echo $xitem1['pfname'];?></td>
        <td align="center" <?php echo $xitem1['nav_status']!='A'?"bgcolor=\"{$bg}\"":"";?>><?php echo $xitem1['nav_status']=='A'?'YES':'NO';?></td>
        <td align="left"><?php echo $xitem1['nav_by'];?></td>
        <td align="center" <?php echo $xitem1['gl_status']!='A'?"bgcolor=\"{$bg}\"":"";?>><?php echo $xitem1['gl_status']=='A'?'YES':'NO';?></td>
        <td align="left"><?php echo $xitem1['gl_by'];?></td>
        <td align="right"><?php echo is_numeric($xitem1['nav_diff'])?number_format($xitem1['nav_diff'],$xitem1['ndec'],'.',','):'';?></td>
        <td align="center"><?php echo $xitem1['ursstat']==0?'No':'Yes';?></td>
        <td align="center"><?php echo is_object($xitem1['approveddate'])?date_format($xitem1['approveddate'],'m/d/Y'):''; ?></td>
        <td align="center"><?php echo is_object($xitem1['gldonedate'])?date_format($xitem1['gldonedate'],'m/d/Y'):''; ?></td>
        <td align="center"><?php echo is_object($xitem1['processdate'])?date_format($xitem1['processdate'],'m/d/Y'):''; ?></td>
        <td align="center"><?php echo is_object($xitem1['curyear'])?date_format($xitem1['curyear'],'Y'):''; ?></td>
        <td align="center"><?php echo is_object($xitem1['doapprovedate'])?date_format($xitem1['doapprovedate'],'m/d/Y-H:i'):''; ?></td>
        <td align="center"><?php echo is_object($xitem1['dodonedate'])?date_format($xitem1['dodonedate'],'m/d/Y-H:i'):''; ?></td>
        <td align="center"><?php echo is_object($xitem1['doursdate'])?date_format($xitem1['doursdate'],'m/d/Y-H:i'):''; ?></td>
    </tr>
<?php $irow++; $t=$xitem1['pftype']; } ?>
</table>                                     
</body>
</html>
