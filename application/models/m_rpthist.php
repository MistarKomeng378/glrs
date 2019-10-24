<?php
class M_rpthist extends CI_Model {

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
    function get_navlisting($pf,$sdt,$edt)
    {
        $str_sql = "EXEC NAVVIEWLISTSP '{$pf}','{$sdt}','{$edt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_bs($pf,$sdt,$edt,$rt)
    {
        $str_sql = "EXEC GETBSREPORTHISTSP '{$pf}','{$sdt}','{$edt}','{$rt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_pl($pf,$sdt,$mdt,$edt,$rt)
    {
        $str_sql = "EXEC GETPLREPORTHISTSP '{$pf}','{$sdt}','{$mdt}','{$edt}','{$rt}'";
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
        $str_sql = "EXEC GETMTMJOURNALHISTSP '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_tb($pf,$sdt,$dt)
    {
        $str_sql = "EXEC GETTBREPORTHISTORYSP '{$pf}','{$sdt}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_nc($pf,$sdt,$dt,$rt)
    {
        $str_sql = "EXEC GETNAVCHANGESHISTORYSP '{$pf}','{$sdt}','{$dt}','{$rt}'"; 
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_gam_all($pf,$sdt,$dt)
    {
        $str_sql = "EXEC GETGLMOVEMENTALLHISTORYSP '{$pf}','{$sdt}','{$dt}'"; 
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_gam($pf,$acc,$sdt,$dt)
    {
        $str_sql = "EXEC GETGLMOVEMENTHISTORYREPORTSP '{$pf}','{$acc}','{$sdt}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_nav($pf,$acc,$sdt,$dt)
    {
        $str_sql = "EXEC GETGLMOVEMENTREPORTSP '{$pf}','{$acc}','{$sdt}','{$dt}'"; echo $str_sql;
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fin_dgb($pf,$dt)
    {
        $str_sql = "EXEC GETGLBALANCESP '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
