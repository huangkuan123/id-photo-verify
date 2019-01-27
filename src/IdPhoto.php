<?php
/**
 * Created by PhpStorm.
 * User: huangkuan
 * Date: 2019/1/26
 * Time: 4:23 PM
 */

namespace HuangKuan\IdPhoto;

use Hanson\Foundation\Foundation;

/**
 * Class IdPhoto
 * @package HuangKuan\Main
 * @method array env_pic($datas)
 * @method array cut_pic($datas)
 * @method array check_pic($datas)
 * @method array cut_check_pic($datas)
 * @method take_pic_wm(string $file_name, $path = null)
 * @method array take_cut_pic(string $file_name, string $app_key, $path = null)
 * @method array take_cut_pic_v2(string $file_name, string $app_key)
 * @method getBase64Image($path)
 *
 */
class IdPhoto extends Foundation
{
    public $main;

    public function __construct($config = [])
    {
        if (!array_key_exists('debug', $config)) {
            $config['debug'] = true;
        }
        parent::__construct($config);
        $this->main = new Main($config);
    }

    public function __call($name, $arg)
    {
        return $this->main->{$name}(...$arg);
    }
}