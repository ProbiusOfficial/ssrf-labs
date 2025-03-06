<?php
error_reporting(0);
function curl($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
  curl_exec($ch);
  curl_close($ch);
}
$url = $_POST['url'];
curl($url);  
?>