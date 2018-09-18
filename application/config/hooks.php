<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'] = array(
                    'class' => 'Custom_hooks',
                    'function' => 'check_for_admin',
                    'filename' => 'Custom_hooks.php',
                    'filepath' => 'hooks'
                    );
    
	
/*$hook['post_controller_constructor'] = array(
                                'class'    => 'Home',
                                'function' => 'check_login',
                                'filename' => 'Home.php',
                                'filepath' => 'hooks'
                                );*/

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
