<?php 

$arq = 'log.txt';
$msg = '';

$msg .= "Adeus Bressan!";

$msg .= '['.date("d/m/Y H:i:s").']';

$msg .= PHP_EOL;

$fo = fopen ($arq, 'a');

fwrite($fo, $msg);

fclose($fo);

// [date] - date - R$ valor

?>