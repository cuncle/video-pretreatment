<?php
$user = '';//操作员
$password = md5('');//操作员密码 
$bucket = '';//服务名
$GMTdate = gmdate('D, d M Y H:i:s') . ' GMT';
$url = 'http://p0.api.upyun.com/pretreatment/';

$ch = curl_init();
$header = array();
$data = array();
$data['service'] = $bucket;
$data['accept'] = 'json';
$data['notify_url'] = 'http://httpbin.org/post';
$data['source'] = '/deqing/bulesky.mp4';
$tasks = array(
    array(
        'type' => 'video',
        'avopts' => "/s/240p(4:3)/as/1/r/30",
        'save_as' => '/16/70/92/99bOOOPICa3.mp4',
        'return_info' => true
    )
);
$data['tasks'] = base64_encode(json_encode($tasks, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
$path = '/pretreatment/';
$method = 'POST';
$str = array(
    $method,
    $path,
    $GMTdate
);
$signature = base64_encode(hash_hmac('sha1', implode('&', $str), $password, true));
$header[] = "Authorization: UPYUN {$user}:{$signature}";
$header[] = "Date: {$GMTdate}";
$header[] = "User-agent: cxiang";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$return = curl_exec($ch);
var_dump($return);
curl_close($ch);

