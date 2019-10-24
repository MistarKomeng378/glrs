<?php
class M_orchid extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data($type=0)   
    {
        $str_sql = "EXEC gw_type_orchid_list '{$type}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($oc_code,$oc_name)   
    {
        $str_sql = "EXEC gw_type_orchid_save '{$oc_code}','{$oc_name}'";
        $this->db->query($str_sql);
    }
    function get_data($oc_code)   
    {
        $str_sql = "EXEC gw_type_orchid_get '{$oc_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
    
}

?>
