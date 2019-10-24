<?php 
$irow=1;foreach($r_data as $xitem) {
    echo substr($xitem['PortfolioName'] . '                                                   ',0,50);
    echo "," .  number_format(0+$xitem['NAVINVESTMENT'],4,'.','');
    echo "\r\n";
}
?>