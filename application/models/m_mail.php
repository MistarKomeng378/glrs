<?php
class M_mail extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function list_data()   
    {
        $str_sql = "EXEC gw_mail_list";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($ml_id,$ml_def,$ml_host,$ml_user,$ml_pass,$ml_send,$ml_sendname)   
    {
        $str_sql = "EXEC gw_mail_save '{$ml_id}','{$ml_def}','{$ml_host}','{$ml_user}','{$ml_pass}','{$ml_send}','{$ml_sendname}'";
        $this->db->query($str_sql);
    }
      
}

?>
