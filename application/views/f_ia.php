        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="ia_progress" /></div>
            <div class="tb_title">Investment Allocation</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
            <table>
                <tr>
                    <td>Fund Manager</td>
                    <td>:</td>
                    <td><select id="ia_s_fm">
                    <option value="ALL">ALL</option>
                </select></td>
                </tr>
                <tr>
                    <td>Portfolio</td>
                    <td>:</td>
                    <td><select id="ia_s_pf">
                    <option value="ALL">ALL</option>
                </select>
                <input type="button" id="ia_b_edit" value="<<< Update Investment Allocation"/></td>
                </tr>
            </table>
            </div>
            <div id="ia_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
<div id="ia_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <tr>
            <td valign="top">Portfolio</td>
            <td valign="top">:</td>
            <td><span id="ia_s_pf_dlg"></span><input type="hidden" id="ia_h_pf_dlg" value="" /></td>
        </tr>
        <tr>
            <td></td><td></td>
            <td>
                <table bgcolor="#808080">
                    <tr bgcolor="#C0C0C0">
                        <th align="left" width="120">Asset Type</th>
                        <th>Minimum</th>
                        <th>Maximum</th>
                    </tr>
                    <tr bgcolor="#F0F0F0">
                        <td>Equity</td>
                        <td><input type="text" id="ia_i_eq_min_dlg" style="width: 100px; text-align: right;" /></td>
                        <td><input type="text" id="ia_i_eq_max_dlg" style="width: 100px; text-align: right;" /></td>
                    </tr>
                    <tr bgcolor="#F0F0F0">
                        <td>Fix Income</td>
                        <td><input type="text" id="ia_i_fi_min_dlg" style="width: 100px; text-align: right;" /></td>
                        <td><input type="text" id="ia_i_fi_max_dlg" style="width: 100px; text-align: right;" /></td>
                    </tr>
                    <tr bgcolor="#F0F0F0">
                        <td>Money Market</td>
                        <td><input type="text" id="ia_i_mm_min_dlg" style="width: 100px; text-align: right;" /></td>
                        <td><input type="text" id="ia_i_mm_max_dlg" style="width: 100px; text-align: right;" /></td>
                    </tr>
                    <tr bgcolor="#F0F0F0">
                        <td>Cash</td>
                        <td><input type="text" id="ia_i_c_min_dlg" style="width: 100px; text-align: right;" /></td>
                        <td><input type="text" id="ia_i_c_max_dlg" style="width: 100px; text-align: right;" /></td>
                    </tr>
                    <tr bgcolor="#F0F0F0">
                        <td>Subscription Fee</td>
                        <td><input type="text" id="ia_i_subs_dlg" style="width: 100px; text-align: right;" /></td>
                        <td></td>
                    </tr>
                    <tr bgcolor="#F0F0F0">
                        <td>Redemption Fee</td>
                        <td><input type="text" id="ia_i_red_dlg" style="width: 100px; text-align: right;" /></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div> 