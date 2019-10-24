        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="rfe_progress" /></div>
            <div class="tb_title">NAV Expense</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cfee/preview" method="post" target="_rexp">
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="rfe_s_fm"></select> - <select id="rfe_s_pf" name="pf"></select></td>
                </tr> 
                <tr>
                    <td valign="top">Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="rfe_i_date"  style="width: 80px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120"></td>
                    <td valign="top" width="5"></td>
                    <td><input type="button" id="rfe_b_view"  value="View" /> <input type="submit" id="rfe_b_preview"  value="Preview" /></td>
                </tr>
            </table>           
            </form>
        </div>
        <div id="rfe_d_view"></div>