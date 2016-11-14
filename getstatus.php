<?
#echo exec('/usr/local/www/apache24/data/storage/scripts/test.py');
$url = 'http://10.8.0.10/storage/index.php';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, 'IE20');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, '1');
$content = curl_exec($ch);
curl_close($ch);
preg_match( '/(hast\s+role:\s+(?P<role>[\w\d]+)<)/i' , $content , $role_hast );
#cho $content;
echo $role_hast['role'];
?>
