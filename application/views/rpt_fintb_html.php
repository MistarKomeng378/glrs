<html>
<head>
<title>Trial Balance Report</title>
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
            <td colspan="2">TRIAL BALANCE REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($sdt),'F d, Y') . " to " . date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr >
            <td><div class="down_line"><strong>ACCOUNT DESCRIPTION</strong></div></td>
            <td><div class="down_line"><strong>ACCOUNT CODE</strong></div></td>
            <td><div align="right" class="down_line"><strong>OPENING BALANCE</strong></div></td>
            <td><div align="right" class="down_line"><strong>DEBIT</strong></div></td>
            <td><div align="right" class="down_line"><strong>KREDIT</strong></div></td>
            <td><div align="right" class="down_line"><strong>ENDING BALANCE</strong></div></td>
        </tr>
    <?php 
        $grpno='';
        $grpdesc='';
        
        $tot_start=0;
        $tot_d=0;
        $tot_k=0;
        $tot_end=0;
        
        $tot_asset=0;
        $tot_liabilities=0;
        
        $tot_all_d =0;
        $tot_all_k=0;
        
        $tot_grp= false;
    ?>
    <?php foreach ($r_data as $item1): ?>
    <?php 
    if($grpno!=$item1["GROUPPF"])
    {
        if($grpno!='')
            $tot_grp=true;
        if($grpno=='1')
            $tot_asset = $tot_end;
        if($grpno=='2')
            $tot_liabilities = $tot_end; 
    ?>
    <?php if($tot_grp) { ?>
        <tr>
            <td><strong><?php echo $grpdesc;?> </strong></td>
            <td></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format($tot_start,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(abs($tot_d),2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(abs($tot_k),2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format($tot_end,2,'.',",");?></strong></div></td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
    <?php 
        $tot_start = 0;
        $tot_d = 0;
        $tot_k = 0;
        $tot_end = 0;
    }
    ?>
    <?php 
        $grpno = $item1["GROUPPF"];
        $grpdesc = $item1["GROUPPFDESC"];
    }?>             
    <?php if ($item1["STARTBALANCE"]!=0  ||  $item1["DEBET"]!=0 ||  $item1["KREDIT"] !=0 || $item1["ENDBALANCE"] !=0 ){ ?>
        <tr>
            <td><?php echo $item1["ACCOUNTNAME"];?></td>
            <td><?php echo $item1["ACCOUNTCODE"];?></td>
            <td><div align="right"><?php echo number_format($item1["STARTBALANCE"],2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format(abs($item1["DEBET"]),2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format(abs($item1["KREDIT"]),2,'.',",");?></div></td>
            <td><div align="right"><?php echo number_format($item1["ENDBALANCE"],2,'.',",");?></div></td>
        </tr>
    <?php }?>
    <?php
        $tot_start +=$item1["STARTBALANCE"];
        $tot_d +=$item1["DEBET"];
        $tot_k +=$item1["KREDIT"];
        $tot_end +=$item1["ENDBALANCE"];
        $tot_all_d+=$item1["DEBET"];
        $tot_all_k +=$item1["KREDIT"];
    ?>                               
    <?php endforeach; ?>    
    <?php if($grpno!='')  {?>
        <tr>
            <td></td>
            <td></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format($tot_start,2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(abs($tot_d),2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(abs($tot_k),2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format($tot_end,2,'.',",");?></strong></div></td>
        </tr>
    <?php }?>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(abs($tot_all_d),2,'.',",");?></strong></div></td>
            <td><div align="right" class="up_down_line"><strong><?php echo number_format(abs($tot_all_k),2,'.',",");?></strong></div></td>
            <td></td>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" align="right"><b>NET ASSETS</b></td> 
            <td><div align="right" class="bottom_line_dot"><strong><?php echo number_format($tot_asset,2,'.',",");?></strong></div></td>
        </tr>
        <tr>
            <td colspan="5" align="right"><b>NET LIABILITIES</b></td> 
            <td><div align="right" class="bottom_line_dot"><strong><?php echo number_format($tot_liabilities,2,'.',",");?></strong></div></td>
        </tr>
        <tr>
            <td colspan="5" align="right"><b>NET ASSETS VALUE</b></td> 
            <td><div align="right" class="bottom_line_dot"><strong><?php echo number_format( ($tot_asset+$tot_liabilities),2,'.',",");?></strong></div></td>
        </tr> 
    </table>
</div>
</body>
</html>