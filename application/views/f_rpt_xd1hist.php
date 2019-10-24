        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="xd1h_progress" /></div>
            <div class="tb_title">Formulir X.D.1</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cxd1h/preview" method="post" target="_xd1" id="xd1h_frm">
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="xd1h_s_fm"></select> - <select id="xd1h_s_pf" name="pf"></select></td>
                </tr>
            </table>
            <table>                                               
                <tr>
                    <td width="120">Last Approved NAV</td>
                    <td width="120">Last GL Done</td>
                    <td width="120">On Date NAV Status</td>
                    <td width="120">On Date GL Status</td>
                    <td width="120">Current Year</td>
                </tr>               
                <tr>
                    <td><span id="xd1h_s_last_dt" style="font-weight: bold;"></span></td>
                    <td><span id="xd1h_s_last_gl_dt" style="font-weight: bold;"></span></td>
                    <td><span id="xd1h_s_ns" style="font-weight: bold;"></span></td>
                    <td><span id="xd1h_s_gs" style="font-weight: bold;"></span></td>
                    <td><span id="xd1h_s_cyear" style="font-weight: bold;"></span>&nbsp; </td>
                </tr> 
            </table>     
            </fieldset>
            <fieldset>
            <table>
                <tr id="xd1h_tr_sdt">
                    <td valign="top" width="120">Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="xd1h_i_date"  style="width: 70px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top">Formulir No.</td>
                    <td valign="top">:</td>
                    <td>
                    <select id="xd1h_s_no" name="no">
                        <option value="1">X.D.1-1</option>
                        <option value="2">X.D.1-2</option>
                        <option value="3">X.D.1-3</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td></td><td></td>
                    <td><input type="button" id="xd1h_b_view" value="View" /> <input type="button" id="xd1h_b_preview" value="View for Print" /></td>
                </tr>
            </table>             
            </fieldset>
            </form>
        </div>
        <div align="center" style="padding: 3px;" id="xd1h_d_view"></div>
        
