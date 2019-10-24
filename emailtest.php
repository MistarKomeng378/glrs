<?php
require_once 'PHPMailer_v5.1/class.phpmailer.php';
send_email('test','custody2@mylab.local','test','10.25.131.25','asd@mylab.local','',25,'asd@mylab.local');
    
    
function send_email($text,$email,$subject,$host,$username,$password,$port,$sender){
    try {
        $mail      = new PHPMailer(true); //New instance, with exceptions enabled
        $body     =  $text;// ISI EMAIL
        $mail->IsSMTP();                           // tell the class to use SMTP
        //$mail->SMTPAuth   = true;                  // enable SMTP authentication
        //$mail->SMTPSecure = 'tls';
        $mail->Port       = intval($port);                    // set the SMTP server port
        $mail->Host       = trim($host);//"smtp.gmail.com"; // SMTP server
        //$mail->Username   = trim($username);//"gugun33gunawan@gmail.com";     // SMTP server username
        //$mail->Password   = $password;// SMTP server password
        //$mail->IsSendmail();  // tell the class to use Sendmail
        $mail->AddReplyTo(trim($username),"CIMB Niaga Trustee And Agency System (C-TAS)");
        $mail->From   = trim($sender);
        $mail->FromName   = "C-TAS Notification For Today";
        
        $i=0;
        echo "============List For ".$subject."=========\n".$email;
		
                $mail->AddAddress($email);
                $mail->AddBCC($email);

        
        $mail->Subject  = "Securities Services - C-TAS Notification : ".$subject;
        $mail->MsgHTML($body);
        $mail->IsHTML(true); // send as HTML
        $mail->Send();
        echo 'Message has been sent.';
        //$notif = mssql_query("INSERT INTO log_email(groupname,email,description,totalsend,date,actiondate)
                              //VALUES('".$subject."','".$username."','Message has been sent','".$i."','".date('m/d/Y H:i:s')."','".date('m/d/Y')."')");        
     }catch (phpmailerException $e) {
        echo $e->errorMessage();
        //$notif = mssql_query("INSERT INTO log_email(groupname,email,description,totalsend,date,actiondate)
                              //VALUES('".$subject."','".$username."','Message failed','".$i."','".date('m/d/Y  H:i:s')."','".date('m/d/Y')."')");        
     }

    
}
?>