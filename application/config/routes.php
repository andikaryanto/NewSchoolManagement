<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/login';
$route['login'] = 'login/index';
$route['login/dologin'] = 'login/dologin';
$route['register'] = 'register/index';

$route['home'] = 'home/index';

$route['mgroupuser'] = 'm_groupuser';
$route['mgroupuser/add'] = 'm_groupuser/add';
$route['mgroupuser/addsave'] = 'm_groupuser/addsave';
$route['mgroupuser/edit/(:num)'] = 'm_groupuser/edit/$1';
$route['mgroupuser/editsave'] = 'm_groupuser/editsave';
$route['mgroupuser/delete'] = 'm_groupuser/delete';
$route['mgroupuser/editrole/(:num)'] = 'm_groupuser/editrole/$1';

$route['muser'] = 'm_user';
$route['muser/add'] = 'm_user/add';
$route['muser/addsave'] = 'm_user/addsave';
$route['muser/edit/(:num)'] = 'm_user/edit/$1';
$route['muser/editsave'] = 'm_user/editsave';
$route['muser/delete/(:num)'] = 'm_user/delete/$1';
$route['muser/activate/(:num)'] = 'm_user/activate/$1';
$route['changePassword'] = 'm_user/changePassword';
$route['saveChangePassword'] = 'm_user/saveNewPassword';
$route['settings'] = 'm_user/setting';
$route['savesettings'] = 'm_user/savesetting';


$route['mkelas'] = 'm_kelas';
$route['mkelas/add'] = 'm_kelas/add';
$route['mkelas/addsave'] = 'm_kelas/addsave';
$route['mkelas/edit/(:num)'] = 'm_kelas/edit/$1';
$route['mkelas/editsave'] = 'm_kelas/editsave';
$route['mkelas/delete/(:num)'] = 'm_kelas/delete/$1';

$route['mschool'] = 'm_school';
$route['mschool/add'] = 'm_school/add';
$route['mschool/addsave'] = 'm_school/addsave';
$route['mschool/edit/(:num)'] = 'm_school/edit/$1';
$route['mschool/editsave'] = 'm_school/editsave';
$route['mschool/delete/(:num)'] = 'm_school/delete/$1';

$route['mschoolyear'] = 'm_schoolyear';
$route['mschoolyear/add'] = 'm_schoolyear/add';
$route['mschoolyear/addsave'] = 'm_schoolyear/addsave';
$route['mschoolyear/edit/(:num)'] = 'm_schoolyear/edit/$1';
$route['mschoolyear/editsave'] = 'm_schoolyear/editsave';
$route['mschoolyear/delete/(:num)'] = 'm_schoolyear/delete/$1';
$route['mschoolyear/activate/(:num)'] = 'm_schoolyear/activate/$1';

$route['mprovince'] = 'm_province';
$route['mprovince/add'] = 'm_province/add';
$route['mprovince/addsave'] = 'm_province/addsave';
$route['mprovince/edit/(:num)'] = 'm_province/edit/$1';
$route['mprovince/editsave'] = 'm_province/editsave';
$route['mprovince/delete'] = 'm_province/delete';

$route['mcity'] = 'm_city';
$route['mcity/add'] = 'm_city/add';
$route['mcity/addsave'] = 'm_city/addsave';
$route['mcity/edit/(:num)'] = 'm_city/edit/$1';
$route['mcity/editsave'] = 'm_city/editsave';
$route['mcity/delete'] = 'm_city/delete';

$route['msubcity'] = 'm_subcity';
$route['msubcity/add'] = 'm_subcity/add';
$route['msubcity/addsave'] = 'm_subcity/addsave';
$route['msubcity/edit/(:num)'] = 'm_subcity/edit/$1';
$route['msubcity/editsave'] = 'm_subcity/editsave';
$route['msubcity/delete'] = 'm_subcity/delete';

$route['mvillage'] = 'm_village';
$route['mvillage/add'] = 'm_village/add';
$route['mvillage/addsave'] = 'm_village/addsave';
$route['mvillage/edit/(:num)'] = 'm_village/edit/$1';
$route['mvillage/editsave'] = 'm_village/editsave';
$route['mvillage/delete'] = 'm_village/delete';

$route['mclass'] = 'm_class';
$route['mclass/add'] = 'm_class/add';
$route['mclass/addsave'] = 'm_class/addsave';
$route['mclass/edit/(:num)'] = 'm_class/edit/$1';
$route['mclass/editsave'] = 'm_class/editsave';
$route['mclass/delete'] = 'm_class/delete';

$route['mpeople'] = 'm_people';
$route['mpeople/add'] = 'm_people/add';
$route['mpeople/addsave'] = 'm_people/addsave';
$route['mpeople/edit/(:num)'] = 'm_people/edit/$1';
$route['mpeople/editsave'] = 'm_people/editsave';
$route['mpeople/delete'] = 'm_people/delete';


//API
$route['api/mdisaster']['GET'] = 'api_mdisaster/get_disaster';
$route['api/mdisaster/(:any)/(:any)'] = 'api_mdisaster/get_disaster/$1/$2';
$route['api/mdisaster/save']['POST'] = 'api_mdisaster/save_disaster';
