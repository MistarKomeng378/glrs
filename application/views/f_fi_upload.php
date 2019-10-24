        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fu_progress" /></div>
            <div class="tb_title">FI Tax Upload</div>
        </div>
        <div style="padding: 3px;"> 
            <iframe name="iframe_fu" id="iframe_fu"  src="#" style="postion:fixed;left:-9999;top:-9999;display:none"></iframe>
            <form id="frm_fu" name="frm_fu" target="iframe_fu"  action="<?php echo $url;?>index.php/cu/fiup" method="POST" enctype="multipart/form-data"> 
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="fu_s_fm"></select></td>
                </tr>                                               
                <tr>
                    <td valign="top">Portfolio</td>
                    <td valign="top">:</td>
                    <td><select id="fu_s_pf" name="pf"></select></td>
                </tr>                 
            </table>
            <table>
                <tr>
                    <td width="120">Last Approved NAV</td>
                    <td width="120">Last GL Done</td>
                    <td width="120">On Date NAV Status</td>
                    <td width="120">On Date GL Status</td>
                </tr>                
                <tr>
                    <td><span id="fu_s_last_dt" style="font-weight: bold;"></span></td>
                    <td><span id="fu_s_last_gl_dt" style="font-weight: bold;"></span></td>
                    <td><span id="fu_s_nav_status" style="font-weight: bold;"></span></td>
                    <td><span id="fu_s_gl_status" style="font-weight: bold;"></span></td>
                </tr>                  
            </table>
            </fieldset>
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="120">Trade Date</td>
                    <td valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="fu_i_date"  style="width: 80px;" class="i_dtpicker" name="dt" />  (dd-mm-yyyy)
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="120">FI Security Master File</td>
                    <td valign="top" width="5">:</td>
                    <td><input type="file" id="fu_f_fi_sec" size="40" name="f_fisec" /> </td>                    
                </tr>
                <tr>
                    <td valign="top">FI Transaction File</td>
                    <td valign="top">:</td>
                    <td><input type="file" id="fu_f_fi_trx" size="40" name="f_fitrx" /> </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="button" value="Upload" id="fu_b_upload" />
                        <input type="button" value="Upload or Process" id="fu_b_upload_proc" />
                        <input type="button" value="Refresh" id="fu_b_refresh" />
                    </td>
                </tr>
            </table> 
            <input type="hidden" id="fu_i_a" name="a" value="" />
            </fieldset>
            </form>            
        </div><hr />
        Approved NAV On Date: <span id="fu_s_ondt" style="font-weight: bold;"></span>
        <table width="100%" bgcolor="#ACACAC">
            <tr bgcolor="#F0F0F0">
                <th align="left" width="50">PF CODE</th>
                <th align="left" width="320">PF NAME</th>
                <th align="right">NET ACCRUED</th>                
            </tr>
            <tbody id="fu_tbody"></tbody>
        </table>