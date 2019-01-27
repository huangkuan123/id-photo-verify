<?php
/**
 * Created by PhpStorm.
 * User: huangkuan
 * Date: 2019/1/26
 * Time: 9:34 PM
 */

namespace HuangKuan\IdPhoto;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    //本类主要处理请求和签名,根据方法自动选择key进行操作
    const URL = 'https://apicall.id-photo-verify.com/api/';
    public $conf;
    public $methods_key = array();

    public function __construct($conf)
    {
        $this->conf = $conf;
        self::initKeys();
    }

    private function initKeys()
    {
        $this->methods_key['env_pic'] = $this->conf['env'];
        $this->methods_key['cut_pic'] = $this->conf['cut'];
        $this->methods_key['check_pic'] = $this->conf['check_pic'];
        $this->methods_key['cut_check_pic'] = $this->conf['env_cut'];
    }

    public function requestGet(string $method)
    {
        $url = self::URL . $method;
        $http = $this->getHttp();
        $result = $http->get($url);
        return $result;
    }

    public function requestPost(string $method, array $params, $key = '')
    {
        $key_leng = strlen($key);
        if (array_key_exists('app_key', $params) || $key_leng !== 0) {
            $params['app_key'] = $key ?: $params['app_key'];
        } elseif (array_key_exists($method, $this->methods_key)) {
            $params['app_key'] = $this->methods_key[$method];
        }
        $http = $this->getHttp();
        $response = $http->json(self::URL . $method, $params);
        return $response->getBody()->__toString();
    }

}