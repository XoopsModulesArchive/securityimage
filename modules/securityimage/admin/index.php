<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/
include_once('admin_header.php');

securityimage_adminMenu(0, _AM_SIMAGE_INDEX);

check_security_image();

include('admin_footer.php');

function check_security_image() {
	echo "<br />";
	echo "<table width='100%' class='outer' cellspacing='1' cellpadding='3' border='0' >";
	echo "<tr><td class='even'>" . _AM_SIMAGE_DIR_IMAGES . " : " . XOOPS_ROOT_PATH . "/uploads/securityimage/</td></tr>";
	echo "<tr><td class='even'>" . _AM_SIMAGE_DIR_FONTS  . " : " . XOOPS_ROOT_PATH . "/uploads/securityimage/fonts/</td></tr>";
	echo "</table>";

	echo "<br />";
	echo "<table width='100%' class='outer' cellspacing='1' cellpadding='3' border='0' >";
	echo "<tr><th>" . _AM_SIMAGE_CONFIG . "</th></tr>";

	echo "<tr>";
	echo "<td class='even'><b>";
	echo _AM_SIMAGE_GD_TXT;
	if ( extension_loaded('gd') ) {
		echo "<font color='#009900'>";
	    echo _AM_SIMAGE_GD_INSTALLED;
		$gdinfo = gd_info();
		echo " -- ${gdinfo['GD Version']}";
    	echo "</font>";
	} else {
		echo "<font color='#CC0000'>";
		echo _AM_SIMAGE_GD_NOTINSTALLED;
    	echo "</font>";
	}
	echo "</b></td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td class='odd'><b>";
	echo _AM_SIMAGE_CLASS;
	if ( file_exists(XOOPS_ROOT_PATH . "/class/xoopsform/securityimage.php" ) ) {
		echo "<font color='#009900'>";
	    echo _AM_SIMAGE_CLASS_TRUE;
    	echo "</font>";
	} else {
		echo "<font color='#CC0000'>";
	    echo _AM_SIMAGE_CLASS_FALSE;
    	echo "</font>";
	}
	echo "</b></td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td class='even'><b>";
	echo _AM_SIMAGE_INCLUDE;
	if ( defined('SECURITYIMAGE_INCLUDED') ) {
		echo "<font color='#009900'>";
	    echo _AM_SIMAGE_INCLUDE_TRUE;
    	echo "</font>";
	} else {
		echo "<font color='#CC0000'>";
	    echo _AM_SIMAGE_INCLUDE_FALSE;
    	echo "</font>";
	}
	echo "</b></td>";
	echo "</tr>";
	echo "</table>";
}
?>