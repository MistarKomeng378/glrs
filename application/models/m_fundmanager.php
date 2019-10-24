<?php
class M_fundmanager extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data($type=0)   
    {
        $str_sql = "EXEC gw_fundmanager_list '{$type}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($fm_code,$fm_name,$fm_addr1,$fm_addr2,$fm_addr3,$fm_city,$fm_country,$fm_postal,$fm_phone1,$fm_phone2,$fm_fax1,$fm_fax2,$fm_mail,$fm_mailaddr,$fm_mailcc,$fm_time,$fm_ibpa)   
    {
        $str_sql = "EXEC gw_fundmanager_save '{$fm_code}','{$fm_name}','{$fm_addr1}','{$fm_addr2}','{$fm_addr3}','{$fm_city}','{$fm_country}','{$fm_postal}','{$fm_phone1}','{$fm_phone2}','{$fm_fax1}','{$fm_fax2}','{$fm_mail}','{$fm_mailaddr}','{$fm_mailcc}','{$fm_time}','{$fm_ibpa}'";
        $this->db->query($str_sql);
    }
    function get_data($fm_code)   
    {
        $str_sql = "EXEC gw_fundmanager_get '{$fm_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
}

?>
