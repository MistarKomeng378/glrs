        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="user_progress" /></div>
            <div class="tb_title">Portfolio</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
                <input type="button" id="user_b_new" value="New User"/>
                <input type="button" id="user_b_edit" value="Edit User"/> -
                <input type="button" id="user_b_resetpass" value="Reset Password"/>
            </div>
            <div id="user_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
            <input type="hidden" id="user_h_action" value="n" />
        </div>
<div id="user_dlg_new" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <tr>
            <td valign="top">User Login ID</td>
            <td valign="top">:</td>
            <td><input type="text" id="user_i_id_dlg"  style="width: 80px;" size="20" /></td>
        </tr>
        <tr>
            <td valign="top">User Name</td>
            <td valign="top">:</td>
            <td><input type="text" id="user_i_name_dlg"  style="width: 240px;" size="50" /></td>
        </tr>
        <tr>
            <td valign="top">User Password</td>
            <td valign="top">:</td>
            <td><input type="password" id="user_i_pass1_dlg"  style="width: 120px;" size="50" /></td>
        </tr>
        <tr>
            <td valign="top">User Password Confirm</td>
            <td valign="top">:</td>
            <td><input type="password" id="user_i_pass2_dlg"  style="width: 120px;" size="50" /></td>
        </tr>
        <tr>
            <td valign="top">User Level</td>
            <td valign="top">:</td>
            <td><select id="user_s_lvl_dlg">
                <option value="0">Administrator</option>
                <option value="5">Supervisor</option>
                <option value="7">Koordinator</option>
                <option value="10">Maker</option>
                <option value="15">Inquery</option>
            </select>
            </td>
        </tr>
        <tr>
            <td valign="top"></td>
            <td valign="top"></td>
            <td><input type="checkbox" id="user_c_enable_dlg" name="user_c_enable_dlg" value="1" checked /> <label for="user_c_enable_dlg">Enable</label>
            <input type="checkbox" id="user_c_lock_dlg" name="user_c_lock_dlg" value="1" /> <label for="user_c_lock_dlg">Locked</label>
            </td>
        </tr>
    </table>
</div> 
<div id="user_dlg_resetpass" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <tr>
            <td valign="top">New Password</td>
            <td valign="top">:</td>
            <td><input type="password" id="user_i_rpass1_dlg"  style="width: 140px;" size="50" /></td>
        </tr>
        <tr>
            <td valign="top">New Password Confirm</td>
            <td valign="top">:</td>
            <td><input type="password" id="user_i_rpass2_dlg"  style="width: 140px;" size="50" /></td>
        </tr>
    </table>
</div>