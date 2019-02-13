<?php

use pf\config\Config;

/**
 * Created by PhpStorm.
 * User: 运营部
 * Date: 2019/2/12
 * Time: 13:11
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
class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        Config::env(dirname(__DIR__) . '/.env');
        Config::loadFiles(__DIR__ . '/../config');
    }

    public function testAll()
    {
        $this->assertInternalType('array', Config::all());
    }

    public function testGetEnv()
    {
        $this->assertInternalType('string', Config::getEnv('APP_NAME'));
    }

    public function testGet()
    {
        $this->assertInternalType('string', Config::get('app.app_name'));
        $this->assertNull(Config::get('app.debug'));
    }

    public function testHas()
    {
        $this->assertFalse(Config::has('app.debug'));
        $this->assertTrue(Config::has('app.app_name'));
    }
}
