<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>General Ledger Reporting System</title>

    <link type="text/css" rel="stylesheet" href="<?php echo $url;?>css/layout-default-latest.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $url;?>css/smoothness/jquery-ui-1.8.16.custom.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $url;?>css/layout-pane.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $url;?>css/layout-addon.css" />
                                                                                
    <script type="text/javascript" src="<?php echo $url;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/jquery-ui-1.8.16.smoothness.min.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/jquery.layout.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/jquery.json-2.3.js"></script> 
    
    <link rel="stylesheet" href="<?php echo $url;?>css/slick.grid.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="<?php echo $url;?>css/examples.css" type="text/css" media="screen" charset="utf-8" />
     
    <style type="text/css">
    body{
        font-size:.8em;
    }
    .login{
        padding:0px;
        background-color: #F0F0F0;   
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
    }
    .up_line{
    border-top: 1px dotted #969696;
    }

    .down_line{
        border-bottom: 1px dotted #969696;    
    }

    .up_down_line{
        border-top: 1px dotted  #969696;
        border-bottom: 1px dotted #969696;    
    }
    </style>
    
    <script type="text/javascript">
        var uri = '<?php echo $url;?>';
        var open_svr_dt = '<?php $tday=getdate(); echo substr('00' . $tday["mday"],-2) . '-' . substr('00' . $tday["mon"],-2) . '-' . $tday["year"];?>';
        var start_year_svr_dt = '<?php $tday=getdate(); echo '01-01-' . $tday["year"];?>';
        var end_year_svr_dt = '<?php $tday=getdate(); echo '31-12-' . $tday["year"];?>';
        var start_month_svr_dt = '<?php $tday=getdate(); echo '01-' . substr('00' . $tday["mon"],-2) . '-' . $tday["year"];?>';
        
        var start_year_svr_dt_prev = '<?php $tday=getdate(); echo '01-01-' . ($tday["year"]-1);?>';
        var start_month_svr_dt_prev = '<?php $tday=getdate(); echo '01-' . substr('00' . $tday["mon"],-2) . '-' . ($tday["year"]-1);?>';
        
        function ltrim(str, chars) {
            chars = chars || "\\s";
            return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
        }
         
        function rtrim(str, chars) {
            chars = chars || "\\s";
            return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
        }
        function trim(str, chars) {
            return ltrim(rtrim(str, chars), chars);
        }
        function decodeurl(str)
        {
              //return encodeURIComponent(trim(str)).replace(/%2F/g, '/');    
            var stri = ''+trim(str);
            var strilength = stri.length;
            //alert(stri[stri.length-1]);
            if(stri[strilength-1]=='.')
                stri = stri.substr(0,strilength-1);      
            
            if(stri)
                return encodeURIComponent(stri).replace(/%2F/g, '/');
            else
                return '';
        }
        <?php if ($sess['lvl']<=5){?>
            var r_frm = array("f_pfu");
        <?php }?>
        
        <?php if ($sess['lvl']<=10){?>
            var r_frm = array("");
        <?php }?>
        
    </script>
    
    
    <script src="<?php echo $url;?>js/jquery.event.drag-2.0.min.js"></script>
    <script src="<?php echo $url;?>js/slick.core.js"></script>
    <script src="<?php echo $url;?>js/plugins/slick.checkboxselectcolumn.js"></script>
    <script src="<?php echo $url;?>js/plugins/slick.autotooltips.js"></script>
    <script src="<?php echo $url;?>js/plugins/slick.cellrangedecorator.js"></script>
    <script src="<?php echo $url;?>js/plugins/slick.cellrangeselector.js"></script>
    <script src="<?php echo $url;?>js/plugins/slick.cellcopymanager.js"></script>
    <script src="<?php echo $url;?>js/plugins/slick.cellselectionmodel.js"></script>
    <script src="<?php echo $url;?>js/plugins/slick.rowselectionmodel.js"></script>
    <script src="<?php echo $url;?>js/slick.editors.js"></script>
    <script src="<?php echo $url;?>js/slick.grid.js"></script>    
    <script src="<?php echo $url;?>js/slick.dataview.js"></script>    
    
    <script type="text/javascript" src="<?php echo $url;?>js/zcontent_c.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zinput_ipt.js"></script> 
    <?php if ( ($sess['lvl']==0 && $sess['lvl_sub']==1) || $sess['lvl']<0 ){?>
    <script type="text/javascript" src="<?php echo $url;?>js/zuserparam_upar.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zuser_user.js"></script>         
    <?php }?>
    <?php if (($sess['lvl']==0 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
    <script type="text/javascript" src="<?php echo $url;?>js/zportfolio_pf.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zfundmanager_fm.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zgl_gl.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zia_ia.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zmail_ml.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zendyear_eod.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zunitissued_ui.js"></script> 
    <!-- Add By MistarKomeng -->
    <script type="text/javascript" src="<?php echo $url;?>js/zreksadana.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zorchid.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zkindorchid.js"></script>
    <?php }?>
    <?php if ( ($sess['lvl']<=5 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
    <script type="text/javascript" src="<?php echo $url;?>js/znavapproval_na.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/znavapproval_nagl.js"></script>
    <?php } else if($sess['lvl']<=10 && $sess['lvl_sub']==0){?>
    <script type="text/javascript" src="<?php echo $url;?>js/znavapproval_na_user.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/znavapproval_nagl.js"></script>
    <?php }?>
    <?php if ( ($sess['lvl']<=7 && $sess['lvl_sub']==0) || $sess['lvl']<0){?> 
    <script type="text/javascript" src="<?php echo $url;?>js/zfiupload_fu.js"></script>
    <?php }?>
    <?php if($sess['lvl']<=10 && $sess['lvl_sub']==0){?>
    <script type="text/javascript" src="<?php echo $url;?>js/zdailyupload_du.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zdailyupload_dumi.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zibpa_ibpa.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zibparekon_ibpar.js"></script>     
    <script type="text/javascript" src="<?php echo $url;?>js/zfifo_fifo.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zrptexpenses_zrfe.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zsubred_zsr.js"></script> 
    <?php }?>
    <?php if ( ($sess['lvl']<=15 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
    <script type="text/javascript" src="<?php echo $url;?>js/zrptnbmon_nbm.js"></script>    
    <script type="text/javascript" src="<?php echo $url;?>js/zrptmailmon_mm.js"></script>    
    <script type="text/javascript" src="<?php echo $url;?>js/zrptfinance_rf.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zrptfinancehist_rfh.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zrptnavlisting_nl.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zrptfiaccrued_fia.js"></script>
    <script type="text/javascript" src="<?php echo $url;?>js/zrptxd1_xd1.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zrptxd1hist_xd1h.js"></script> 
    <script type="text/javascript" src="<?php echo $url;?>js/zrpttval_tv.js"></script>    
    <!--
    <script type="text/javascript" src="<?php echo $url;?>js/zrptexpenses_rexp.js"></script> 
    -->
    <?php }?>
    <?php if ( $sess['lvl']<=10){?>
    <script type="text/javascript" src="<?php echo $url;?>js/zrptmi_rmi.js"></script> 
    <?php }?>
    <?php if ( $sess['lvl']<=10){?>
    <script type="text/javascript" src="<?php echo $url;?>js/zrpt_sinvest.js"></script> 
    <?php }?>
    <?php if($sess['lvl']<=7) {?>
    <script type="text/javascript" src="<?php echo $url;?>js/zfem_fem.js"></script> 
    <?php }?>
    
    <script type="text/javascript">
    
    var myLayout; 

   $(document).ready(function () {
        myLayout = $('body').layout({
            west__size:         200          
         //, south__size: 30
        , spacing_open:         4
        ,    spacing_closed:    12
        });
         <?php echo "var lvl={$sess['lvl']};"; ?>
         c_loadpage('nav','westnav','');
        <?php if ( ($sess['lvl']==0 && $sess['lvl_sub']==1) || $sess['lvl']<0 ){?>
        c_loadpage('f_user_parameter','f_upar','upar_initiate');
        c_loadpage('f_user','f_user','user_initiate');
        <?php }?>
        <?php if (($sess['lvl']==0 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
        c_loadpage('f_pf','f_pf','pf_initiate');
        c_loadpage('f_fm','f_fm','fm_initiate');
        c_loadpage('f_gl','f_gl','gl_initiate');
        c_loadpage('f_ia','f_ia','ia_initiate');
        c_loadpage('f_mail','f_ml','ml_initiate');        
        c_loadpage('f_endyear','f_eod','eod_initiate');
        c_loadpage('f_unit_issued','f_ui','ui_initiate'); 
        //Add By MistarKomeng
        // namafile - id
        c_loadpage('f_tp','f_tp','tp_initiate'); 
        c_loadpage('f_oc','f_oc','oc_initiate');
        c_loadpage('f_ock','f_ock','ock_initiate');
        //End Add
        <?php }?>
        <?php if ( ($sess['lvl']<=7 && $sess['lvl_sub']==0) || $sess['lvl']<0){?> 
        c_loadpage('f_fi_upload','f_fu','fu_initiate');
        <?php }?>
        <?php if ( ($sess['lvl']<=5 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
        c_loadpage('f_nav_approval','f_na','na_initiate');
        c_loadpage('f_nav_approval_gl','f_nagl','nagl_initiate');
        <?php } else if($sess['lvl']<=10 && $sess['lvl_sub']==0){?>
        c_loadpage('f_nav_approval_user','f_na','na_initiate');
        c_loadpage('f_nav_approval_gl','f_nagl','nagl_initiate');
        <?php }?>
        <?php if($sess['lvl']<=10 && $sess['lvl_sub']==0){?>
        c_loadpage('f_daily_upload','f_du','du_initiate');
        c_loadpage('f_daily_uploadmi','f_dumi','dumi_initiate');
        
        c_loadpage('f_ibpa','f_ibpa','ibpa_initiate');
        c_loadpage('f_ibpa_rekon','f_ibpar','ibpar_initiate');
        c_loadpage('f_fifo','f_fifo','fifo_initiate');
        c_loadpage('f_rpt_expenses','f_rfe','rfe_initiate');
        c_loadpage('f_subred_rekon','f_subred','subred_initiate');
        <?php }?>
        <?php if ( ($sess['lvl']<=15 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
        c_loadpage('f_rpt_nbmon','f_nbm','nbm_initiate');  
        c_loadpage('f_rpt_mailmon','f_mm','mm_initiate');  
        c_loadpage('f_rpt_finance','f_rf','rf_initiate');
        c_loadpage('f_rpt_financehist','f_rfh','rfh_initiate');
        c_loadpage('f_rpt_navlisting','f_nl','nl_initiate');
        c_loadpage('f_rpt_fiaccrued','f_fia','fia_initiate');
        c_loadpage('f_rpt_xd1','f_xd1','xd1_initiate');
        c_loadpage('f_rpt_xd1hist','f_xd1h','xd1h_initiate');
        c_loadpage('f_rpt_tval','f_tv','tv_initiate');  
        <?php }?>
        <?php if ( $sess['lvl']<=10) { ?>
        c_loadpage('f_rpt_rmi','f_rmi','rmi_initiate');
        <?php } ?>
        <?php if ( $sess['lvl']<=10) { ?>
        c_loadpage('f_rpt_sinvest','f_rsinvest','rsinvest_initiate');
        <?php } ?>
        <?php if($sess['lvl']<=7) {?>
        c_loadpage('f_fee_maintenance','f_fem','fem_initiate');
        <?php }?>
     });       
    </script> 
    
</head> 
<body> 
<!-- manually attach allowOverflow method to pane -->
<div class="ui-layout-north" onmouseover="myLayout.allowOverflow('north')" onmouseout="myLayout.resetOverflow(this)">
    <div  style="color: #808080; background:  url('<?php echo $url;?>/img/cimbniaga.png') no-repeat; margin: 0; padding-left : 400px ; font-size: 3.6em;">
    &nbsp;
    </div>    
</div>
 
<!-- allowOverflow auto-attached by option: west__showOverflowOnHover = true -->
<div class="ui-layout-west" id="westnav"></div>
    
<div class="ui-layout-center">
    <?php if ( ($sess['lvl']==0 && $sess['lvl_sub']==1) || $sess['lvl']<0 ){?>
    <div id="f_upar" style="padding:0; border: 1px solid #ACACAC;width: 520px; display:none;" ></div>    
    <div id="f_user" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>    
    <?php }?>
    <?php if (($sess['lvl']==0 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
    <div id="f_pf" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>    
    <div id="f_fm" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>    
    <div id="f_gl" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>    
    <div id="f_ia" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>    
    <div id="f_ml" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>    
    <div id="f_eod" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div> 
    <div id="f_ui" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <!-- Add By MistarKomeng -->
    <div id="f_tp" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_oc" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_ock" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_mf" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <?php }?>
    <?php if ( ($sess['lvl']<=7 && $sess['lvl_sub']==0) || $sess['lvl']<0){?> 
    <div id="f_fu" style="padding:0; border: 1px solid #ACACAC;width: 520px; display:none;" ></div>    
    <?php }?>
    <?php if ( ($sess['lvl']<=5 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
    <div id="f_na" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div> 
    <div id="f_nagl" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div> 
    <?php } else if($sess['lvl']<=10 && $sess['lvl_sub']==0){?>
    <div id="f_na" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div> 
    <div id="f_nagl" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div> 
    <?php }?>
    
    <?php if($sess['lvl']<=10 && $sess['lvl_sub']==0){?>
    <div id="f_du" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>    
    <div id="f_dumi" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>        
    <div id="f_ibpa" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>  
    <div id="f_ibpar" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>  
    <div id="f_fifo" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_rfe" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_subred" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <?php }?>    
    <?php if ( ($sess['lvl']<=15 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
    <div id="f_nbm" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_mm" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_rf" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>          
    <div id="f_rfh" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>          
    <div id="f_nl" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>      
    <div id="f_fia" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>      
    <div id="f_xd1" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>      
    <div id="f_xd1h" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <div id="f_tv" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <!--
    <div id="f_rexp" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    -->
    <?php }?>
    <?php if ( $sess['lvl']<=10){?>
    <div id="f_rmi" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <?php }?>
    <?php if ( $sess['lvl']<=10){?>
    <div id="f_rsinvest" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <?php }?>    
    <?php if($sess['lvl']<=7) {?>
    <div id="f_fem" style="padding:0; border: 1px solid #ACACAC;width: 100%; display:none;" ></div>
    <?php }?>
</div>

<script>var _API_JQUERY=1;var _API_PROTOTYPE=2;var _api;var _idleTimeout=300000;var _awayTimeout=12000000;var _idleNow=false;var _idleTimestamp=null;var _idleTimer=null;var _awayNow=false;var _awayTimestamp=null;var _awayTimer=null;function setIdleTimeout(a){_idleTimeout=a;_idleTimestamp=new Date().getTime()+a;if(_idleTimer!=null){clearTimeout(_idleTimer)}_idleTimer=setTimeout(_makeIdle,a+50)}function setAwayTimeout(a){_awayTimeout=a;_awayTimestamp=new Date().getTime()+a;if(_awayTimer!=null){clearTimeout(_awayTimer)}_awayTimer=setTimeout(_makeAway,a+50)}function _makeIdle(){var a=new Date().getTime();if(a<_idleTimestamp){_idleTimer=setTimeout(_makeIdle,_idleTimestamp-a+50);return}_idleNow=true;try{if(document.onIdle){document.onIdle()}}catch(b){}}function _makeAway(){var a=new Date().getTime();if(a<_awayTimestamp){_awayTimer=setTimeout(_makeAway,_awayTimestamp-a+50);return}_awayNow=true;try{if(document.onAway){document.onAway()}}catch(b){}}function _initPrototype(){_api=_API_PROTOTYPE}function _active(c){var a=new Date().getTime();_idleTimestamp=a+_idleTimeout;_awayTimestamp=a+_awayTimeout;if(_idleNow){setIdleTimeout(_idleTimeout)}if(_awayNow){setAwayTimeout(_awayTimeout)}try{if((_idleNow||_awayNow)&&document.onBack){document.onBack(_idleNow,_awayNow)}}catch(b){}_idleNow=false;_awayNow=false}function _initJQuery(){_api=_API_JQUERY;var a=$(document);a.ready(function(){a.mousemove(_active);try{a.mouseenter(_active)}catch(b){}try{a.scroll(_active)}catch(b){}try{a.keydown(_active)}catch(b){}try{a.click(_active)}catch(b){}try{a.dblclick(_active)}catch(b){}})}function _initPrototype(){_api=_API_PROTOTYPE;var a=$(document);Event.observe(window,"load",function(b){Event.observe(window,"click",_active);Event.observe(window,"mousemove",_active);Event.observe(window,"mouseenter",_active);Event.observe(window,"scroll",_active);Event.observe(window,"keydown",_active);Event.observe(window,"click",_active);Event.observe(window,"dblclick",_active)})}try{if(Prototype){_initPrototype()}}catch(err){}try{if(jQuery){_initJQuery()}}catch(err){}setIdleTimeout(_idleTimeout);setAwayTimeout(_awayTimeout);
document.onIdle=function(){};
document.onAway=function(){alert('Idle for 20 Minutes. You will be logout!'); window.location.href="<?php echo $url;?>index.php/cs/do_logout";};
document.onBack=function(a,b){};</script>
</body>
</html>

