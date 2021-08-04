
<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
function getcontentxd12($data){
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
    $xls.='<table width="100%" bgcolor="#000000">
            <tr bgcolor="#ffffff">
                <td colspan="3">LAPORAN OPERASI REKSA DANA</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td colspan="3">
                    <table width="100%">
                    <tr>
                        <td width="200">Manager Investasi</td>
                        <td width="5">:</td>
                        <td>'.$data['r_pf']['fmname'].'</td>
                    </tr>
                    <tr>
                        <td width="200">Bank Kustodian</td>
                        <td width="5">:</td>
                        <td>CIMB Niaga</td>
                    </tr>
                    <tr>
                        <td width="200">Nama Reksa Dana</td>
                        <td width="5">:</td>
                        <td>'.$data['r_pf']['pfname'].'</td>
                    </tr>
                    <tr>
                        <td width="200">Jenis Reksa Dana</td>
                        <td width="5">:</td>
                        <td>'.$data['r_pf']['fkindname'].'</td>
                    </tr>
                    <tr>
                        <td width="200">Type Reksa Dana</td>
                        <td width="5">:</td>
                        <td>'.$data['r_pf']['ftypename'].'</td>
                    </tr>
                    <tr>
                        <td width="200">Tanggal</td>
                        <td width="5">:</td>
                        <td>'.date_format(date_create($data['dt']),'F d, Y').'</td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td colspan="2" align="center">LAPORAN OPERASI</td>
                <td align="center">s/d Hari ini</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr bgcolor="#E0E0E0">
                <td colspan="3" align="center">Pendapatan Investasi</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>            
                <div align="center">1</div><div align="center">2</div>
                </td>
                <td>
                <div>Dividen</div>
                <div>Bunga</div>
                </td>
                <td>
                <div align="right">'.number_format($data['r_dataxd12']['3'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd12']['4'],4,'.',',').'</div>
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">3</td>
                <td>TOTAL PENDAPATAN INVESTASI</td>
                <td><div align="right">'.number_format($data['r_dataxd12']['5'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr bgcolor="#E0E0E0">
                <td colspan="3" align="center">Biaya Pengelolaan Investasi</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>
                <div align="center">4</div><div align="center">5</div><div align="center">6</div><div align="center">7</div><div align="center">8</div>
                </td>
                <td>
                <div>Biaya Pengelolaan Investasi</div>
                <div>Biaya Kustodian</div>
                <div>Biaya Lain-lain</div>
                <div>Biaya Piutang Ragu-ragu</div>
                <div>Provisi Pajak</div>
                </td>
                <td>
                <div align="right">'.number_format($data['r_dataxd12']['6'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd12']['7'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd12']['8'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd12']['9'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd12']['10'],4,'.',',').'</div>
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">9</td>
                <td>TOTAL BIAYA</td>
                <td><div align="right">'.number_format($data['r_dataxd12']['11'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">10</td>
                <td>PENDAPATAN INVESTASI BERSIH</td>
                <td><div align="right">'.number_format($data['r_dataxd12']['12'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr bgcolor="#E0E0E0">
                <td colspan="3" align="center">Laba/Rugi yang direalisasikan dan yang belum direalisasikan</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>
                <div align="center">11</div><div align="center">12</div><div>&nbsp;</div>
                </td>
                <td>
                <div>Laba/Rugi Bersih Investasi</div>
                <div>Laba/Rugi yang belum direalisasikan</div>
                <div>&nbsp;</div>
                </td>
                <td>
                <div align="right">'.number_format($data['r_dataxd12']['13'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd12']['14'],4,'.',',').'</div>
                <div>&nbsp;</div>
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">13</td>
                <td>LABA/RUGI INVESTASI BERSIH</td>
                <td><div align="right">'.number_format($data['r_dataxd12']['15'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
            <td align="center">14</td>
            <td>PERNDAPAN OPERASI BERSIH</td>
            <td><div align="right">'.number_format($data['r_dataxd12']['16'],4,'.',',').'</div></td>
        </tr>
    </table>';
    return $xls;
    }
?>