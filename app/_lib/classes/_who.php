<?php
class usersLoggedIn{
	function getusersLoggedIn($statsOnly = 0) {

	$whoUsersType = shell_exec("who");	
	$whoUsersFormatted = str_replace(" ", " &middot ", $whoUsersType);	
	if (!$statsOnly) {
	?>

	
	
	<div class="userIcon">
		  	<img src='_lib/images/user.png' align='middle'>
		  </div> 
		  
		  <div class="userTitle">
		  	Active Users
		  </div>
		  
		  <div class="userText">
		  	<div style="width: 500px">
		  	<?php }
				if($whoUsersFormatted == ""){
					if ($statsOnly) {
						echo '"[]"';
						return;
					}
					echo "<strong>No users logged in</strong>";
		  	}else{
		  		$s = "";
				if ($statsOnly) {
					echo '[';
					$statsText = '';
				}
				//Split lines into individual array elements
				$lines = explode ("\n", $whoUsersType);
				foreach ($lines as $line)
				{
					//Replace multiple spaces with single space
					$line = preg_replace("/ +/", " ", $line);

					if (strlen($line)>0)
					{

						//Now split fields into multiple values
						$fields = explode(" ", $line);
						if ($statsOnly) {
							$statsText .= '{
								"user" : "'.$fields[0].'",
								"ip" : "'.$fields[5].'",
								"since" : "'.$fields[4].'"
							},';
							continue;
						}
						$s .= "<div style='float: left; padding-bottom: 30px; padding-right: 20px;'><strong>User:</strong> " . $fields[0] . "<br />";
						$s .= "<strong>IP From:</strong> " . $fields[5] . "<br />";
						$s .= "<strong>Since:</strong> " . $fields[4] . "</div>";

						$s .= "";
					}
				}
				if ($statsOnly) {
					echo substr($statsText, 0, -1);
					echo ']';
					return;
				}
				echo $s;
		  	}
			?>
		  	</div>		  	
		  </div>
	
	<div style="clear:both"></div>
	
	
<?php
}
}

