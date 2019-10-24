        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="ml_progress" /></div>
            <div class="tb_title">Mail Sender</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
            
                <input type="button" id="ml_b_new" value="New Sender"/>
                <input type="button" id="ml_b_edit" value="Update Sender"/></td>
            </div>
            <div id="ml_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
<div id="ml_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <tr>
            <td valign="top">Default Sender</td>
            <td valign="top">:</td>
            <td><select id="ml_s_default_dlg">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </td>
        </tr>        
        <tr>
            <td valign="top">Mail Host</td>
            <td valign="top">:</td>
            <td><input type="text" id="ml_i_host_dlg" style="width: 220px;" /> </td>
        </tr>
        <tr>
            <td valign="top">Mail User</td>
            <td valign="top">:</td>
            <td><input type="text" id="ml_i_user_dlg" style="width: 260px;" /> </td>
        </tr>
        <tr>
            <td valign="top">Mail Password</td>
            <td valign="top">:</td>
            <td><input type="text" id="ml_i_pass_dlg" style="width: 180px;" /> </td>
        </tr>
        <tr>
            <td valign="top">Mail Sender</td>
            <td valign="top">:</td>
            <td><input type="text" id="ml_i_sender_dlg" style="width: 260px;" /> </td>
        </tr>
        <tr>
            <td valign="top">Sender Name</td>
            <td valign="top">:</td>
            <td><input type="text" id="ml_i_sendername_dlg" style="width: 260px;" /> <input type="hidden" id="ml_i_id_dlg" /></td>
        </tr>
    </table>
</div> 