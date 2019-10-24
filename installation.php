<!DOCTYPE html>
<html>
<head>
	<title>
		Installation C-tas
	</title>
</head>

<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
<body>

<div>
	<h1 style="align-items: center;">C-TAS Installation</h1>
	<form action="installation.php" method="post" autocomplete="off">
		<table>
			<tr>
				<td>DNS Name</td>
				<td>:</td>
				<td><input type="text" name="hostname"></td>
			</tr>
			<tr>
				<td>User</td>
				<td>:</td>
				<td><input type="text" name="user"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>Database name</td>
				<td>:</td>
				<td><input type="text" name="database"></td>
			</tr>
		</table>
		<input type="submit">
	</form>
</div>
</body>
</html>


<?php 
error_reporting(0);

$hostname 	= $_POST['hostname'];
$user 		= $_POST['user'];
$database 	= $_POST['database'];
$action		= $_POST['action'];
$password 	= $_POST['password'];


$password = base64_encode($password);

$my_file = 'application\config\database.php';
unlink($my_file);
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = '<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

$active_group = "default";
$active_record = TRUE;

$db["default"]["hostname"] = "'.$hostname.'";
$db["default"]["username"] = "'.$user.'";
$db["default"]["password"] = base64_decode("'.$password.'");
$db["default"]["database"] = "'.$database.'";
$db["default"]["dbdriver"] = "sqlsrv";
$db["default"]["dbprefix"] = "";
$db["default"]["pconnect"] = FALSE;
$db["default"]["db_debug"] = TRUE;
$db["default"]["cache_on"] = FALSE;
$db["default"]["cachedir"] = "";
$db["default"]["char_set"] = "utf8";
$db["default"]["dbcollat"] = "utf8_general_ci";';

fwrite($handle,$data);

?>