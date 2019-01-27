# *证件照研究院 PHP-SDK*

## *安装*
install 

`
$ composer require huangkuan/id-photo-verify 
`

## *项目引入*

```PHP
<?php

require 'vendor/autoload.php';
$config = [
    'env' => '865d284.....1950e685',//证件照环境检测key
    'cut' => 'c54e7c0f5d......9ec0f73',//证件照制作key
    'env_cut' => '8059e8c.....bfcfeb0855',//检测与制作
    'check_pic' => 'd82b84b.....be6356907'//证件照检测
];
$obj = new \HuangKuan\IdPhoto\IdPhoto($config);//实例化一个处理对象
$base64_img = $obj->getBase64Image('./demo1.jpg');//使用这个方法可以将图片转为 Base64 编码

``` 

## *功能介绍*

[证件照研究院文档](http://dev.id-photo-verify.com/doc.html )。<br />
缺少 Key,缺少参数，该 SDK 将拦截请求，抛出异常。<br />
根据部分调用方法与 $config 配置，将自主选择对应的 Key 进行处理。
详情见 demo.php 文件。

```PHP
//证件照环境检测 ↓
$obj->env_pic($datas);
//制作证件照 ↓
$obj->cut_pic($datas);
//检测证件照 ↓
$obj->check_pic($datas);
//制作并检测证件照 ↓
$obj->cut_check_pic($datas);
//========以下功能，用哪个 key 做的图，就用哪个 key 取。
//如果不传入 $path 路径，则默认返回图片流，需自己put进文件。
//获取带水印图片 ↓
$obj->take_pic_wm($file_name, $key, $path=null);
//获取不带水印的图片 ↓
$obj->take_cut_pic($file_name, $key, $path=null);
//同时获取无水印单张和排版图片 ↓
$obj->take_cut_pic_v2($file_name, $key);
``` 





