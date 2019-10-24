        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="nl_progress" /></div>
            <div class="tb_title">NAV Listing</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cnl/view_listing" method="post" target="_nl">
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="nl_s_fm"></select> - <select id="nl_s_pf" name="pf"></select></td>
                </tr> 
                <tr>
                    <td valign="top">Period</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="nl_i_sdate"  style="width: 80px;" class="i_dtpicker" name="sdt" /> -
                        <input type="text" id="nl_i_edate"  style="width: 80px;" class="i_dtpicker" name="edt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120"></td>
                    <td valign="top" width="5"></td>
                    <td><input type="button" id="nl_b_view"  value="View" /> <input type="submit" id="nl_b_preview"  value="Preview" /></td>
                </tr>
            </table>           
            </form>
        </div>
        <div id="nl_d_view"></div>