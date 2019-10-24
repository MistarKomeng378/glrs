<?php
class M_ia extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data($fm,$pf)
    {
        $str_sql = "EXEC gw_ia_list '{$fm}','{$pf}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_data($pf)
    {
        $str_sql = "EXEC gw_ia_get '{$pf}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($pf,$a_min,$a_max,$fi_min,$fi_max,$mm_min,$mm_max,$c_min,$c_max,$sub_min,$red_min)
    {
        $str_sql = "EXEC gw_ia_save '{$pf}','{$a_min}','{$a_max}','{$fi_min}','{$fi_max}','{$mm_min}','{$mm_max}','{$c_min}','{$c_max}','{$sub_min}','{$red_min}' ";
        $this->db->query($str_sql);        
    }
}

?>
