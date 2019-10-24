    <ul id="west_toc">              
        <?php if($sess['lvl']<=0)   {?>
        <li> MAINTENANCE
            <ul>
                <?php if (($sess['lvl']==0 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
                <li><a href="#" onclick="c_showpage('f_pf','pf_show');">Portfolio</a></li>
                <li><a href="#" onclick="c_showpage('f_fm','fm_show');">Fund Manager</a></li>
                <li><a href="#" onclick="c_showpage('f_gl','gl_show');">GL Master</a></li>
                <li><a href="#" onclick="c_showpage('f_ia','ia_show');">Investment Allocation</a></li>
                <li><a href="#" onclick="c_showpage('f_ml','ml_show');">Mail Sender</a></li>
                <li><a href="#" onclick="c_showpage('f_ui','ui_show');">Unit Issued</a></li>
                <!--Add By MistarKomeng-->
                <li><a href="#" onclick="c_showpage('f_tp','tp_show');">MM Fund Type</a></li>
                <li><a href="#" onclick="c_showpage('f_oc','oc_show');">Orchid Type</a></li>
                <li><a href="#" onclick="c_showpage('f_ock','ock_show');">Orchid Kind</a></li>

                <!--End Add-->
                <?php }?> 
                <?php if ( ($sess['lvl']==0 && $sess['lvl_sub']==1) || $sess['lvl']<0 ){?> 
                <li><a href="#" onclick="c_showpage('f_upar','upar_show');">User Parameter</a></li>
                <li><a href="#" onclick="c_showpage('f_user','user_show');">User</a></li>
                <?php }?> 
                <li><a href="#" onclick="c_showpage('f_fem','fem_show');">Fee</a></li>
            </ul>
        </li>
        <?php }?>   
        <?php if(($sess['lvl']<=10 && $sess['lvl_sub']==0) || $sess['lvl']<0)  {?>
        <li>Upload Data
            <ul>
                <li><a href="#" onclick="c_showpage('f_du','du_show');">NAV or GL per Fund</a></li>
                <li><a href="#" onclick="c_showpage('f_dumi','dumi_show');">NAV or GL All</a></li>
                <?php if(($sess['lvl']<=7 && $sess['lvl_sub']==0) || $sess['lvl']<0)  {?>
                <li><a href="#" onclick="c_showpage('f_fu','fu_show');">FI Tax</a></li>
                <?php } ?>
            </ul>
        </li> 
        <li>Process Data
            <ul>
                <li><a href="#" onclick="c_showpage('f_na','na_show');">Approval for NAV &amp; GL</a></li>
                <li><a href="#" onclick="c_showpage('f_nagl','nagl_show');">Approval for GL All</a></li>
                <?php if (($sess['lvl']==0 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
                <li><a href="#" onclick="c_showpage('f_eod','eod_show');">End of Year</a></li>
                <?php }?> 
            </ul>
        </li> 
        <?php }?>
        <?php if($sess['lvl']<=15)   {?>
        <li>Reporting &amp; Inquery
            <ul>
                <li><a href="#" onclick="c_showpage('f_nbm','nbm_show');">NAV &amp; TB Process Monitoring</a></li>                
                
                <li><a href="#" onclick="c_showpage('f_nl','nl_show');">NAV Listing</a></li>
                <li><a href="#" onclick="c_showpage('f_rf','rf_show');">Financial Reporting</a></li>
                <li><a href="#" onclick="c_showpage('f_fia','fia_show');">FI Accrued Interest Inquery</a></li>
                <?php if($sess['lvl']<=10)   {?>
                <li><a href="#" onclick="c_showpage('f_rmi','rmi_show');">MI Reports</a></li>
                <?php }?>
                <!--
                <li><a href="#" onclick="c_showpage('f_xd1','xd1_show');">Formulir X.D.1</a></li>
                -->
                <li><a href="#" onclick="c_showpage('f_rfh','rfh_show');">History Financial Reporting</a></li>
                <?php if($sess['lvl']<=10)   {?> 
                <!--
                <li><a href="#" onclick="c_showpage('f_rexp','rexp_show');">NAV Expenses (dev)</a></li>
                -->
                <li><a href="#" onclick="c_showpage('f_mm','mm_show');">Email Monitoring </a></li>
                <li><a href="#" onclick="c_showpage('f_rfe','rfe_show');">Daily Fee</a></li>
                <?php }?>
                <?php if($sess['lvl']<=10)   {?> 
                <li><a href="#" onclick="c_showpage('f_rsinvest','rsinvest_show');">NAV Performance S-Invest</a></li>
                <?php }?>
                <li><a href="#" onclick="c_showpage('f_tv','tv_show');">Portfolio Valuation Summary</a></li>                
            </ul>
        </li> 
        <?php }?>
        <?php if ( ($sess['lvl']<=10 && $sess['lvl_sub']==0) || $sess['lvl']<0){?>
        <li>Tools
            <ul>
                <li><a href="#" onclick="c_showpage('f_ibpa','ibpa_show');">IBPA Data Extraction</a></li>
                <li><a href="#" onclick="c_showpage('f_ibpar','ibpar_show');">IBPA vs Hiport Reconciliation</a></li>
                <li><a href="#" onclick="c_showpage('f_fifo','fifo_show');">Sales by FIFO</a></li>
                <li><a href="#" onclick="c_showpage('f_subred','subred_show');">Subs/ Red Reconciliation</a></li>
            </ul>
        </li> 
        <?php }?>
        <li><a href="<?php echo $url;?>index.php/cs/show_change_pass">Change Password</a></li>
        <li><a href="<?php echo $url;?>index.php/cs/do_logout">Logout</a></li>
    </ul>
