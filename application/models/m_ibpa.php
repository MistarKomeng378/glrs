<?php
class M_ibpa extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function get_setting()
    {
        $str_sql = "select top 1 * from gw_ibpa_setting"; 
        $query = $this->db->query($str_sql);
        return $query->result_array();
    }
    function get_mi_ph()
    { 
        $str_sql = "select IBpaCode mi_code,PricingHour mi_pricing_hour,FundManagerCode mi_hiport_code 
from FundManagerTB where ibpacode<>'' and ibpacode is not null";
        $query = $this->db->query($str_sql);
        return $query->result_array();
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
    function insert_batch_ibpa_price($addr,$dt,$mi,$sec,$price,$secname='')
    {
        $this->query.="insert into gw_ibpa_price_tmp(client_address,ibpa_date,mi_code,sec_code,ibpa_price,sec_name)
            values('{$addr}','{$dt}','{$mi}','{$sec}','{$price}','{$secname}');";
    }
    function insert_batch_hiport_price($addr,$dt,$ph,$sec,$price)
    {
        $this->query.="insert into gw_ibpa_price_mi_tmp(client_address,hiport_date,hiport_ph,sec_code,hiport_price)
            values('{$addr}','{$dt}','{$ph}','{$sec}','{$price}');";
    }
    function delete_tmp($addr)
    {
        $str_sql = "delete from gw_ibpa_price_tmp where client_address = '{$addr}';delete from gw_ibpa_price_mi_tmp where client_address = '{$addr}'";        // echo $str_sql;
        $this->db->query($str_sql);
    }
    function get_rekon($dt,$addr)
    { 
        $str_sql = "exec gw_ibpa_rekon '{$dt}','{$addr}'";
        $query = $this->db->query($str_sql);
        return $query->result_array(); ;
    }
    
}

?>
