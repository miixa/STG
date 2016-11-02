<?
exec ('/usr/local/bin/sudo -u root /sbin/hastctl list', $output_hast, $state_hast);
$role = $output_hast[1];
echo '<h1>STG0<br>',$role,'</h1>';
if (strstr($role, 'primary')){
	echo '	<form action="/storage/scripts/secondary.php">
			<input type="submit" value="Transfer role to SPG1">   
		</form>';
}
if (strstr($role, 'secondary')){
	echo '  <form action="/storage/scripts/primary.php">
			<input type="submit" value="get role Primary">
		</form>
		';
}
if (strstr($role,'init')){
	echo '	<form action="/storage/scripts/secondary.php">
			<input type="submit" value="Secondary">   
		</form>';

	echo '  <form action="/storage/scripts/primary.php">
			<input type="submit" value="Primary">
		</form>';

}

?> 
