        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="upar_progress" /></div>
            <div class="tb_title">User Parameter</div>
        </div>
        <div style="padding: 3px;"> 
            <table>
                <tr>
                    <td valign="top" width="190">Expired Login Days</td>
                    <td valign="top" width="5">:</td>
                    <td><input type="text" id="upar_i_eld"  style="width: 40px;text-align: right;" name="eld" /></td>
                </tr>
                <tr>
                    <td>Expired Password Days</td>
                    <td>:</td>
                    <td><input type="text" id="upar_i_epd"  style="width: 40px;text-align: right;" name="epd" /></td>
                </tr>
                <tr>
                    <td>Min Password</td>
                    <td>:</td>
                    <td><input type="text" id="upar_i_minp"  style="width: 40px;text-align: right;" name="minp" /></td>
                </tr>
                <tr>
                    <td>Password contain Alpha Numeric</td>
                    <td>:</td>
                    <td><select id="upar_s_anp" name="anp">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Password Contain Capital Char</td>
                    <td>:</td>
                    <td><select id="upar_s_ccp" name="ccp">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Recycle Times Password</td>
                    <td>:</td>
                    <td><input type="text" id="upar_i_rtp"  style="width: 40px;text-align: right;" name="rtp" /></td>
                </tr>
                <tr>
                    <td>Max Wrong Password</td>
                    <td>:</td>
                    <td><input type="text" id="upar_i_mwp"  style="width: 40px;text-align: right;" name="mwp" /></td>
                </tr>
                <tr>
                    <td>Min User Length</td>
                    <td>:</td>
                    <td><input type="text" id="upar_i_minu"  style="width: 40px;text-align: right;" name="mwp" /></td>
                </tr>
                <tr>
                    <td>Max User Length</td>
                    <td>:</td>
                    <td><input type="text" id="upar_i_maxu"  style="width: 40px;text-align: right;" name="mwp" /></td>
                </tr>
                <tr>
                    <td></td><td></td>
                    <td><input type="button" id="upar_b_update" value="Update Parameter" /></td>
                </tr>
            </table>
        </div>
        