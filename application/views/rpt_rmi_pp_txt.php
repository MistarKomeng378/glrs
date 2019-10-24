<?php
$irow=1;foreach($r_data as $xitem) {
    echo date_format(date_create($dt),'m/d/Y');
    echo ",\"{$xitem['PortfolioCode']}\",\"{$xitem['PortfolioName']}\",\"{$xitem['FundManagerName']}\",{$xitem['nrow']},\"{$xitem['securitycode']}\",\"{$xitem['SecurityName']}\"";
    echo "," . (0+$xitem['procentage'])*100;
    echo "\r\n";
    $irow++;
}
?>        