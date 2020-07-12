<?php
/**
* Module: SecurityImage
* Version1.0
* Author: DuGris aka L. Jen <http://www.dugris.info>
* Licence: GPL see LICENSE
*/
define("_MI_SIMAGE_NAME","SecurityImage");
define("_MI_SIMAGE_DESC","Management of SecurityImage class");

// Admin Menu
define("_MI_SIMAGE_ADMENU0", "Preference");
define("_MI_SIMAGE_ADMENU1", "Index");
define("_MI_SIMAGE_ADMENU2", "Background image");
define("_MI_SIMAGE_ADMENU3", "True Type Fonts");
define("_MI_SIMAGE_ADMENU4", "Permissions");

// block

// Options préférences
define("_MI_SIMAGE_DEFAUT", "Use personalized parameters");
define("_MI_SIMAGE_DEFAUT_DSC", "Yes = Parameters selected below<br>Non = Parameters defined in the module");

define("_MI_SIMAGE_MEMBERS", "Use security code for members");

define("_MI_SIMAGE_SESSION_NAME","Session's name");

define("_MI_SIMAGE_NUMCHAR" , "Number of characters for the code");
define("_MI_SIMAGE_MINFONTSIZE" , "Minimum caracters height");
define("_MI_SIMAGE_MAXFONTSIZE" , "Maximum caracters height");
define("_MI_SIMAGE_SENSITIVECASE","Deactivate the check of the case");
define("_MI_SIMAGE_BACKGROUND" , "Select the background type");
define("_MI_SIMAGE_NUMBACKGROUND" , "Number of object for the background");
define("_MI_SIMAGE_NUMBACKGROUND_DSC" , "<font color='#CC0000'><b>Only for this background : </b></font><br />Circles, Lines, Rectangles, Polygons.");

define("_MI_SIMAGE_POLYGONPOINT", "Number of points for polygons");
define("_MI_SIMAGE_IMAGES_SELECT" , "Select the images to be used");
define("_MI_SIMAGE_IMAGES_SELECT_DSC" , "<font color='#CC0000'><b>Only if the backgound was à image</b></font>");

define("_MI_SIMAGE_FONT_TYPE", "Type of font to be used");
define("_MI_SIMAGE_FONTS_TTF" , "Select the font <font color='#CC0000'>TTF</font> to be used");
define("_MI_SIMAGE_FONTS_SELECT_DSC" , "");

define("_MI_SIMAGE_CIRCLE"    , "Circles");
define("_MI_SIMAGE_LINE"      , "Lines");
define("_MI_SIMAGE_RECTANGLE" , "Rectangles");
define("_MI_SIMAGE_BARS"      , "Bars");
define("_MI_SIMAGE_ELLIPSE"   , "Ellipses");
define("_MI_SIMAGE_POLYGON"   , "Polygons");
define("_MI_SIMAGE_IMAGE"     , "Images");

define("_MI_SIMAGE_IMG_MAX_FILESIZE", "<font color='#CC0000'>Images</font> : Maximum file size");
define("_MI_SIMAGE_IMG_MAX_WIDTH", "<font color='#CC0000'>Images</font> : Maximum width");
define("_MI_SIMAGE_IMG_MAX_HEIGHT", "<font color='#CC0000'>Images</font> : Maximun height");

define("_MI_SIMAGE_FONT_MAX_FILESIZE", "<font color='#CC0000'>Fontes</font> : Maximum file size");
?>