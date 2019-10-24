<?php
class M_eod extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function process($pf)
    {
        $str_sql = "EXEC gw_eoy_process '{$pf}'";
        $this->db->query($str_sql);
    }
    function cancel($pf)
    {
        $str_sql = "EXEC gw_eoy_cancel '{$pf}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
