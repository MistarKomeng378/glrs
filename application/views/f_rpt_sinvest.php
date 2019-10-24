        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="rsinvest_progress" /></div>
            <div class="tb_title">Reports</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/crsinvest/g" method="post" target="_rsinvest" id="rsinvest_frm">
            <fieldset>
            <table>
                <tr>
                    <td valign="top">Report Name</td>
                    <td valign="top">:</td>
                    <td>
                    <select id="rsinvest_s_name" name="rn">
                        <option value="NAVK">NAV Performance (Non Proteksi)</option>
                        <option value="NAVP">NAV Performance (Proteksi)</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120">Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="rsinvest_i_date"  style="width: 70px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td></td><td></td>
                    <td>
                        <input type="submit" id="rsinvest_b_text" value="Get" name="sbt" />
                    </td>
                </tr>
            </table>             
            </fieldset>
            </form>
        </div>
        <div align="center" style="margin: 0;">
        <table width="765">
            <tr>
                <td id="rsinvest_d_view"></td>
            </tr>
        </table>
        </div>
        