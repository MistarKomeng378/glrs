<html>
<head>
<title>Mark to Market Journal Report</title>
<style type="text/css">
  BODY, TD {
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
            <td colspan="2">MTM JOURNAL REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
    <?php 
        $desc='';
    ?>
    <?php foreach ($r_data as $item1): ?>
    <?php 
    if($desc!=$item1["DESCRIPTION"])
    {
        $desc=$item1["DESCRIPTION"]
    ?>
        <tr>
            <td colspan="6"><div><strong><u><?php echo $item1["DESCRIPTION"];?></u></strong></div></td>
        </tr>
    <?php } ?>
        <tr>
            <td width="20">&nbsp;</td>
            <td width="60"><?php echo $item1["REFNO"];?></td>
            <td width="120"><?php echo $item1["ACCOUNTCODE"];?></td>
            <td width="320"><?php echo $item1["ACCOUNTNAME"];?></td>
            <td  width="20"><?php echo $item1["SIGN"];?></td>
            <td><div align="right"><?php echo number_format($item1["AMOUNT"],2,'.',",");?></div></td>
        </tr>
    
    <?php endforeach; ?>    
    </table> 
</div>
</body>
</html>