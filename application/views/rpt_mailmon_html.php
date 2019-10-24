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
Fund Mailer Monitoring: <?php echo date_format(date_create($dt),'d M Y'); ?>
<table bgcolor="#808080">
    <tr bgcolor="#E0E0E0">
        <th width="5" align="center" valign="middle">NO</th>
        <th width="50" align="center" valign="middle">PF CODE</th>
        <th width="350" align="left">PF NAME</th>
        <th width="50" align="center">SENDED</th>
        <th width="50" align="center">TIME</th>
    </tr>
<?php $irow=0; $fmcode='';  foreach ($r_data as $xitem1) {  ?>
    <?php if($fmcode!=$xitem1['fmcode']) { ?>
    <tr bgcolor="#ffffff">  
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#C0C0FF">  
        <td colspan="5"><b><?php echo $xitem1['fmname'];?></b></td>
    </tr>
    <?php $fmcode=$xitem1['fmcode']; $irow=0;} if($xitem1['fname']=='') $bg="#FFC0FF"; else $bg="#C0FFC0"; ?>
    <tr bgcolor="<?php echo $bg;?>">
        <td align="center"><?php echo $irow+1;?></td>
        <td align="center"><?php echo $xitem1['pfcode'];?></td>
        <td align="left"><?php echo $xitem1['pfname'];?></td>
        <td align="center"> <?php echo $xitem1['fname']==''?"No":"YES";?></td>
        <td align="center"><?php echo is_object($xitem1['mail_date'])?date_format($xitem1['mail_date'],'H:i'):''; ?></td>
    </tr>
<?php $irow++; } ?>
</table>                                     
</body>
</html>
