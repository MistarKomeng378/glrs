<?php
class M_subred extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function clear_batch_query()
    {
        $this->query='';
    }
    function run_batch_query()
    {
        if($this->query!='')
            $this->db->query($this->query);
    }
    function insert_batch($pf,$dt,$tp,$bal,$uid)
    {
        $this->query.="insert into gw_subred_daily_glrs(PortfolioCode, NavDate, [Type], Balance, UploadDate, UploadBy)
            values('{$pf}','{$dt}','{$tp}','{$bal}',getdate(),'{$uid}');";
    }
    function delete_tmp()
    {
        $str_sql = "delete from gw_subred_daily_glrs;";        // echo $str_sql;
        $this->db->query($str_sql);
    }
    function get_rekon($dt)
    { 
        $str_sql = "exec gw_subred_rekon '{$dt}'";
        $query = $this->db->query($str_sql);
        return $query->result_array(); ;
    }
    
}

?>
