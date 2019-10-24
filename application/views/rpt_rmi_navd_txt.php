<?php foreach($r_data as $xitem) {
    echo "\"{$xitem['PortfolioName']}\",\"{$xitem['DESC']}\"," . date_format($xitem['VALDATE'],'m/d/Y');
    echo ","  . number_format(0+$xitem['AMOUNT'],0+$xitem['NAVDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['NAV'],0+$xitem['NAVDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['PRICE'],0+$xitem['PRICEDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['UNIT'],0+$xitem['UNITDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['RETURN1YEARACT'],4,'.','');
    echo ","  . number_format(0+$xitem['RETURN1YEAR'],4,'.','');
    echo ","  . number_format(0+$xitem['RETURN30DAYS'],4,'.','');
    echo ","  . date_format($xitem['DT_PY'],'m/d/Y');
    echo ","  . number_format(0+$xitem['NAV_PY'],0+$xitem['NAVDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['PRICE_PY'],0+$xitem['PRICEDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['UNIT_PY'],0+$xitem['UNITDECIMAL'],'.','');
    echo ","  . date_format($xitem['DT_LEM'],'m/d/Y');
    echo ","  . number_format(0+$xitem['NAV_LEM'],0+$xitem['NAVDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['PRICE_LEM'],0+$xitem['PRICEDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['UNIT_LEM'],0+$xitem['UNITDECIMAL'],'.','');
    echo ","  . date_format($xitem['DT_PD'],'m/d/Y');
    echo ","  . number_format(0+$xitem['NAV_PD'],0+$xitem['NAVDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['PRICE_PD'],0+$xitem['PRICEDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['UNIT_PD'],0+$xitem['UNITDECIMAL'],'.','');
    echo ","  . date_format($xitem['DT_LEY'],'m/d/Y');
    echo ","  . number_format(0+$xitem['NAV_LEY'],0+$xitem['NAVDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['PRICE_LEY'],0+$xitem['PRICEDECIMAL'],'.','');
    echo ","  . number_format(0+$xitem['UNIT_LEY'],0+$xitem['UNITDECIMAL'],'.','');
    echo "\r\n";
} ?>