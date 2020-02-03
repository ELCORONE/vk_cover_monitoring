<?php
require_once "monitoring.php";
/*
    $server['name']        = $queryData[0];
    $server['map']         = $queryData[1];
    $server['game']        = $queryData[2];
    $server['description'] = $queryData[3];
    $server['players']
    $server['playersmax']
    $server['bots']
    $server['dedicated']
    $server['os']  
    $server['password']
    $server['vac'] 

*/

$img = ImageCreateFromJPEG("maps/".$server['map'].".jpg");
 
// определяем цвет, в RGB
$color = imagecolorallocate($img, 0, 0, 0);
 
// указываем путь к шрифту
$font = __DIR__ .'/arial.ttf';
 

imagettftext($img, 24, 0, 20, 355, $color, $font, "Карта : ".$server['map']);
imagettftext($img, 24, 0, 20, 390, $color, $font, "Игроков онлайн : ".$server['players']."/".$server['playersmax']);
// 24 - размер шрифта
// 0 - угол поворота
// 365 - смещение по горизонтали
// 159 - смещение по вертикали
 
header('Content-type: image/jpeg');
//imagejpeg($img, NULL, 100);
imagejpeg($img, 'maps/result.jpg', 100);
?>
