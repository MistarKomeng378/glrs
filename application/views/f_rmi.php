        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="rmi_progress" /></div>
            <div class="tb_title">Financial Reporting</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/crmi/preview" method="post" target="_mi" id="rmi_frm">
            <fieldset>
            <table>
                <tr>
                    <td valign="top">Report Name</td>
                    <td valign="top">:</td>
                    <td>
                    <select id="rmi_s_name" name="rn">
                        <option value="NAVB">NAV for Business</option>
                        <option value="NAVD">MI NAV Detail</option>
                        <option value="NAVS">NAV Summary</option>
                        <option value="PP">Portfolio Percentage</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120">Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="rmi_i_date"  style="width: 70px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr id="rmi_tr_fm">
                    <td valign="top" width="120">Fund Manager</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="rmi_s_fm" name="fm"></select></td>
                </tr>
                <tr  id="rmi_tr_pf">
                    <td valign="top" width="120">Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="rmi_s_pf" name="pf"></select></td>
                </tr>
                <tr>
                    <td></td><td></td>
                    <td><input type="button" id="rmi_b_view" value="View" /> 
                    <input type="button" id="rmi_b_preview" value="View for Print" /></td>
                </tr>
            </table>             
            </fieldset>
            <input type="hidden" name="a" value="1" />
            </form>
        </div>
        <div align="center" style="margin: 0;">
        <table width="765">
            <tr>
                <td id="rmi_d_view"></td>
            </tr>
        </table>
        </div>
        
