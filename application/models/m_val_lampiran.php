<?php
class M_val_lampiran extends CI_Model {    
    private $q_rows = 400;
    private $q_str_val = "";   
    private $q_str_bas = "";
    private $q_str_bal = "";
    private $q_str_trx = "";
    private $q_str_ost = "";
    private $q_count =array("val"=>0,"bas"=>0,"bal"=>0,"trx"=>0,"ost"=>0);

    function __construct()
    {                                     
        parent::__construct();           
        $this->load->database('default');
        $this->up_q_clear();
    }
    function up_delete($uid)   
    {
        $str_sql = "EXEC gw_up_val_lamp_delete '{$uid}'  ";
        $this->db->query($str_sql);
    }
    function val_insert($dt,$time,$pf,$cat,$secname,$liq,$group,$seccode,$holding,$cost,$mkt,$unreal,$accrued,$zlex,$cur,$ex_code,$uid,$syar='')   
    {
        $str_sql = "EXEC gw_up_val_insert '{$dt}','{$time}','{$pf}','{$cat}','{$secname}','{$liq}','{$group}','{$seccode}',{$holding},{$cost},{$mkt},{$unreal},{$accrued},'{$zlex}','{$cur}','{$ex_code}','{$uid}','{$syar}'  ";
        $this->db->query($str_sql);
    }
    function bas_insert($client_code, $data_date, $bank_name, $transtype,  $id, $detail, $detail1, $debit, $kredit, $balance,$no,$user_login)   
    {
        $str_sql = "EXEC gw_up_rpt_bas_insert '{$client_code}','{$data_date}','{$bank_name}','{$transtype}','{$id}','{$detail}','{$detail1}','{$debit}','{$kredit}','{$balance}','{$no}','{$user_login}'  ";
        $this->db->query($str_sql);
    }
    function bal_insert($client_code, $data_date, $bank_code, $bank_name, $due_date, $rate, $amount1, $amount2,$user_login)   
    {
        $str_sql = "EXEC gw_up_rpt_bal_insert '{$client_code}','{$data_date}','{$bank_code}','{$bank_name}','{$due_date}','{$rate}','{$amount1}','{$amount2}','{$user_login}'  ";
        $this->db->query($str_sql);
    }
    function trx_insert($client_code, $data_date, $trx_date, $trx_type, $sec_code, $sec_name, $id, $due_date, $rate, $unit, $cost, $int_inc, $proceed, $pl, $notes,$user_login)   
    {
        $str_sql = "EXEC gw_up_rpt_trx_insert '{$client_code}','{$data_date}','{$trx_date}','{$trx_type}','{$sec_code}','{$sec_name}','{$id}','{$due_date}','{$rate}','{$unit}','{$cost}','{$int_inc}','{$proceed}','{$pl}','{$notes}','{$user_login}'  ";
        $this->db->query($str_sql);
    }
    function ost_insert($client_code, $data_date, $contract_date, $settle_date, $broker_name,$broker_code, $id, $sec_code, $sec_name, $trx_type, $trx_name, $unit, $cur, $amount,$user_login)   
    {
        $str_sql = "EXEC gw_up_rpt_ost_insert '{$client_code}','{$data_date}','{$contract_date}','{$settle_date}','{$broker_name}','{$broker_code}','{$id}','{$sec_code}','{$sec_name}','{$trx_type}','{$trx_name}','{$unit}','{$cur}','{$amount}','{$user_login}'  ";
        $this->db->query($str_sql);
    }
    function up_move($pf,$dt,$uid)
    {
        $str_sql = "EXEC gw_up_val_lamp_move '{$pf}','{$dt}','{$uid}'  ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
    
    function up_q_clear($qall="all")
    {
        if($qall=='all' || $qall=='val')
            $this->q_str_val = "";      
        if($qall=='all' || $qall=='bas')
            $this->q_str_bas = "";
        if($qall=='all' || $qall=='bal')
            $this->q_str_bal = "";
        if($qall=='all' || $qall=='trx')
            $this->q_str_trx = "";
        if($qall=='all' || $qall=='ost')
            $this->q_str_ost = "";
        if($qall=='all')
            $this->q_count =array("val"=>0,"bas"=>0,"bal"=>0,"trx"=>0,"ost"=>0);
        else
            $this->q_count[$qall]=0;
    }
    function up_q_set_rows($r)
    {
        $this->q_rows=$r;
    }
    function up_q_insert_val($dt,$time,$pf,$cat,$secname,$liq,$group,$seccode,$holding,$cost,$mkt,$unreal,$accrued,$zlex,$cur,$ex_code,$uid,$syar='')   
    {
        $this->q_str_val.="INSERT INTO gw_up_mtmimporttb
    ( MTMDATE, MTMTIME, PORTFOLIOCODE, SECURITYCATEGORY, SECURITYNAME, LIQUIDITYCODE, GLGROUP, SECURITYCODE,
    HOLDING, TOTALCOST, TOTALVALUE, UNREALIZEDVALUE, ACCRUEDINTEREST , ZLEXPIRYDATE, CURRENCY,EXTERNALCODE,user_login,SYARIAH_CODE )
    VALUES
    ('{$dt}','{$time}','{$pf}','{$cat}','{$secname}','{$liq}','{$group}','{$seccode}',{$holding},{$cost},{$mkt},{$unreal},{$accrued},'{$zlex}','{$cur}','{$ex_code}','{$uid}','{$syar}');\r\n";
        $this->q_count['val']++;
        if($this->q_count['val']==$this->q_rows)
            $this->up_q_run('val');
    }
    function up_q_insert_bas($client_code, $data_date, $bank_name, $transtype,  $id, $detail, $detail1, $debit, $kredit, $balance,$no,$user_login)   
    {
        $this->q_str_bas.="insert into gw_up_rpt_bas ( client_code, data_date, bank_name, transtype,  id, detail, detail1, debit, kredit, balance,[no],user_login)
    VALUES
    ('{$client_code}','{$data_date}','{$bank_name}','{$transtype}','{$id}','{$detail}','{$detail1}','{$debit}','{$kredit}','{$balance}','{$no}','{$user_login}');\r\n";
        $this->q_count['bas']++;
        if($this->q_count['bas']==$this->q_rows)
            $this->up_q_run('bas');
    }
    function up_q_insert_bal($client_code, $data_date, $bank_code, $bank_name, $due_date, $rate, $amount1, $amount2,$user_login)   
    {
        $this->q_str_bal.="insert into gw_up_rpt_bal (client_code, data_date, bank_code, bank_name, due_date, rate, amount1, amount2,user_login)
    VALUES
    ('{$client_code}','{$data_date}','{$bank_code}','{$bank_name}','{$due_date}','{$rate}','{$amount1}','{$amount2}','{$user_login}');\r\n";
        $this->q_count['bal']++;
        if($this->q_count['bal']==$this->q_rows)
            $this->up_q_run('bal');
    }
    function up_q_insert_trx($client_code, $data_date, $trx_date, $trx_type, $sec_code, $sec_name, $id, $due_date, $rate, $unit, $cost, $int_inc, $proceed, $pl, $notes,$user_login)   
    {
        $this->q_str_trx.="insert into gw_up_rpt_trx (client_code, data_date, trx_date, trx_type, sec_code, sec_name, id, due_date, rate, unit, cost, int_inc, proceed, pl, notes,user_login)
    VALUES
    ('{$client_code}','{$data_date}','{$trx_date}','{$trx_type}','{$sec_code}','{$sec_name}','{$id}','{$due_date}','{$rate}','{$unit}','{$cost}','{$int_inc}','{$proceed}','{$pl}','{$notes}','{$user_login}');\r\n";
        $this->q_count['trx']++;
        if($this->q_count['trx']==$this->q_rows)
            $this->up_q_run('trx');
    }
    function up_q_insert_ost($client_code, $data_date, $contract_date, $settle_date, $broker_name,$broker_code, $id, $sec_code, $sec_name, $trx_type, $trx_name, $unit, $cur, $amount,$user_login)   
    {
        $this->q_str_ost.="insert into gw_up_rpt_ost (client_code, data_date, contract_date, settle_date, broker_name,broker_code, id, sec_code, sec_name, trx_type, trx_name, unit, cur, amount,user_login)
    VALUES
    ('{$client_code}','{$data_date}','{$contract_date}','{$settle_date}','{$broker_name}','{$broker_code}','{$id}','{$sec_code}','{$sec_name}','{$trx_type}','{$trx_name}','{$unit}','{$cur}','{$amount}','{$user_login}');\r\n";
        $this->q_count['ost']++;
        if($this->q_count['ost']==$this->q_rows)
            $this->up_q_run('ost');
    }
    function up_q_run($qall='all')
    {
        if($qall=='all' || $qall=='val')
            if($this->q_count["val"]>0)
            { 
                $this->db->query($this->q_str_val);
                $this->up_q_clear("val");
            }
        if($qall=='all' || $qall=='bas')
            if($this->q_count["bas"]>0)
            {
                $this->db->query($this->q_str_bas);
                $this->up_q_clear("bas");
            }
        if($qall=='all' || $qall=='bal')
            if($this->q_count["bal"]>0)
            {
                $this->db->query($this->q_str_bal);
                $this->up_q_clear("bal");
            }
        if($qall=='all' || $qall=='trx')
            if($this->q_count["trx"]>0)
            {
                $this->db->query($this->q_str_trx);
                $this->up_q_clear("trx");
            }
        if($qall=='all' || $qall=='ost')
            if($this->q_count["ost"]>0)
            {
                $this->db->query($this->q_str_ost);
                $this->up_q_clear("ost");
            }        
    }
    function up_q_move($dt,$uid)
    {
        $str_sql = "EXEC gw_up_val_lamp_move_all '{$dt}','{$uid}' ";
        $query=$this->db->query($str_sql);
        return $query->result_array();
    }
}

?>