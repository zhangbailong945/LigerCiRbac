<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Memcached settings
| -------------------------------------------------------------------------
| Your Memcached servers can be specified below.
|
|	See: https://codeigniter.com/user_guide/libraries/caching.html#memcached
|
*/
//是否开启
$config['flag'] = FALSE;
//memcached权限验证
$config['config'] = array(
               'servers' => array('localhost'),
               'debug'   => false
             );
