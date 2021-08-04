
<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
function getcontent($data){
    // print_r($data['r_pf']['pfname']);
    // die();
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
            <td colspan="2">TRIAL BALANCE REPORT</td>
        </tr>
        <tr>                                                                 
            <td colspan="2">'.date_format(date_create($data->sdt),'F d, Y') . ' to '. date_format(date_create($data->dt),'F d, Y').'</td>
        </tr>
    </table><hr />';
    $xls.='<table width="100%">
            <tr >
                <td><div class="down_line"><strong>ACCOUNT DESCRIPTION</strong></div></td>
                <td><div class="down_line"><strong>ACCOUNT CODE</strong></div></td>
                <td><div align="right" class="down_line"><strong>OPENING BALANCE</strong></div></td>
                <td><div align="right" class="down_line"><strong>DEBIT</strong></div></td>
                <td><div align="right" class="down_line"><strong>KREDIT</strong></div></td>
                <td><div align="right" class="down_line"><strong>ENDING BALANCE</strong></div></td>
            </tr>';
    $grpno='';
    $grpdesc='';
    
    $tot_start=0;
    $tot_d=0;
    $tot_k=0;
    $tot_end=0;
    
    $tot_asset=0;
    $tot_liabilities=0;
    
    $tot_all_d =0;
    $tot_all_k=0;
    
    $tot_grp= false;   
    // print_r($data['r_data']);
    foreach ($data['r_data'] as $item1):
    if($grpno!=$item1["GROUPPF"])
    {
    if($grpno!='')
        $tot_grp=true;
    if($grpno=='1')
        $tot_asset = $tot_end;
    if($grpno=='2')
        $tot_liabilities = $tot_end;

    if($tot_grp) {
    $xls.='<tr>
            <td><strong><?php echo $grpdesc;?> </strong></td>
            <td></td>
            <td><div align="right" class="up_down_line"><strong>'.number_format($tot_start,2,'.',",").'</strong></div></td>
            <td><div align="right" class="up_down_line"><strong>'.number_format(abs($tot_d),2,'.',",").'</strong></div></td>
            <td><div align="right" class="up_down_line"><strong>'.number_format(abs($tot_k),2,'.',",").'</strong></div></td>
            <td><div align="right" class="up_down_line"><strong>'.number_format($tot_end,2,'.',",").'</strong></div></td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>';
        $tot_start = 0;
        $tot_d = 0;
        $tot_k = 0;
        $tot_end = 0;
    }
        $grpno = $item1["GROUPPF"];
        $grpdesc = $item1["GROUPPFDESC"];
    }
    if ($item1["STARTBALANCE"]!=0  ||  $item1["DEBET"]!=0 ||  $item1["KREDIT"] !=0 || $item1["ENDBALANCE"] !=0 ){
        $xls.='<tr>
        <td>'.$item1["ACCOUNTNAME"].'</td>
        <td>'.$item1["ACCOUNTCODE"].'</td>
        <td><div align="right">'.number_format($item1["STARTBALANCE"],2,'.',",").'</div></td>
        <td><div align="right">'.number_format(abs($item1["DEBET"]),2,'.',",").'</div></td>
        <td><div align="right">'.number_format(abs($item1["KREDIT"]),2,'.',",").'</div></td>
        <td><div align="right">'.number_format($item1["ENDBALANCE"],2,'.',",").'</div></td>
    </tr>';
    }
        $tot_start +=$item1["STARTBALANCE"];
        $tot_d +=$item1["DEBET"];
        $tot_k +=$item1["KREDIT"];
        $tot_end +=$item1["ENDBALANCE"];
        $tot_all_d+=$item1["DEBET"];
        $tot_all_k +=$item1["KREDIT"];
    endforeach;
    if($grpno!='')  {
        $xls.='<tr>
        <td></td>
        <td></td>
        <td><div align="right" class="up_down_line"><strong>'.number_format($tot_start,2,'.',",").'</strong></div></td>
        <td><div align="right" class="up_down_line"><strong>'.number_format(abs($tot_d),2,'.',",").'</strong></div></td>
        <td><div align="right" class="up_down_line"><strong>'.number_format(abs($tot_k),2,'.',",").'</strong></div></td>
        <td><div align="right" class="up_down_line"><strong>'.number_format($tot_end,2,'.',",").'</strong></div></td>
    </tr>';

    }
        $xls.='<tr>
        <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><div align="right" class="up_down_line"><strong>'.number_format(abs($tot_all_d),2,'.',",").'</strong></div></td>
        <td><div align="right" class="up_down_line"><strong>'.number_format(abs($tot_all_k),2,'.',",").'</strong></div></td>
        <td></td>
    <tr>
        <td colspan="6">&nbsp;</td>
    </tr>
    </tr>
    <tr>
        <td colspan="5" align="right"><b>NET ASSETS</b></td> 
        <td><div align="right" class="bottom_line_dot"><strong>'.number_format($tot_asset,2,'.',",").'</strong></div></td>
    </tr>
    <tr>
        <td colspan="5" align="right"><b>NET LIABILITIES</b></td> 
        <td><div align="right" class="bottom_line_dot"><strong>'.number_format($tot_liabilities,2,'.',",").'</strong></div></td>
    </tr>
    <tr>
        <td colspan="5" align="right"><b>NET ASSETS VALUE</b></td> 
        <td><div align="right" class="bottom_line_dot"><strong>'.number_format( ($tot_asset+$tot_liabilities),2,'.',",").'</strong></div></td>
    </tr>
</table>';
    return $xls;
    }
?>