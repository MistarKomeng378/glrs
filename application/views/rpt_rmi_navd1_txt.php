"FUND CODE","DATE",,AUM,NAV_PERUNIT,TOT_UNIT,EQUITIES,FI_GOV,FI_CORP,LIQ_CASH,LIQ_TD,OTHERS_ASET,MGT_FEE,CUS_FEE,AUD_FEE,OTHERS_LIABIl,TOT_ASET,EQT_PCT_ASSET,EQT_PCT_AUM,FI_PCT_ASSET,FI_PCT_AUM,LIQ_PCT_ASSET,LIQ_PCT_AUM
<?php foreach($r_data as $xitem) {?>
<?php 
    echo "\"{$xitem['PortfolioCode']}\"";
    echo ",\"" . date_format($xitem['VALDATE'],'m/d/Y') . "\"";
    echo "," .  number_format(0+$xitem['AUM'],4,'.','');
    echo "," .  number_format(0+$xitem['NAV_PER_UNIT'],4,'.','');
    echo "," .  number_format(0+$xitem['TOT_UNIT'],4,'.','');
    echo "," .  number_format(0+$xitem['EQUITIES'],4,'.','');
    echo "," .  number_format(0+$xitem['FI_Govt'],4,'.','');
    echo "," .  number_format(0+$xitem['FI_Corp'],4,'.','');
    echo "," .  number_format(0+$xitem['CASH'],4,'.','');
    echo "," .  number_format(0+$xitem['TD'],4,'.','');
    echo "," .  number_format(0+$xitem['OTHERS_ASET'],4,'.','');
    echo "," .  number_format(0+$xitem['MGT_FEE'],4,'.','');
    echo "," .  number_format(0+$xitem['CUST_FEE'],4,'.','');
    echo "," .  number_format(0+$xitem['AUD_FEE'],4,'.','');
    echo "," .  number_format(0+$xitem['OTHERS_FEE'],4,'.','');
    echo "," .  number_format(0+$xitem['TOT_ASET'],4,'.','');
    echo "," .  number_format(0+$xitem['EQ_PCT_ASET'],4,'.','');
    echo "," .  number_format(0+$xitem['EQ_PCT_AUM'],4,'.','');
    echo "," .  number_format(0+$xitem['FI_PCT_ASET'],4,'.','');
    echo "," .  number_format(0+$xitem['FI_PCT_AUM'],4,'.','');
    echo "," .  number_format(0+$xitem['LIQ_PCT_ASET'],4,'.','');
    echo "," .  number_format(0+$xitem['LIQ_PCT_AUM'],4,'.','');
} ?>