<?php

function logFile($rtn){
	$f=fopen("log.txt","a");
	fwrite($f, $rtn . "\n");
	fclose($f);
}

?>