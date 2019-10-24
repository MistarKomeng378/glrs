<?php
class M_kindorchid extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data($type=0)   
    {
        $str_sql = "EXEC gw_kind_orchid_list '{$type}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($ock_code,$ock_name)   
    {
        $str_sql = "EXEC gw_kind_orchid_save '{$ock_code}','{$ock_name}'";
        $this->db->query($str_sql);
    }
    function get_data($ock_code)   
    {
        $str_sql = "EXEC gw_kind_orchid_get '{$ock_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
    
}

?>
