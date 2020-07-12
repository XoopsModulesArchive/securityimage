<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/
include_once('admin_header.php');

switch($op) {
	case _AM_SIMAGE_POST:

	// Uploading the font
	if ( $_FILES['file_download']['name'] != '' ) {
		$filename = $_POST['xoops_upload_file'][0] ;
		if( !empty( $filename ) || $filename != '' ) {
			$max_size = securityimage_GetOptions('si_font_max_filesize');
			$allowed_mimetypes = securityimage_getAllowedImagesTypes("ttf");

			if( $_FILES[$filename]['tmp_name'] == '' || ! is_readable( $_FILES[$filename]['tmp_name'] ) ) {
				redirect_header( 'javascript:history.go(-1)' , 2, _AM_SIMAGE_FILEUPLOAD_ERROR ) ;
				exit ;
			}

			include_once(XOOPS_ROOT_PATH . '/class/uploader.php');
			$uploader = new XoopsMediaUploader(XOOPS_ROOT_PATH . '/uploads/securityimage/fonts', $allowed_mimetypes, $max_size);

			if( $uploader->fetchMedia( $filename ) && $uploader->upload() ) {
            	$si_TTFallowed[] = $uploader->getSavedFileName();
			} else {
				redirect_header( 'javascript:history.go(-1)' , 2, _AM_SIMAGE_FILEUPLOAD_ERROR . $uploader->getErrors() ) ;
				exit ;
			}
		}
	}
	$config =& $config_handler->getConfig($conf_ids);
	$new_value =& ${$config->getVar('conf_name')};
	if (is_array($new_value) || $new_value != $config->getVar('conf_value')) {
		$config->setConfValueForInput($new_value);
		$config_handler->insertConfig($config);
    }
	redirect_header( 'ttf_fonts.php' , 2, _AM_SIMAGE_SAVE_OK) ;
    exit();
    break;
}

securityimage_adminMenu(2, _AM_SIMAGE_TTF_FONTS);
securityimage_UpdateOptions( 'si_TTFallowed');
$FontList = get_FontList('ttf');
$maxselect = count($FontList) > 10  ? 10 : count( $FontList );

$sform = new XoopsThemeForm(_AM_SIMAGE_TTF_FONTS, 'font', 'ttf_fonts.php');
$sform->setExtra('enctype="multipart/form-data"');

// images directory
$sform->addElement( new XoopsFormLabel( _AM_SIMAGE_DIR_FONTS , XOOPS_ROOT_PATH . '/uploads/securityimage/fonts/' ) );

// Selected font
$select_font = new XoopsFormSelect(_MI_SIMAGE_FONTS_TTF, 'si_TTFallowed', securityimage_GetOptions('si_TTFallowed'), $maxselect, true);
$select_font->addOptionArray( $FontList );
$sform->addElement($select_font);
$sform->addElement( new XoopsFormHidden('conf_ids', securityimage_GetConfId('si_TTFallowed') ) );

// upload font
$max_size = securityimage_GetOptions('si_font_max_filesize');
$font_box = new XoopsFormFile(_AM_SIMAGE_FONT_UPLOAD, 'file_download', $max_size);
$font_box->setDescription(_AM_SIMAGE_FONT_UPLOAD_TTF);
$font_box->setExtra( "size ='60'") ;
$sform->addElement($font_box);

//Submit buttons
$button_tray = new XoopsFormElementTray('' ,'');
$submit_btn = new XoopsFormButton('', 'op', _AM_SIMAGE_POST , 'submit');
$submit_btn->setExtra('accesskey="s"');
$button_tray->addElement($submit_btn);
$sform->addElement($button_tray);


$sform->display();

include('admin_footer.php');
?>