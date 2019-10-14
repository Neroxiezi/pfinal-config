<?php
	/**
	 * ----------------------------------------
	 * | Created By pfinal-config                 |
	 * | User: pfinal <lampxiezi@163.com>     |
	 * | Date: 2019/10/14                      |
	 * | Time: 下午12:20                        |
	 * ----------------------------------------
	 * |    _____  ______ _             _     |
	 * |   |  __ \|  ____(_)           | |    |
	 * |   | |__) | |__   _ _ __   __ _| |    |
	 * |   |  ___/|  __| | | '_ \ / _` | |    |
	 * |   | |    | |    | | | | | (_| | |    |
	 * |   |_|    |_|    |_|_| |_|\__,_|_|    |
	 * ----------------------------------------
	 */
	
	namespace pf\config;
	
	class ConfigProvider
	{
		//延迟加载
		public $defer = false;
		
		public function boot()
		{
			//加载.env文件并加载配置文件
			Config::env('.env')->loadFiles(ROOT_PATH.'/system/config');
			//设置时区
			date_default_timezone_set(Config::get('app.timezone'));
			//调试时允许跨域访问
			if (Config::get('app.debug')) {
				header('Access-Control-Allow-Origin:*');
				header('Access-Control-Allow-Headers:*');
			}
		}
		
		public function register()
		{
			$this->app->single(
				'Config',
				function () {
					return Config::single();
				}
			);
		}
	}