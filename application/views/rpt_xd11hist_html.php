<html>
<head>
<title><?php echo "XD11_{$r_pf[0]['pfcode']}_" .  date_format(date_create($dt),'Ymd')  ?></title>
<style type="text/css">
  BODY, TD, TH {
  padding:0;
  margin:0;
  font-family: Geneva, Arial, Helvetica, sans-serif;
  font-size:   11px;
}

.up_line{
    border-top: 1px solid #969696;
}

.down_line{
    border-top: 1px dotted  #969696;
    border-bottom: 1px dotted #969696;    
}

.up_down_line{
    border-top: 1px dotted  #969696;
    border-bottom: 1px dotted #969696;    
}
</style>
</head>
<body>       
<?php $r=0;if(count($r_data)>0) $r=1;?>
<div style="width: 765px;">
    <img src="<?php echo $url;?>img/cimbniaga.jpg" alt=""> <br />
    <!--
    Peraturan Nomor X.D.1
    <table width="100%">                                         
        <tr>
            <td width="60%"></td>
            <td align="right">
                <table width="100%">
                    <td><b>Lampiran</b></td>
                    <td width="4"><b>:</b></td>
                    <td width="20"><b>1</b></td>
                </table>
            </td>
        </tr>
        <tr>
            <td><b>FORMULIR NOMOR : X.D.1-1</b></td>
            <td>
                <table width="100%">
                    <td>Peraturan No.</td>
                    <td width="4">:</td>
                    <td width="20">X.D.1</td>
                </table>
            </td>
        </tr>
    </table><Br />
    -->
    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#ffffff">
            <td colspan="3">LAPORAN AKTIVA DAN KEWAJIBAN REKSA DANA</td>
        </tr>
        <tr bgcolor="#ffffff">
            <td colspan="3">
                <table width="100%">
                    <tr>
                        <td width="200">Manager Investasi</td>
                        <td width="5">:</td>
                        <td><?php echo isset($r_pf[0]['fmname'])?$r_pf[0]['fmname']:'';?></td>
                    </tr>
                    <tr>
                        <td width="200">Bank Kustodian</td>
                        <td width="5">:</td>
                        <td>CIMB Niaga</td>
                    </tr>
                    <tr>
                        <td width="200">Nama Reksa Dana</td>
                        <td width="5">:</td>
                        <td><?php echo isset($r_pf[0]['pfname'])?$r_pf[0]['pfname']:'';?></td>
                    </tr>
                     <tr>
                        <td width="200">Jenis Reksa Dana</td>
                        <td width="5">:</td>
                        <td><?php echo isset($r_pf[0]['fkindname'])?$r_pf[0]['fkindname']:'';?></td>
                    </tr>
                    <tr>
                        <td width="200">Type Reksa Dana</td>
                        <td width="5">:</td>
                        <td><?php echo isset($r_pf[0]['ftypename'])?$r_pf[0]['ftypename']:'';?></td>
                    </tr>
                    <tr>
                        <td width="200">Tanggal</td>
                        <td width="5">:</td>
                        <td><?php echo date_format(date_create($dt),'F d, Y');?></td>
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
            <div align="right"><?php echo isset($r_data[0]['3'])?number_format($r_data[0]['3'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['4'])?number_format($r_data[0]['4'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['5'])?number_format($r_data[0]['5'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['6'])?number_format($r_data[0]['6'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['7'])?number_format($r_data[0]['7'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['8'])?number_format($r_data[0]['8'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['9'])?number_format($r_data[0]['9'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['10'])?number_format($r_data[0]['10'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['11'])?number_format($r_data[0]['11'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['12'])?number_format($r_data[0]['12'],4,'.',','):'&nbsp;';?></div>
            </td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">11</td>
            <td>TOTAL AKTIVA</td>
            <td><div align="right"><?php echo isset($r_data[0]['13'])?number_format($r_data[0]['13'],4,'.',','):'&nbsp;';?></div></td>
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
            <div align="right"><?php echo isset($r_data[0]['14'])?number_format($r_data[0]['14'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['15'])?number_format($r_data[0]['15'],4,'.',','):'&nbsp;';?></div>
            </td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">14</td>
            <td>TOTAL KEWAJIBAN</td>
            <td><div align="right"><?php echo isset($r_data[0]['16'])?number_format($r_data[0]['16'],4,'.',','):'&nbsp;';?></div></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">15</td>
            <td>TOTAL AKTIVA BERSIH</td>
            <td><div align="right"><?php echo isset($r_data[0]['17'])?number_format($r_data[0]['17'],4,'.',','):'&nbsp;';?></div></td>
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
            <div align="right"><?php echo isset($r_data[0]['18'])?number_format($r_data[0]['18'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['19'])?number_format($r_data[0]['19'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['20'])?number_format($r_data[0]['20'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['21'])?number_format($r_data[0]['21'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['22'])?number_format($r_data[0]['22'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['23'])?number_format($r_data[0]['23'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['24'])?number_format($r_data[0]['24'],4,'.',','):'&nbsp;';?></div>
            <div align="right" style="border-top:1px solid #000000 ; border-bottom: 1px double #000000;"><?php echo isset($r_data[0]['25'])?number_format($r_data[0]['25'],4,'.',','):'&nbsp;';?></div>
            <div>&nbsp;</div>
            <div align="right"><?php echo isset($r_data[0]['26'])?number_format($r_data[0]['26'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['27'])?number_format($r_data[0]['27'],4,'.',','):'&nbsp;';?></div>
            </td>
        </tr>
    </table>
</div>        
</body>
</html>