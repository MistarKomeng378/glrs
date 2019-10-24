        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="fifo_progress" /></div>
            <div class="tb_title">FIFO</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cfifo/preview" method="post" target="_xd1" id="fifo_frm">
            <fieldset>
            <table>
                <tr>
                    <td valign="top" width="120">Fund Manager - Portfolio</td>
                    <td valign="top" width="5">:</td>
                    <td><select id="fifo_s_fm"></select> - <select id="fifo_s_pf" name="pf"></select></td>
                </tr>
                <tr>
                    <td valign="top">Security</td>
                    <td valign="top">:</td>
                    <td>
                    <select id="fifo_s_sec" name="sec"></select><br />
                    ** When <b>Viewing</b> <b>ALL</b> Security, zero (0) Fifo Holding and SALE Holding will not be displayed!<br />
                    ** Use <b>View for Print</b> to display ALL.
                    
                    </td>
                </tr>
            </table>             
            </fieldset>
            <fieldset>
            <legend>Sales Simulation</legend>
            <table>
                <tr>
                    <td valign="top" width="120">Unit Sold</td>
                    <td valign="top" width="5">:</td>
                    <td><input type="text" style="width: 180px; text-align: right;" id="fifo_i_unit" name="u" /></td>
                </tr>
                <tr>
                    <td valign="top" width="120">Proceed</td>
                    <td valign="top" width="5">:</td>
                    <td><input type="text" style="width: 180px; text-align: right;" id="fifo_i_proc" name="p" /></td>
                </tr>
                <tr>
                    <td></td><td></td>
                    <td><input type="button" id="fifo_b_view" value="View" /> <input type="button" id="fifo_b_preview" value="View for Print" /></td>
                </tr>
            </table>             
            </fieldset>
            </form>
        </div>
        <div align="center" style="padding: 3px;" id="fifo_d_view"></div>
        
