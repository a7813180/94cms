<?php

    /*
    94cms 2.1版
    www.94cms.com QQ:80085391  TEL: 400-0515-082
    论坛：bbs.94cms.com
   */
    date_default_timezone_set ('Asia/Shanghai');
	define('ENVIRONMENT', 'development'); //常量为 'production' 将会关闭这些错误(报告)。在开发模式下，推荐设为 'development'
	define("CHARSET", 'utf-8');
    ini_set('memory_limit','128M'); //如果备份mysql超时 请把数组修改大点！
    define("_94CMS_BUG", 1); // 调式模式
  

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}


	$system_path = 'phpcode';

	$application_folder = 'app';


	// Set the current directory correctly for CLI requests
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';

	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}


	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// The PHP file extension
	// this global constant is deprecated.
	define('EXT', '.php');

	// Path to the system folder
	define('BASEPATH', str_replace("\\", "/", $system_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

  

	// The path to the "application" folder
	if (is_dir($application_folder))
	{
		define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
	}
	else
	{
		if ( ! is_dir(BASEPATH.$application_folder.'/'))
		{
			exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		}

		define('APPPATH', BASEPATH.$application_folder.'/');
	}

require_once BASEPATH.'core/CodeIgniter.php';