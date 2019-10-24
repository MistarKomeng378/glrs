<?php
class M_fee extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_code()   
    {
        $str_sql = "EXEC gw_fee_list_code";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
    function save_data($pf_code,$fem_code,$fem_pct,$fem_val,$fem_year,$fem_flat,$fem_daily,$fem_enable,$fem_inc,$fem_tax,$baseon='PREVNAV',$fnav=1000)   
    {
        $str_sql = "EXEC gw_fee_save_master '{$pf_code}','{$fem_code}','{$fem_pct}','{$fem_val}','{$fem_year}','{$fem_flat}','{$fem_daily}','{$fem_enable}','{$fem_inc}','{$fem_tax}','{$baseon}','{$fnav}'";
        $this->db->query($str_sql);
        //echo $str_sql;
    }
    function list_master($fm_code,$pf_code)   
    {
        $str_sql = "EXEC gw_fee_list_master '{$fm_code}','{$pf_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function list_orchid_type()
    {
        $str_sql = "EXEC gw_portfolio_ochid_type_list";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function list_orchid_kind()
    {
        $str_sql = "EXEC gw_portfolio_ochid_kind_list";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function list_master_detail($pf_code,$fee_code)   
    {
        $str_sql = "EXEC gw_fee_list_master_detail '{$pf_code}','{$fee_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data_detail($pf_code,$fem_code,$fem_pct,$fem_end,$fem_no)   
    {
        $str_sql = "EXEC gw_fee_save_master_detail '{$pf_code}','{$fem_code}','{$fem_pct}','{$fem_end}','{$fem_no}'";
        $this->db->query($str_sql);
    }
    function delete_data_detail($pf_code,$fem_code,$fem_no)   
    {
        $str_sql = "EXEC gw_fee_delete_master_detail '{$pf_code}','{$fem_code}','{$fem_no}'";
        $this->db->query($str_sql);
    }
    function get_expense($pf,$dt)
    {
        //$str_sql = "EXEC FEEREPORTVIEWSP '{$pf}','{$dt}'";
        $str_sql = "EXEC gw_feereport_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_master()
    {
        $str_sql = "EXEC [gw_fee_get_master]";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_detail()
    {
        $str_sql = "EXEC [gw_fee_get_detail]";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
