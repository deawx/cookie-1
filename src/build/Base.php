<?php
/*--------------------------------------------------------------------------
 | Software: [WillPHP framework]
 | Site: www.113344.com
 |--------------------------------------------------------------------------
 | Author: no-mind <24203741@qq.com>
 | WeChat: www113344
 | Copyright (c) 2020-2022, www.113344.com. All Rights Reserved.
 |-------------------------------------------------------------------------*/
namespace willphp\cookie\build;
use willphp\config\Config;
use willphp\crypt\Crypt;
/**
 * Cookie 管理组件
 * Class Cookie
 * @package willphp\cookie
 */
class Base {
	protected $cookie = []; //cookie集合	
	protected $prefix = 'willphp'; //前缀	 
	public function __construct() {
		$this->cookie  = $_COOKIE;
		$this->prefix = Config::get('cookie.prefix', $this->prefix).'##';
	}
    /**
     * 设置
     * @param string $name   名称
     * @param mixed  $value  值
     * @param int    $expire 过期时间
     * @param string $path   有效路径
     * @param string $domain 有效域名
     */
	public function set($name, $value, $expire = 0, $path = '/', $domain = '') {
		$name = $this->prefix.$name;
		$value = Crypt::encrypt($value);
		$this->cookie[$name] = $value;
		$expire = $expire ? time() + $expire : $expire;
		if (PHP_SAPI != 'cli') {
			setcookie($name, $value, $expire, $path, $domain);
		}
	}
    /**
     * 检测
     * @param string $name 名称
     * @return bool
     */
	public function has($name) {
		return isset($this->cookie[$this->prefix.$name]);
	}
	/**
     * 获取
     * @param string $name 名称
     * @param string default 默认值
     * @return mixed
     */
	public function get($name, $default = '') {
		if ($this->has($name)) {
			return Crypt::decrypt($this->cookie[$this->prefix.$name]);
		}
		return $default;
	}
    /**
     * 获取所有
     * @return array
     */
	public function all() {
		$data = [];
		foreach ($this->cookie as $name => $value) {
			$data[$name] = $this->get($name);
		}		
		return $data;
	}
    /**
     * 删除
     * @param string $name 名称
     * @return bool
     */
	public function del($name) {
		if (isset($this->cookie[$this->prefix.$name])) {
			unset($this->cookie[$this->prefix.$name]);
		}
		if (PHP_SAPI != 'cli') {
			setcookie($this->prefix.$name, '', 1);
		}		
		return true;
	}
    /**
     * 删除所有
     * @return bool
     */
	public function flush() {
		$this->cookie = [];
		if (PHP_SAPI != 'cli') {
			foreach ($this->cookie as $key => $value) {
				setcookie($key, '', 1, '/');
			}
		}		
		return true;
	}
}