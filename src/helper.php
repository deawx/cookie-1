<?php
if (!function_exists('cookie')) {
	/**
	 * 获取和设置cookie
     * @param string $name   名称
     * @param mixed  $value  值
     * @param int    $expire 过期时间
     * @param string $path   有效路径
     * @param string $domain 有效域名
	 * @return mixed
	 */
	function cookie($name = '', $value = '', $expire = 0, $path = '/', $domain = '') {
		if ($name == '') {
			return \willphp\cookie\Cookie::all();
		}
		if (is_null($name)) {
			return \willphp\cookie\Cookie::flush();
		}
		if ('' === $value) {
			return (0 === strpos($name, '?'))? \willphp\cookie\Cookie::has(substr($name, 1)) : \willphp\cookie\Cookie::get($name);
		}
		if (is_null($value)) {
			return \willphp\cookie\Cookie::del($name);
		}
		return \willphp\cookie\Cookie::set($name, $value, $expire, $path, $domain);
	}
}