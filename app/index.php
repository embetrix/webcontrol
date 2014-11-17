<?php

$passwdfile = '/etc/webcontrol/passwd';

if (file_exists($passwdfile))
{
    session_start();

    if($_SESSION['username'] != "")
    {
        require('main.php'); 
        die;
    }

    require('_lib/includes/_header.php');
    require('_lib/classes/_login.php'); 
?>

     <div id="firstBlockContainer">
       <div class="firstBlockWrapper">
         <div style="padding-top: 40px;">
           <center>
Please login<br/><br/>
            <form name="login" method="post" action="index.php">
               <input type="text" name="username" class="loginForm" placeholder="Username" autofocus />
               <input type="password" name="password" class="loginForm" placeholder="Password" /><br/>
               <input type="submit" value="Login" name="login" class="minimal" />
               <br/><br/>
<?php
    if ($wrong == 1)
    {
        echo "<font color='red'>Incorrect Username/Password</font>";
    }
?>
             </form>
           </center>
         </div>
       </div>
       <br/><br/><br/>
     </div>
<?php    
}
else
{
    require('_lib/includes/_header.php');
?>

        <div id="firstBlockContainer">
          <div class="firstBlockWrapper">
            <div style="padding-top: 20px;">
The file /etc/webcontrol/passwd does not exist, so please open a terminal session as root and run the commands below:<br/>
<br/>
mkdir -p /etc/webcontrol<br/>
touch /etc/webcontrol/passwd<br/>
chown root.lighttpd /etc/webcontrol/passwd<br/>
chmod 640 /etc/webcontrol/passwd<br/>
mcedit /etc/webcontrol/passwd<br/>
<br/>
Once you are in the editor, add the lines below and press the keys "CTRL+X", "Y" and "ENTER"<br/>
{<br/>
<p style="text-indent: 2em;">"user":"webcontrol",<br/></p>
<p style="text-indent: 2em;">"password":"choose-a-password"<br/></p>
}<br/>
            </div>
          </div>
          <br/><br/><br/>
        </div>
<?php
}

require('_lib/includes/_footer.php');
