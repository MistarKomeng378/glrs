<?php if ( ! defined('BASEPATH')) exit(''); ?>
<?php
$html_xd11="";$htmlxd111 = "";$htmlxd112 = "";
$htmlxd111 = "
    <table width=\"100%\"> 
        <tr>
            <td width=\"35%\"><b>{$row_pf["pfname"]}</b></td>
            <td width=\"30%\" align=\"center\"><b>LAPORAN AKTIVA DAN KEWAJIBAN REKSA DANA</b><br />{$date}</td>
            <td align=\"right\" width=\"35%\"><b>{$row_pf["fmname"]}</b></td>
        </tr>
    </table><hr /> ";
$xd1_3 = isset($row_xd11[0][3])?number_format($row_xd11[0][3],4,'.',','):'&nbsp;';
$xd1_4 = isset($row_xd11[0][4])?number_format($row_xd11[0][4],4,'.',','):'&nbsp;';
$xd1_5 = isset($row_xd11[0][5])?number_format($row_xd11[0][5],4,'.',','):'&nbsp;';
$xd1_6 = isset($row_xd11[0][6])?number_format($row_xd11[0][6],4,'.',','):'&nbsp;';
$xd1_7 = isset($row_xd11[0][7])?number_format($row_xd11[0][7],4,'.',','):'&nbsp;';
$xd1_8 = isset($row_xd11[0][8])?number_format($row_xd11[0][8],4,'.',','):'&nbsp;';
$xd1_9 = isset($row_xd11[0][9])?number_format($row_xd11[0][9],4,'.',','):'&nbsp;';
$xd1_10 = isset($row_xd11[0][10])?number_format($row_xd11[0][10],4,'.',','):'&nbsp;';
$xd1_11 = isset($row_xd11[0][11])?number_format($row_xd11[0][11],4,'.',','):'&nbsp;';
$xd1_12 = isset($row_xd11[0][12])?number_format($row_xd11[0][12],4,'.',','):'&nbsp;';
$xd1_13 = isset($row_xd11[0][13])?number_format($row_xd11[0][13],4,'.',','):'&nbsp;';
$xd1_14 = isset($row_xd11[0][14])?number_format($row_xd11[0][14],4,'.',','):'&nbsp;';
$xd1_15 = isset($row_xd11[0][15])?number_format($row_xd11[0][15],4,'.',','):'&nbsp;';
$xd1_16 = isset($row_xd11[0][16])?number_format($row_xd11[0][16],4,'.',','):'&nbsp;';
$xd1_17 = isset($row_xd11[0][17])?number_format($row_xd11[0][17],4,'.',','):'&nbsp;';
$xd1_18 = isset($row_xd11[0][18])?number_format($row_xd11[0][18],4,'.',','):'&nbsp;';
$xd1_19 = isset($row_xd11[0][19])?number_format($row_xd11[0][19],4,'.',','):'&nbsp;';
$xd1_20 = isset($row_xd11[0][20])?number_format($row_xd11[0][20],4,'.',','):'&nbsp;';
$xd1_21 = isset($row_xd11[0][21])?number_format($row_xd11[0][21],4,'.',','):'&nbsp;';
$xd1_22 = isset($row_xd11[0][22])?number_format($row_xd11[0][22],4,'.',','):'&nbsp;';
$xd1_23 = isset($row_xd11[0][23])?number_format($row_xd11[0][23],4,'.',','):'&nbsp;';
$xd1_24 = isset($row_xd11[0][24])?number_format($row_xd11[0][24],4,'.',','):'&nbsp;';
$xd1_25 = isset($row_xd11[0][25])?number_format($row_xd11[0][25],4,'.',','):'&nbsp;';
$xd1_26 = isset($row_xd11[0][26])?number_format($row_xd11[0][26],4,'.',','):'&nbsp;';
$xd1_27 = isset($row_xd11[0][27])?number_format($row_xd11[0][27],4,'.',','):'&nbsp;';
$htmlxd1111 = "
    <table width=\"634\" bgcolor=\"#000000\" cellspacing=\"1\">
        <tr>
            <td colspan=\"3\"  bgcolor=\"#ffffff\">LAPORAN AKTIVA DAN KEWAJIBAN REKSA DANA</td>
        </tr>
        <tr bgcolor=\"#ffffff\">
            <td colspan=\"3\">
                <table width=\"100%\">
                    <tr>
                        <td width=\"200\">Manager Investasi</td>
                        <td width=\"5\">:</td>
                        <td>{$row_pf['fmname']}</td>
                    </tr>
                    <tr>
                        <td width=\"200\">Bank Kustodian</td>
                        <td width=\"5\">:</td>
                        <td>CIMB Niaga</td>
                    </tr>
                    <tr>
                        <td width=\"200\">Nama Reksa Dana</td>
                        <td width=\"5\">:</td>
                        <td>{$row_pf['pfname']}</td>
                    </tr>
                    <tr>
                        <td width=\"200\">Jenis Reksa Dana</td>
                        <td width=\"5\">:</td>
                        <td>{$row_pf['fkindname']}</td>
                    </tr>
                    <tr>
                        <td width=\"200\">Type Reksa Dana</td>
                        <td width=\"5\">:</td>
                        <td>{$row_pf['ftypename']}</td>
                    </tr>
                    <tr>
                        <td width=\"200\">Tanggal</td>
                        <td width=\"5\">:</td>
                        <td>{$date}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" colspan=\"2\" width=\"70%\" align=\"center\">LAPORAN AKTIVA DAN KEWAJIBAN</td>
            <td bgcolor=\"#ffffff\" width=\"30%\" align=\"center\">s/d Hari Ini</td>
        </tr>
         <tr>
            <td bgcolor=\"#ffffff\" width=\"5%\" align=\"center\">&nbsp;<div align=\"center\">&nbsp;</div>1<br />2<br />3<br />4<br />5<br />6<br />7<br />8<br />9<br />10
            </td>
            <td bgcolor=\"#ffffff\" width=\"65%\" align=\"left\">&nbsp;<div align=\"center\">Aktiva</div>
                Investasi dalam Instrumen Pasar Uang
                <br />Investasi dalam Instrumen Hutang Lainnya
                <br />Investasi dalam Saham
                <br />Investasi dalam Waran dan Right
                <br />K a s
                <br />Piutang Deviden
                <br />Piutang Bunga
                <br />Piutang Efek yang Dijual
                <br />Piutang Lainnya
                <br />Aktiva Lain-lain (Pajak Dibayar Dimuka)
            </td>
            <td bgcolor=\"#ffffff\" width=\"30%\" align=\"right\">&nbsp;<div align=\"center\">&nbsp;</div>
                {$xd1_3}
                <br />{$xd1_4}
                <br />{$xd1_5}
                <br />{$xd1_6}
                <br />{$xd1_7}
                <br />{$xd1_8}
                <br />{$xd1_9}
                <br />{$xd1_10}
                <br />{$xd1_11}
                <br />{$xd1_12}
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" align=\"center\">11</td>
            <td bgcolor=\"#ffffff\" align=\"left\">TOTAL AKTIVA</td>
            <td bgcolor=\"#ffffff\" align=\"right\">{$xd1_13}</td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" align=\"center\">&nbsp;<div align=\"center\">&nbsp;</div>12<br />13
            </td>
            <td bgcolor=\"#ffffff\" align=\"left\">&nbsp;<div align=\"center\">Kewajiban</div>
                Utang Efek yang Dibeli
                <br />Utang Lain-lain
            </td>
            <td bgcolor=\"#ffffff\" align=\"right\">&nbsp;<div align=\"center\">&nbsp;</div>
                {$xd1_14}
                <br />{$xd1_15}
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" align=\"center\">14</td>
            <td bgcolor=\"#ffffff\" align=\"left\">TOTAL KEWAJIBAN</td>
            <td bgcolor=\"#ffffff\" align=\"right\">{$xd1_16}</td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" align=\"center\">&nbsp;</td>
            <td bgcolor=\"#ffffff\" align=\"left\">&nbsp;</td>
            <td bgcolor=\"#ffffff\" align=\"right\">&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" align=\"center\">15</td>
            <td bgcolor=\"#ffffff\" align=\"left\">TOTAL AKTIVA BERSIH</td>
            <td bgcolor=\"#ffffff\" align=\"right\">{$xd1_17}</td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" width=\"5%\" align=\"center\">&nbsp;<br />16<br />17<br />18<br />19<br />20<br />21<br />22
            </td>
            <td bgcolor=\"#ffffff\" width=\"65%\" align=\"left\">&nbsp;<br />
                Jumlah Saham/Unit Penyertaan yang diterbitkan
                <br />Pelunasan/Pembelian Kembali Saham/Unit Penyertaan
                <br />Akumulasi/Laba/Rugi sampai dengan tahun sebelumnya
                <br />Pendapatan yang sudah didistribusikan
                <br />Laba/Rugi yang belum direalisasikan
                <br />Laba/Rugi yang sudah direalisasikan
                <br />Pendapatan investasi Bersih
            </td>
            <td bgcolor=\"#ffffff\" width=\"30%\" align=\"right\">&nbsp; <br />
                {$xd1_18}
                <br />{$xd1_19}
                <br />{$xd1_20}
                <br />{$xd1_21}
                <br />{$xd1_22}
                <br />{$xd1_23}
                <br />{$xd1_24}
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" align=\"center\">23</td>
            <td bgcolor=\"#ffffff\" align=\"left\">TOTAL SAHAM/UNIT PENYERTAAN DAN LABA/RUGI</td>
            <td bgcolor=\"#ffffff\" align=\"right\">{$xd1_25}</td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\" width=\"5%\" align=\"center\">&nbsp;<br />24<br />25
            </td>
            <td bgcolor=\"#ffffff\" width=\"65%\" align=\"left\">&nbsp;<br />
                Jumlah Saham/Unit Penyertaan yang Beredar
                <br />Nilai Aktiva Bersih per saham/Unit Penyertaan
            </td>
            <td bgcolor=\"#ffffff\" width=\"30%\" align=\"right\">&nbsp; <br />
                {$xd1_26}
                <br />{$xd1_27}
            </td>
        </tr>
    </table>";
     
$html_xd11 .=  $htmlxd1111 ;
?>