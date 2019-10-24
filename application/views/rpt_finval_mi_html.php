<html>
<head>
<title>Valuation Report</title>
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
<?php $pfrow=0;foreach($r_pfs as $r_pf) {?>
    <?php if($r_pf['APPROVESTATUS']=='A') {?>
    <?php if($pfrow++>0) {?>
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <?php }?>
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf["pfname"];?></b></td>
            <td align="right"><?php echo $r_pf["fmname"];?></td>
        </tr>
        <tr>                                                                 
            <td colspan="2">VALUATION REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr >
            <td class="down_line">SEC CODE</td>
            <td class="down_line">SEC NAME</td>
            <td align="right" class="down_line">HOLDING</td>
            <td align="right" class="down_line">TOTAL COST</td>
            <td align="right" class="down_line">TOTAL VALUE</td>
        </tr>
    <?php 
        $group='';
        $pgroup =false;
        $tot_holding=0;
        $tot_cost=0;
        $tot_val=0;
    ?>
    <?php foreach ($r_data[$r_pf['pfcode']] as $item1): ?>
    <?php 
    if($group!=$item1["GL_GROUP"])
    {
        if($group!='')
            $pgroup=true;
        $group=$item1["GL_GROUP"];
    ?>
    <?php if($pgroup) {   ?>
        <tr>
            <td></td>
            <td></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_holding,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_cost,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_val,2,'.',",");?></strong></div></td>
        </tr>
        
    <?php 
        $tot_holding=0;
        $tot_cost=0;
        $tot_val=0;
    }
    ?>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
    <?php } ?>
        <tr>
            <td><?php echo $item1["SECURITYCODE"];?></td>
            <td><?php echo $item1["SECURITYNAME"];?></td>
            <td><div align="right"><?php echo number_format($item1["HOLDING"],2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format($item1["TOTALCOST"],2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format($item1["TOTALVALUE"],2,'.',",");?></div></td>
        </tr>
    <?php
        $tot_holding+=$item1["HOLDING"];
        $tot_cost+=$item1["TOTALCOST"];
        $tot_val+=$item1["TOTALVALUE"];
        $pgroup=false;
    ?>
    <?php endforeach; ?>   
    <?php if($group!='') {?>
        <tr>
            <td></td>
            <td></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_holding,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_cost,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($tot_val,2,'.',",");?></strong></div></td>
        </tr>
    <?php }?> 
    </table>
    <?php }?>
<?php }?>
</div>
</body>
</html>