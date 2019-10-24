<!--//////////////////////////// CREATE BY MISTARKOMENG //////////////////////////////////-->

<div style="padding: 3px;background-color: #E0E0E0; border-bottom: 1px solid #ACACAC;">
            <div style="float: right;margin:0"><img src="<?php echo $url;?>img/ajax-loader-small.gif" class="img_hide" id="oc_progress" /></div>
            <div class="tb_title">Orchid Type</div>
        </div>
        <div style="padding: 3px;">              
            <div  style="border: 1px solid #ACACAC; background-color: #F0F0F0;">               
                <input type="button" id="oc_b_new" value="New Type Orchid"/>
                <input type="button" id="oc_b_edit" value="Update Type Orchid"/>               
            </div>
            <div id="oc_slick" style="clear:both; border: 1px solid #ACACAC; height: 450px; "></div>
        </div>
<!-- Add New Type Orchid -->        
<div id="oc_dlg" style=" overflow:hidden; display:    none;padding:   0px;padding-top: 4px;"> 
    <table>
        <!--
        <tr>
            <td valign="top">Type Orchid</td>
            <td valign="top">:</td>
            <td><input type="hidden" id="oc_i_oc_code_dlg"  style="width: 100px;" /></td>
        </tr> 
        -->   <input type="hidden" id="oc_i_oc_code_dlg"  style="width: 100px;" />   
        <tr>            
            <td valign="top">Type Orchid</td>
            <td valign="top">:</td>
            <td><input type="text" id="oc_i_oc_name_dlg"  style="width: 200px;" /></td>
            
        </tr>
    </table>
</div> 
<!-- END Add-->