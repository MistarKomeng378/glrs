<?php
class M_portfolio extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data($fundmanager_code='ALL',$type)   
    {
        $str_sql = "EXEC gw_portfolio_list '{$fundmanager_code}','{$type}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
    function save_data($pf_code,$pf_name,$fm_code,$pf_cy,$pf_cur,$pf_active,$pf_ph,$pf_mm,$pf_type,$pf_pdec,$pf_ndec,$pf_udec,$pf_mail,$filecode,$pf_gl,$pf_otype,$pf_okind,$scode='',$tb='',$pf_mailtb=0,$pf_mailval=0)   
    {
        $str_sql = "EXEC gw_portfolio_save '{$pf_code}','{$pf_name}','{$fm_code}','{$pf_cy}','{$pf_cur}','{$pf_active}','{$pf_ph}','{$pf_mm}','{$pf_type}','{$pf_pdec}','{$pf_ndec}','{$pf_udec}','{$pf_mail}','{$filecode}','{$pf_gl}','{$pf_otype}','{$pf_okind}','{$scode}','{$tb}','{$pf_mailtb}','{$pf_mailval}'";
        $this->db->query($str_sql); //echo $str_sql;
    }
    function get_data($pf_code)   
    {
        $str_sql = "EXEC gw_portfolio_get '{$pf_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    //Edit By MistarKomeng
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
    function get_data_approved($mi_code,$dt)   
    {
        $str_sql = "EXEC gw_portfolio_get_approved '{$mi_code}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }

    function list_mm_fund_type()   
    {
        $str_sql = "EXEC gw_portfolio_mm_fund_type_list";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
