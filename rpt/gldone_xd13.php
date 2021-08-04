
<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
function getcontentxd13($data){
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
                <td colspan="3">LAPORAN PERUBAHAN AKTIVA BERSIH</td>
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
            <tr bgcolor="#E0E0E0">
                <td colspan="3" align="center">Pendapatan Investasi</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>            
                <div align="center">NO.</div>
                <div align="center">&nbsp;</div>
                <div align="center">1</div>
                <div align="center">2</div>
                <div align="center">3</div>
                <div align="center">4</div>
                </td>
                <td>
                <div style="background-color: E0E0E0;">&nbsp;</div>
                <div style="background-color: E0E0E0;" align="center">Perubahan Kekayaan Bersih dari Hasil Operasi</div>
                <div>Pendapatan Investasi Bersih</div>
                <div>Laba/Rugi Realisasi Bersih Investasi</div>
                <div>Penyesuaian Atas Akumulasi Laba/Rugi sampai dengan tahun sebelumnya</div>
                <div>Perubahan atas kenaikan yang tidak direalisasikan</div>
                </td>
                <td>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="right">'.number_format($data['r_dataxd13']['3'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd13']['4'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd13']['5'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd13']['6'],4,'.',',').'</div>
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">5</td>
                <td>T O T A L</td>
                <td><div align="right">'.number_format($data['r_dataxd13']['7'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>            
                <div align="center">&nbsp;</div>
                <div align="center">&nbsp;</div>
                <div align="center">6</div>
                <div align="center">7</div>
                <div align="center">8</div>
                </td>
                <td>
                <div style="background-color: E0E0E0;">&nbsp;</div>
                <div style="background-color: E0E0E0;" align="center">Transaksi untuk Pemegang Saham/ Unit Penyertaan</div>
                <div>Distribusi kepada Pemegang Saham/Unit Penyertaan</div>
                <div>Penjualan Saham/Unit Penyertaan</div>
                <div>Pembelian Kembali Saham/Unit Penyertaan</div>
                </td>
                <td>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="right">'.number_format($data['r_dataxd13']['8'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd13']['9'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd13']['10'],4,'.',',').'</div>
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">9</td>
                <td>PERUBAHAN KEKAYAAN BERSIH</td>
                <td><div align="right"'.number_format($data['r_dataxd13']['11'],4,'.',',').'</div></td>
            </tr>
    </table>';
    return $xls;
    }
?>