<!--//////////////////////////// CREATE BY MISTARKOMENG //////////////////////////////////-->

<div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="tp_progress" /></div>
            <div class="tb_title">Parameter Reksadana</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">               
                <input type="button" id="tp_b_new" value="New Type Reksadana"/>
                <input type="button" id="tp_b_edit" value="Update Type Reksadana"/>
               <!--
                <input type="text" id="tp_i_tp_search" style="width: 200px;"/>
                <input type="button" id="tp_b_search" value="Search"/>
                -->
            </div>
            <div id="tp_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
<!-- Add New Type Reksadana -->        
<div id="tp_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <!--
        <tr>
            <td valign="top">Type Reksadana</td>
            <td valign="top">:</td>
            <td><input type="hidden" id="tp_i_tp_code_dlg"  style="width: 100px;" /></td>
        </tr> 
        -->   <input type="hidden" id="tp_i_tp_code_dlg"  style="width: 100px;" />   
        <tr>            
            <td valign="top">Type Reksadana</td>
            <td valign="top">:</td>
            <td><input type="text" id="tp_i_tp_name_dlg"  style="width: 200px;" /></td>
            
        </tr>
        <tr>
            <td valign="top">Keterangan</td>
            <td valign="top">:</td>
            <td><textarea type="text" id="tp_i_tp_ket_dlg"  style="width: 200px;" rows="1"></textarea></td>
        </tr>
    </table>
</div> 
<!-- END Add-->