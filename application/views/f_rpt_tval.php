        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="tv_progress" /></div>
            <div class="tb_title">Total Value</div>
        </div>
        <div style="padding: 3px;"> 
            <form action="<?php echo $url;?>index.php/ctv/getrpt" method="post" target="_tval">
            NAV Date :<input type="text" id="tv_i_sdate"  style="width: 80px;" class="i_dtpicker" name="dt" /> (dd-mm-yyyy)
                  <input type="submit" value="Get data" id="tv_b_preview" />
            </form>
        </div>
        <div id="tv_d_view"></div>