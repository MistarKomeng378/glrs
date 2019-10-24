        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="nbm_progress" /></div>
            <div class="tb_title">NAV &amp; TB Process Monitoring</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/cnbm/view_proc" method="post" target="_cnbm">
            Date :<input type="text" id="nbm_i_sdate"  style="width: 80px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                  <input type="button" value="View" id="nbm_b_view" /> <input type="submit" value="Preview" id="nbm_b_preview" />
            </form>
        </div>
        <div id="nbm_d_view"></div>