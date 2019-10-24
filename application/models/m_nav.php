<?php
class M_nav extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function check_status($pf='',$dt='')   
    {
        $str_sql = "EXEC gw_nav_get_status '{$pf}','{$dt}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function check_status_cur($pf='',$dt='')   
    {
        $str_sql = "EXEC gw_nav_get_status_cur '{$pf}','{$dt}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function process($pf,$dt)
    { 
        $str_sql = "EXEC gw_nav_process '{$pf}','{$dt}'";
        $this->db->query($str_sql);
    }
    function get_detail($pf,$dt)
    {
        $str_sql = "exec gw_nav_get_detail '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_category($pf,$dt)
    {
        $str_sql = "EXEC gw_nav_get_category  '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_section($pf,$dt,$sect)
    {
        $str_sql = "EXEC gw_nav_get_section  '{$pf}','{$dt}','{$sect}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function approve($pf,$dt,$uid)
    { 
        $str_sql = "EXEC gw_nav_approve '{$pf}','{$dt}','{$uid}','{$_SERVER['REMOTE_ADDR']}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function unapprove($pf,$dt,$uid)
    { 
        $str_sql = "EXEC gw_nav_unapprove '{$pf}','{$dt}','{$uid}','{$_SERVER['REMOTE_ADDR']}'";
        $this->db->query($str_sql);
    }
    function gldone($pf,$dt,$uid)
    { 
        $str_sql = "EXEC gw_nav_gldone '{$pf}','{$dt}','{$uid}','{$_SERVER['REMOTE_ADDR']}'";
        $this->db->query($str_sql);
    }
    function glundone($pf,$dt,$uid)
    { 
        $str_sql = "EXEC gw_nav_glundone '{$pf}','{$dt}','{$uid}','{$_SERVER['REMOTE_ADDR']}'";
        $this->db->query($str_sql);
    }
    function approved_list($dt)
    {
        $str_sql = "EXEC gw_nav_approved_list  '{$dt}'"; 
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function last_approved_list($fm)
    {
        $str_sql = "EXEC gw_nav_last_approved_list  '{$fm}'"; 
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_expenses($pf,$dt)
    {
        $str_sql = "EXEC gw_nav_expense_get  '{$pf}','{$dt}'"; 
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function pre_gldone_all($dt)
    {
        $str_sql = "EXEC gw_nav_get_detail_all  '{$dt}'"; 
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function gldone_all($dt,$uid)
    { 
        $str_sql = "EXEC gw_nav_gldone_all '{$dt}','{$uid}','{$_SERVER['REMOTE_ADDR']}'";
        $this->db->query($str_sql);
    }
}

?>
