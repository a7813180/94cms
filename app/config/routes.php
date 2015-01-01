<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "index/index";
$route['404_override'] = '';
$route[APP_ADMIN.'/(.*)'] = APP_ADMIN."/$1"; //防止把自定义url把后台给定向过去

$route['module/(.*)'] = "module/$1"; //模型定向

$route['member/(.*)'] = "module/member/$1"; //模型定向

$route['member'] = "module/member/home"; //模型定向
//单页
$route['page_view_(:num)'] = "page/index/$1";
$route['p_(.*)'] = "page/index/$1";
$route['page/index/(:num)'] = "page/index/$1";


//列表页

$route['list_view_(:num)_(:num)'] = "cate/index/$1/$2";
$route['cate/index/(:num)'] = "cate/index/$1";
$route['cate/index/(:num)/(:num)'] = "cate/index/$1/$2";

$route['tag/(.*)'] = "tag/index/$1";
$route['tag'] = "tag/index";

//内容页
$route['show/index/(:num)/(:num)'] = "show/index/$1/$2";
$route['show/comm/(:num)/(:num)'] = "show/comm/$1/$2";
$route['show/click/(:num)/(:num)'] = "show/click/$1/$2";
$route['show_view_(:num)_(:num)'] = "show/index/$1/$2";
$route['show_dow_(:num)_(:num)'] = "show/dow/$1/$2";
$route['search'] = "search/index";

//手机
$route['wap'] = "module/wap/home";
//手机单页
$route['wap/page_view_(:num)'] = "module/wap/page/index/$1";
$route['wap/p_(.*)'] = "module/wap/page/index/$1";
$route['wap/page/index/(:num)'] = "module/wap/page/index/$1";
$route['wap/(.*)/list_(:num)'] = "module/wap/cate/index/$1/$2";
$route['wap/list_view_(:num)_(:num)'] = "module/wap/cate/index/$1/$2";
//
$route['wap/show/index/(:num)/(:num)'] = "module/wap/show/index/$1/$2";
$route['wap/show/click/(:num)/(:num)'] = "module/wap/show/click/$1/$2";
$route['wap/show_view_(:num)_(:num)'] = "module/wap/show/index/$1/$2";
$route['wap/(.*)/(:num)'] = "module/wap/show/index/$1/$2";
$route['wap/(.*)'] = "module/wap/cate/index/$1";


 
$route['(.*)/list_(:num)'] = "cate/index/$1/$2";
$route['(.*)/(:num)'] = "show/index/$1/$2";
$route['(.*)'] = "cate/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */