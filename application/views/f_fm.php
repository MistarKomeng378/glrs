        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fm_progress" /></div>
            <div class="tb_title">Fund Manager</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
                <input type="button" id="fm_b_new" value="New Fund Manager"/>
                <input type="button" id="fm_b_edit" value="Update Fund Manager"/>
                
            </div>
            <div id="fm_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
<div id="fm_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>        
        <tr>
            <td valign="top">Fund Manager</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_code_dlg"  style="width: 60px;" /> - <input type="text" id="fm_i_fm_name_dlg"  style="width: 240px;" /></td>
        </tr>
        <tr>
            <td valign="top">Address 1</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_addr1_dlg"  style="width: 315px;" /></td>
        </tr>
        <tr>
            <td valign="top">Address 2</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_addr2_dlg"  style="width: 315px;" /></td>
        </tr>
        <tr>
            <td valign="top">Address 3</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_addr3_dlg"  style="width: 315px;" /></td>
        </tr>
        <tr>
            <td valign="top">City</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_city_dlg"  style="width: 60px;" /> - Country: <input type="text" id="fm_i_fm_country_dlg"  style="width: 60px;" /></td>
        </tr>
        <tr>
            <td valign="top">Postal Code</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_postal_dlg"  style="width: 60px;" /></td>
        </tr>
        <tr>
            <td valign="top">Phone1</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_phone1_dlg"  style="width: 140px;" /> / <input type="text" id="fm_i_fm_phone2_dlg"  style="width: 140px;" /></td>
        </tr>
        <tr>
            <td valign="top">Fax1</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_fax1_dlg"  style="width: 140px;" /> / <input type="text" id="fm_i_fm_fax2_dlg"  style="width: 140px;" /></td>
        </tr>
        <tr>
            <td valign="top">Automatic Mail</td>
            <td valign="top">:</td>
            <td><select id=fm_i_fm_mail_dlg>
                <option value="0">N</option>
                <option value="1">Y</option>
            </select>
            </td>
        </tr>
         <tr>
            <td valign="top">Mail Address</td>
            <td valign="top">:</td>
            <td><textarea id="fm_i_fm_mailaddr_dlg" rows="4" style="width: 315px;"></textarea></td>
        </tr>
        <tr>
            <td valign="top">Mail CC Address </td>
            <td valign="top">:</td>
            <td><textarea id="fm_i_fm_mailaddrcc_dlg" rows="4" style="width: 315px;"></textarea></td>
        </tr>
        <tr>
            <td valign="top">Time (hh:mm)</td>
            <td valign="top">:</td>
            <td><input type="text" id="fm_i_fm_ph_dlg"  style="width: 40px; text-align: center" /> - IBPA Code <input type="text" id="fm_i_fm_ibpa_dlg"  style="width: 60px; text-align: center;" /></td>
        </tr>
    </table>
</div> 