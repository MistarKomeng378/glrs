        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="na_progress" /></div>
            <div class="tb_title">NAV Approval</div>
        </div>
        <div style="padding: 3px;"> 
            <input type="hidden" id="na_i_pf_h" value="" />
            <input type="hidden" id="na_i_date_h" value="" />
            <input type="hidden" id="na_i_nc_h" value="" />
            <input type="hidden" id="na_i_rd_h" value="" />
            <table>
                <tr>
                    <td valign="top" width="130">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="na_s_fm"></select> - <select id="na_s_pf"></select></td>
                </tr>                                               
                <tr>
                    <td valign="top">Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="na_i_date"  style="width: 70px;" class="i_dtpicker" /> (dd-mm-yyyy)
                        <button id="na_b_view" >View</button>
                    </td>
                </tr>
            </table>
            <table bgcolor="#969696">            
                <tr bgcolor="#C0C0FF">
                    <th valign="top" width="120" align="center">Last Approved NAV</th>
                    <th valign="top" width="120" align="center">Last GL Done</th>
                    <th valign="top" width="120" align="center">On Date NAV Status</th>
                    <th valign="top" width="120" align="center">On Date GL Status</th>
                    <th valign="top" width="120" align="center">URS Last Posting</th>
                    <th valign="top" align="center">Current Year</th>
                </tr>
                <tr bgcolor="#FFFFFF">
                    <td align="center"><span id="na_s_last_dt" style="font-weight: bold;"></span></td>
                    <td align="center"><span id="na_s_last_gl_dt" style="font-weight: bold;"></span></td>
                    <td align="center"><span id="na_s_ns" style="font-weight: bold;"></span></td>
                    <td align="center"><span id="na_s_gs" style="font-weight: bold;"></span></td>
                    <td align="center"><span id="na_s_urs_dt" style="font-weight: bold;"></span></td>
                    <td align="center"><span id="na_s_cur_year" style="font-weight: bold;"></span></td>
                </tr>
            </table>
            
            <table width="100%" bgcolor="#969696">
                <tr bgcolor="#C0C0FF">
                    <th width="25%">Category</th>
                    <th align="right" width="25%">Investment</th>
                    <th align="right" width="25%">GL</th>
                    <th align="right">Different</th>
                </tr>
                <tbody id=na_tb_cat></tbody>
            </table>
            <br />
            <table width="100%" bgcolor="#585858">
                <tr bgcolor="#C0FFC0">
                    <th align="right" width="33%">NAV-Investment</th>
                    <th align="right" width="33%">NAV-GL</th>
                    <th align="right">Different</th>
                </tr>
                <tr bgcolor="#FFFFFF">
                    <td align="right"><span id="na_s_invest"></span></td>
                    <td align="right"><span id="na_s_gl"></span></td>
                    <td align="right"><span id="na_s_diff"></span></td>
                </tr>
                <tr id="na_tr_nav_prev">
                    <th colspan="3" align="center" style="font-size: 150%; font-weight: bold;">
                        <span id="s_nav_prev"></span><br />
                    </th>                    
                </tr>
                <tr id="na_tr_nav_c" bgcolor="#ffffff">
                    <th colspan="3" align="center" style="font-size: 150%; font-weight: bold;">
                        <span id="s_nav_c"></span>
                    </th>                    
                </tr>
            </table>
            <div align="center">
                <button id="na_b_approve" disabled="disabled">Approve</button>
                <button id="na_b_unapprove" disabled="disabled">Un-Approve</button>      -
                <button id="na_b_gl_done" disabled="disabled">Gl Done</button>
                <button id="na_b_gl_undone" disabled="disabled">GL Un-Done</button>
            </div>            
        </div>
        <div style="margin: 4px 2px 2px 2px; border: #800080 solid 1px;" id="na_d_view"></div>
        <div style="margin: 4px 2px 2px 2px; border: #800080 solid 1px;" id="na_d_viewtax" align="center"></div>
        <div style="margin: 4px 2px 2px 2px; border: #800080 solid 1px;" id="na_d_viewval"></div>
        <div style="margin: 4px 2px 2px 2px; border: #800080 solid 1px;" id="na_d_viewint"></div>
        <div id="approv_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;">
        <table id="approvalspv">
            <tr><td>Username</td><td>:</td><td><input type="text" name="usr" id="usr"></td></tr>
            <tr><td>Password</td><td>:</td><td><input type="password" name="pwd" id="pwd"></td></tr>
            </table>
        </div>
