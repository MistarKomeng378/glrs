<html>
<head>
<title>GL Account Movement</title>
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
            <td colspan="2">GL ACCOUNT MOVEMENT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($sdt),'F d, Y') . " to " . date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <thead>
        <?php 
            $tot=0;  
            $row=0;        
            $gl_acc ="";
            $tot_c =0;
            $tot_d=0;
            
        ?>
        <tr>
            <td><div class="down_line"><b>Date</b></div></td>
            <td><div align="right" class="down_line"><b>Reffno&nbsp;</b></div></td>
            <td><div class="down_line"><b>Description</b></div></td>
            <td><div align="right" class="down_line"><b>Debit</b></div></td>
            <td><div align="right" class="down_line"><b>Credit</b></div></td>
            <td><div align="right" class="down_line"><b>Balance</b></div></td>
        </tr>
        </thead>
        <tbody>
        
        
        <?php foreach ($r_data as $item1): ?>
        <?php $tot += $item1["NETMOVEMENT"];?>
        <?php 
        $row++;
        if (1) {
            if($gl_acc!=$item1["ACCOUNTCODE"]) {
                if($gl_acc!=""){ ?>
        <tr>
            <td colspan="3">&nbsp;</td>
            <td><div align="right"><b><?php echo number_format($tot_d,3,'.',',');?></b></div></td>
            <td><div align="right"><b><?php echo number_format($tot_c,3,'.',',');?></b></div></td>
        </tr>        
        <?php
                }
                $gl_acc=$item1["ACCOUNTCODE"];
                $tot = $item1["NETMOVEMENT"]; 
                $row=0;
                $tot_c =0;
                $tot_d=0;
        ?>
        <tr>
            <td colspan="6"><div class="down_line"><b><?php echo $item1["ACCOUNTCODE"] . "  -  " . $item1["ACCOUNTNAME"];?></b></div></td>
        </tr>
        <?php }}  
            $tot_c +=$item1["CREDIT"];
            $tot_d +=$item1["DEBIT"];?>
        <tr <?php if($row%2==1) echo 'bgcolor="#F0F0F0"';?>>
            <td><div><b><?php echo date_format($item1["JOURNALDATE"],"d M Y");?></b></div></td>
            <td><div align="right"><?php echo $item1["REFNO"] . "&nbsp;";?></div></td>
            <td><div><?php echo $item1["DESCRIPTION"];?></div></td>
            <td><div align="right"><?php echo number_format($item1["DEBIT"],3,'.',',');?></div></td>
            <td><div align="right"><?php echo number_format($item1["CREDIT"],3,'.',',');?></div></td>
            <td><div align="right"><b><?php echo number_format($tot,5,'.',',');?></b></div></td>
        </tr>
        <?php endforeach; ?>
        <?php if($gl_acc!=""){ ?>
        <tr>
            <td colspan="3">&nbsp;</td>
            <td><div align="right"><b><?php echo number_format($tot_d,3,'.',',');?></b></div></td>
            <td><div align="right"><b><?php echo number_format($tot_c,3,'.',',');?></b></div></td>
        </tr>        
        <?php }                                            ?>
        </tbody>
    </table>
</div>
</body>
</html>