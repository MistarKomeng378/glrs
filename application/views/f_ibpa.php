        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="ibpa_progress" /></div>
            <div class="tb_title">IBPA Data Extraction</div>
        </div>
        <div style="padding: 3px;" align="center">  
            
                <iframe name="iframe_ibpa" id="iframe_ibpa"  src="#" style="postion:fixed;left:-9999;top:-9999;display:none"></iframe>
                <form id="frm_ibpa" name="frm_ibpa"  target="iframe_ibpa"  action="<?php echo $url;?>index.php/cibpa/upload" method="POST" enctype="multipart/form-data">
                Tgl (dd-mm-yyyy): <input type="text" id="ibpa_i_date" name="dt"  class="i_dtpicker" style="width: 80px;" />
                Filename :
                <input type="file" id="ibpa_f" name="ibpa_f" size="40" />
                <input type="button" id="ibpa_b_upload"  value="Upload & Extract!" />  
                </form>            
            <hr />
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;" align="left"><input type="button" id="ibpa_b_reload"  value="Reload File!" /></div>
            <div id="ibpa_d_view" style="clear:both; border: 1px solid #ACACAC; height: 400px; padding-top: 10px; " align="center"></div>
        </div>