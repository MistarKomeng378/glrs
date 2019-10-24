        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fem_progress" /></div>
            <div class="tb_title">Fee Maintenance</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
            <table>
                <tr>
                    <td>Fund Manager</td>
                    <td>Portfolio</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><select id="fem_s_fm"><option value="ALL">ALL</option></select></td>
                    <td><select id="fem_s_pf"><option value="ALL">ALL</option></select></td>
                    <td><input type="button" id="fem_b_edit" value="Update Fee"/> 
                    <td><input type="button" id="fem_b_get" value="Download Data"/> 
                </tr>
            </table>
            </div>
            <div id="fem_slick" style="clear:both; border: 1px solid #ACACAC; height: 230px; "></div>
            <input type="button" id="fem_b_add_tier" value="Add Tier" />
            <input type="button" id="fem_b_edit_tier" value="Edit Tier" disabled="disabled" />
            <input type="button" id="fem_b_del_tier" value="Delete Tier" disabled="disabled" />
            <div id="fem_slick_tier" style="clear:both; border: 1px solid #ACACAC; height: 130px; "></div>
        </div>
 <div id="fem_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;">     
    <table> 
        <tr><td colspan="9"><b>Portfolio: <input type="hidden"  id="fem_h_pf_dlg"/><span id="fem_sp_pf"></span></b></td></tr>
        <tr>
            <td valign="bottom">Code</td>
            <td valign="bottom">Pct/Amt</td>
            <td valign="bottom" align="right">Value</td>
            <td valign="bottom">BASE ON</td>
            <td valign="bottom">FIRST NAV</td>
            <td valign="bottom">Year</td>
            <td valign="bottom">Flat/Tier</td>
            <td valign="bottom" align="center">Include Tax</td>
            <td valign="bottom">Tax</td>
            <td valign="bottom">Enable</td>
        </tr>
        <tr>
            <td><select id="fem_s_code_dlg"></select></td>
            <td>
                <select id="fem_s_pct_dlg">
                    <option value="P">Percentage</option>
                    <option value="A">Amount</option>
                </select>
            </td>
            <td><input type="text" id="fem_i_val_dlg" style="width: 100px; text-align: right;" /> </td>
            <td>
                <select id="fem_s_baseon_dlg">
                    <option value="PREVNAV">PREVIOUS NAV</option>
                    <option value="CURUNIT">CURRENT UNIT</option>
                </select>
            </td>
            <td><input type="text" id="fem_i_fnav_dlg" style="width: 90px; text-align: right;" value="1000" /> </td>
            <td>
                <select id="fem_s_year_dlg">
                    <option value="366">Actual</option>
                    <option value="365">365</option>
                </select>
            </td>
            <td>
                <select id="fem_s_flat_dlg">
                    <option value="F">Flat</option>
                    <option value="T">Tier</option>
                </select>
            </td>
            <td>
                <select id="fem_s_inctax_dlg">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </td>
            <td><input type="text" id="fem_i_tax_dlg" style="width: 20px; text-align: right;" value="10" /> </td>            
            <!--
            <td align="center">
                <select id="fem_s_daily_dlg">
                    <option value="N">No</option>
                    <option value="A">Yes</option>
                </select>
            </td>
            -->
            <td align="center">
                <select id="fem_s_enable_dlg">
                    <option value="A">Yes</option>
                    <option value="N">No</option>
                </select>
            </td>
        </tr>
    </table>
</div> 
<div id="fem_dlg1" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <b>Portfolio: <input type="hidden"  id="fem_h_pf_dlg2"/><span id="fem_sp_pf2"></span></b><br />
    <b>Feecode: <input type="hidden"  id="fem_h_code_dlg2"/><span id="fem_sp_code2"></span></b>
    <table> 
        <tr>
            <td valign="top">Sequence</td>
            <td valign="top">PCT</td>
            <td valign="top">Max Range</td>
        </tr>
        <tr>
            <td>
                <select id="fem_s_seq_dlg2">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </td>
            <td><input type="text" id="fem_i_pct_dlg2" style="width: 90px; text-align: right;" /> </td>
            <td><input type="text" id="fem_i_range_dlg2" style="width: 140px; text-align: right;" /> </td>
        </tr>
    </table>
</div> 