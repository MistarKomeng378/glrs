
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title><?php echo "XD13_{$r_pf[0]['pfcode']}_" .  date_format(date_create($dt),'Ymd')  ?></title>
<style type="text/css">

@page {
    margin: 2cm;
}

body {
  font-family: arial;
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
        <td colspan="3">LAPORAN OPERASI REKSA DANA</td>
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
        <td colspan="2" align="center">LAPORAN OPERASI</td>
        <td width="140" align="center">s/d Hari ini</td>
    </tr>
    <tr bgcolor="#ffffff">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr bgcolor="#E0E0E0">
        <td colspan="3" align="center">Pendapatan Investasi</td>
    </tr>
    <tr bgcolor="#ffffff">
        <td width="30" align="center">
            <div align="center">&nbsp;</div>
            <div align="center">1</div>
            <div align="center">2</div>
            <div align="center">3</div>
            <div align="center">4</div>
        </td>
        <td>
            <div style="background-color: E0E0E0;" align="center">Perubahan Kekayaan Bersih dari Hasil Operasi</div>
            <div>Pendapatan Investasi Bersih</div>
            <div>Laba/Rugi Realisasi Bersih Investasi</div>
            <div>Penyesuaian Atas Akumulasi Laba/Rugi sampai dengan tahun sebelumnya</div>
            <div>Perubahan atas kenaikan yang tidak direalisasikan</div>
        </td>
        <td align="right">
            <div>&nbsp;</div>
            <div align="right"><?php echo isset($r_data[0]['3'])?number_format($r_data[0]['3'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['4'])?number_format($r_data[0]['4'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['5'])?number_format($r_data[0]['5'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['6'])?number_format($r_data[0]['6'],4,'.',','):'&nbsp;';?></div>
        </td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">5</td>
        <td>T O T A L</td>
        <td><div align="right"><?php echo isset($r_data[0]['7'])?number_format($r_data[0]['7'],4,'.',','):'&nbsp;';?></div></td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">
             <div align="center">&nbsp;</div>
            <div align="center">6</div>
            <div align="center">7</div>
            <div align="center">8</div>
        </td>
        <td>
              <div style="background-color: E0E0E0;" align="center">Transaksi untuk Pemegang Saham/ Unit Penyertaan</div>
            <div>Distribusi kepada Pemegang Saham/Unit Penyertaan</div>
            <div>Penjualan Saham/Unit Penyertaan</div>
            <div>Pembelian Kembali Saham/Unit Penyertaan</div>
        </td>
        <td align="right">
                  <div>&nbsp;</div>
            <div align="right"><?php echo isset($r_data[0]['8'])?number_format($r_data[0]['8'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['9'])?number_format($r_data[0]['9'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['10'])?number_format($r_data[0]['10'],4,'.',','):'&nbsp;';?></div>
        </td>
    </tr>
    <tr bgcolor="#ffffff">
        <td align="center">9</td>
        <td>PERUBAHAN KEKAYAAN BERSIH</td>
        <td><div align="right"><?php echo isset($r_data[0]['11'])?number_format($r_data[0]['11'],4,'.',','):'&nbsp;';?></div></td>
    </tr>
</table>
</body>
</html>