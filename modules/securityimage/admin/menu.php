<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/
$adminmenu[0]['title'] =_MI_SIMAGE_ADMENU1;
$adminmenu[0]['link'] = 'admin/index.php';
$adminmenu[1]['title'] = _MI_SIMAGE_ADMENU2;
$adminmenu[1]['link'] = 'admin/images.php';
$adminmenu[2]['title'] = _MI_SIMAGE_ADMENU3;
$adminmenu[2]['link'] = 'admin/ttf_fonts.php';
$adminmenu[3]['title'] = _MI_SIMAGE_ADMENU4;
$adminmenu[3]['link'] = 'admin/permissions.php';

if (isset($xoopsModule)) {
	$headermenu[0]['title'] = _PREFERENCES;
	$headermenu[0]['link'] = XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid');

	$headermenu[1]['title'] = _AM_SIMAGE_UPDATE_MODULE;
	$headermenu[1]['link'] = XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin&op=update&module=' . $xoopsModule->getVar('dirname');
}
?>