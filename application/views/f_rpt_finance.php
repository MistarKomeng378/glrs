        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="rf_progress" /></div>
            <div class="tb_title">Financial Reporting</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cfin/view_rpt" method="post" target="_nl" id="rf_frm">
            <fieldset>
            <input type="hidden" id="rf_h_v" name="v" value="0" />
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="rf_s_fm" name="fm"></select> - <select id="rf_s_pf" name="pf"></select></td>
                </tr>
            </table>
            <table>                                               
                <tr>
                    <td width="120">Last Approved NAV</td>
                    <td width="120">Last GL Done</td>
                    <td width="120">On Date NAV Status</td>
                    <td width="120">On Date GL Status</td>
                    <td width="120">Current Year</td>
                </tr>               
                <tr>
                    <td><span id="rf_s_last_dt" style="font-weight: bold;"></span></td>
                    <td><span id="rf_s_last_gl_dt" style="font-weight: bold;"></span></td>
                    <td><span id="rf_s_ns" style="font-weight: bold;"></span></td>
                    <td><span id="rf_s_gs" style="font-weight: bold;"></span></td>
                    <td><span id="rf_s_cyear" style="font-weight: bold;"></span>&nbsp; </td>
                </tr> 
            </table>     
            </fieldset>
            <fieldset>
            <table>
                <tr>
                    <td valign="top">Report Name</td>
                    <td valign="top">:</td>
                    <td>
                    <select id="rf_s_name" name="rn">
                        <option value="NAV">Net Aset Value</option>
                        <option value="BS">Balance Sheet</option>
                        <option value="PL">Profit &amp; Loss</option>
                        <option value="VAL">Valuation</option>
                        <option value="MTM">MTM Journal</option>
                        <option value="TB">Trial Balance</option>
                        <option value="NC">NAV Changes</option>
                        <option value="GAM">GL Acccount Movement</option>
                        <option value="DGB">Daily GL Balance</option>
                        <option value="XD11">Formulir X.D.1-1</option>
                        <option value="XD12">Formulir X.D.1-2</option>
                        <option value="XD13">Formulir X.D.1-3</option>
                        <option value="NP">NAV Performance</option>
                        <option value="FB">Financial Book</option>
                    </select>
                    </td>
                </tr>
                <tr id="rf_tr_sdt">
                    <td valign="top" width="120">Start Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="rf_i_sdate"  style="width: 70px;" class="i_dtpicker" name="sdt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120">As of Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="rf_i_date"  style="width: 70px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr id="rf_tr_srt">
                    <td valign="top">Report Code</td>
                    <td valign="top">:</td>
                    <td><input type="text" id="rf_i_type"  style="width: 70px;" value="ALL" name="rt" /> </td>
                </tr> 
                <tr id="rf_tr_sacc">   
                    <td valign="top">Account No</td>
                    <td valign="top">:</td>
                    <td>
                    <select id="rf_s_acc" name="acc"></select>
                    </td>
                </tr> 
                <tr>
                    <td></td><td></td>
                    <td>
                        <input type="button" id="rf_b_view" value="View" /> 
                        <input type="button" id="rf_b_preview" value="View for Print" />
                        <?php if ( $sess['lvl']<=10){ ?>
                        <input type="button" id="rf_b_preview_mi" value="View for Print per MI" />
                        <?php }?>
                    </td>
                </tr>
            </table>             
            </fieldset>
            </form>
        </div>
        <div align="center" style="margin: 0;">
        <table width="765">
            <tr>
                <td id="rf_d_view"></td>
            </tr>
        </table>
        </div>
        