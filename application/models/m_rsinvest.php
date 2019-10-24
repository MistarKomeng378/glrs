<?php
class M_rsinvest extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function get_nav($dt='',$k='NAVK')   
    {
        $str_sql = "EXEC gw_nav_sinvest_nav_performance '{$dt}','{$k}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}
?>
