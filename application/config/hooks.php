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