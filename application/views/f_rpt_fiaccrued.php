        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fia_progress" /></div>
            <div class="tb_title">FI Accrued</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cfia/view_tax" method="post" target="_fia" id="fia_frm">
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="fia_s_fm"></select> - <select id="fia_s_pf" name='pf'></select></td>
                </tr> 
            </table>
            <table>                                               
                <tr>
                    <td width="120">Last Approved NAV</td>
                    <td width="120">Last GL Done</td>
                    <td width="120">On Date NAV Status</td>
                    <td width="120">On Date GL Status</td>
                </tr>               
                <tr>
                    <td><span id="fia_s_last_dt" style="font-weight: bold;"></span></td>
                    <td><span id="fia_s_last_gl_dt" style="font-weight: bold;"></span></td>
                    <td><span id="fia_s_ns" style="font-weight: bold;"></span></td>
                    <td><span id="fia_s_gs" style="font-weight: bold;"></span>&nbsp;</td>
                </tr> 
            </table>
            </fieldset>
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="120">Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="fia_i_date" name="dt"  style="width: 80px;" class="i_dtpicker" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120"></td>
                    <td valign="top" width="5"></td>
                    <td><input type="button" id="fia_b_view"  value="View" /> <input type="button" id="fia_b_preview"  value="Preview" /></td>
                </tr>
            </table>
            </fieldset>
            </form>
            <div id="fia_slick" style="clear:both; border: 1px solid #ACACAC; height: 260px;  "></div>
            <table width="100%">
                <tr>
                    <td width="50%">
                    Security: <select id='fia_s_sec'></select>
                    </td>
                    <td align="right">Gross Total: <input type="text" align="right" id="fia_i_tot" style="width: 200px; text-align: right;" readonly /></td>
                </tr>
            </table> <br />
            <table bgcolor="#C0C0C0">
                <tr bgcolor="#F0F0F0">
                    <th align="right" width="150">Gross</th>
                    <th align="right" width="150">Uns. Tax on Sale</th>
                    <th align="right" width="150">Uns. Tax Adjust</th>
                    <th align="right" width="150">Net</th>
                </tr>
                <tr bgcolor="#ffffff">
                    <td align="right"><span id="fia_s_gross"></span></td>
                    <td align="right" id="fia_s_sale"></td>
                    <td align="right" id="fia_s_txn"></td>
                    <td align="right" id="fia_s_net"></td>
                </tr>
            </table>
        </div>