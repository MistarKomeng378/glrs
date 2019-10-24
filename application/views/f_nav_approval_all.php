        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="naglprogress" /></div>
            <div class="tb_title">GL Done for ALL</div>
        </div>
        <div style="padding: 3px;"> 
            <fieldset>
            
            <table>
                <tr>
                    <td valign="top"  valign="top" width="140">NAV Date</td>
                    <td valign="top"  valign="top" width="5">:</td>
                    <td>
                        <input type="text" id="nagl_sdate"  style="width: 80px;" class="i_dtpicker" name="sdt" /> (dd-mm-yyyy)
                    </td>
                </tr> 
                <tr>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td>
                        <input type="button" id="naglb_view"  value="View" /> 
                        <input type="button" id="naglb_done"  value="GL Done" />
                    </td>
                </tr> 
            </table>   
            </fieldset> 
        </div>
        <div style="margin: 4px 2px 2px 2px; border: #800080 solid 1px;" id="nagld_view"></div>