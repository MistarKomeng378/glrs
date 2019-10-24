        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="eod_progress" /></div>
            <div class="tb_title">End of Year</div>
        </div>
        <div style="padding: 3px;"> 
            <table width="100%">
                <tr>
                    <td valign="top" width="140">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="eod_s_fm"></select> - <select id="eod_s_pf" name="pf"></select></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                         <table>                                               
                            <tr>
                                <td width="120">Last Approved NAV</td>
                                <td width="120">Last GL Done</td>
                                <td width="120">Current Year</td>                                
                            </tr>               
                            <tr>
                                <td><span id="eod_s_last_dt" style="font-weight: bold;"></span></td>
                                <td><span id="eod_s_last_gl_dt" style="font-weight: bold;"></span></td>
                                <td><span id="eod_s_cyear" style="font-weight: bold;"></span>&nbsp; </td>
                            </tr> 
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="140"></td>
                    <td valign="top" width="5"></td>
                    <td>
                        <input type="button" id="eod_b_eod"  value="End of Year" /> - 
                        <input type="button" id="eod_b_ceod"  value="Cancel End of Year" />
                    </td>
                </tr>
            </table>           
            <input type="hidden" id="eod_i_gleoy" />
        </div>
        <div id="eod_d_view"></div>