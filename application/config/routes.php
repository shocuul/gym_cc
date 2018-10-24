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

//USUARIOS
$route['usuarios/nuevo'] = 'auth/create_user';
$route['usuarios/editar_usuario/(:num)'] = 'auth/edit_user/$1';
$route['usuarios/eliminar']['post'] = 'auth/delete_user';
$route['usuarios']['get'] = 'auth/users';
$route['usuarios/(:num)']['get'] = 'auth/users/$1';
$route['usuarios/editar_usuario/(:num)'] = 'auth/edit_user/$1';
$route['usuarios/eliminar']['post'] = 'auth/delete_user';

//PERFIL
$route['perfil'] = 'member/profile';
$route['perfil/(:num)/realizar/(:num)'] = 'member/routine_complete/$1/$2';
//$route['perfil/(:num)/asistencia'] = 'member/register_assists/$1';
$route['menus'] = 'page/menus';

//SOCIOS
$route['socio/detalles/(:num)'] = 'member/detail/$1';
$route['socio/detalles/(:num)/plan/(:num)'] = 'member/manage_plan/$1/$2';
$route['socio/detalles/(:num)/plan/(:num)/medidas']['post'] = 'member/add_metric/$1/$2';
$route['socio/detalles/(:num)/plan'] = 'member/add_plan/$1';
$route['socio/detalles/(:num)/eliminar_plan'] = 'member/delete_plan/$1';
$route['socios']['get'] = 'member';
$route['socios/eliminar']['post'] = 'member/delete_member';
$route['socios/nuevo'] = 'member/create_member';
$route['socios/editar_socio/(:num)'] = 'member/edit_member/$1';

//ESTADISTICAs
$route['estadisticas'] = 'stats';

//AJAX
$route['ajax/generate_login_info']['post'] = 'member/generate_login_info';
$route['ajax/generate_chart_data/(:num)'] = 'member/generate_chart_data/$1';
$route['ajax/usuarios'] = 'auth/ajax_users';
$route['ajax/socios'] = 'member/ajax_members';
$route['ajax/upload'] = 'member/upload';
$route['ajax/generate_stats'] = 'stats/ajax_assists_charts';
$route['ajax/plans'] = 'configuration/ajax_plans';


//PLANES
$route['configuracion/planes'] = 'configuration/plans';
$route['configuracion/comunicados'] = 'configuration/notices';
$route['configuracion/plan/(:num)'] = 'configuration/plan/$1';
$route['configuracion/plan/editar'] = 'configuration/edit_plan';
$route['configuracion/plan/(:num)/rutina']['post'] = 'configuration/add_routine/$1'; 
$route['configuracion/plan/(:num)/eliminar_rutina']['post'] = 'configuration/delete_rutine/$1';
$route['configuracion/imagenes'] = 'configuration/images';
$route['plan/eliminar'] = 'configuration/delete_plan';

//CONFIGURACION
$route['configuracion/permisos'] = 'configuration/permissions';
$route['configuracion/permisos/eliminar'] = 'configuration/permissions_delete';

//AUTH
$route['iniciar_sesion'] = 'auth/login';
$route['cerrar_sesion'] = 'auth/logout';
$route['default_controller'] = 'page';
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