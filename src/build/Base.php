<?php
/**
 * Created by PhpStorm.
 * User: 南丞
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
        $config = explode('.', $key);
        foreach ((array)$config as $d) {
            if (!isset($tmp[$d])) {
                $tmp[$d] = [];
            }
            $tmp = &$tmp[$d];
        }
        $tmp = $name;
        return true;
    }

    /**
     * 环境所需配置
     * @param string $file
     * @return $this
     */
    public function env($file = '.env')
    {
        //var_dump($file);exit;
        if (is_file($file)) {
            $content = file_get_contents($file);
            preg_match_all('/(.+?)=(.+)/', $content, $env, PREG_SET_ORDER);
            if ($env) {
                foreach ($env as $e) {
                    self::$env[$e[1]] = $e[2];
                }
            }
        } else {
            die("The configuration file is missing. env, please see if there is a configuration file. Refer to the. env_example file for the content of the configuration file.\n");
        }
        return $this;
    }

    /**
     * 加载所有的自定义配置文件
     * @param $dir
     */
    public function loadFiles($dir)
    {
        //var_dump($dir);exit();
        foreach (glob($dir . '/*') as $f) {
            $info = pathinfo($f);
            $this->set($info['filename'], include $f);
        }
    }

    /**
     * 所有的自定义配置文件
     * @return array
     */
    public function all()
    {
        return self::$items;
    }

    /**
     * 获取配置项
     * @param $name
     * @return mixed
     */
    public static function getEnv($name)
    {
        if (isset(self::$env[$name])) {
            return self::$env[$name];
        } else {
            die("This configuration item does not exist\n");
        }

    }

    /**
     * 获取自定义配置的内容
     * @param $key
     * @param null $default
     * @return array|mixed|null
     */
    public function get($key, $default = null)
    {
        $tmp = self::$items;
        $config = explode('.', trim($key, '.'));
        if (count($config) > 0) {
            foreach ((array)$config as $d) {
                if (isset($tmp[$d])) {
                    $tmp = $tmp[$d];
                } else {
                    return $default;
                }
            }
        }
        return $tmp;
    }

    /**
     * 判断配置项是否存在
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        $tmp = self::$items;
        $config = explode('.', trim($key, '.'));
        if (count($config) > 0) {
            foreach ((array)$config as $d) {
                if (isset($tmp[$d])) {
                    $tmp = $tmp[$d];
                } else {
                    return false;
                }
            }
        }
        return true;
    }
    public function setItems($items)
    {
        return self::$items = $items;
    }

}
