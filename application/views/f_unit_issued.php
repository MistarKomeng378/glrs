        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="ui_progress" /></div>
            <div class="tb_title">Unit Issued</div>
        </div>
        <div style="padding: 3px;"> 
            <table>
                <tr>
                    <td valign="top" width="80">FM- Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="ui_s_fm"></select> - <select id="ui_s_pf"></select></td>
                </tr>
                <tr>
                    <td valign="top">Last Unit Date</td>
                    <td valign="top">:</td>
                    <td><span id="ui_s_dt"></span></td>
                </tr>                                               
                <tr>
                    <td valign="top">Last Unit</td>
                    <td valign="top">:</td>
                    <td><span id="ui_s_amount"></span></td>
                </tr>
                <tr>
                    <td valign="top">Process Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="ui_i_date"  style="width: 70px;" class="i_dtpicker" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top">Amount</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="ui_i_amount"  style="width: 160px; text-align: right;"  />
                    </td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td>
                        <input type="button" id="ui_b_update" value="Update" />
                    </td>
                </tr>
            </table>            
        </div>
