<?php
class M_jur extends CI_Model {

    private $q_str = "";
    private $q_rows = 400;
    private $q_count=0;
    
    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
        $this->up_q_clear();
    }
    function up_delete($uid)
    {
        $str_sql = "EXEC gw_up_journal_delete '{$uid}'";
        $this->db->query($str_sql);
    }
    function up_insert($pf,$dt,$ref,$acc,$sign,$amount,$desc,$cur,$uid)   
    {
        $str_sql = "EXEC gw_up_journal_insert '{$pf}','{$dt}','{$ref}','{$acc}','{$sign}','{$amount}','{$desc}','{$cur}','{$uid}'";
        $this->db->query($str_sql);
    }
    function up_move($pf,$sdt,$dt,$uid)
    {
        $str_sql = "EXEC gw_up_journal_move '{$pf}','{$sdt}','{$dt}','{$uid}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    function mtm_process($pf,$dt)
    {
        $str_sql = "EXEC gw_mtm_process '{$pf}','{$dt}' ";
        $this->db->query($str_sql);
    }
    function mtm_process_all($dt)
    {
        $str_sql = "EXEC gw_mtm_process_all '{$dt}' ";
        $this->db->query($str_sql);
    }
    function up_move_mi($fm,$sdt,$dt,$uid)
    {
        $str_sql = "EXEC gw_up_journal_move_mi '{$fm}','{$sdt}','{$dt}','{$uid}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
    function up_q_clear()
    {
        $this->q_str="";
        $this->q_count=0;
    }
    function up_q_set_rows($r)
    {
        $this->q_rows=$r;
    }
    function up_q_insert($pf,$dt,$ref,$acc,$sign,$amount,$desc,$cur,$uid)
    {
        $this->q_str.="INSERT INTO gw_up_journaltb
                    ( PORTFOLIOCODE, JOURNALDATE, REFNO, ACCOUNTCODE, SIGNDC, AMOUNT, [DESCRIPTION], CURRENCY ,user_login)
                    VALUES
                    ('{$pf}','{$dt}','{$ref}','{$acc}','{$sign}',{$amount},'{$desc}','{$cur}','{$uid}');";
        $this->q_count++;
        if($this->q_count==$this->q_rows)
            $this->up_q_run();
    }
    function up_q_run()
    {
        if($this->q_count>0)
        {
            $this->db->query($this->q_str);
            $this->up_q_clear();
        }
    }
    function up_q_move($sdt,$edt,$uid)
    {
        $str_sql = "EXEC gw_up_journal_move_all '{$sdt}','{$edt}','{$uid}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>
