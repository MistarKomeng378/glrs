        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fp_progress" /></div>
            <div class="tb_title">FI Tax Process</div>
        </div>
        <div style="padding: 3px;"> 
            <table>
                <tr>
                    <td valign="top" width="120">Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="fp_i_sdate"  style="width: 80px;" class="i_dtpicker" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="button" value="Process" id="fp_b_process" /></td>
                </tr>
            </table>             
        </div>
        <div id="fp_d_view"></div>