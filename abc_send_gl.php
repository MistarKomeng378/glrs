<?php
// $argv[1]='D:/MAILDATA_GL/GLRS';
if(!isset($argv[1]))
    die('No Argument is specified!');
$base_dir_sys=$argv[1];
$base_dir = preg_replace('/\\\/','/',$base_dir_sys);

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



      
$tsql = "exec gw_mail_sender_get";
$stmt = sqlsrv_query( $conn, $tsql);
$row_mail = sqlsrv_fetch_array($stmt);
sqlsrv_free_stmt( $stmt);

$arr_file=array();
if ($handle = opendir($base_dir.'/CUR/')) {
    while (false !== ($entry = readdir($handle))) {
        if(is_file($base_dir.'/CUR/'.$entry))
        {   $filename = $base_dir.'/CUR/'.$entry;
            if(strlen($entry)>5)
            {
                $arr_file[]=array("nm_file"=>$filename,"code"=>substr($entry,0,6),'nf'=>$entry);
            }
        }
    }
    closedir($handle);
}
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
                'mi_mail'=>$row_data["mi_mail"],'mi_mail_cc'=>$row_data["mi_mail_cc"],'file'=>array(),'pf_code'=>$row_data['pf_code']);
        $mi_code=$row_data["mi_code"];
    }
    foreach($arr_file as $item)
    {
        if($row_data["pf_code"]===$item['code'])
        {            
            $arr_mail[$irow]['file'][]=array('nf'=>$item['nf'],'pf'=>$row_data["pf_name"],'fname'=>$item["nm_file"],'pf_code'=>$row_data["pf_code"]);
        }
    }
}
sqlsrv_free_stmt( $stmt);

$arr_mail_send = array();
foreach($arr_mail as $item1)
{
    if(count($item1['file'])>0)
        $arr_mail_send[]=$item1;
}

require_once('PHPMailer_v5.1/class.phpmailer.php');

$irows=0;
foreach($arr_mail_send as $item1)
{
    if(count($item1['file'])>0)
    {
        $mail = new PHPMailer(); // defaults to using php "mail()"

        //$mail->IsSendmail(); // telling the class to use SendMail transport

        //$body             = file_get_contents('contents.html');
        //$body             = eregi_replace("[\]",'',$body);

        $mail->IsSMTP();
        $mail->SMTPAuth = true;  
        // $mail->Host ='localhost'; 
        // $mail->Port = 1025;
		$row_mail['mail_host'];
        $mail->Port = 27;
        // $mail->Port = 587;
        
        // $mail->SMTPSecure='ssl';
        $mail->Username = $row_mail['mail_user'];
        $mail->Password   = $row_mail['mail_pass'];
        $mail->SMTPDebug =1;
        //$mail->Helo = "helo";
        $mail->From = $row_mail['mail_sender'];
        $mail->FromName = $row_mail['mail_sender_name'];

        $mail->AddReplyTo($row_mail['mail_sender'],$row_mail['mail_sender_name']);

        $mail->SetFrom($row_mail['mail_sender'],$row_mail['mail_sender_name']);



        //$mail->Subject    = $row_mail['mail_subject'];
        $mail->Subject    = "CUSTODY NIAGA: TB / BS / PL / XD11 REPORT - {$item1['mi_name']}";

        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        

        $mailto = explode(',', $item1["mi_mail"]);
        foreach($mailto as $mailaddr)
        {
            if(trim($mailaddr)!='')
                $mail->AddAddress($mailaddr);
        }
        $mailcc = explode(',', $item1["mi_mail_cc"]);
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
            //$str_pf.="<li>{$item2['nf']} - {$item2['pf']}</li>";
            $str_pf.="<li>{$item2['nf']}</li>";
        }
        if($str_pf!='')
            $str_pf="<ol>".$str_pf ."</ol>";
        
        $body = "<body>".$row_mail['mail_content']."</body>";
        $body = str_replace("%list%",$str_pf,$body);
        $body = eregi_replace("[\]",'',$body);
        $mail->MsgHTML($body);
        
        if($mail->Send()) {
            $tsql = "sp_mail_log_insert '{$item1['mi_code']}','{$item1['mi_mail']}','{$item1["mi_mail_cc"]}','{$str_attachment}','Mail success' ";
            $stmt = sqlsrv_query( $conn, $tsql);
            foreach($item1['file'] as $item2)
            {
                $vdt=substr($item2['nf'],7,4) . "/" . substr($item2['nf'],11,2) . "/" . substr($item2['nf'],13,2) ;
                if (trim($vdt)=="")
                    $vdt = '1/1/1900';
                $a=@exec("cmd /c move /Y  \"{$base_dir_sys}\\CUR\\{$item2["nf"]}\" \"{$base_dir_sys}\\SEND\"");
                $tsql = "gw_mail_log_add '{$item1['mi_code']}','{$item2['pf_code']}','{$item2['nf']}','{$vdt}' ";
                $stmt = sqlsrv_query( $conn, $tsql);
            }
        }
    }
}
// sqlsrv_close( $conn);
// echo "<pre>";
// print_r($arr_mail_send);
// echo "</pre>";
// die();
 
?>
