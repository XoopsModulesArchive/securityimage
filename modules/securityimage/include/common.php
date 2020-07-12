<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/

if (!defined('XOOPS_ROOT_PATH')) {
 	die('XOOPS root path not defined');
}

if( !defined('MODULE_DIRNAME') ){
	define('MODULE_DIRNAME', 'securityimage');
}

if( !defined('MODULE_URL') ){
	define('MODULE_URL', XOOPS_URL . '/modules/' . MODULE_DIRNAME . '/');
}

if( !defined('MODULE_ROOT_PATH') ){
	define('MODULE_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . MODULE_DIRNAME.'/');
}

if( !defined('MODULE_IMAGE_URL') ){
	define('MODULE_IMAGE_URL', MODULE_URL . 'images/');
}

if( !defined('MODULE_IMAGE_PATH') ){
	define('MODULE_IMAGE_PATH', MODULE_ROOT_PATH . 'images/');
}

if( !defined('MODULE_IMAGE_UPLOAD_URL') ){
	define('MODULE_IMAGE_UPLOAD_URL', XOOPS_URL . '/uploads/' . MODULE_DIRNAME . '/');
}

if( !defined('MODULE_IMAGE_UPLOAD_PATH') ){
	define('MODULE_IMAGE_UPLOAD_PATH', MODULE_ROOT_PATH . '/uploads/' . MODULE_DIRNAME . '/');
}

include_once(XOOPS_ROOT_PATH . '/include/cp_header.php');
include_once(XOOPS_ROOT_PATH . '/include/cp_functions.php');
include_once(XOOPS_ROOT_PATH . '/class/xoopslists.php');
include_once(XOOPS_ROOT_PATH . '/class/xoopsmodule.php');
include_once(XOOPS_ROOT_PATH . '/class/xoopsformloader.php');
include_once(XOOPS_ROOT_PATH . '/class/module.textsanitizer.php');

include_once(MODULE_ROOT_PATH . 'include/functions.php');

if (isset($HTTP_GET_VARS)) {
	foreach ($HTTP_GET_VARS as $k => $v) {
		$$k = $v;
	}
}

if (isset($HTTP_POST_VARS)) {
	foreach ($HTTP_POST_VARS as $k => $v) {
		$$k = $v;
	}
}

$op = isset($op) ? $op : '';

$SecurityImageModule = &SecurityImage_getModuleInfo();
$myts =& MyTextSanitizer::getInstance();
?>