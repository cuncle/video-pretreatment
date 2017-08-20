<?php
$user = '';//操作员
$password = md5('');//操作员密码
$bucket = 'deqing';//服务名
$GMTdate = gmdate('D, d M Y H:i:s') . ' GMT';
$url = 'http://p1.api.upyun.com/'.$bucket.+/snapshot/';

$ch = curl_init();
$data = array();
$data['notify_url'] = 'http://httpbin.org/post';
$data['source'] = '/upyun/upyun.mp4';
$data['save_as']='/demo/demo.png';
$data['point']= '00:00:05';
$datajson = json_encode($data,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$uri = '/'.$bucket.'/snapshot/'; 
$method = 'POST';
$str = array(
    $method,
    $uri,
    $GMTdate
);
$signature = base64_encode(hash_hmac('sha1', implode('&', $str), $password, true));
$header = array();
$header[] = "Authorization: UPYUN {$user}:{$signature}";
$header[] = "Date: {$GMTdate}";
$header[] = "User-agent: cxiang";
$header[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datajson);
$return = curl_exec($ch);
var_dump($return);
curl_close($ch);
