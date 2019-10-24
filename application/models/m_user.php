<?php
class M_user extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function get_info($user_login ='' )   
    {
        $str_sql = "EXEC gw_user_info '{$user_login}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function lock($user_login ='',$locked=1 )   
    {
        $str_sql = "EXEC gw_user_lock '{$user_login}',{$locked} ";
        $this->db->query($str_sql);        
    }
    function set_wrong_pass_count($user_login,$count)
    {
        $str_sql = "EXEC gw_user_set_wrong_pass_count '{$user_login}',{$count} ";
        $this->db->query($str_sql);        
    }
    function reset_last_login($user_login)
    {
        $str_sql = "EXEC gw_user_reset_last_login '{$user_login}' ";
        $this->db->query($str_sql);        
    }
    function reset_last_change_password($user_login)
    {
        $str_sql = "EXEC gw_user_reset_last_change_password '{$user_login}' ";
        $this->db->query($str_sql);        
    }
    function change_password($user_login,$user_password)
    {
        $str_sql = "EXEC gw_user_change_password '{$user_login}','{$user_password}' ";
        $this->db->query($str_sql);        
    }
    function get_parameter()   
    {
        $str_sql = "EXEC gw_user_parameter_get";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function update_parameter($eld,$epd,$minp,$anp,$ccp,$rtp,$mwp,$minu,$maxu)
    {
        $str_sql = "EXEC gw_user_parameter_update '{$eld}','{$epd}','{$minp}','{$anp}','{$ccp}','{$rtp}','{$mwp}','{$minu}','{$maxu}' ";
        $this->db->query($str_sql);
    }
    function list_data($uid)   
    {
        $str_sql = "EXEC gw_user_list '{$uid}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function save_data($uid,$uname,$pass,$ulvl,$ugroup,$uenable,$ulock,$a,$by)
    {
        $str_sql = "EXEC gw_user_save '{$uid}','{$uname}','{$pass}','{$ulvl}','{$ugroup}','{$uenable}','{$ulock}','{$a}','{$by}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function reset_pass($uid,$pass,$by)
    {
        $str_sql = "EXEC gw_user_reset_pass '{$uid}','{$pass}','{$by}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
