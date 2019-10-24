        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="ibpa_progress" /></div>
            <div class="tb_title">IBPA Data Extraction</div>
        </div>
        <div style="padding: 3px;" align="center">  
            
                <form id="frm_ibpar" name="frm_ibpar"  target="_ibpar"  action="<?php echo $url;?>index.php/cibpa/recon" method="POST" enctype="multipart/form-data">
                <table width="380">
                    <tr>
                        <td width="120">IBPA File</td>
                        <td width="3">:</td>
                        <td><input type="file" id="ibpar_f" name="ibpar_f" size="40" /></td>
                    </tr>
                    <tr>
                        <td>Hiport File</td>
                        <td>:</td>
                        <td><input type="file" id="ibpar_f_hp" name="ibpar_f_hp" size="40" /> </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><input type="text" id="ibpar_i_date"  name="dt" style="width: 70px;" class="i_dtpicker" /> (dd-mm-yyyy)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><input type="submit" id="ibpar_b_upload"  value="Rekonsile!" />  </td>
                    </tr>
                </table>                
                </form>
            
        </div>