<?
header ('Location: http://10.8.0.100/storage/index.php');
exec('/usr/local/bin/sudo -u root /etc/rc.d/ctld stop',$op,$return);
exec('/usr/local/bin/sudo -u root /sbin/zpool export -f HAStg',$op,$status);
exec('/usr/local/bin/sudo -u root /sbin/hastctl role secondary clfox',$op,$status);
exec('/usr/local/bin/sudo -u root /sbin/ifconfig em0 vhid 1 state BACKUP',$op,$status);

echo $return;
?>
