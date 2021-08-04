
<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
function getcontentbs($data){
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
                <td colspan="2">BALANCE SHEET REPORT</td>
            </tr>
            <tr>                                                                 
                <td colspan="2">'.date_format(date_create($data['dt']),'F d, Y').'</td>
            </tr>
        </table><hr />';
    $xls.='<table width="100%">';
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

    foreach ($data['r_data'] as $item1):
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
                $nav+=$item1["BALANCE"];
                if($ptot2){
                $xls.='<tr>
                <td width="50">&nbsp;</td>
                <td width="150">&nbsp;</td>
                <td width="300">&nbsp;</td>
                <td><div align="right" class="up_line">'.number_format($lvl2tot,2,'.',",").'</div></td>
                </tr>';
                }
                if($ptot1){
                $xls.='<tr>
                <td width="50">&nbsp;</td>
                <td width="150">&nbsp;</td>
                <td width="300"><div align="right"><strong>'.$lvl1desc.'</strong></td>
                <td><div align="right" class="up_line"><strong>'.number_format($lvl1tot,2,'.',",").'</strong></div></td>
                </tr>';
                }
                if($plvl1){
                $xls.='<tr>
                    <td colspan="4"><strong>'.$item1["LEVEL01DESC"].'</strong></td>
                </tr>';
                }
                if($plvl2){
                $xls.='<tr>
                    <td width="50">&nbsp;</td>
                    <td colspan="3"><strong>'.$item1["LEVEL02DESC"].'</strong></td>
                </tr>';
                }
                if($item1["BALANCE"]!=0) {
                $xls.='<tr>
                    <td width="50">&nbsp;</td>
                    <td width="150">'.$item1["ACCOUNTCODE"].'</td>
                    <td width="300">'.$item1["ACCOUNTNAME"].'</td>
                    <td><div align="right">'.number_format($item1["BALANCE"],2,'.',",").'</div></td>
                </tr>';  

                }
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

                endforeach;
                if($lvl2!='') {
                $xls.='<tr>
                <td width="50">&nbsp;</td>
                <td width="150">&nbsp;</td>
                <td width="300">&nbsp;</td>
                <td><div align="right" class="up_line">'.number_format($lvl2tot,2,'.',",").'</div></td>
                </tr>'; 

                }
                if($lvl1!=''){
                $xls.='<tr>
                    <td width="50">&nbsp;</td>
                    <td width="150">&nbsp;</td>
                    <td width="300"><div align="right"><strong>'.$lvl1desc.'</strong></td>
                    <td><div align="right" class="up_line"><strong>'.number_format($lvl1tot,2,'.',",").'</strong></div></td>
                </tr>';

                }
                $xls.='</table><p></p>';
                $xls.='<table width="100%">
                <tr>
                    <td width="200">&nbsp;</td>
                    <td>
                        <div style="border:1px solid #000000; padding: 5px;">
                            <table width="100%">
                                <tr>
                                    <td><b>Total Net Asset Value</b></td>
                                    <td align="right"><b>'.number_format($nav,2,'.',",").'</b></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>';
    return $xls;
    }
?>