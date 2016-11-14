<?
exec ('/usr/local/bin/sudo -u root /sbin/ifconfig em0', $output_ifconfig, $state_ifconfig);
exec ('/usr/local/bin/sudo -u root /sbin/hastctl list', $output_hast, $state_hast);
exec ('/usr/local/bin/sudo -u root /sbin/zpool list HAStg', $output_zpool, $state_zpool);
$role_hast_local = $output_hast[1];
$carp_state = explode(" ",$output_ifconfig[8])[1];
$zpool_status = explode(" ",$output_zpool[1])[27];
echo '<h1>STG0<br> HAST ',$role_hast_local,'</h1>';
echo '<h1>zpool status:',$zpool_status,'</h1>';
echo '<h1>carp status:',$carp_state,'</h1>';

if (strstr($role_hast_local, 'primary')){
	echo '	<form action="/storage/scripts/secondary.php">
			<input type="submit" value="Secondary">
		</form>';
}

if (strstr($role_hast_local, 'secondary')){
	echo '  <form action="/storage/scripts/primary.php">
			<input type="submit" value="Primary">
		</form>';
}
if (strstr($role_hast_local,'init')){
	echo '	<form action="/storage/scripts/secondary.php">
			<input type="submit" value="Secondary">   
		</form>';

	echo '  <form action="/storage/scripts/primary.php">
			<input type="submit" value="Primary">
		</form>';
}
if (strstr($carp_state,'MASTER')){
	$url = 'http://10.8.0.10/storage/index.php';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'IE20');
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, '1');
	$content = curl_exec($ch);
	curl_close($ch);
	preg_match( '/(hast\s+role:\s+(?P<role>[\w\d]+)<)/i' , $content , $role_hast_remote );
	#echo $content;
	#echo $role_hast_remote['role'];
	echo '<h1>STG1<br>HAST role: ',$role_hast_remote['role'],'</h1>';
	if (strstr($role_hast_remote['role'], 'primary')){
		echo '	<form action="http://10.8.0.10/storage/scripts/secondary.php">
			<input type="submit" value="Secondary">   
		</form>';
	}

/*	if (strstr($role_hast_remote['role'], 'secondary') and strstr($role_hast_local, 'secondary') or strstr($role_hast_local,'init')){
		echo '  <form action="http://10.8.0.10/storage/scripts/primary.php">
			<input type="submit" value="Primary">
			</form>
		';
	}*/	
	if (strstr($role_hast_remote['role'],'init')){
		echo '	<form action="http://10.8.0.10/storage/scripts/secondary.php">
			<input type="submit" value="Secondary">   
			</form>';

		echo '  <form action="http:/10.8.0.10/storage/scripts/primary.php">
			<input type="submit" value="Primary">
			</form>';
	}
}
?> 
