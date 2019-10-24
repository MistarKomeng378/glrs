        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="pf_progress" /></div>
            <div class="tb_title">Portfolio</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
                <select id="pf_s_fm">
                    <option value="ALL">ALL</option>
                </select>
                <input type="button" id="pf_b_new" value="New Portfolio"/>
                <input type="button" id="pf_b_edit" value="Update Portfolio"/>
                <input type="text" id="pf_i_pf_search" style="width: 200px;"/>
                <input type="button" id="pf_b_search" value="Search"/>
            </div>
            <div id="pf_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
<div id="pf_dlg_new" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <tr>
            <td valign="top">Fund Manager Name</td>
            <td valign="top">:</td>
            <td><select id="pf_s_fm_dlg"></select></td>
        </tr>
        <tr>
            <td valign="top">Portfolio</td>
            <td valign="top">:</td>
            <td><input type="text" id="pf_i_pf_code_dlg"  style="width: 60px;" /> - <input type="text" id="pf_i_pf_name_dlg"  style="width: 240px;" /></td>
        </tr>
        <tr>
            <td valign="top">S-Invest Code</td>
            <td valign="top">:</td>
            <td><input type="text" id="pf_i_pf_sinvestcode_dlg"  style="width: 130px;" /></td>
        </tr>
        <tr>
            <td valign="top">Currency</td>
            <td valign="top">:</td>
            <td><select id=pf_s_cur_dlg>
                <option value="IDR">IDR</option>
                <option value="USD">USD</option>
            </select> - Active:
            <select id="pf_s_active_dlg">
                <option value="Y">YES</option>
                <option value="N">NO</option>
            </select>
            </td>
        </tr>
        <tr>
            <td valign="top">Current year</td>
            <td valign="top">:</td>
            <td><input type="text" id="pf_i_curyear_dlg" style="width: 80px; text-align: right;" /> -
            Pricing Time: <input type="text" id="pf_i_time_dlg"  style="width: 40px;" />
            </td>
        </tr>
        <tr>
            <td valign="top">MM Fund</td>
            <td valign="top">:</td>
            <td><select id=pf_s_mm_dlg>
                <option value="N">N</option>
                <option value="Y">Y</option>
            </select> - Type:
            <select id=pf_s_type_dlg>
            <?php 
                foreach($mm_id as $xitem1)
                    echo "<option value=\"{$xitem1['mm_id']}\">{$xitem1['mm_name']}</option>";
            ?>
            </select>
            <!--
            <select id="pf_s_type_dlg">
                <option value="RDN">REKSADANA</option>
                <option value="LNK">UNIT LINK</option>
                <option value="DP">DANA PENSIUN</option>
                <option value="OTH">OTHERS</option>
            </select>
            -->
            </td>
        </tr>
        <!--///////////////// Edit By MistarKomeng ////////////////////-->
        <tr>
            <td valign="top">ORCHID Type-Kind</td>
            <td valign="top">:</td>
            <td><select id=pf_s_otype_dlg>
            <?php 
                foreach($r_type as $xitem1)
                    echo "<option value=\"{$xitem1['type_id']}\">{$xitem1['type_name']}</option>";
            ?>
            </select>
            <select id="pf_s_okind_dlg">
            <?php 
                foreach($r_kind as $xitem1)
                    echo "<option value=\"{$xitem1['kind_id']}\">{$xitem1['kind_name']}</option>";
            ?>
            </select>
            </td>
        </tr>
        <!--////////////// End Edit ////////////////-->
        <tr>
            <td valign="top">Decimal</td>
            <td valign="top">:</td>
            <td>
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>    
                        <td width="40">Price</td>
                        <td width="40">NAV</td>
                        <td>Unit</td>
                    </tr>
                    <tr>
                        <td><input type="text" id="pf_i_pdec_dlg"  style="width: 30px;" /></td>
                        <td><input type="text" id="pf_s_ndec_dlg"  style="width: 30px;" /></td>
                        <td><input type="text" id="pf_s_udec_dlg"  style="width: 30px;" /></td>
                    </tr>
                </table>            
            </td>
        </tr>
        <tr>
            <td valign="top">Do Trial Balance</td>
            <td valign="top">:</td>
            <td>
                <select id="pf_s_tb_dlg">
                    <option value="1">Y</option>
                    <option value="0">N</option>
                </select>
            </td>
        </tr>
        <tr>
            <td valign="top">Automatic Mail</td>
            <td valign="top">:</td>
            <td>
                <table>
                    <tr>
                        <td align="center">Financial Book</td><td align="center">|</td>
                        <td align="center">Trial Balance</td><td align="center">|</td>
                        <td align="center">Valuation</td>
                    </tr>
                    <tr>
                        <td align="center">
                            <select id="pf_s_mail_dlg">
                                <option value="0">N</option>
                                <option value="1">Y</option>
                            </select>
                        </td><td align="center">|</td>
                        <td align="center">
                            <select id="pf_s_mailtb_dlg">
                                <option value="0">N</option>
                                <option value="1">Y</option>
                            </select>
                        </td><td align="center">|</td>
                        <td align="center">
                            <select id="pf_s_mailval_dlg">
                                <option value="0">N</option>
                                <option value="1">Y</option>
                            </select>
                        </td>
                    </tr>
                </table>            
            </td>
        </tr>
        <tr id="pf_tr_pfgl" style="">
            <td valign="top">Copy GL From</td>
            <td valign="top">:</td>
            <td>
                <select id="pf_s_pfgl_dlg">
                </select> <br /> **Blank if do not need copy the new gl
            </td>
        </tr>
    </table>
</div> 