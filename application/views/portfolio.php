        <div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="pfu_progress" /></div>
            <div class="tb_title">Equity Trx Extraction</div>
        </div>
        <div style="padding: 3px;">  
            <div style="padding: 3px;border: 1px solid #ACACAC;" align="center" >
                <iframe name="iframe_10_1" id="iframe_10_1"  src="#" style="postion:fixed;left:-9999;top:-9999;display:none"></iframe>
                <form id="frm_10_1_form" name="frm_10_1_form"  target="iframe_10_1"  action="<?php echo $url;?>index.php/addon_upload/eq_trx_upload_save_to_table" method="POST" enctype="multipart/form-data">
                Filename :
                <input type="file" id="i_10_1_f" name="i_10_1_f" size="40" />
                <input type="button" id="b_10_1_upload"  value="Upload & Process!" />     
                <a href="<?php echo $url;?>/excel_template/template.xls">template excel</a>      
                </form>
            </div>
            <br />
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;"><input type="button" id="b_10_1" value="Get Txt" disabled /></div>
            <div id="pfu_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>