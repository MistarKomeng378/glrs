
<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
function getcontentxd11($data){
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
                <td colspan="3">LAPORAN AKTIVA DAN KEWAJIBAN REKSA DANA</td>
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
                <td colspan="2" align="center">LAPORAN AKTIVA DAN KEWAJIBAN</td>
                <td align="center">s/d Hari ini</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>
                <div>&nbsp;</div><div>&nbsp;</div>
                <div align="center">1</div><div align="center">2</div><div align="center">3</div><div align="center">4</div><div align="center">5</div>
                <div align="center">6</div><div align="center">7</div><div align="center">8</div><div align="center">9</div><div align="center">10</div>
                </td>
                <td>
                <div>&nbsp;</div>
                <div align="center">Aktiva</div>
                <div>Investasi dalam Instrumen Pasar Uang</div>
                <div>Investasi dalam Instrumen Hutang Lainnya</div>
                <div>Investasi dalam Saham</div>
                <div>Investasi dalam Waran dan Right</div>
                <div>K a s</div>
                <div>Piutang Deviden</div>
                <div>Piutang Bunga</div>
                <div>Piutang Efek yang Dijual</div>
                <div>Piutang Lainnya</div>
                <div>Aktiva Lain-lain (Pajak Dibayar Dimuka)</div>
                </td>
                <td>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="right">'.number_format($data['r_dataxd11']['3'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['4'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['5'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['6'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['7'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['8'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['9'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['10'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['11'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['12'],4,'.',',').'</div>
        
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">11</td>
                <td>TOTAL AKTIVA</td>
                <td><div align="right">'.number_format($data['r_dataxd11']['13'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>
                <div>&nbsp;</div><div>&nbsp;</div>
                <div align="center">12</div><div align="center">13</div>
                </td>
                <td>
                <div>&nbsp;</div>
                <div align="center">Kewajiban</div>
                <div>Utang Efek yang Dibeli</div>
                <div>Utang Lain-lain</div>
                </td>
                <td>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div align="right">'.number_format($data['r_dataxd11']['14'],4,'.',',').'</div>
                <div align="right">'.number_format($data['r_dataxd11']['15'],4,'.',',').'</div>
                </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">14</td>
                <td>TOTAL KEWAJIBAN</td>
                <td><div align="right">'.number_format($data['r_dataxd11']['16'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>&nbsp;</td>
                <td></td>
                <td></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td align="center">15</td>
                <td>TOTAL AKTIVA BERSIH</td>
                <td><div align="right">'.number_format($data['r_dataxd11']['17'],4,'.',',').'</div></td>
            </tr>
            <tr bgcolor="#ffffff">
            <td>
            <div>&nbsp;</div>
            <div align="center">16</div><div align="center">17</div><div align="center">18</div><div align="center">19</div><div align="center">20</div>
            <div align="center">21</div><div align="center">22</div><div align="center">23</div><div align="center">&nbsp;</div>
            <div align="center">24</div><div align="center">25</div>
            </td>
            <td>
            <div>&nbsp;</div>
            <div>Jumlah Saham/Unit Penyertaan yang diterbitkan</div>
            <div>Pelunasan/Pembelian Kembali Saham/Unit Penyertaan</div>
            <div>Akumulasi/Laba/Rugi sampai dengan tahun sebelumnya</div>
            <div>Pendapatan yang sudah didistribusikan</div>
            <div>Laba/Rugi yang belum direalisasikan</div>
            <div>Laba/Rugi yang sudah direalisasikan</div>
            <div>Pendapatan investasi Bersih</div>
            <div style="border-top:1px solid #000000 ; border-bottom: 1px double #000000;">TOTAL SAHAM/UNIT PENYERTAAN DAN LABA/RUGI</div>
            <div>&nbsp;</div>
            <div>Jumlah Saham/Unit Penyertaan yang Beredar</div>
            <div>Nilai Aktiva Bersih per saham/Unit Penyertaan</div>
            </td>
            <td>
            <div>&nbsp;</div> 
            <div align="right">'.number_format($data['r_dataxd11']['18'],4,'.',',').'</div>
            <div align="right">'.number_format($data['r_dataxd11']['19'],4,'.',',').'</div>
            <div align="right">'.number_format($data['r_dataxd11']['20'],4,'.',',').'</div>
            <div align="right">'.number_format($data['r_dataxd11']['21'],4,'.',',').'</div>
            <div align="right">'.number_format($data['r_dataxd11']['22'],4,'.',',').'</div>
            <div align="right">'.number_format($data['r_dataxd11']['23'],4,'.',',').'</div>
            <div align="right">'.number_format($data['r_dataxd11']['24'],4,'.',',').'</div>
            <div align="right" style="border-top:1px solid #000000 ; border-bottom: 1px double #000000;">'.number_format($data['r_dataxd11']['25'],4,'.',',').'</div>
            <div>&nbsp;</div>
            <div align="right">'.number_format($data['r_dataxd11']['26'],4,'.',',').'</div>
            <div align="right">'.number_format($data['r_dataxd11']['27'],4,'.',',').'</div>
            </td>
        </tr>
    </table>';
    return $xls;
    }
?>