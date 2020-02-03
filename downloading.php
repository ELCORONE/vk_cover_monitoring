<?php

$token = "токен группы с правами к фотографиям";
$group_id = "индификатор группы";

require_once 'adding.php';	// Добавление информации о сервере

// Загружаемый файл
$cover_path = dirname(__FILE__).'/maps/result.jpg';
$post_data = array('file' => new CURLFile($cover_path, 'image/jpeg', 'image0'));

// Получение адреса для загрузки изображения на сервер
$upload_url = file_get_contents("https://api.vk.com/method/photos.getOwnerCoverPhotoUploadServer?group_id=".$group_id."&crop_x2=1590&access_token=".$token."&v=5.103");
$url = json_decode($upload_url)->response->upload_url;

// Добавление файла
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$result = json_decode(curl_exec($ch),true);
// Загрузка изображения на сервер Вконтакте
$safe = file_get_contents("https://api.vk.com/method/photos.saveOwnerCoverPhoto?hash=".$result['hash']."&photo=".$result['photo']."&access_token=".$token."&v=5.103");
?>
