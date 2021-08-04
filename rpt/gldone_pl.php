
<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
function getcontentpl($data){
    $xls='';
    $xls.='<style type="text/css">
    table{
        font-size:.8em;
    }
    .login{
        padding:0px;
        background-color: #F0F0F0;   
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
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
    </style>';
    $xls.='<hr />
        <table width="100%">                                         
            <tr>
                <td><b>'.$data['r_pf']['pfname'].'</b></td>
                <td align="right">'.$data['r_pf']['fmname'].'</td>
            </tr>
            <tr>                                                                 
                <td colspan="2">INCOME STATEMENT REPORT</td>
            </tr>
            <tr>                                                                 
                <td colspan="2">'.date_format(date_create($data['dt']),'F d, Y').'</td>
            </tr>
        </table><hr />';
    $xls.='<table width="100%">
            <tr >
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><div align="right" class="up_down_line"><strong>CURRENT MONTH</strong></div></td>
                <td><div align="right" class="up_down_line"><strong>YEAR DATE</strong></div></td>
            </tr>';
    $lvl1='';
    $ptot=false;
    $tot_month=0;
    $tot_year=0;
    $tot_month_all=0;
    $tot_year_all =0;
    $reset_tot=false;

    foreach ($data['r_data'] as $item1):
        if($lvl1!=$item1["LEVEL01CODE"])
        {
            if($lvl1!='')
            $ptot=true;
            $lvl1=$item1["LEVEL01CODE"];

            if($ptot) {
                $xls.='<tr>
                <td width="150"></td>
                <td width="300"></td>
                <td><div align="right" class="up_line"><strong>'.number_format(-1*$tot_month,2,'.',",").'</strong></div></td>
                <td><div align="right" class="up_line"><strong>'.number_format(-1*$tot_year,2,'.',",").'</strong></div></td>
                </tr>';
                $tot_month=0;
                $tot_year=0;  
            }
            if($lvl1=='03'){
                $xls.='<tr>
                <td width="150"></td>
                <td width="300"></td>
                <td><div align="right" class="up_down_line"><strong>'.number_format(-1*$tot_month_all,2,'.',",").'</strong></div></td>
                <td><div align="right" class="up_down_line"><strong>'.number_format(-1*$tot_year_all,2,'.',",").'</strong></div></td>
                </tr>';
            }
            $xls.='<tr>
                        <td colspan="4"><strong>'.$item1["LEVEL01DESC"].'</strong></td>
                    </tr>';

        }
        if($item1["CurrentMonth"]!=0 || $item1["YearToDate"]!=0) {
            $xls.='<tr>
                <td width="150">'.$item1["ACCOUNTCODE"].'</td>
                <td width="300">'.$item1["ACCOUNTNAME"].'</td>
                <td><div align="right">'.number_format(-1*$item1["CurrentMonth"],2,'.',",").'</div></td>
                <td><div align="right">'.number_format(-1*$item1["YearToDate"],2,'.',",").'</div></td>
            </tr>';
        }
        $tot_month+=$item1["CurrentMonth"];
        $tot_year+=$item1["YearToDate"]; 
        $tot_month_all+=$item1["CurrentMonth"];
        $tot_year_all+=$item1["YearToDate"];
    endforeach;
    if($lvl1!=''){
        $xls.='<tr>
                <td width="150"></td>
                <td width="300"></td>
                <td><div align="right" class="up_line"><strong>'.number_format(-1*$tot_month,2,'.',",").'</strong></div></td>
                <td><div align="right" class="up_line"><strong>'.number_format(-1*$tot_year,2,'.',",").'</strong></div></td>
            </tr>';
    }
    $xls.='<td width="150"></td>
            <td width="300" align="right"><b>PROFIT / LOSS</b></td>
            <td><div align="right" class="up_down_line"><strong>'.number_format(-1*$tot_month_all,2,'.',",").'</strong></div></td>
            <td><div align="right" class="up_down_line"><strong>'.number_format(-1*$tot_year_all,2,'.',",").'</strong></div></td>
        </tr>
        </table>';
    return $xls;
    }
?>