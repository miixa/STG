<?
header ('Location:http://10.8.0.100/storage/index.php');
exec ('/usr/local/bin/sudo -u root /sbin/hastctl role primary clfox');
$pool = exec ('/usr/local/bin/sudo -u root /sbin/zpool list | grep HAStg');

while (!file_exists('/dev/hast/clfox')){
	sleep(1);
	echo $i++;
	if (file_exists('/dev/hast/clfox')){
		echo 'abc';
		echo exec ('/usr/local/bin/sudo -u root /sbin/zpool import -f HAStg');
		echo exec ('/usr/local/bin/sudo -u root /etc/rc.d/ctld restart');
		echo exec ('/usr/local/bin/sudo -u root /sbin/ifconfig em0 vhid 1 state MASTER');

	}	
}
?>
