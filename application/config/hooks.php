<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

//RBAC权限验证 挂钩点
$hook['post_controller_constructor'] = array(
		'class'    => 'Rbac',
		'function' => 'rbac_auth',
		'filename' => 'rbac_hooks.php',
		'filepath' => 'hooks',
		'params'   => '',
);

$hook['display_override'] = array(
		'class'    => 'Rbac',
		'function' => 'view_override',
		'filename' => 'rbac_hook.php',
		'filepath' => 'hooks',
		'params'   => '',
);

//默认开启SESSION
$hook['pre_system'] = array(
		'class'    => '',
		'function' => 'session_start',
		'filename' => '',
		'filepath' => '',
		'params'   => '',
);