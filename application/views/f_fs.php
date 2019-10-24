        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fs_progress" /></div>
            <div class="tb_title">ZFI Security</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">
                <table bgcolor="#E0E0E0">
                    <tr bgcolor="#ffffff">
                        <td>Code</td>
                        <td>Category</td>
                        <td>Name</td>
                        <td>Rate</td>
                        <td>Freq</td>
                        <td>Days in Year</td>
                        <td>Days in Month</td>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <td><input type="text" style="width: 60px;" id="fs_i_code" /></td>
                        <td><select id="fs_s_cat"><option value="FI">FI</option></select></td>
                        <td><input type="text" style="width: 160px;" id="fs_i_name" /></td>                        
                        <td><input type="text" style="width: 60px; text-align: right;" id="fs_i_rate" /></td>
                        <td><input type="text" style="width: 60px; text-align: right;" id="fs_i_freq" /></td>                                               
                        <td><input type="text" style="width: 60px; text-align: right;" id="fs_i_dyear" /></td>
                        <td><input type="text" style="width: 60px; text-align: right;" id="fs_i_dmonth" /></td>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <td>Last Coupon</td>
                        <td>Next Coupon</td>
                        <td>Maturity</td>
                        <td colspan="4"></td>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <td><input type="text" id="fs_i_lcd"  style="width: 80px;" class="i_dtpicker" /></td>
                        <td><input type="text" id="fs_i_lnd"  style="width: 80px;" class="i_dtpicker" /></td>
                        <td><input type="text" id="fs_i_md"  style="width: 80px;" class="i_dtpicker" /></td>
                        <td colspan="4"></td>
                    </tr>
                </table>                
            </div>
            <div id="fs_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
