<?php
class M_fi extends CI_Model {

    private $q_param = array();

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
    }
    function up_sec_delete($uid)
    {
        $str_sql = "EXEC gw_up_zfisec_delete '{$uid}'  ";
        $this->db->query($str_sql);
    }
    function up_sec_move($uid)
    {
        $str_sql = "EXEC gw_up_zfisec_move '{$uid}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function up_sec_insert($sec_code='',$sec_cat='',$sec_name='',$rate=0,$frek=0,$last_coupon='1900-01-01',$next_coupon='1900-01-01',$maturity='1900-01-01',$daysinyear=0,$daysinmonth=0,$uid)   
    {
        $str_sql = "EXEC gw_up_zfisec_insert '{$sec_code}','{$sec_cat}','{$sec_name}',{$rate},{$frek},'{$last_coupon}','{$next_coupon}','{$maturity}',{$daysinyear},{$daysinmonth},'{$uid}'  ";
        $this->db->query($str_sql);
    }
    function up_trx_delete($uid)
    {
        $str_sql = "EXEC gw_up_zfitrx_delete '{$uid}'  ";
        $this->db->query($str_sql);
    }
    function up_trx_move($pf,$dt,$uid)
    {
        $str_sql = "EXEC gw_up_zfitrx_move '{$pf}','{$dt}','{$uid}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function up_trx_insert($txn_no='',$pf_code='',$txn_type='',$cat='',$sec_code='',$trade_dt='1900-01-01',$set_dt='1900-01-01',$face_val=0,$price=0,$cost=0,$int=0,$acc_int=0,$tax=0,$tax_dt='1900-01-01',$last_coupon='1900-01-01',$next_coupon='1900-01-01',$frek=0,$corno=0,$uid)   
    {
        $str_sql = "EXEC gw_up_zfitrx_insert '{$txn_no}','{$pf_code}','{$txn_type}','{$cat}','{$sec_code}','{$trade_dt}','{$set_dt}',{$face_val},{$price},{$cost},{$int},{$acc_int},{$tax},'{$tax_dt}','{$last_coupon}','{$next_coupon}',{$frek},{$corno},'{$uid}'  ";
        $this->db->query($str_sql);
    }
     function get_tax($pf,$dt)
    {
        $str_sql = "EXEC gw_fi_get_tax '{$pf}','{$dt}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_tax_net($pf,$dt)
    {
        $str_sql = "EXEC gw_fi_get_tax_udjustment '{$pf}','{$dt}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_unset_trans($pf,$dt)
    {
        $str_sql = "EXEC [ZFIGETUNSETTLETRANSP] '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_acc_sales_unset($pf,$dt)
    {
        $str_sql = "EXEC [ZFIUNSETTLETXNADJUSTREPORT1] '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fiunsettle_tax_adjust1($pf,$dt)
    {
        $str_sql = "EXEC [ZFIGETTAXUNSETTLEADJUSTREPORT1] '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fiunsettle_txn_adjust($pf,$dt)
    {
        $str_sql = "EXEC [ZFIUNSETTLETXNADJUSTREPORT] '{$pf}','{$dt}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function process($pf,$dt,$uid='')
    {
        $str_sql = "EXEC gw_fi_process '{$pf}','{$dt}','{$uid}','{$_SERVER['REMOTE_ADDR']}' ";
        $this->db->query($str_sql);
    }
    function check_tax($pf,$dt)
    {
        $str_sql = "EXEC gw_fi_check '{$pf}','{$dt}' ";
        $this->db->query($str_sql);
    }
    function get_sectrx($pf)
    {
        $str_sql = "EXEC  gw_fi_get_sectrx  '{$pf}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function get_fifo_trx($pf,$sec)
    {
        $str_sql = "EXEC  gw_fi_get_fifotrx  '{$pf}','{$sec}'";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
