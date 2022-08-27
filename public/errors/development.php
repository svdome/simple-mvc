<?php


echo "<!DOCTYPE html> 
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
<title>Open Server</title>
</head>
<body>
<div><img style=\"width:100%; height:100%;\" src=\"/errors/error_img/dev.jpg\"></div>
<div style=\"margin-top: -600px\">
<center>
<br><br><br><div style=\"width: 600px;\"><span style=\"font-size: 100px; color: red; font-family: Arial, Verdana;\">Ошибка 404!</span>
<br><br><span style=\"font-size: 18px; color: red; font-family: Verdana, Arial;\">Такой страницы не существует</span></div>
<br><br><br><br><i style=\"font-size: 11px; color: #333; font-family: Verdana, Arial;\">http://test/ - это демонстрационный домен.<br>Вы можете удалить его стерев папку domains/test/. Приятной работы!</i>
</center>
</div>
</body>
</html>";

/** @var TYPE_NAME $errno */
echo "Код ошибки: $errno" . '<br>';

/** @var TYPE_NAME $errstr */
echo "Сообщение: $errstr" . '<br>';
/** @var TYPE_NAME $errfile */
echo "В файле: $errfile" . '<br>';

/** @var TYPE_NAME $errline */
echo "В строке: $errline" . '<br>';



