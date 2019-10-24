<?php
class M_reksadana extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data($type=0)   
    {
        $str_sql = "EXEC gw_type_reksadana_list '{$type}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($tp_code,$tp_name,$tp_ket)   
    {
        $str_sql = "EXEC gw_type_reksadana_save '{$tp_code}','{$tp_name}','{$tp_ket}'";
        $this->db->query($str_sql);
    }
    function get_data($tp_code)   
    {
        $str_sql = "EXEC gw_type_reksadana_get '{$tp_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
    
}

?>
