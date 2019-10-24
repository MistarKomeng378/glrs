<?php
class M_gl extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data($fm_code='ALL',$pf_code='ALL')   
    {
        $str_sql = "EXEC gw_glmaster_list '{$fm_code}','{$pf_code}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($fm_code,$pf_code,$glno,$glname,$glsign,$gltype,$glcur,$glcur1)   
    {
        $str_sql = "EXEC gw_glmaster_save '{$fm_code}','{$pf_code}','{$glno}','{$glname}','{$glsign}','{$gltype}','{$glcur}','{$glcur1}'";
        $this->db->query($str_sql);
    }
    function get_data($fm_code,$pf_code,$glno,$cur)   
    {
        $str_sql = "EXEC gw_glmaster_get '{$fm_code}','{$pf_code}','{$glno}','{$cur}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
}

?>
