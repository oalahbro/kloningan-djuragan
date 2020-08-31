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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

$hook['post_controller_constructor'] = array(
     'class'    => '',
     'function' => 'load_config',
     'filename' => 'db_config.php',
     'filepath' => 'hooks'
);
=======
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
=======
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
$hook['post_controller_constructor'][] = array(
	'class'    => '',
	'function' => 'load_config',
	'filename' => 'pengaturan.php',
	'filepath' => 'hooks'
);
/*
$hook['post_controller_constructor'][] = array(
	'function' => 'redirect_ssl',
	'filename' => 'ssl.php',
	'filepath' => 'hooks'
);

$hook['display_override'][] = array(
	'class' => '',
	'function' => 'compress',
	'filename' => 'compress.php',
	'filepath' => 'hooks'
);
<<<<<<< HEAD
*/
>>>>>>> b746267e0988f2a31635814dda93c719d8ac9053
=======
*/
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
