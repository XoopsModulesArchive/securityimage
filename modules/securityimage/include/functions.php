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

function securityimage_adminMenu ($currentoption = 0, $breadcrumb = '') {
	/* Nice buttons styles */
	echo "
    	<style type='text/css'>
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . MODULE_URL . "/images/bg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url('" . MODULE_URL . "/images/left_both.gif') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url('" . MODULE_URL . "images/right_both.gif') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#buttonbar a span {float:none;}
		/* End IE5-Mac hack */
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
	// global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig;
	global $xoopsModule, $xoopsConfig;
	$myts = &MyTextSanitizer::getInstance();

	$tblColors = Array_Fill(0,8,'');
	$tblColors[$currentoption] = 'current';

	if (file_exists(MODULE_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/modinfo.php')) {
		include_once MODULE_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/modinfo.php';
	} else {
		include_once MODULE_ROOT_PATH . 'language/french/modinfo.php';
	}

	include 'menu.php';

	echo '<div id="buttontop">';
	echo '<table style="width: 100%; padding: 0;" cellspacing="0"><tr>';
	echo '<td style="font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;">';
	for( $i=0; $i<count($headermenu); $i++ ){
		echo '<a class="nobutton" href="' . $headermenu[$i]['link'] .'">' . $headermenu[$i]['title'] . '</a> ';
		if ($i < count($headermenu)-1) {
			echo "| ";
		}
	}
	echo '</td>';
	echo '<td style="font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;">' . $breadcrumb . '</td>';
	echo '</tr></table>';
	echo '</div>';

	echo '<div id="buttonbar">';
	echo "<ul>";

	for( $i=0; $i<count($adminmenu); $i++ ){
		echo '<li id="' . $tblColors[$i] . '"><a href="' . MODULE_URL . $adminmenu[$i]['link'] . '"><span>' . $adminmenu[$i]['title'] . '</span></a></li>';
	}
	echo '</ul></div><div style="float: left; width: 100%; ">';
}

function securityimage_get_copywrit() {
	return("<div style='width : auto; float : right; '><a target='_blank' href='http://www.dugris.info/'><img src='" . MODULE_IMAGE_URL . "securityimage.gif' border='0' align='absmiddle'></a></div>");
}

function &SecurityImage_getModuleInfo() {
    static $SecurityImageModule;
	if (!isset($SecurityImageModule)) {
	    global $xoopsModule;
	    if (isset($xoopsModule) && is_object($xoopsModule) && $xoopsModule->getVar('dirname') == 'securityimage') {
	        $SecurityImageModule =& $xoopsModule;
	    }
	    else {
	        $hModule = &xoops_gethandler('module');
	        $SecurityImageModule = $hModule->getByDirname('securityimage');
	    }
	}
	return $SecurityImageModule;
}

function securityimage_GetOptions($option, $repmodule='securityimage')
{
	global $xoopsModuleConfig, $xoopsModule;
	static $tbloptions= Array();
	if(is_array($tbloptions) && array_key_exists($option,$tbloptions)) {
		return $tbloptions[$option];
	}

	$retval=false;
	if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive'))) {
		if(isset($xoopsModuleConfig[$option])) {
			$retval= $xoopsModuleConfig[$option];
		}
	} else {
		$module_handler =& xoops_gethandler('module');
		$module =& $module_handler->getByDirname($repmodule);
		$config_handler =& xoops_gethandler('config');
		if ($module) {
		    $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	    	if(isset($moduleConfig[$option])) {
	    		$retval= $moduleConfig[$option];
	    	}
		}
	}
	$tbloptions[$option]=$retval;
	return $retval;
}

function get_BackgroundList() {
	$MyBackground = array();
	$BackgroundPath = array(XOOPS_ROOT_PATH . '/modules/securityimage/images/background/', XOOPS_ROOT_PATH . '/uploads/securityimage/');
	foreach( $BackgroundPath as $path) {
		if ( is_dir($path) ) {
	    	$handle = opendir( $path );
			while (false !== ($file = readdir($handle))) {
				if ( !preg_match("/^[\.]{1,2}$/",$file) && preg_match("/(\.gif|\.jpg|\.png)$/i",$file) ) {
					$MyBackground[$file] = $file;
				}
	    	}
        }
	}
	return $MyBackground;
}

