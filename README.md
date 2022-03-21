# Cookie组件
cookie组件通过加密cookie数据提高网站安全性

#开始使用

####安装组件
使用 composer 命令进行安装或下载源代码使用(依赖willphp/config组件)。

    composer require willphp/cookie

> WillPHP 框架已经内置此组件，无需再安装。

####调用示例

    \willphp\config\Cookie::set('app', 'willphp', 3600, '/', '113344.com'); //设置

####加密密钥

`config/app.php`配置文件可设置cookie加密密钥：
	
	'key' => 'willphp', //默认密钥
	

####设置

    Cookie::set('app', 'willphp');  

####检测

    Cookie::has('app'); //是否存在

####获取

    Cookie::get('app'); 

####删除

    Cookie::del('app'); 

####清空

    Cookie::flush(); 

#cookie函数

####参数说明

  cookie('[名称]', '[数据]', '[有效时间]' ,'[有效路径]', '[有效域名]');  

####获取
	
    $cookie= cookie('name');

####设置

    cache('app', 'willphp);

####检测

    $bool= cookie('?app');

####删除

    cookie('name', null);

####清空

    cookie(null);



