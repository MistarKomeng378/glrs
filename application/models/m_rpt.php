<?php
class M_rpt extends CI_Model {

    private $q_param = array();
    function __construct()
    {
        parent::__construct();           
        $this->load->database('default');
    }
    function get_procmon($dt)
    {
        $str_sql = "EXEC gw_rpt_nbmon '{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_alertmon($dt)
    {
        $str_sql = "EXEC gw_rpt_alertmon '{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_navlisting($pf,$sdt,$edt)
    {
        $str_sql = "EXEC NAVVIEWLISTSP '{$pf}','{$sdt}','{$edt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_bs($pf,$sdt,$edt,$rt)
    {
        $str_sql = "EXEC GETBSREPORTSP '{$pf}','{$sdt}','{$edt}','{$rt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_pl($pf,$sdt,$mdt,$edt,$rt)
    {
        $str_sql = "EXEC GETPLREPORTSP '{$pf}','{$sdt}','{$mdt}','{$edt}','{$rt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_val($pf,$dt)
    {
        $str_sql = "EXEC GETMTMREPORTSP '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_mtm($pf,$dt)
    {
        $str_sql = "EXEC GETMTMJOURNALSP '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_tb($pf,$sdt,$dt)
    {
        $str_sql = "EXEC gw_rpt_tb '{$pf}','{$sdt}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_nc($pf,$sdt,$dt,$rt)
    {
        $str_sql = "EXEC GETNAVCHANGESSP '{$pf}','{$sdt}','{$dt}','{$rt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_gam_all($pf,$sdt,$dt)
    {
        $str_sql = "EXEC GETGLMOVEMENTALLSP '{$pf}','{$sdt}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_gam($pf,$acc,$sdt,$dt)
    {
        $str_sql = "EXEC GETGLMOVEMENTREPORTSP '{$pf}','{$acc}','{$sdt}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_nav($pf,$acc,$sdt,$dt)
    {
        $str_sql = "EXEC GETGLMOVEMENTREPORTSP '{$pf}','{$acc}','{$sdt}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_dgb($pf,$dt)
    {
        $str_sql = "EXEC GETGLBALANCESP '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_valint($pf,$dt)
    {
        $str_sql = "EXEC gw_mtm_accrued_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_nav_performance($pf,$sdt,$dt)
    {
        $str_sql = "EXEC gw_nav_performance '{$pf}','{$sdt}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_mailmon($dt)
    {
        $str_sql = "EXEC gw_mail_monitor '{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_fb_pvr($pf,$dt)
    {
        $str_sql = "EXEC gw_rpt_pvr_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_fb_bas($pf,$dt)
    {
        $str_sql = "EXEC gw_rpt_bas_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_fb_bal($pf,$dt)
    {
        $str_sql = "EXEC gw_rpt_bal_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_fb_trx($pf,$dt)
    {
        $str_sql = "EXEC gw_rpt_trx_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_fb_ost($pf,$dt)
    {
        $str_sql = "EXEC gw_rpt_ost_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_tv($dt)
    {
        $str_sql = "EXEC sp_mtmgettotalvalue '{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
