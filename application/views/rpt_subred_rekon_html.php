<html>
<head>
<title>Subcription/ Redemption Reconciliation</title>
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
<hr />
Subscription/ Redemption Reconciliation: <?php echo date_format(date_create($dt),'d M Y'); ?>
<table width="100%" bgcolor="#808080">
    <tr bgcolor="#E0E0E0">
        <th rowspan="2" width="5" align="center" valign="middle">NO</th>
        <th rowspan="2" width="50" align="center" valign="middle">PF CODE</th>
        <th rowspan="2" valign="middle" align="left">PF NAME</th>
        <th colspan="4">GLRS</th>
        <th colspan="4">URS</th>
    </tr>
    <tr bgcolor="#E0E0E0">
        <th align="center" width="90">Sub</th>
        <th align="center" width="90">Red</th>
        <th align="center" width="90">Cin</th>
        <th align="center" width="90">Cout</th>
        <th align="center" width="90">Sub</th>
        <th align="center" width="90">Red</th>
        <th align="center" width="90">Cin</th>
        <th align="center" width="90">Cout</th>        
    </tr>
<?php $irow=0; $t='';  foreach ($r_data as $xitem1) { 
    if($irow++%2==0) $bg="#FFFFFF"; else $bg="#F0F0F0"; 
    $beda=false;
    if(($xitem1['glrs_sub']+$xitem1['glrs_red']+$xitem1['glrs_cin']+$xitem1['glrs_cout'])-($xitem1['urs_sub']+$xitem1['urs_red']+$xitem1['urs_cin']+$xitem1['urs_cout'])!=0)
        $beda=true;
    if($beda) $bg="#FFC0FF";
    $bedasub=false;
    if($xitem1['glrs_sub']-$xitem1['urs_sub']!=0)
        $bedasub=true;
    $bedared=false;
    if($xitem1['glrs_red']-$xitem1['urs_red']!=0)
        $bedared=true;
    $bedacin=false;
    if($xitem1['glrs_cin']-$xitem1['urs_cin']!=0)
        $bedacin=true;
    $bedacout=false;
    if($xitem1['glrs_cout']-$xitem1['urs_cout']!=0)
        $bedacout=true;
    
?>
    <tr bgcolor="<?php echo $bg;?>">
        <td align="center"><?php echo $irow+1;?></td>
        <td align="center"><?php echo $xitem1['pf'];?></td>
        <td align="left"><?php echo $xitem1['pfname'];?></td>
        <td align="right" <?php if($bedasub) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['glrs_sub'],2,'.',',');?></td>
        <td align="right" <?php if($bedared) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['glrs_red'],2,'.',',');?></td>
        <td align="right" <?php if($bedacin) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['glrs_cin'],2,'.',',');?></td>
        <td align="right" <?php if($bedacout) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['glrs_cout'],2,'.',',');?></td>
        <td align="right" <?php if($bedasub) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['urs_sub'],2,'.',',');?></td>
        <td align="right" <?php if($bedared) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['urs_red'],2,'.',',');?></td>
        <td align="right" <?php if($bedacin) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['urs_cin'],2,'.',',');?></td>
        <td align="right" <?php if($bedacout) echo "style=\"color:#FF0000;\""; ?>><?php echo number_format($xitem1['urs_cout'],2,'.',',');?></td>
    </tr>
<?php $irow++; } ?>
</table>
</body>
</html>
