 <hr />
    <table width="100%">                                         
        <tr>
            <td><b><?php echo $r_pf[0]["pfname"];?></b></td>
            <td align="right"><?php echo $r_pf[0]["fmname"];?></td>
        </tr>
        <tr>                                                                 
            <td colspan="2">DAILY GL BALANCE REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2"><?php echo  date_format(date_create($sdt),'F d, Y');?></td>
        </tr>
    </table><hr />
    <table width="100%">
    <?php 
    $type ='';
    $type_tot=0;
    $all_tot=0;
    $ptype=false;
    $ptype_tot=false;
    ?>
    <?php foreach ($r_data as $item1): ?>
        <?php 
            if($type!=$item1["ACCOUNTTYPE"])
            {
                if($type!='')
                    $ptype_tot = true;
                $ptype = true;
            }
        ?>
    <?php if($ptype_tot){ ?>        
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150">&nbsp;</td>
            <td width="300">&nbsp;</td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($type_tot,2,'.',","); ?></strong></div></td>
        </tr>
    <?php }if($ptype){ ?>
        
        <tr>
            <td colspan="4"><strong><?php echo $map_type[trim($item1["ACCOUNTTYPE"])];?></strong></td>
        </tr>
    <?php } ?>
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150"><?php echo $item1["ACCOUNTCODE"];?></td>
            <td width="300"><?php echo $item1["ACCOUNTNAME"];?></td>
            <td><div align="right"><?php echo number_format($item1["BALANCE"],2,'.',",");?></div></td>
        </tr>
    <?php
        if($ptype_tot)
            $type_tot = 0;   
        $ptype = false;
        $ptype_tot = false;
        $type=$item1["ACCOUNTTYPE"];
        $type_tot += $item1["BALANCE"];
        $all_tot += $item1["BALANCE"];
    ?>
    <?php endforeach; ?>    
    <?php if($type!='') {?>
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150">&nbsp;</td>
            <td width="300">&nbsp;</td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($type_tot,2,'.',","); ?></strong></div></td>
        </tr>
        <tr>
            <td width="50">&nbsp;</td>
            <td width="150">&nbsp;</td>
            <td width="300">&nbsp;</td>
            <td><div align="right" class="up_line"><strong><?php echo number_format($all_tot,2,'.',","); ?></strong></div></td>
        </tr>
    <?php } ?>
    </table>