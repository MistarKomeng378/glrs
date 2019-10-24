<?php
class M_ui extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function get_last_date($pf='')   
    {
        $str_sql = "EXEC gw_unit_issued_get_last '{$pf}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_data($pf='',$dt)   
    {
        $str_sql = "EXEC gw_unit_issued_get '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function upd_data($pf='',$dt,$nml,$uid)   
    {
        $str_sql = "EXEC gw_unit_issued_update '{$pf}','{$dt}','{$nml}','{$uid}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
