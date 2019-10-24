<?php
class M_rmi extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function get_data($fm,$pf,$dt,$t)
    {
        if($t=='NAVB')
            $str_sql = "EXEC gw_rpt_business '{$dt}'";
        else if($t=='NAVS')
            $str_sql = "EXEC gw_rpt_nav_summary '{$fm}','{$dt}'";
        else if($t=='PP')
            $str_sql = "EXEC gw_rpt_top '{$fm}','{$pf}','{$dt}'";     
        else if($t=='NAVD')
            $str_sql = "EXEC gw_rpt_nav_detail '{$pf}','{$dt}'";
        else if($t=='NAVD1')
            $str_sql = "EXEC gw_rpt_nav_detail_bhn '{$fm}','{$dt}'";
        else
            $str_sql = "select 1 a where 1=2";
        
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
