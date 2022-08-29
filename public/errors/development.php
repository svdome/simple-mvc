<?php


echo "<!DOCTYPE html> 
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
<title>Open Server</title>
</head>
<body>
<div><img style=\"width:100%; height:100%;\" src=\"/public/errors/error_img/dev.jpg\"></div>
<div style=\"margin-top: -50%\">

<br><br><br><div style=\"width: 600px;\"><span style=\"font-size: 32px; color: red; font-family: Arial, Verdana;\">"
?>Код ошибки:

<?"</span>
</div>
</body>
</html>";

/** @var TYPE_NAME $errno */
echo $errno . '<br>';

/** @var TYPE_NAME $errstr */
echo "Сообщение: $errstr" . '<br>';
/** @var TYPE_NAME $errfile */
echo "В файле: $errfile" . '<br>';

/** @var TYPE_NAME $errline */
echo "В строке: $errline" . '<br>';



