        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fiaeprogress" /></div>
            <div class="tb_title">NAV Listing</div>
        </div>
        <div style="padding: 3px;"> 
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="fiae_s_fm"></select> - <select id="fiae_s_pf"></select></td>
                </tr> 
                <tr>
                    <td valign="top">Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="fiae_i_date"  style="width: 80px;" class="i_dtpicker" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120"></td>
                    <td valign="top" width="5"></td>
                    <td><input type="button" id="fiae_b_view"  value="View" /> <input type="button" id="fiae_b_preview"  value="Preview" /></td>
                </tr>
            </table> 
            <div id="fiae_grid" style="height: 400px;"></div>
            <table>
                <tr>
                    <td align="left"><select id="fiae_s_efect"></select></td>
                    <td align="right">Total ammount <input type="text" id="fiae_i_total" style="text-align: right; width: 150px;" /></td>
                </tr>
            </table>
        </div>