function get_FontList($typefont = "ttf") {
	$MyFonts = array();
	$FontPath = array(XOOPS_ROOT_PATH . '/modules/securityimage/fonts/', XOOPS_ROOT_PATH . '/uploads/securityimage/fonts/');
	foreach( $FontPath as $path) {
		if ( is_dir($path) ) {
	    	$handle = opendir( $path );
			while (false !== ($file = readdir($handle))) {
				if ( preg_match('@()\.' . $typefont . '$$@', $file, $tmp) ) {
					$MyFonts[$file] = $file;
				}
	    	}
        }
	}
	return $MyFonts;
}

function securityimage_UpdateOptions( $conf_name = 'si_imageallowed') {
	global $xoopsDB;
	$module_handler =& xoops_gethandler('module');
	$config_handler =& xoops_gethandler('config');
	$option_handler =& xoops_gethandler('configoption');

	$module =& $module_handler->getByDirname('securityimage');
	$configs =& $config_handler->getConfigs(new Criteria('conf_modid', $module->getVar('mid')));

	if ( count($configs) > 0) {
		$config_handler =& xoops_gethandler('config');
		$order = 0;
		for ($i = 0; $i <  count($configs); $i++) {
			if ( $configs[$i]->getvar('conf_name') == $conf_name ) {
        		$conf_id = $configs[$i]->getvar('conf_id');
	            $options = & $option_handler->getObjects( new Criteria('conf_id', $configs[$i]->getvar('conf_id') ) );
    	        foreach ( $options as $option) {
					$sql = sprintf('DELETE FROM %s WHERE confop_id = %u', $xoopsDB->prefix('configoption'), $option->getVar('confop_id'));
					if (!$xoopsDB->queryF($sql)) {
						echo 'erreur <br />';
					}
    	        }
			}
		}
    	$configs = $module->getInfo('config');
	    foreach ($configs as $config) {
			if ( $config['name'] == $conf_name ) {
				if (isset($config['options']) && is_array($config['options'])) {
					foreach ($config['options'] as $confop_name => $confop_value) {
                	    $sql = sprintf('INSERT INTO %s (confop_id, confop_name, confop_value, conf_id) VALUES (%u, %s, %s, %u)', $xoopsDB->prefix('configoption'), 0, $xoopsDB->quoteString($confop_name), $xoopsDB->quoteString($confop_value), $conf_id);
						if (!$xoopsDB->queryF($sql)) {
							echo 'erreur <br />';
						}
					}
				}
	    	}
    	}
	}
}

function securityimage_GetConfId( $conf_name = 'si_imageallowed') {
	$module_handler =& xoops_gethandler('module');
	$config_handler =& xoops_gethandler('config');
	$option_handler =& xoops_gethandler('configoption');

	$module =& $module_handler->getByDirname('securityimage');
	$configs =& $config_handler->getConfigs(new Criteria('conf_modid', $module->getVar('mid')));

	if ( count($configs) > 0) {
		$config_handler =& xoops_gethandler('config');
		$order = 0;
		for ($i = 0; $i <  count($configs); $i++) {
			if ( $configs[$i]->getvar('conf_name') == $conf_name ) {
        		$conf_id = $configs[$i]->getvar('conf_id');
            }
        }
    }
    return $conf_id;
}

function securityimage_getAllowedImagesTypes( $allowedType = 'gif|jpg|jpeg|png') {
	$ret = array();
	$myarray = explode('|', $allowedType);
    foreach ($myarray as $key => $typemine) {
    	$ret[$key] = 'image/' . $typemine;
    }
	return $ret;
}

function securityimage_checkperms() {
	global $xoopsUser;
    $securityimageModule = SecurityImage_getModuleInfo();
	$groups = is_object( $xoopsUser ) ? $xoopsUser -> getGroups() : XOOPS_GROUP_ANONYMOUS;
	$securityimage_permission_Handler = & xoops_getmodulehandler('permission', 'securityimage');
	return $securityimage_permission_Handler->checkRight( 'securityimage', 1, $groups, $securityimageModule->getVar('mid') );
}
?>