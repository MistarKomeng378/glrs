        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="ur_progress" /></div>
            <div class="tb_title">Financial Reporting</div>
        </div>
        <div style="padding: 3px;"> 
            <table>
                <tr>
                    <td valign="top" width="120">Expired Login Days</td>
                    <td valign="top" width="5">:</td>
                    <td><input type="text" id="ur_i_eld"  style="width: 70px;" name="eld" /></td>
                </tr>
                <tr>
                    <td>Expired Password Days</td>
                    <td>:</td>
                    <td><input type="text" id="ur_i_epd"  style="width: 70px;" name="epd" /></td>
                </tr>
                <tr>
                    <td>Min Password</td>
                    <td>:</td>
                    <td><input type="text" id="ur_i_minp"  style="width: 70px;" name="minp" /></td>
                </tr>
                <tr>
                    <td>Alpha Numeric Password</td>
                    <td>:</td>
                    <td><select id="ur_s_anp" name="anp">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Contain Capital Password</td>
                    <td>:</td>
                    <td><select id="ur_s_ccp" name="ccp">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Recycle Times Password</td>
                    <td>:</td>
                    <td><input type="text" id="ur_i_rtp"  style="width: 70px;" name="rtp" /></td>
                </tr>
                <tr>
                    <td>Max Wrong Password</td>
                    <td>:</td>
                    <td><input type="text" id="ur_i_mwp"  style="width: 70px;" name="mwp" /></td>
                </tr>
                <tr>
                    <td></td><td></td>
                    <td><input type="button" id="ur_b_view" value="Update" /></td>
                </tr>
            </table>
        </div>
        