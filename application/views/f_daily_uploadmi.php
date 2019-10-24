        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="dumi_progress" /></div>
            <div class="tb_title">Daily Upload All</div>
        </div>
        <div style="padding: 3px;"> 
            <iframe name="iframe_dumi" id="iframe_dumi"  src="#" style="postion:fixed;left:-9999;top:-9999;display:none"></iframe>
            <form id="frm_dumi" name="frm_dumi" target="iframe_dumi"  action="<?php echo $url;?>index.php/cu/dupmi" method="POST" enctype="multipart/form-data"> 
            <fieldset>
            <table>
                <tr>
                    <td valign="top"  valign="top" width="140">GL Start Date</td>
                    <td valign="top"  valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="dumi_i_sdate"  style="width: 80px;" class="i_dtpicker" name="sdt" /> (dd-mm-yyyy)
                    </td>
                </tr> 
                <tr>
                    <td valign="top">GL Last Date &amp; NAV Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="dumi_i_date"  style="width: 80px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                    </td>
                </tr> 
            </table>   
            </fieldset>
            <fieldset>
            <legend>NAV Position+Lampiran &amp; GL </legend>
            <table>
                <tr>
                    <td valign="top"  width="140">Valuation file</td>
                    <td valign="top"  width="5">:</td>
                    <td><input type="file" id="dumi_f_val" size="60" name="f_val" /></td>
                </tr>
                <tr>
                    <td valign="top"  width="140">Journal file</td>
                    <td valign="top"  width="5">:</td>
                    <td><input type="file" id="dumi_f_journal" size="60" name="f_jur" /></td>
                </tr>
            </table> 
            </fieldset> 
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="140"><td>
                    <td valign="top" width="5"></td>
                    <td><input type="button" id="dumi_b_upload"  value="Upload" /> <input type="button" id="dumi_b_refresh"  value="Refresh" /></td>
                </tr>
            </table>
            </fieldset>
            </form> 
        </div>
        <div style="margin: 4px 2px 2px 2px; border: #800080 solid 1px;" id="dumi_d_view"></div>