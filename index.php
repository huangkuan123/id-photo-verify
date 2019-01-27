<?php
/**
 * Created by PhpStorm.
 * User: huangkuan
 * Date: 2019/1/26
 * Time: 10:21 PM
 */

require 'vendor/autoload.php';

$config = [
    'debug' => true,
    'log' => [
        'name' => 'id_photo',
        'file' => './logs/id_photo.log',
        'level' => 'debug',
        'permission' => 0777,
    ],
    'env' => '...',//证件照环境检测key
    'cut' => '...',//证件照制作key
    'env_cut' => '...',//检测与制作
    'check_pic' => '...'//证件照检测
];
$m = new \HuangKuan\IdPhoto\IdPhoto($config);
$base64_img = $m->getBase64Image('./demo.jpg');
//$datas = array(
//    'file' => $base64_img,
//    'facepose' => 40,
//    'eyegaze' => 40,
//    'eyeskew' => 35,
//    'shoulderskew' => 20,
//    'darkillum' => 50,
//    'unbalanceillum' => 50,
//    'bfsimilarity' => 60
//);
//$result = $m->env_pic($datas);//证件照环境检测
//$datas = array(
//    'file' => $base64_img,
//    'spec_id' => 1
//);
//$result = $m->cut_pic($datas);//制作证件照
//$data = array(
//    'file' => $base64_img,
//    'spec_id' => 1
//);
//$result = $m->check_pic($data);//检测证件照
//$data = array(
//    'file' => $base64_img,
//    'spec_id' => 1
//);
//$result = $m->cut_check_pic($data);//制作并检测证件照
//$result = $m->take_pic_wm('c9a495c421fd11e99e3300163e0070b6blue3_print_wm', './take_pic_wm.jpeg');//获取带水印图片
//$result = $m->take_cut_pic('39289b4d21ff11e99e3300163e0070b625455blue3', $config['env_cut'], './take_cut_pic.jpeg');//获取不带水印的图片
//$result = $m->take_cut_pic_v2('39289b4d21ff11e99e3300163e0070b625455blue3', $config['env_cut']);
//var_dump($result);

