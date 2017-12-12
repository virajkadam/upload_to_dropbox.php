<?php
date_default_timezone_set('Asia/Kolkata');
$day = date('l');

switch ($day) {
	case 'Monday': $path = $day.'.tar.gz'; break;
	case 'Tuesday': $path = $day.'.tar.gz'; break;
	case 'Wednesday': $path = $day.'.tar.gz'; break;
	case 'Thursday': $path = $day.'.tar.gz'; break;
	case 'Friday': $path = $day.'.tar.gz'; break;
	case 'Saturday': $path = $day.'.tar.gz'; break;
	case 'Sunday': $path = $day.'.tar.gz'; break;
	default:break;
}

$file_path_local = '/backup/'.$path;
$file_path_dropbox = '/backup/'.$path;
$fp = fopen($file_path_local, 'rb');

#$token = 'k82wlowy99AAAAAAAAAADV2dhdaj1pzUnifuHA1ttIdyqmLtTNhB2u7HxTiL31KT';
$token = 'bnXugbm50EAAAAAAAAAAMgPGojDKP1iwxMXA_2j9u5R1Nm4TQczbKAIgmbneVJLm';

$cheaders = array('Authorization: Bearer '.$token,
			'Content-Type: application/octet-stream',
			'Dropbox-API-Arg: {"path":"'.$file_path_dropbox.'", "mode":"overwrite" }');

	$ch = curl_init('https://content.dropboxapi.com/2/files/upload');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
	curl_setopt($ch, CURLOPT_PUT, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_INFILE, $fp);
	curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file_path_local));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);

	echo $res;
	curl_close($ch);
	fclose($fp);


?>
