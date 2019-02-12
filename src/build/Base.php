<?php
/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2019/2/12
 * Time: 13:01
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

namespace pf\config\build;

class Base
{
    protected static $items = [];
    protected static $env = [];

    public function batch(array $config)
    {
        foreach ($config as $k => $v) {
            $this->set($k, $v);
        }
        return true;
    }

    public function set($key, $name)
    {
        $tmp = &self::$items;
        $config = explode(',', $key);
        foreach ((array)$config as $d) {
            if (!isset($tmp[$d])) {
                $tmp[$d] = [];
            }
            $tmp = &$tmp[$d];
        }
        $tmp = $name;
        return true;
    }
}
