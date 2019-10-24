<?php
class M_xd1 extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function get_xd1($pf,$dt,$no)
    {
        if($no==1)
            $str_sql = "EXEC gw_get_bapepam11 '{$dt}','{$pf}'";
        else if($no==2)
            $str_sql = "EXEC gw_get_bapepam12 '{$dt}','{$pf}'";
        else
            $str_sql = "EXEC gw_get_bapepam13 '{$dt}','{$pf}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_xd1_hist($pf,$dt,$no)
    {
        if($no==1)
            $str_sql = "EXEC gw_get_bapepam11_hist '{$dt}','{$pf}'";
        else if($no==2)
            $str_sql = "EXEC gw_get_bapepam12_hist '{$dt}','{$pf}'";
        else
            $str_sql = "EXEC gw_get_bapepam13_hist '{$dt}','{$pf}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
