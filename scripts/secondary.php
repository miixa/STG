<?
header ('Location: http://10.8.0.100/storage/index.php');
exec('/usr/local/bin/sudo -u root /etc/rc.d/ctld stop',$op,$status_ctld_stop);

if ($status_ctld_stop == 0){
        exec('/usr/local/bin/sudo -u root /etc/rc.d/ctld status',$output_ctld_status,$status_ctld);
        echo '1',$output_ctld_status[0];
        if ($output_ctld_status[0] == 'ctld is not running.'){
                exec('/usr/local/bin/sudo -u root /sbin/zpool export HAStg',$op,$status_hast);
                echo '2';
                if ($status_hast == 0){
                        exec('/usr/local/bin/sudo -u root /sbin/zpool list | grep HAStg',$output_zpool,$status);
                        echo '3';
                        if (!$output_zpool){
                                exec('/usr/local/bin/sudo -u root /sbin/hastctl role secondary clfox',$op,$status);
                                echo '4';
                                do {
                                        exec('/usr/local/bin/sudo -u root /sbin/ifconfig em0 vhid 1 state BACKUP',$op,$status_carp);
                                        sleep(3);
                                        exec('/usr/local/bin/sudo -u root /sbin/ifconfig em0',$output_ifconfig, $state_ifconfig);
                                        $carp_state = explode(" ",$output_ifconfig[8])[1];
                                }while ($carp_state == 'MASTER');

                        }
                }
        }
}


/*echo $return;*/
?>

