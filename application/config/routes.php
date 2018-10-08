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

$route['usuarios']['get'] = 'auth/users';
$route['ajax/generate_login_info']['post'] = 'member/generate_login_info';
$route['ajax/generate_chart_data/(:num)']['get'] = 'member/generate_chart_data/$1';
$route['usuarios/nuevo'] = 'auth/create_user';
$route['usuarios/editar_usuario/(:num)'] = 'auth/edit_user/$1';
$route['usuarios/eliminar']['post'] = 'auth/delete_user';
$route['socios/eliminar']['post'] = 'member/delete_member';
$route['socios/nuevo'] = 'member/create_member';
$route['socios/editar_socio/(:num)'] = 'member/edit_member/$1';
$route['socio/detalles/(:num)'] = 'member/detail/$1';
$route['configuracion/planes'] = 'configuration/plans';
$route['configuracion/plan/editar'] = 'configuration/edit_plan';
$route['plan/eliminar'] = 'configuration/delete_plan';
$route['socio/detalles/(:num)/medidas']['post'] = 'member/add_metric/$1';
$route['socios']['get'] = 'member';
$route['iniciar_sesion'] = 'auth/login';
$route['cerrar_sesion'] = 'auth/logout';
$route['default_controller'] = 'auth/users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*function map_resources($resource)
{
    echo "$route['{$resource}']['get'] = '{$resource}/list_all'\n";
    echo "$route['{$resource}']['post'] = '{$resource}/create'\n";
    echo "$route['{$resource}/(:any)']['get'] = '{$resource}/show/$1'\n";
    echo "$route['{$resource}/(:any)']['put'] = '{$resource}/update/$1'\n";
    echo "$route['{$resource}/(:any)']['delete'] = '{$resource}/delete/$1'\n";
}
map_resource('socios');
map_resource('usuarios');*/