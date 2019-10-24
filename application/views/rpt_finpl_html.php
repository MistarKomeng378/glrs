<html>
<head>
<title>Profit & Loss Report</title>
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
            <td colspan="2">INCOME STATEMENT REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr >
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><div align="right" class="up_down_line"><strong>CURRENT MONTH</strong></div></td>
            <td><div align="right" class="up_down_line"><strong>YEAR DATE</strong></div></td>
        </tr>
    <?php 
        $lvl1='';
        $ptot=false;
        $tot_month=0;
        $tot_year=0;
        $tot_month_all=0;
        $tot_year_all =0;
        $reset_tot=false;             
    ?>
    <?php foreach ($r_data as $item1): ?>
    <?php 
    if($lvl1!=$item1["LEVEL01CODE"])
    {
        if($lvl1!='')
            $ptot=true;
        $lvl1=$item1["LEVEL01CODE"];
    ?>
    <?php if($ptot) { ?>
        <tr>
            <td width="150"></td>
            <td width="300"></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format(-1*$tot_month,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format(-1*$tot_year,2,'.',",");?></strong></div></td>
        </tr>
    <?php 
        $tot_month=0;
        $tot_year=0;  
    }?>
<?php
    if($lvl1=='03'){
?>
        <tr>
            <td width="150"></td>
            <td width="300"></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(-1*$tot_month_all,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(-1*$tot_year_all,2,'.',",");?></strong></div></td>
        </tr>
<?php } ?>
        <tr>
            <td colspan="4"><strong><?php echo $item1["LEVEL01DESC"];?></strong></td>
        </tr>
    <?php } ?>
    <?php if($item1["CurrentMonth"]!=0 || $item1["YearToDate"]!=0) { ?>
        <tr>
            <td width="150"><?php echo $item1["ACCOUNTCODE"];?></td>
            <td width="300"><?php echo $item1["ACCOUNTNAME"];?></td>
            <td><div align="right"><?php echo number_format(-1*$item1["CurrentMonth"],2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format(-1*$item1["YearToDate"],2,'.',",");?></div></td>
        </tr>
    <?php } ?>
    <?php
        $tot_month+=$item1["CurrentMonth"];
        $tot_year+=$item1["YearToDate"]; 
        $tot_month_all+=$item1["CurrentMonth"];
        $tot_year_all+=$item1["YearToDate"];
    ?>                               
    <?php endforeach; ?>    
    <?php if($lvl1!='')  {?>
        <tr>
            <td width="150"></td>
            <td width="300"></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format(-1*$tot_month,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format(-1*$tot_year,2,'.',",");?></strong></div></td>
        </tr>
    <?php }?>
        <tr>
            <td width="150"></td>
            <td width="300" align="right"><b>PROFIT / LOSS</b></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(-1*$tot_month_all,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(-1*$tot_year_all,2,'.',",");?></strong></div></td>
        </tr>
    </table>
</div>
</body>
</html>