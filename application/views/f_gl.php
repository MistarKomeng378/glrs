        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="gl_progress" /></div>
            <div class="tb_title">Portfolio</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
            <table>
                <tr>
                    <td>Fund Manager</td>
                    <td>:</td>
                    <td><select id="gl_s_fm">
                    <option value="ALL">ALL</option>
                </select></td>
                </tr>
                <tr>
                    <td>Portfolio</td>
                    <td>:</td>
                    <td><select id="gl_s_pf">
                    <option value="ALL">ALL</option>
                </select>
                <input type="button" id="gl_b_new" value="New GL"/>
                <input type="button" id="gl_b_edit" value="Update GL"/></td>
                </tr>
            </table>
            </div>
            <div id="gl_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
<div id="gl_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <tr>
            <td valign="top">Fund Manager</td>
            <td valign="top">:</td>
            <td><select id="gl_s_fm_dlg">
                    <option value="ALL">ALL</option>
                </select></td>
        </tr>
        <tr>
            <td valign="top">Portfolio</td>
            <td valign="top">:</td>
            <td><select id="gl_s_pf_dlg">
                    <option value="ALL">ALL</option>
                </select></td>
        </tr>
        <tr>
            <td valign="top">Account No</td>
            <td valign="top">:</td>
            <td><input type="text" id="gl_i_accno_dlg" style="width: 60px; text-align: right;" /> </td>
        </tr>
        <tr>
            <td valign="top">Account Name</td>
            <td valign="top">:</td>
            <td><input type="text" id="gl_i_accname_dlg" style="width: 260px;" /> </td>
        </tr>
        <tr>
            <td valign="top">Sign</td>
            <td valign="top">:</td>
            <td><select id=gl_s_sign_dlg>
                <option value="C">Credit</option>
                <option value="D">Debet</option>
            </select> - Type:
            <select id="gl_s_type_dlg">
                <option value="P">P</option>
                <option value="R">Revenue</option>
                <option value="A">Asset</option>
                <option value="L">Liabilities</option>
                <option value="E">Expense</option>
            </select>
            - Currency:
            <select id="gl_s_cur_dlg">
                <option value="IDR">IDR</option>
                <option value="USD">USD</option>
                <option value="GBP">GBP</option>
            </select><input type="hidden" id="gl_s_cur_dlg_h" />
            </td>
        </tr>
    </table>
</div> 