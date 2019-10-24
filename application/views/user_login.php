<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>General Ledger Reporting System</title>
    <script type="text/javascript" src="<?php echo $url;?>js/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $("#up").val('');
        if($("#ud").val()=='')
            $("#ud").focus();
        else
            $("#up").focus();
    });
    </script>
</head> 
<body> 
    <div  style="color: #808080; background:  url('<?php echo $url;?>/img/cimbniaga.png') no-repeat; margin: 0; padding-left : 330px ; font-size: 2.5em;">
    &nbsp;
    </div>
    <hr />
    <br />
    <div style="width: 270px; margin: 30px auto 0px auto; border: 1px solid #004080; background-color: #E0E0E0; padding: 0px; -moz-border-radius: 1em 0; ">
    <div style="padding: 5px; border-bottom: 1px solid #004080; margin: 0; background-color: #ACACAC; -moz-border-radius-topleft: 1em;">Form Login Applikasi</div>
    <div style="padding: 5px; margin: 0;">
        <form action="<?php echo $url;?>index.php/cs/do_login" method="post" id="frm_user" >
        <table width="100%" border="0">
            <tr>
                <td width="100">User ID</td>
                <td width="1">:</td>
                <td><input type="text" id="ud" name="g_ud" /></td>
            </tr>
            <tr>
                <td>User Password</td>
                <td>:</td>
                <td><input type="password" id="up" name="g_up"  value=""  /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Login" /></td>
            </tr>
        </table>
        </form>   
    </div>
</div>
<br /> 
<div align="center" style="color: red;"> 
<?php
    if(isset($err_login))
    {
        if($err_login['no']==2)
            echo "User is Disabled";
        else if($err_login['no']==3)
            echo "User is Locked";
        else if($err_login['no']==4)
            echo "Wrong password "  . ($err_login['wrong']+1) .", max {$err_login['wrong_max']}";            
        else if($err_login['no']==5)
            echo "User is locked. User did not login for {$err_login['exp_login']} days";
    }
?>
</div>
</body>
</html>

