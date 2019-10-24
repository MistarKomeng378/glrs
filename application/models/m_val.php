<?php
class M_val extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function up_delete($uid)   
    {
        $str_sql = "EXEC gw_up_val_delete '{$uid}'  ";
        $this->db->query($str_sql);
    }
    function up_insert($dt,$time,$pf,$cat,$secname,$liq,$group,$seccode,$holding,$cost,$mkt,$unreal,$accrued,$zlex,$cur,$ex_code,$uid,$syar='')   
    {
        $str_sql = "EXEC gw_up_val_insert '{$dt}','{$time}','{$pf}','{$cat}','{$secname}','{$liq}','{$group}','{$seccode}',{$holding},{$cost},{$mkt},{$unreal},{$accrued},'{$zlex}','{$cur}','{$ex_code}','{$uid}','{$syar}'  ";
        $this->db->query($str_sql);
    }
    function up_move($pf,$dt,$uid)
    {
        $str_sql = "EXEC gw_up_val_move '{$pf}','{$dt}','{$uid}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function up_move_mi($fm,$dt,$uid)
    {
        $str_sql = "EXEC gw_up_val_move_mi '{$fm}','{$dt}','{$uid}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>