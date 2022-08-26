<?php

echo '<div>
        <img style="width:100%; height:100%;" background-image: src="/errors/error_img/1.jpg">
        <div style="margin-top: -600px">
        <center>
        <br><br><br><div style=\"width:600px;\"><span style=\"font-size: 150px; color: green; font-family: Arial, Verdana;\">Ошибка</span>
        <br><br><span style=\"font-size: 150px; color: #333; font-family: Verdana, Arial;\">Такой страницы нет</span></div>
        <br><br><br><br><i style=\"font-size: 11px; color: #333; font-family: Verdana, Arial;\">Ошибка<br>Ошибка</i>
        </center>
        </div>
       </div>';

/** @var TYPE_NAME $errno */
echo "Код ошибки: $errno" . '<br>';

/** @var TYPE_NAME $errstr */
echo "Сообщение: $errstr" . '<br>';
/** @var TYPE_NAME $errfile */
echo "В файле: $errfile" . '<br>';

/** @var TYPE_NAME $errline */
echo "В строке: $errline" . '<br>';


