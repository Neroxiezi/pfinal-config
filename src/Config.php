<?php
/**
 * Created by PhpStorm.
 * User: nancheng
 * Date: 2019/2/12
 * Time: 12:59
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

namespace pf\config;

use pf\config\build\Base;

class Config
{
    protected static $link = null;

    public function __call($method, $params)
    {
        return call_user_func_array([self::single(), $method], $params);
    }

    public static function single()
    {
        if (is_null(self::$link)) {
            self::$link = new Base();
        }
        return self::$link;
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([self::single(), $name], $arguments);
    }
}