<html>
<head>
<title>Balance Sheet Report</title>
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
            <td colspan="2">BALANCE SHEET REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table> <hr />
    <table width="100%">
    <?php 
    $nav=0;
    $lvl1 ='';
    $lvl2 = '';
    $lvl1desc = '';
    $lvl2desc='';
    $lvl1tot=0;
    $lvl2tot=0;
    $plvl1=false;
    $plvl2=false;
    $ptot1=false;
    $ptot2=false;
    ?>
    <?php foreach ($r_data as $item1): ?>
        <?php 
            if($lvl1!=$item1["LEVEL01CODE"])
            {
                if($lvl2!='')
                    $ptot2 = true;
                if($lvl1!='')
                    $ptot1=true;
                $lvl2='';
                $plvl1=true;
            }
            if($lvl2!=$item1["LEVEL02CODE"])
            {
                if($lvl2!='')
                    $ptot2 = true;
                $plvl2=true;
            }
            if( ($item1["LEVEL01CODE"]=='01' && $item1["LEVEL02CODE"]=='01' ) || ($item1["LEVEL01CODE"]=='02' && $item1["LEVEL02CODE"]=='02'))
                $nav+=$item1["BALANCE"]
        ?>
    <?php if($ptot2){ ?>        
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150">&nbsp;</td>
            <td width="300">&nbsp;</td>
            <td><div align="right" class="up_line"><?php echo number_format($lvl2tot,2,'.',","); ?></div></td>
        </tr>
    <?php }if($ptot1){ ?>
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150">&nbsp;</td>
            <td width="300"><div align="right"><strong><?php echo $lvl1desc;?></strong></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($lvl1tot,2,'.',","); ?></strong></div></td>
        </tr>
    <?php }if($plvl1){ ?>
        <tr>
            <td colspan="4"><strong><?php echo $item1["LEVEL01DESC"];?></strong></td>
        </tr>
    <?php }if($plvl2){ ?>
        <tr>
            <td width="50">&nbsp;</td>
            <td colspan="3"><strong><?php echo $item1["LEVEL02DESC"];?></strong></td>
        </tr>
    <?php } ?>
    <?php if($item1["BALANCE"]!=0) { ?>
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150"><?php echo $item1["ACCOUNTCODE"];?></td>
            <td width="300"><?php echo $item1["ACCOUNTNAME"];?></td>
            <td><div align="right"><?php echo number_format($item1["BALANCE"],2,'.',",");?></div></td>
        </tr>
    <?php }?>
    <?php
        if($ptot2)
            $lvl2tot = 0;   
        if($ptot1)
            $lvl1tot = 0;
        $plvl1=false;
        $plvl2=false;
        $ptot1=false;
        $ptot2=false;
        $lvl1=$item1["LEVEL01CODE"];
        $lvl1desc = $item1["LEVEL01DESC"];
        $lvl2=$item1["LEVEL02CODE"];
        $lvl2desc = $item1["LEVEL02DESC"];
        $lvl1tot += $item1["BALANCE"];
        $lvl2tot += $item1["BALANCE"];
    ?>
    <?php endforeach; ?>    
    <?php if($lvl2!='') {?>
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150">&nbsp;</td>
            <td width="300">&nbsp;</td>
            <td><div align="right" class="up_line"><?php echo number_format($lvl2tot,2,'.',","); ?></div></td>
        </tr>
    <?php } if($lvl1!=''){?>
         <tr>
            <td width="50">&nbsp;</td>
            <td width="150">&nbsp;</td>
            <td width="300"><div align="right"><strong><?php echo $lvl1desc;?></strong></td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($lvl1tot,2,'.',","); ?></strong></div></td>
        </tr>
    <?php } ?>
    </table>
    <p></p>
    <table width="100%">
        <tr>
            <td width="200">&nbsp;</td>
            <td>
                <div style="border:1px solid #000000; padding: 5px;">
                    <table width="100%">
                        <tr>
                            <td><b>Total Net Asset Value</b></td>
                            <td align="right"><b><?php echo number_format($nav,2,'.',",");?></b></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table> 
</div>
</body>
</html>