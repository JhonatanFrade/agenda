<?php 

$arq = 'log.txt';

$msg = '';

$msg .= "Adeus Bressan!";

$msg .= '['.date("d/m/Y H:i:s").']';

$msg .= PHP_EOL;

$fo = fopen ($arq, 'a+');

fwrite($fo, $msg);

fclose($fo);

// [date] - date - R$ valor

//  1 - Crédito , 2 - Débito / O campo ná tabela tá como int

?>