<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/
include_once("admin_header.php");
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

$op = '';

foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

securityimage_adminMenu(3, _AM_SIMAGE_PERMISSIONS);
$form_view = new XoopsGroupPermForm("", $xoopsModule->getVar('mid'), "securityimage", "");
$form_view->addItem(1, _MI_SIMAGE_ACTIVATE);
echo $form_view->render();

include("admin_footer.php");
?>