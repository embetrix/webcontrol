<?php
session_start();

if($_SESSION['username'] == "")
{
    die("You are not logged in");
}

?>

<html>

<head>
<style type="text/css">
body{
    font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
    font-size:12px;
}
p, h1, form, button{border:0; margin:0; padding:0;}
.spacer{clear:both; height:1px;}
/* ----------- My Form ----------- */
.myform{
    margin:0 auto;
    width:400px;
    padding:14px;
}

/* ----------- stylized ----------- */
#stylized{
    border:solid 2px #666666;
    background:#D9E0DB;
}
#stylized h1 {
    font-size:14px;
    font-weight:bold;
    margin-bottom:8px;
}
#stylized p{
    font-size:11px;
    color:#666666;
    margin-bottom:20px;
    border-bottom:solid 1px #666666;
    padding-bottom:10px;
}
#stylized label{
    display:block;
    font-weight:bold;
    text-align:right;
    width:140px;
    float:left;
}
#stylized .small{
    color:#666666;
    display:block;
    font-size:11px;
    font-weight:normal;
    text-align:right;
    width:140px;
}
#stylized input{
    float:left;
    font-size:12px;
    padding:4px 2px;
    border:solid 1px #666666;
    width:230px;
    margin:2px 0 20px 10px;
}
#stylized select{
    float:left;
    font-size:12px;
    padding:4px 2px;
    border:solid 1px #666666;
    width:230px;
    margin:2px 0 20px 10px;
}
#stylized button{
    clear:both;
    margin-left:150px;
    width:125px;
    height:31px;
    background:#666666;
    text-align:center;
    line-height:31px;
    color:#FFFFFF;
    font-size:11px;
    font-weight:bold;
}
</style>
</head>

<body>
<div id="stylized" class="myform">
<form id="form" name="vpnSettings" method="post" action="_configurevpn.php">
<h1>OpenVPN Configuration</h1>
<p>Set OpenVPN configuration and credentials</p>

<label>Config
<span class="small">OpenVPN config</span>
</label>
<select name="config">
<?php
exec('/bin/ls /etc/openvpn/configs' , $vpnconfig_list, $retval);

if (empty($vpnconfig_list))
{
    print "<option value='none_detected'>No VPN config...</option>";
}
else
{
    foreach ($vpnconfig_list as $vpnconfig)
       print "<option value="."\"$vpnconfig\"".">$vpnconfig</option>";
}
?>
</select>

<label>User
<span class="small">OpenVPN username</span>
</label>
<input type="text" name="user"/>

<label>Password
<span class="small">OpenVPN username</span>
</label>
<input type="text" name="passwd"/>

<button name="configure_vpn" type="submit">Configure</button>
<div class="spacer"></div>

<?php
if(isset($_POST['configure_vpn']))
{
    if (($_POST['config'] != 'none' &&
         $_POST["user"] != "none_detected" && $_POST['user'] != "") ||
        ($_POST['passwd'] == 'none' && $_POST["passwd"] != "none_detected"))
    {
        system('/usr/sbin/config-vpn' .
               ' "' . $_POST["config"] . '"' .
               ' "' . $_POST['user'] . '"' .
               ' "' . $_POST['passwd'] . '"', $retval);
        if ($retval == 0)
        {
            echo "<font color='black'>OK</font>";
            sleep(3);
?>
            <script type="text/javascript">
            <!--
            window.location = "../../main.php"
            //-->
            </script>
<?php
        }
        else
        {
            echo "<font color='red'>Configuration error</font>";
        }
    }
    else
    {
        echo "<font color='red'>Input error</font>";
    }
}
?>

</form>
</div>

</body>
</html>
