<?php
	
	if (!function_exists('env')) {
		/**
		 * 根据.env配置文件获取匹配项
		 *
		 * @param $name  配置名称
		 * @param $value 为空时的返回值
		 *
		 * @return mixed
		 */
		function env($name, $value = null)
		{
			return \pf\config\Config::getEnv($name) ?: $value;
		}
	}