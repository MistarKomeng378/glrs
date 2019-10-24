<?php 
$irow=1;foreach($r_data as $xitem) {
    echo "{$irow},";
    echo date_format(date_create($dt),'m/d/Y');
    echo ",\"{$xitem['PORTFOLIOCODE']}\",\"{$xitem['PortfolioName']}\",\"{$xitem['JENIS']}\"";
    echo "," . number_format((0+$xitem['CURRENTPRICE']),$xitem['PRICEDECIMAL'],'.','');
    echo "," . (0+$xitem['RETURN30DAYS']);
    echo "," . (0+$xitem['RETURN1YEAR']);
    echo "," . (0+$xitem['RETURN1YEARACT']);
    echo "\r\n";
    $irow++;
}
?>        