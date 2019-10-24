<html>
<head>
<title>NAV Changes Report</title>
<style type="text/css">
  BODY, TD {
  padding:0;
  margin:0;
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size:   11px;
}

.up_line{
    border-top: 1px dotted #969696;
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
            <td colspan="2">NAV CHANGES REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($sdt),'F d, Y') . " to " . date_format(date_create($dt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>           
            <td class="down_line"><div align="right"><b><?php echo date_format(date_create($sdt),'d M Y');?></b></div></td>
            <td class="down_line"><div align="right"><b>MOVEMENT</b></div></td>
            <td class="down_line"><div align="right"><b><?php echo date_format(date_create($dt),'d M Y');?></b></div></td>
        </tr>
    <?php 
    
    $lvl1 ='';
    $lvl1desc='';
    $plvl1=false;
    $plvl1desc=false;
    $nav1_tot = 0;
    $nav2_tot = 0;
    $nav1_tot_all = 0;
    $nav2_tot_all = 0;
    ?>
    <?php foreach ($r_data as $item1): ?>
    <?php if($item1["LEVEL02CODE"]!='') { ?>
        <?php 
            if($lvl1!=$item1["LEVEL01CODE"])
            {
                if($lvl1!='')
                    $plvl1=true;
                $plvl1desc=true;
                $lvl1= $item1["LEVEL01CODE"];
            }       
        ?>
    <?php if($plvl1){ ?>        
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>           
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*$nav1_tot,3,'.',","); ?></b></div></td>
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*($nav2_tot-$nav1_tot),3,'.',","); ?></b></div></td>
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*$nav2_tot,3,'.',","); ?></b></div></td>
        </tr>
    <?php } if($plvl1desc){ ?>        
        <tr>
            <td colspan="5"><strong><?php echo $item1["LEVEL01DESC"];?></strong></td>
        </tr>
    <?php } ?>
        
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $item1["LEVEL02DESC"];?></td>           
            <td><div align="right"><?php echo number_format(-1*$item1["NAV1"],3,'.',","); ?></div></td>
            <td><div align="right"><?php echo number_format(-1*($item1["NAV2"]-$item1["NAV1"]),3,'.',","); ?></div></td>
            <td><div align="right"><?php echo number_format(-1*$item1["NAV2"],3,'.',","); ?></div></td>
        </tr>
    <?php 
        if($plvl1)
        {
            $nav1_tot =0;
            $nav2_tot =0;
        }
        $plvl1desc=false;
        $plvl1 = false;
        //if($item1["LEVEL01CODE"]!='00')
        $nav1_tot += $item1["NAV1"];
        $nav2_tot += $item1["NAV2"];
        $nav1_tot_all += $item1["NAV1"];
        $nav2_tot_all += $item1["NAV2"];
        $pdetail=true;  
        $pspec = false; 
    }
    ?>
    <?php endforeach; ?> 
    <?php if($lvl1!=''){ ?>        
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>           
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*$nav1_tot,3,'.',","); ?></b></div></td>
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*($nav2_tot-$nav1_tot),3,'.',","); ?></b></div></td>
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*$nav2_tot,3,'.',","); ?></b></div></td>
        </tr>
    <?php }?>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>           
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*$nav1_tot_all,3,'.',","); ?></b></div></td>
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*($nav2_tot_all-$nav1_tot_all),3,'.',","); ?></b></div></td>
            <td><div align="right" class="up_line"><b><?php echo number_format(-1*$nav2_tot_all,3,'.',","); ?></b></div></td>
        </tr>
    </table>
</div>
</body>
</html>