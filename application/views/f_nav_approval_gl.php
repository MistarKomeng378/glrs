        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="nagl_progress" /></div>
            <div class="tb_title">GL Done for ALL</div>
        </div>
        <div style="padding: 3px;"> 
            <fieldset>
                NAV Date: <input type="text" id="nagl_i_date"  style="width: 80px;" class="i_dtpicker" name="sdt" /> (dd-mm-yyyy)
                <input type="button" id="nagl_b_view"  value="View" />  -
                <input type="button" id="nagl_b_done"  value="GL Done" />
                <input type="hidden" id="nagl_h_date" />
            </fieldset> 
        </div>
        <div style="margin: 4px 2px 2px 2px; border: #800080 solid 1px;" id="nagl_d_view"></div>