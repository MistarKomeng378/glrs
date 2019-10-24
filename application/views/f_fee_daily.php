        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fed_progress" /></div>
            <div class="tb_title">Daily Fee Calculation</div>
        </div>
        <div style="padding: 3px;"> 
            <table>
                <tr>
                    <td valign="top" width="80">Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="fed_s_fm"></select> - <select id="fed_s_pf" name="pf"></select></td>
                </tr>
                <tr>
                    <td valign="top">Last NAV</td>
                    <td valign="top">:</td>
                    <td><span id="fed_s_nav"></span></td>
                </tr> 
                <tr>
                    <td valign="top">Period</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="fed_i_date"  style="width: 80px;" class="i_dtpicker" name="edt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top" ></td>
                    <td valign="top" ></td>
                    <td><input type="button" id="fed_b_calc"  value="Calculate" />
                </tr>
            </table>           
        </div>
        <div id="fed_d_view"></div>