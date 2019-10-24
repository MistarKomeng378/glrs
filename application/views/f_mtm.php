        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="mtm_progress" /></div>
            <div class="tb_title">Mark To Market</div>
        </div>
        <div style="padding: 3px;"> 
            
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="mtm_s_fm"></select></td>
                </tr>                                               
                <tr>
                    <td valign="top">Portfolio</td>
                    <td valign="top">:</td>
                    <td><select id="mtm_s_pf"></select></td>
                </tr> 
                <tr>
                    <td valign="top">Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="mtm_i_date"  style="width: 70px;" class="i_dtpicker" /> (dd-mm-yyyy)
                    </td>
                </tr>               
                <tr>
                    <td valign="top">Last Approved NAV</td>
                    <td valign="top">:</td>
                    <td><span id="mtm_s_last_dt" style="font-weight: bold;"></span></td>
                </tr> 
                </tr>                
                <tr>
                    <td valign="top">Last GL Done</td>
                    <td valign="top">:</td>
                    <td><span id="mtm_s_last_gl_dt" style="font-weight: bold;"></span></td>
                </tr>                  
                <tr>
                    <td valign="top">On Date NAV Status</td>
                    <td valign="top">:</td>
                    <td><span id="mtm_s_ns" style="font-weight: bold;"></span></td>
                </tr> 
                </tr>                
                <tr>
                    <td valign="top">On Date GL Status</td>
                    <td valign="top">:</td>
                    <td><span id="mtm_s_gs" style="font-weight: bold;"></span></td>
                </tr>
                <tr>
                    <td></td><td></td>
                    <td><button id="mtm_b_process" >Do MTM</button></td>
                </tr>
            </table>     
            <table width="100%" bgcolor="#585858">
                <tr bgcolor="#C0FFC0">
                    <th align="right" width="33%">NAV-Investment</th>
                    <th align="right" width="33%">NAV-GL</th>
                    <th align="right">Different</th>
                </tr>
                <tr bgcolor="#FFFFFF">
                    <td align="right"><span id="mtm_s_invest"></span></td>
                    <td align="right"><span id="mtm_s_gl"></span></td>
                    <td align="right"><span id="mtm_s_diff"></span></td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 2px;" id="mtm_d_view"></div>