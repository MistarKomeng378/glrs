        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="du_progress" /></div>
            <div class="tb_title">Daily Upload</div>
        </div>
        <div style="padding: 3px;"> 
            <iframe name="iframe_du" id="iframe_du"  src="#" style="postion:fixed;left:-9999;top:-9999;display:none"></iframe>
            <form id="frm_du" name="frm_du" target="iframe_du"  action="<?php echo $url;?>index.php/cu/dup" method="POST" enctype="multipart/form-data"> 
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="140">Fund Manager-Portoflio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="du_s_fm"></select>-<select id="du_s_pf" name="pf"></select></td>
                </tr>                                               
                <tr>
                    <td valign="top">GL Start Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="du_i_sdate"  style="width: 80px;" class="i_dtpicker" name="sdt" /> (dd-mm-yyyy)
                    </td>
                </tr> 
                <tr>
                    <td valign="top">GL Last Date/ NAV Date</td>
                    <td valign="top">:</td>
                    <td>
                        <input type="text" id="du_i_date"  style="width: 80px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="200">Last Approved NAV</td>
                    <td width="200">Last GL Done</td>
                    <td width="200">NAV Status on NAV Date</td>
                    <td>GL Status on NAV Date</td>
                </tr>                
                <tr>
                    <td><span id="du_s_last_dt" style="font-weight: bold;"></span></td>
                    <td><span id="du_s_last_gl_dt" style="font-weight: bold;"></span></td>
                    <td><span id="du_s_nav_status" style="font-weight: bold;"></span></td>
                    <td><span id="du_s_gl_status" style="font-weight: bold;"></span></td>
                </tr>                  
            </table>
            </fieldset>
            <fieldset>
            <legend>NAV Position</legend>
            <table>
            <!--
                <tr>
                    <td valign="top" width="120">FI Security Master File</td>
                    <td valign="top" width="5">:</td>
                    <td><input type="file" id="du_f_fi_sec" size="40" name="f_fisec" /> 
                    
                </tr>
                <tr>
                    <td valign="top">FI Transaction File</td>
                    <td valign="top">:</td>
                    <td><input type="file" id="du_f_fi_trx" size="40" name="f_fitrx" /> </td>
                </tr>
                -->
                <tr>
                    <td valign="top"  width="140">Valuation file</td>
                    <td valign="top"  width="5">:</td>
                    <td><input type="file" id="du_f_val" size="60" name="f_val" />
                    
                    </td>
                </tr>
            </table> 
            </fieldset>
        
            <fieldset>
            <legend>GL/ TB</legend>            
            <table>
                <tr>
                    <td valign="top" width="140">Journal file</td>
                    <td valign="top" width="5">:</td>
                    <td><input type="file" id="du_f_journal" size="60" name="f_jur" /> </td>
                </tr>  
            </table> 
            </fieldset> 
            
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="140"><td>
                    <td valign="top" width="5"></td>
                    <td><input type="button" id="du_b_upload"  value="Upload" /> <input type="button" id="du_b_refresh"  value="Refresh" /></td>
                </tr>
            </table>
            </fieldset>
            </form> 
            
        </div>