<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/

$modversion['name'] = _MI_SIMAGE_NAME;
$modversion['version'] = "1.0";
$modversion['description'] = _MI_SIMAGE_DESC;
$modversion['credits'] = "DuGris ( http://www.dugris.info )<br />The XOOPS Project";
$modversion['author'] = "DuGris aka L. Jen <http://www.dugris.info>";
$modversion['help'] = "";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 1;
$modversion['image'] = "images/securityimage_slogo.png";
$modversion['dirname'] = "securityimage";

//install
$modversion['onInstall'] = 'include/oninstall.php';
//update
 $modversion['onUpdate'] = 'include/onupdate.php';

 // Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 0;

// Search
$modversion['hasSearch'] = 0;

// Sql
$modversion['sqlfile']['mysql'] = "";

// Tables created by sql file (without prefix!)

// Templates

// Blocks

// Options préférences
include_once(XOOPS_ROOT_PATH . '/modules/securityimage/include/functions.php');

$i = 0;

$i++;
$modversion['config'][$i]['name'] = 'si_defaut';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_DEFAUT';
$modversion['config'][$i]['description'] = '_MI_SIMAGE_DEFAUT_DSC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] = array(_YES => 1, _NO => 0);

$i++;
$modversion['config'][$i]['name'] = 'si_sessionname';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_SESSION_NAME';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "securityimage";

$i++;
$modversion['config'][$i]['name'] = 'si_numchar';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_NUMCHAR';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 6;
$modversion['config'][$i]['options'] = array('4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8);

$fontsize = array();
for ($j=10; $j <= 20; $j++) {$fontsize["$j"]=$j;}
$i++;
$modversion['config'][$i]['name'] = 'si_minfontsize';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_MINFONTSIZE';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 12;
$modversion['config'][$i]['options'] = $fontsize;

$fontsize = array();
for ($j=10; $j <= 20; $j++) {$fontsize["$j"]=$j;}
$i++;
$modversion['config'][$i]['name'] = 'si_maxfontsize';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_MAXFONTSIZE';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 16;
$modversion['config'][$i]['options'] = $fontsize;

$i++;
$modversion['config'][$i]['name'] = 'si_sensitivecase';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_SENSITIVECASE';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] = array(_YES => 1, _NO => 0);

$i++;
$modversion['config'][$i]['name'] = 'si_background';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_BACKGROUND';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] = array(
                                     '_MI_SIMAGE_BARS'      => 0,
                                     '_MI_SIMAGE_CIRCLE'    => 1,
                                     '_MI_SIMAGE_LINE'      => 2,
                                     '_MI_SIMAGE_RECTANGLE' => 3,
									 '_MI_SIMAGE_ELLIPSE'   => 4,
									 '_MI_SIMAGE_POLYGON'   => 5,
                                     '_MI_SIMAGE_IMAGE'     => 100
                                     );

$i++;
$modversion['config'][$i]['name'] = 'si_numbackground';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_NUMBACKGROUND';
$modversion['config'][$i]['description'] = '_MI_SIMAGE_NUMBACKGROUND_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 30;
$modversion['config'][$i]['options'] = array('0' => 0, '10' => 10, '20' => 20, '30' => 30, '40' => 40, '50' => 50, '60' => 60, '70' => 70, '80' => 80, '90' => 90, '100' => 100);

$i++;
$modversion['config'][$i]['name'] = 'si_polygonpoint';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_POLYGONPOINT';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 3;
$modversion['config'][$i]['options'] = array('3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10);

$i++;
$modversion['config'][$i]['name'] = 'si_imageallowed';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_IMAGES_SELECT';
$modversion['config'][$i]['description'] = '_MI_SIMAGE_IMAGES_SELECT_DSC';
$modversion['config'][$i]['formtype'] = 'select_multi';
$modversion['config'][$i]['valuetype'] = 'array';
$modversion['config'][$i]['options'] = get_BackgroundList();

$i++;
$modversion['config'][$i]['name'] = 'si_TTFallowed';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_FONTS_TTF';
$modversion['config'][$i]['description'] = '_MI_SIMAGE_FONTS_SELECT_DSC';
$modversion['config'][$i]['formtype'] = 'select_multi';
$modversion['config'][$i]['valuetype'] = 'array';
$modversion['config'][$i]['options'] = get_FontList('ttf');

$i++;
$modversion['config'][$i]['name'] = 'si_img_max_filesize';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_IMG_MAX_FILESIZE';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "10000";

$i++;
$modversion['config'][$i]['name'] = 'si_img_max_width';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_IMG_MAX_WIDTH';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "150";

$i++;
$modversion['config'][$i]['name'] = 'si_img_max_height';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_IMG_MAX_HEIGHT';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "30";

$i++;
$modversion['config'][$i]['name'] = 'si_font_max_filesize';
$modversion['config'][$i]['title'] = '_MI_SIMAGE_FONT_MAX_FILESIZE';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "100000";

?>