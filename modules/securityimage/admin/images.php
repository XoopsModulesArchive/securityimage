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

	// Uploading the image
	if ( $_FILES['file_download']['name'] != '' ) {
		$filename = $_POST['xoops_upload_file'][0] ;
		if( !empty( $filename ) || $filename != '' ) {
			$max_size = securityimage_GetOptions('si_img_max_filesize');
            $max_imgwidth = securityimage_GetOptions('si_img_max_width');
			$max_imgheight = securityimage_GetOptions('si_img_max_height');
			$allowed_mimetypes = securityimage_getAllowedImagesTypes();

			if( $_FILES[$filename]['tmp_name'] == '' || ! is_readable( $_FILES[$filename]['tmp_name'] ) ) {
				redirect_header( 'javascript:history.go(-1)' , 2, _AM_SIMAGE_FILEUPLOAD_ERROR ) ;
				exit ;
			}

			include_once(XOOPS_ROOT_PATH . '/class/uploader.php');
			$uploader = new XoopsMediaUploader(XOOPS_ROOT_PATH . '/uploads/securityimage', $allowed_mimetypes, $max_size, $max_imgwidth, $max_imgheight);

			if( $uploader->fetchMedia( $filename ) && $uploader->upload() ) {
            	$si_imageallowed[] = $uploader->getSavedFileName();
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
	redirect_header( 'images.php' , 2, _AM_SIMAGE_SAVE_OK) ;
    exit();
    break;
}

securityimage_adminMenu(1, _AM_SIMAGE_IMAGES);
securityimage_UpdateOptions( 'si_imageallowed');

$image_array = get_BackgroundList();
$image_key = array_keys($image_array);
$image_view = $image_array[ $image_key[0]];
$maxselect = count( $image_array > 10 ) ? 10 : count( $image_array );

$sform = new XoopsThemeForm(_AM_SIMAGE_IMAGES, 'securityimage', 'images.php');
$sform->setExtra('enctype="multipart/form-data"');

// images directory
$sform->addElement( new XoopsFormLabel( _AM_SIMAGE_DIR_IMAGES , XOOPS_ROOT_PATH . '/uploads/securityimage/' ) );

// Selected background
$select_image = new XoopsFormSelect(_MI_SIMAGE_IMAGES_SELECT, 'si_imageallowed', securityimage_GetOptions('si_imageallowed'), $maxselect, true);
$select_image->addOptionArray( $image_array );
$sform->addElement($select_image);
$sform->addElement( new XoopsFormHidden('conf_ids', securityimage_GetConfId() ) );

// Preview image
//$image_select = new XoopsFormSelect( '', 'viewimage', $image_array[0] );
//$image_select->addOptionArray( $image_array );
//$image_select->setExtra( "onchange='showImgSelected(\"image3\", \"viewimage\", \"" . 'uploads/securityimage/' . "\", \"\", \"" . XOOPS_URL . "\")'" );
//$image_tray = new XoopsFormElementTray(_AM_SIMAGE_IMG_VIEW, '&nbsp;' );
//$image_tray->addElement( $image_select );
//$image_tray->addElement( new XoopsFormLabel( '', "<br /><br /><img src='" . XOOPS_URL . "/uploads/securityimage/" . $image_view . "' name='image3' id='image3' width='150' height='30' alt='' />" ) );
//$sform->addElement( $image_tray );

// upload image
$max_size = securityimage_GetOptions('si_img_max_filesize');;
$image_box = new XoopsFormFile(_AM_SIMAGE_IMG_UPLOAD, 'file_download', $max_size);
//$image_box->setDescription(_AM_SIMAGE_IMG_UPLOAD_DSC);
$image_box->setExtra( "size ='60'") ;
$sform->addElement($image_box);

//Submit buttons
$button_tray = new XoopsFormElementTray('' ,'');
$submit_btn = new XoopsFormButton('', 'op', _AM_SIMAGE_POST , 'submit');
$submit_btn->setExtra('accesskey="s"');
$button_tray->addElement($submit_btn);
$sform->addElement($button_tray);

$sform->display();


include('admin_footer.php');
?>