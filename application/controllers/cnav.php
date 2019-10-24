<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cnav extends CI_Controller {      
    var $data;
    function __construct()
    {
        parent::__construct();       
        $this->load->helper('url');
        $this->load->library('session');      
        $this->data=array("url"=>base_url(),"sess"=>$this->_get_login_info());
    }
    function index()
    {  
    }
    function _get_login_info()
    {
        $err = array("uid"=>"","name"=>'','lvl'=>100,'group'=>100);
        if($this->session->userdata('uid')!='')
        {
            $this->load->model("M_user");      
            $r_data=$this->M_user->get_info($this->session->userdata('uid'));
            if(count($r_data)>0)
            {
                $err['name']=$r_data[0]['user_name']; 
                $err['lvl']=$r_data[0]['user_lvl']; 
                $err['group']=$r_data[0]['user_group'];
                $err['uid']=$this->session->userdata('uid'); 
            }
        }
        return $err;
    }
    function check_status()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        if (!isset($param['pf']))
            $param['pf']='ALL';
        if (!isset($param['dt']))
            $param['dt']='01-01-1900';
        $sdt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);
        $this->load->model("M_nav");      
        $r_data=$this->M_nav->check_status($param['pf'],$sdt); 
        $arr_status=array('n_d'=>'','n_d1'=>'','n_s'=>'0','g_d'=>'','g_d1'=>'','g_s'=>'0v','u_d'=>'','u_d1'=>'','c_n'=>'','c_g'=>'','c_y'=>'','c_u'=>'0');
        if(count($r_data)>0)
        {
            $arr_status=array(
                'n_d'=> is_object($r_data[0]['VALUATIONDATE'])?date_format($r_data[0]['VALUATIONDATE'],'d M Y'):''
                ,'n_d1'=> is_object($r_data[0]['VALUATIONDATE'])?date_format($r_data[0]['VALUATIONDATE'],'d-m-Y'):''
                ,'n_s'=>$r_data[0]['APPROVESTATUS']
                ,'g_d'=>is_object($r_data[0]['GLDATE'])?date_format($r_data[0]['GLDATE'],'d M Y'):''
                ,'g_d1'=>is_object($r_data[0]['GLDATE'])?date_format($r_data[0]['GLDATE'],'d-m-Y'):''
                ,'g_s'=>$r_data[0]['GLDONESTATUS']
                ,'u_d'=>is_object($r_data[0]['URSPOSTDATE'])?date_format($r_data[0]['URSPOSTDATE'],'d M Y'):''
                ,'u_d1'=>is_object($r_data[0]['URSPOSTDATE'])?date_format($r_data[0]['URSPOSTDATE'],'d-m-Y'):''
                ,'c_n'=>$r_data[0]['APPROVESTATUS_CUR']
                ,'c_g'=>$r_data[0]['GLDONESTATUS_CUR']
                ,'c_y'=>is_object($r_data[0]['CURYEAR'])?date_format($r_data[0]['CURYEAR'],'d M Y'):''
                ,'c_u'=>$r_data[0]['UPOST']
                ,'c_ad'=>$r_data[0]['ALLDONE']
                ,'c_ys'=>$r_data[0]['CYEAR_STATUS']
                ,'g_eoy'=>$r_data[0]['GLEOYDONE']
                );
        }
        $this->data['r_data']=$arr_status;
        echo json_encode($this->data);
    }   
    function get_pre_approval ()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);   
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->load->model("M_nav");        
        
        $r_data=$this->M_nav->check_status($param['pf'],$dt); 
        
        if(count($r_data)>0)
        {
            if($r_data[0]['APPROVESTATUS']=='0' || $r_data[0]['APPROVESTATUS']=='')
            { 
                $this->M_nav->process($param['pf'],$dt); 
            }
            if($r_data[0]['GLDONESTATUS']=='0' && $r_data[0]['APPROVESTATUS_CUR']=='A')
            { 
                $this->load->model("M_jur");
                $this->M_jur->mtm_process($param['pf'],$dt); 
            }
        }
        $r_cat=$this->M_nav->get_category($param['pf'],$dt); 
        $r_nav=$this->M_nav->get_detail($param['pf'],$dt); 
        $r_section=array();
        $r_section['sect_A']=$this->M_nav->get_section($param['pf'],$dt,'A'); 
        if(count($r_section['sect_A'])>0)
        {
            $r_section['sect_B']=$this->M_nav->get_section($param['pf'],$dt,'B'); 
            $r_section['sect_C']=$this->M_nav->get_section($param['pf'],$dt,'C'); 
            //$r_section['sect_D']=$this->M_nav->get_section($param['pf'],$dt,'D'); 
            $r_section['sect_H']=$this->M_nav->get_section($param['pf'],$dt,'H'); 
            
        }
        $this->load->model("M_portfolio");
        $r_section['r_pf']=$this->M_portfolio->get_data($param['pf']); 
        $r_section['dt_nav']=$dt;
            
        $this->data['r_det']=array('invest'=>number_format($r_nav[0]['NAV_INVEST'],4,'.',','),'gl'=>number_format($r_nav[0]['NAV_GL'],4,'.',','),'diff'=>number_format($r_nav[0]['DIFF'],4,'.',','),
            'prev'=>number_format($r_nav[0]['NAV_PREV'],4,'.',','),'prevdiff'=>number_format($r_nav[0]['DIFF_PREV'],4,'.',','),
            'u'=>($r_nav[0]['NAV_INVEST']-$r_nav[0]['NAV_PREV']>=0)?1:0,'c'=>number_format($r_nav[0]['CHANGEPCT'],4,'.',','),'a'=>$r_nav[0]['ALERT'],'pty'=>$r_section['r_pf'][0]['t']);
        $r_cat1=array();
        $str_html='';
        foreach($r_cat as  $xitem)
            $str_html.="<tr bgcolor=\"#FFFFFF\"><td>{$xitem['ASSET']}</td><td align=\"right\">".number_format($xitem['INVESTVALUE'],4,'.',',')."</td><td align=\"right\">".number_format($xitem['GLVALUE'],4,'.',',')."</td><td align=\"right\">".number_format($xitem['DIFFRENT'],4,'.',',')."</td></tr>\n";
        $this->data['s_cat']=$str_html;
        
        
        $this->data['r_sect']=$this->load->view('rpt_nav_a',$r_section,true);
        
        $this->load->model("M_rpt"); 
        $r_val['r_data']=$this->M_rpt->get_fin_val($param['pf'],$dt); 
        $r_val['dt']=$dt;
        $this->data['r_val']=$this->load->view('rpt_finval',$r_val,true);
        
        
        $r_valint['r_data']=$this->M_rpt->get_fin_valint($param['pf'],$dt); 
        $r_valint['dt']=$dt;
        $this->data['r_valint']=$this->load->view('rpt_finvalint',$r_valint,true);
        
        $t_fi1=0;
        if(count($r_section['sect_A'])>0)
            foreach($r_section['sect_A'] as $x_tfi)
                if($x_tfi['SECURITYCATEGORY']=='ZS' && $x_tfi['GROUPCODE']=='FI')
                    $t_fi1=$x_tfi['ASSETVALUE'];
        
        $this->load->model("M_fi"); 
        $r_fi=$this->M_fi->get_tax_net($param['pf'],$dt); 
        $t_fi2=0;
        if(count($r_fi)>0)
            $t_fi2=$r_fi[0]["net"];
        $bg='#ffffff';
        if($t_fi1+$t_fi2!=0)
            $bg = '#FF8080';
        $this->data['r_fi'] = "<table bgcolor=\"#C0C0C0\">
                <tr bgcolor=\"#F0F0F0\">
                    <th align=\"right\" width=\"150\">Gross Tax</th>
                    <th align=\"right\" width=\"150\">Uns. Tax on Sale</th>
                    <th align=\"right\" width=\"150\">Uns. Tax Adjust</th>
                    <th align=\"right\" width=\"150\">Net Tax</th>
                </tr>
                <tr bgcolor=\"{$bg}\">
                    <td align=\"right\">" . (isset($r_fi[0]["gross"])?number_format($r_fi[0]["gross"],2,'.',','):'') .  "</td>
                    <td align=\"right\">" . (isset($r_fi[0]["gross"])?number_format($r_fi[0]["sale"],2,'.',','):'') .  "</td>
                    <td align=\"right\">" . (isset($r_fi[0]["gross"])?number_format($r_fi[0]["txn"],2,'.',','):'') .  "</td>
                    <td align=\"right\">" . (isset($r_fi[0]["gross"])?number_format($r_fi[0]["net"],2,'.',','):'') .  "</td>
                </tr>
            </table>";
        echo json_encode($this->data);
    }
    function approve()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->load->model("M_nav");
        $r_data=$this->M_nav->approve($param['pf'],$dt,$this->data['sess']['uid']); 
        if (count($r_data)>0)
            echo $r_data[0]['err'];
        else
            echo 0;
    }
    function unapprove()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->load->model("M_nav");
        $r_data=$this->M_nav->unapprove($param['pf'],$dt,$this->data['sess']['uid']); 
        echo 1;
    }
    function gldone()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->load->model("M_nav");
        $r_data=$this->M_nav->gldone($param['pf'],$dt,$this->data['sess']['uid']); 
        echo 1;
    }
    function glundone()
    {
        if($this->data['sess']['uid']=='')
        {
            echo json_encode($this->data);
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->load->model("M_nav");
        $r_data=$this->M_nav->glundone($param['pf'],$dt,$this->data['sess']['uid']); 
        echo 1;
    }
    function approved_list()
    {
        if($this->data['sess']['uid']=='')
        {
            echo '0';
            return 0;
        }   
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        $dt = change_dt_format(remove_bad_sql(str_sql_string($param["dt"])),512);     
        $this->load->model("M_nav");
        $r_data=$this->M_nav->approved_list($dt); 
        $str_data='';
        foreach($r_data as $xitem1)
            $str_data .="<tr bgcolor=\"#FFFFFF\"><td>{$xitem1['pf']}</td><td>{$xitem1['pfname']}</td><td align=\"right\">" . number_format(0+$xitem1['netaccrued'],2,'.',',') . "</td></tr>";
        echo $str_data;
    }
    function list_la()
    {
        if($this->data['sess']['uid']=='')
            return 0;
        
        $param=$this->input->post(); 
        if(is_array($param))
            sql_quot_all($param);
        if(!isset($param['fm']))
            $param['fm']='';
        $this->load->model("M_nav");
        $r_data=$this->M_nav->last_approved_list($param['fm']); 
        $str_data="";
        foreach($r_data as $xitem1)
            $str_data .="<tr bgcolor=\"#FFFFFF\"><td align=\"center\">{$xitem1['pf']}</td><td>{$xitem1['portfolioname']}</td><td align=\"center\">" . (is_object($xitem1['VALUATIONDATE'])?date_format($xitem1['VALUATIONDATE'],'F d, Y'):'') . "</td></tr>";
        
        echo $str_data;
    }
} 
?>
