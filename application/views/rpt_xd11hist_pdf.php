
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title><?php echo "XD11_{$r_pf[0]['pfcode']}_" .  date_format(date_create($dt),'Ymd')  ?></title>
<style type="text/css">

@page {
    margin: 2cm;
}

body {
  font-family: Arial;
    margin: 1cm 0;
    text-align: justify;
    font-size: 9pt;
}

#header,
#footer {
  position: fixed;
  left: 0;
    right: 0;
    color: #aaa;
    font-size: 0.9em;
}

#header {
  top: 0;
    border-bottom: 0.1pt solid #aaa;
}

#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}

#header table,
#footer table {
    width: 100%;
    border-collapse: collapse;
    border: none;
}

#header td,
#footer td {
  padding: 0;
    width: 50%;
}

.page-number {
  text-align: center;
}

.page-number:before {
  content: "Page " counter(page);
}

hr {
  page-break-after: always;
  border: 0;
}
#dc td {
    padding:0;margin: 0;
}
</style>
  
</head>

<body>

<div id="header">
  <table>
    <tr>
      <td><img src="img/cimb.png" /><br /></td>
      <td style="text-align: right;">Laporan Reksa Dana</td>
    </tr>
  </table>
</div>

<div id="footer">
  <div class="page-number"></div>
</div>     

<?php $r=0;if(count($r_data)>0) $r=1;?>
<table width="100%" bgcolor="#585858" style="margin: 0; padding: 0;" cellpadding="0" cellspacing="0" border="0">
    <tr bgcolor="#ffffff">
        <td colspan="3">LAPORAN AKTIVA DAN KEWAJIBAN REKSA DANA</td>
    </tr>
    <tr bgcolor="#ffffff">
        <td colspan="3">
            <table>
                <tr>
                    <td width="120">Manager Investasi</td>
                    <td width="5">:</td>
                    <td><?php echo isset($r_pf[0]['fmname'])?$r_pf[0]['fmname']:'';?></td>
                </tr>
                <tr>
                    <td>Bank Kustodian</td>
                    <td>:</td>
                    <td>CIMB Niaga</td>
                </tr>
                <tr>
                    <td>Nama Reksa Dana</td>
                    <td>:</td>
                    <td><?php echo isset($r_pf[0]['pfname'])?$r_pf[0]['pfname']:'';?></td>
                </tr>
                <tr>
                    <td>Jenis Reksa Dana</td>
                    <td>:</td>
                    <td><?php echo isset($r_pf[0]['fkindname'])?$r_pf[0]['fkindname']:'';?></td>
                </tr>
                <tr>
                    <td>Type Reksa Dana</td>
                    <td>:</td>
                    <td><?php echo isset($r_pf[0]['ftypename'])?$r_pf[0]['ftypename']:'';?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?php echo date_format(date_create($dt),'F d, Y');?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="100%" bgcolor="#585858" style="margin: 0; padding: 0;" cellpadding="0" cellspacing="0" border="0">
    <tr bgcolor="#ffffff">
        <td colspan="2" align="center">LAPORAN AKTIVA DAN KEWAJIBAN</td>
        <td width="140" align="center">s/d Hari ini</td>
    </tr>
    <tr bgcolor="#ffffff">
        <td width="30" align="center">
            <div>&nbsp;</div>
            <div align="center">1</div><div align="center">2</div><div align="center">3</div><div align="center">4</div><div align="center">5</div>
            <div align="center">6</div><div align="center">7</div><div align="center">8</div><div align="center">9</div><div align="center">10</div>
        </td>
        <td>
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
        <td align="right">
            <div>&nbsp;</div>
            <div align="right"><?php echo isset($r_data[0]['3'])?number_format($r_data[0]['3'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['4'])?number_format($r_data[0]['4'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['5'])?number_format($r_data[0]['5'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['6'])?number_format($r_data[0]['6'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['7'])?number_format($r_data[0]['7'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['8'])?number_format($r_data[0]['8'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['9'])?number_format($r_data[0]['9'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['10'])?number_format($r_data[0]['10'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['11'])?number_format($r_data[0]['11'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['12'])?number_format($r_data[0]['12'],2,'.',','):'&nbsp;';?></div>
        </td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">11</td>
        <td>TOTAL AKTIVA</td>
        <td align="right"><div align="right"><?php echo isset($r_data[0]['13'])?number_format($r_data[0]['13'],2,'.',','):'&nbsp;';?></div></td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">
            <div>&nbsp;</div>
            <div align="center">12</div><div align="center">13</div>
        </td>
        <td>
            <div align="center">Kewajiban</div>
            <div>Utang Efek yang Dibeli</div>
            <div>Utang Lain-lain</div>
        </td>
        <td align="right">
            <div>&nbsp;</div>
            <div align="right"><?php echo isset($r_data[0]['14'])?number_format($r_data[0]['14'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['15'])?number_format($r_data[0]['15'],2,'.',','):'&nbsp;';?></div>
        </td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">14</td>
        <td>TOTAL KEWAJIBAN</td>
        <td align="right"><?php echo isset($r_data[0]['16'])?number_format($r_data[0]['16'],2,'.',','):'&nbsp;';?></div></td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">15</td>
        <td>TOTAL AKTIVA BERSIH</td>
        <td align="right"><?php echo isset($r_data[0]['17'])?number_format($r_data[0]['17'],2,'.',','):'&nbsp;';?></div></td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">
            <div align="center">16</div><div align="center">17</div><div align="center">18</div><div align="center">19</div><div align="center">20</div>
            <div align="center">21</div><div align="center">22</div><div align="center" style="border-top:1px solid #000000 ; border-bottom: 1px double #000000;">23</div><div align="center">&nbsp;</div>
            <div align="center">24</div><div align="center">25</div>
        </td>
        <td>
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
        <td align="right">
            <div align="right"><?php echo isset($r_data[0]['18'])?number_format($r_data[0]['18'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['19'])?number_format($r_data[0]['19'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['20'])?number_format($r_data[0]['20'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['21'])?number_format($r_data[0]['21'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['22'])?number_format($r_data[0]['22'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['23'])?number_format($r_data[0]['23'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['24'])?number_format($r_data[0]['24'],2,'.',','):'&nbsp;';?></div>
            <div align="right" style="border-top:1px solid #000000 ; border-bottom: 1px double #000000;"><?php echo isset($r_data[0]['25'])?number_format($r_data[0]['25'],2,'.',','):'&nbsp;';?></div>
            <div>&nbsp;</div>
            <div align="right"><?php echo isset($r_data[0]['26'])?number_format($r_data[0]['26'],2,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['27'])?number_format($r_data[0]['27'],2,'.',','):'&nbsp;';?></div>
        </td>
    </tr>    
</table>
</body>
</html>