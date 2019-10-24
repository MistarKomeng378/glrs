        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="mm_progress" /></div>
            <div class="tb_title">Fund Mailer Monitoring</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cmm/view_mon" method="post" target="_cmm">
            Date :<input type="text" id="mm_i_sdate"  style="width: 80px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                  <input type="button" value="View" id="mm_b_view" /> <input type="submit" value="Preview" id="mm_b_preview" />
            </form>
        </div>
        <div id="mm_d_view"></div>