<?php

if(!isset($argv[1]))
    die('No Argument is specified!');
$base_dir_sys=$argv[1];
$base_dir = preg_replace('/\\\/','/',$base_dir_sys);
echo $base_dir;

    define('BASEPATH', 'g_get'); 
include('application/config/database.php');

$connectionInfo = array( "UID"=>$db['default']['username'],
                         "PWD"=>$db['default']['password'],
                         "Database"=>$db['default']['database']);
                         
$conn = sqlsrv_connect( $db['default']['hostname'], $connectionInfo);

if( $conn === false )
{
     echo "Unable to connect.</br>";
     die( print_r( sqlsrv_errors(), true));
}



$today=date('m/d/Y');  //$today='7/19/2016';
$today = "10/17/2018" ;
list($ta1,$ta2,$ta3) =explode("/",$today);
$a=@exec("cmd /c mkdir  \"{$base_dir_sys}\\HIST\\{$ta3}\\{$ta1}\\{$ta2}\"");

$tsql = "exec gw_mail_sender_get";
$stmt = sqlsrv_query( $conn, $tsql);
$row_mail = sqlsrv_fetch_array($stmt);
sqlsrv_free_stmt( $stmt);

$arr_file=array();
if ($handle = opendir($base_dir.'/CUR/')) {
    while (false !== ($entry = readdir($handle))) {
        if(is_file($base_dir.'/CUR/'.$entry))
        {
            //echo "$entry\n";
            $filename = $base_dir.'/CUR/'.$entry;
            list($kd,$kode,$dino) = split("_",$entry);
            if(trim($kode)!='')
            {
                $arr_file[]=array("nm_file"=>$filename,"code"=>$kode,'nf'=>$entry);
            }
        }
    }
    closedir($handle);
}

//print_r($arr_file);
//print_r($row_mail);


$tsql = "exec gw_mail_reciever_list";
$stmt = sqlsrv_query( $conn, $tsql);
$mi_code='';
$arr_mail=array();
$irow=0;

while($row_data = sqlsrv_fetch_array($stmt))
{
    if($mi_code!=$row_data["mi_code"])
    {
        if($mi_code!='')
            $irow++;
        $arr_mail[$irow]=array('mi_code'=>$row_data["mi_code"],'mi_name'=>$row_data["mi_name"],
                'mi_mail'=>$row_data["mi_mail"],'mi_mail_cc'=>$row_data["mi_mail_cc"],'file'=>array());
        $mi_code=$row_data["mi_code"];
    }
    foreach($arr_file as $item)
    {   
        if($row_data["pf_code"]==$item['code'])
            $arr_mail[$irow]['file'][]=array('nf'=>$item['nf'],'pf'=>$row_data["pf_name"],'fname'=>$item["nm_file"],'pf_code'=>$row_data["pf_code"]);
    }
}

sqlsrv_free_stmt( $stmt);





require_once('PHPMailer_v5.1/class.phpmailer.php');


//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

//print_r($arr_mail);
$today=date('m/d/Y');
//$today=date('3/8/2016');
foreach($arr_mail as $item1)
{
    if(count($item1['file'])>0)
    {
        $mail = new PHPMailer(); // defaults to using php "mail()"

        //$mail->IsSendmail(); // telling the class to use SendMail transport

        //$body             = file_get_contents('contents.html');
        //$body             = eregi_replace("[\]",'',$body);

        $mail->IsSMTP();
      //  $mail->SMTPAuth = true;  
        $mail->Host = $row_mail['mail_host'];
        $mail->Port = 25;
        //$mail->SMTPSecure=true;
        $mail->Username = $row_mail['mail_user'];
        $mail->Password   = $row_mail['mail_pass'];
        //$mail->SMTPDebug =1;
        //$mail->Helo = "helo";


        $mail->From = $row_mail['mail_sender'];
        $mail->FromName = $row_mail['mail_sender_name'];

        $mail->AddReplyTo($row_mail['mail_sender'],$row_mail['mail_sender_name']);

        $mail->SetFrom($row_mail['mail_sender'],$row_mail['mail_sender_name']);



        $mail->Subject    = 'XD1-1 - Custody Niaga';

        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        

        $mailto = explode(',', $item1["mi_mail"]);
        //$mailto = array("guruh.widoyoko@cimbniaga.co.id");
        foreach($mailto as $mailaddr)
        {
            if(trim($mailaddr)!='')
                $mail->AddAddress($mailaddr);
        }
        $mailcc = explode(',', $item1["mi_mail_cc"]);
        //$mailcc = array();
        foreach($mailcc as $mailaddr)
        {
            if(trim($mailaddr)!='')
                $mail->AddCC($mailaddr);
        }
        $str_attachment='';
        $str_pf="";
        foreach($item1['file'] as $item2)
        {
            $mail->AddAttachment($item2['fname']);
            $str_attachment.=' '. $item2['nf'];
            $str_pf.="<li>{$item2['nf']} - {$item2['pf']}</li>";
        }
        if($str_pf!='')
            $str_pf="<ol>".$str_pf ."</ol>";
        
        $body = "<body>Dear All,<br /><br />Kami sampaikan Laporan XD1-1 terlampir.{$str_pf}<br /><br /><i><span style='font-size:10.0pt;'>This Email is generated by computer automatically. Please do not reply.</span></i><br /><br /><span style='font-size:12.0pt;font-family:Mistral;color:#1F497D'>Best Regards,</span><br /> <br />Fund Accounting<br />Portfolio & Fund Accounting<br />Securities & Custody Operations<br /><span style='font-size:9pt;'>Graha Niaga lt. 7, Jl. Jend Sudirman kav. 58, Jakarta | Ph. (62-61) 250-5151/5252/5353 ext: 37021/37045/37043/37038| Fax. 250-5206/250-5189/527-6051</span></body>";
        $mail->MsgHTML($body);
        
        if($mail->Send()) {
            $tsql = "sp_mail_log_insert_pdf '{$item1['mi_code']}','{$item1['mi_mail']}','{$item1["mi_mail_cc"]}','{$str_attachment}','Mail success' ";
            $stmt = sqlsrv_query( $conn, $tsql);
            foreach($item1['file'] as $item2)
            {   
                $a=@exec("cmd /c move /Y  \"{$base_dir_sys}\\CUR\\{$item2["nf"]}\" \"\"{$base_dir_sys}\\HIST\\{$ta3}\\{$ta1}\\{$ta2}\"");
                $tsql = "sp_mail_log_pf_insert_pdf '{$item1['mi_code']}','{$item2['pf_code']}','{$item2['nf']}' ";
                $stmt = sqlsrv_query( $conn, $tsql);                
                //echo "cmd /c {$base_dir_sys}\\reksa_mail_file_pdf.bat mov_his  {$item2["nf"]}";
            }
        }
        else
        {
            $tsql = "sp_mail_log_insert_pdf '{$item1['mi_code']}','{$item1['mi_mail']}','{$item1["mi_mail_cc"]}','{$str_attachment}','Mail error' ";
            $stmt = sqlsrv_query( $conn, $tsql);
        }
    }
    
}

echo "Sending email done. Please check . <a href='mon.php'>The Log</a>";
//AddAttachment
//print_r($row_mail);


sqlsrv_close( $conn);                                                    
?>
