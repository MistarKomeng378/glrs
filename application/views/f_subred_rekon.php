        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="subred_progress" /></div>
            <div class="tb_title">Subscription/ Redemption Reconciliation</div>
        </div>
        <div style="padding: 3px;" align="center">  
                <iframe name="iframe_subred" id="iframe_subred"  src="#" style="postion:fixed;left:-9999;top:-9999;display:none"></iframe>
                <form id="frm_subred" name="frm_subred"  target="iframe_subred"  action="<?php echo $url;?>index.php/csubred/upload" method="POST" enctype="multipart/form-data">
                Tgl (dd-mm-yyyy): <input type="text" id="subred_i_date" name="dt"  class="i_dtpicker" style="width: 80px;" />
                Filename :
                <input type="file" id="subred_f" name="subred_f" size="40" />
                <input type="button" id="subred_b_upload"  value="Upload &amp; Rekon" />  
                <input type="button" id="subred_b_view"  value="Preview" />  
                </form>                        
                <div id="subred_d_view" style="clear:both; border: 1px solid #ACACAC; padding-top: 10px; " align="center"></div>
        </div>
       <form id="frm_subred_v" action="<?php echo $url;?>index.php/csubred/get_rekon" method="post" target="subred_v">
            <input type="hidden" id="subred_h_date" name="dt" value="" />
       </form>