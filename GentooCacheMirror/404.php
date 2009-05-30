<?php
ignore_user_abort(true);
set_time_limit(0);
define('PACKET_SIZE',8194);
$serverPath = "/gentoo-mirror";
$serverStorePath = "/var/gentoo-mirror";
$mirrorServer = 'de-mirror.org';
$mirrorPath = '/distro/gentoo';


function createDir($mainPath,$directory) {
	$Dirs = explode('/',$directory);
	$path = $mainPath;
	for ($i = 0; $i < count($Dirs); $i++) {
		$path = $path.'/'.$Dirs[$i];
		if(!is_dir($path)) {
			mkdir($path);
		}
	}
}

function echoHeadHeaders($server,$path) {
	$fp = fsockopen($server,80);
	if (!$fp) {
		return false;
	}
	fwrite($fp, "HEAD $path HTTP/1.1\r\nHOST: $server\r\n\r\n");
	while (!feof($fp)) {
		$line = fgets($fp);
		if (stristr($line,"HTTP/1.1 404") !== false) {
			return false;
		}
		if (stristr($line,"Content-Length:") !== false) {
			header($line);
		}
		if (stristr($line,"Content-Type:") !== false) {
			header($line);
		}
	}
	return true;
}
function getFileAndPrint($mirrorServer,$FromPath, $toPath) {
	if (!echoHeadHeaders($mirrorServer,$FromPath)) {
		return false;
	}
	$FromPtr = fopen('http://'.$mirrorServer.$FromPath,'r');
	if (!$FromPtr) {
		return false;
	}
	$ToPtr = fopen($toPath,'w+');
	if (!$toPath) {
		return false;
	}
	$buffer = '';
	while (!feof($FromPtr)) {
		$buffer = fread($FromPtr,PACKET_SIZE);
		echo $buffer;
		fwrite($ToPtr, $buffer);
	}
	fclose($FromPtr);
	fclose($ToPtr);
	return true;
}

$requestedFile = str_replace($serverPath,'',$_SERVER["REQUEST_URI"]);
header("HTTP/1.1 200 OK");
createDir($serverStorePath,dirname($requestedFile));
if (!getFileAndPrint($mirrorServer,$mirrorPath.$requestedFile,$serverStorePath.'/'.$requestedFile)) {
	header("HTTP/1.1 404 Not Found");
	echo "File Not Found";
}
