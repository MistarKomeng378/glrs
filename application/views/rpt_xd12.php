    <table width="100%" bgcolor="#000000">
        <tr bgcolor="#ffffff">
            <td colspan="3">LAPORAN OPERASI REKSA DANA</td>
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
            <div align="right"><?php echo isset($r_data[0]['3'])?number_format($r_data[0]['3'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['4'])?number_format($r_data[0]['4'],4,'.',','):'&nbsp;';?></div>
            </td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">3</td>
            <td>TOTAL PENDAPATAN INVESTASI</td>
            <td><div align="right"><?php echo isset($r_data[0]['5'])?number_format($r_data[0]['5'],4,'.',','):'&nbsp;';?></div></td>
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
            <div align="right"><?php echo isset($r_data[0]['6'])?number_format($r_data[0]['6'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['7'])?number_format($r_data[0]['7'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['8'])?number_format($r_data[0]['8'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['9'])?number_format($r_data[0]['9'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['10'])?number_format($r_data[0]['10'],4,'.',','):'&nbsp;';?></div>
            </td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">9</td>
            <td>TOTAL BIAYA</td>
            <td><div align="right"><?php echo isset($r_data[0]['11'])?number_format($r_data[0]['11'],4,'.',','):'&nbsp;';?></div></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">10</td>
            <td>PENDAPATAN INVESTASI BERSIH</td>
            <td><div align="right"><?php echo isset($r_data[0]['12'])?number_format($r_data[0]['12'],4,'.',','):'&nbsp;';?></div></td>
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
            <div align="right"><?php echo isset($r_data[0]['13'])?number_format($r_data[0]['13'],4,'.',','):'&nbsp;';?></div>
            <div align="right"><?php echo isset($r_data[0]['14'])?number_format($r_data[0]['14'],4,'.',','):'&nbsp;';?></div>
            <div>&nbsp;</div>
            </td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">13</td>
            <td>LABA/RUGI INVESTASI BERSIH</td>
            <td><div align="right"><?php echo isset($r_data[0]['15'])?number_format($r_data[0]['15'],4,'.',','):'&nbsp;';?></div></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td align="center">14</td>
            <td>PERNDAPAN OPERASI BERSIH</td>
            <td><div align="right"><?php echo isset($r_data[0]['16'])?number_format($r_data[0]['16'],4,'.',','):'&nbsp;';?></div></td>
        </tr>
    </table>
