<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>General Ledger Reporting System</title>
    <script type="text/javascript" src="<?php echo $url;?>js/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        <?php
        if(isset($err_change))
            if($err_change==0)
            {
                echo "alert('Successfully change password!');";
                echo "window.location=\"{$url}\";";
            }
        ?>
        $("#up1").val('');
        $("#up2").val('');
        $("#up3").val('');
    });
    </script>
</head> 
<body> 
    <div  style="color: #808080; background:  url('<?php echo $url;?>/img/cimbniaga.png') no-repeat; margin: 0; padding-left : 330px ; font-size: 2.5em;">
    &nbsp;
    </div>
    <hr />
    <br />
    <div style="width: 340px; margin: 30px auto 0px auto; border: 1px solid #004080; background-color: #E0E0E0; padding: 0px; -moz-border-radius: 1em 0; ">
    <div style="padding: 5px; border-bottom: 1px solid #004080; margin: 0; background-color: #ACACAC; -moz-border-radius-topleft: 1em;">Form Change Password</div>
    <div style="padding: 5px; margin: 0;">
        <form action="<?php echo $url;?>index.php/cs/change_pass" method="post" id="frm_user" >
        <table width="100%" border="0">
            <tr>
                <td width="160">User ID</td>
                <td width="1">:</td>
                <td><input type="text" id="ud" name="g_ud"  value="<?php echo isset($uid)?$uid:"";?>" readonly style="background-color: #F0F0F0;" /></td>
            </tr>
            <tr>
                <td>Old Password</td>
                <td>:</td>
                <td><input type="password" id="up1" name="g_up1"  value="" /></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td>:</td>
                <td><input type="password" id="up2" name="g_up2"  value="" /></td>
            </tr>
            <tr>
                <td>Confirm New Password</td>
                <td>:</td>
                <td><input type="password" id="up3" name="g_up3"  value="" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Change" /><input type="button" value="Back" onclick="window.location='<?php echo $url; ?>'" /></td>
            </tr>
        </table>
        </form>   
    </div>
</div>
<br />
<div align="center" style="color: red;"> 
<?php
    if(isset($err_change))
    {
        $err_apc = "Minimal password must {$err_change_min} chars &amp; must contain Alphabet";
        $err_apc .= $err_change_am ==1?", Numeric":'';
        $err_apc .= $err_change_caps ==1?", Capital":'';
        $arr_err_msg=array("","Wrong old password!","User is disabled, locked or doesn't exists!","Password did not match!",
        $err_apc, $err_apc,$err_apc,$err_apc);
        if($err_change!=0)
            echo $arr_err_msg[$err_change];
    }
?>
</div>

<div align="center" style="color: green;"> 
<?php
    if(isset($err_change))
        if($err_change==0)
            echo "Successfully change password!";
?>
</div>
</body>
</html>
