<?php
/**
 * Created by PhpStorm.
 * User: huangkuan
 * Date: 2019/1/26
 * Time: 9:36 PM
 */

namespace HuangKuan\IdPhoto;


/**
 * Class Main
 * @package HuangKuan\IdPhoto
 */
class Main extends Api
{
    /**
     * 获取base64后的图片
     * @param $path
     * @return string
     */
    public function getBase64Image($path)
    {
        return chunk_split(base64_encode(file_get_contents($path)));
    }

    /**
     * 1.证件照环境检测
     * @param array $datas
     * @return mixed
     * @throws \Exception
     */
    public function env_pic(array $datas)
    {
        $method = 'env_pic';
        $need = ['file', 'facepose', 'eyegaze', 'eyeskew', 'shoulderskew', 'darkillum', 'unbalanceillum', 'bfsimilarity'];
        self::check($method, $need, $datas);
        return self::toArray($this->requestPost($method, $datas));
    }

    /**
     * 2.制作证件照
     * @param array $datas
     * @return mixed
     * @throws \Exception
     */
    public function cut_pic(array $datas)
    {
        $method = 'cut_pic';
        $need = ['file', 'spec_id'];
        self::check($method, $need, $datas);
        return self::toArray($this->requestPost($method, $datas));
    }

    /**
     * 3.检测证件照
     * @param array $datas
     * @return mixed
     * @throws \Exception
     */
    public function check_pic(array $datas)
    {
        $method = 'check_pic';
        $need = ['file', 'spec_id'];
        self::check($method, $need, $datas);
        return self::toArray($this->requestPost($method, $datas));
    }

    /**
     * 4.制作并检测证件照
     * @param array $datas
     * @return mixed
     * @throws \Exception
     */
    public function cut_check_pic(array $datas)
    {
        $method = 'cut_check_pic';
        $need = ['file', 'spec_id'];
        self::check($method, $need, $datas);
        return self::toArray($this->requestPost($method, $datas));
    }

    /**
     * 5.获取带水印图片(流)
     * @param string $file_name
     * @param null $path
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function take_pic_wm(string $file_name, $path = null)//
    {
        $url = 'take_pic_wm/' . $file_name;
        $result = $this->requestGet($url)->getBody()->__toString();
        $iserror = self::toArray($result);
        if (is_array($iserror)) {
            return $iserror;
        }
        if (is_null($path)) {
            return $result;
        }
        file_put_contents($path, $result);
        return $path;
    }

    /**
     * 6.获取无水印图片(流)
     * @param string $file_name
     * @param string $app_key
     * @param null $path
     * @return mixed|null
     * @throws \Exception
     */
    public function take_cut_pic(string $file_name, string $app_key, $path = null)
    {
        $method = 'take_cut_pic';
        $need = ['file_name', 'app_key'];
        $datas = compact('file_name', 'app_key');
        self::check($method, $need, $datas);
        $result = $this->requestPost($method, $datas, $app_key);
        $iserror = self::toArray($result);
        if (is_array($iserror)) {
            return $iserror;
        }
        if (is_null($path)) {
            return $result;
        }
        file_put_contents($path, $result);
        return $path;
    }

    /**
     * 7.同时获取无水印单张和排版图片
     * @param string $file_name
     * @param string $app_key
     * @return mixed
     * @throws \Exception
     */
    public function take_cut_pic_v2(string $file_name, string $app_key)
    {
        $method = 'take_cut_pic_v2';
        $need = ['file_name', 'app_key'];
        $datas = compact('file_name', 'app_key');
        self::check($method, $need, $datas);
        return self::toArray($this->requestPost($method, $datas, $app_key));
    }

    /**
     * 可自行根据文档修改,当通不过则不会发生Http请求
     * @param $method
     * @param $needs
     * @param $datas
     * @return bool
     * @throws \Exception
     */
    private function check($method, $needs, $datas)
    {
        foreach ($needs as $value) {
            if (!array_key_exists($value, $datas)) {
                throw new \Exception($method . ' missing parameter: ' . $value);
            }
        }
        return true;
    }

    private function toArray($json)
    {
        return json_decode($json, true);
    }
}