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
$hooks['pre_controller'] = array(
    'class'     =>  'MyClass',
    'function'  =>  'MyFunction',
    'filename'  =>  'MyClass.php',
    'filepath'  =>  'hooks',
    'params'    =>  array('beer', 'snack', 'wine')
);