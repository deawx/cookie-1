<?php
/*--------------------------------------------------------------------------
 | Software: [WillPHP framework]
 | Site: www.113344.com
 |--------------------------------------------------------------------------
 | Author: no-mind <24203741@qq.com>
 | WeChat: www113344
 | Copyright (c) 2020-2022, www.113344.com. All Rights Reserved.
 |-------------------------------------------------------------------------*/
namespace willphp\cookie;
use willphp\cookie\build\Base;
class Cookie {
	protected static $link;	
	public function __call($method, $params) {
		return call_user_func_array([self::single(), $method], $params);
	}	
	public static function single()	{
		if (!self::$link) {
			self::$link = new Base();
		}		
		return self::$link;
	}	
	public static function __callStatic($name, $arguments) {
		return call_user_func_array([self::single(), $name], $arguments);
	}
}