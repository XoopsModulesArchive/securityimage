<?php
/**
* Module: SecurityImage
* Version : 1.0
* Author: DuGris aka L. Jen <http://www.dugris.info/>
* Licence: GPL see LICENSE
*/
$ind_source = XOOPS_ROOT_PATH . "/uploads/index.html";

$dest = securityimage_create_dir();
if ($dest) {
	$ind_dest = $dest . "index.html";
	securityimage_copyr($ind_source, $ind_dest);
}

$dest = securityimage_create_dir("fonts");
if ($dest) {
	$ind_dest = $dest . "index.html";
	securityimage_copyr($ind_source, $ind_dest);
}

$dest = securityimage_create_dir("cache");
if ($dest) {
	$ind_dest = $dest . "index.html";
	securityimage_copyr($ind_source, $ind_dest);
}

function securityimage_create_dir( $directory = "" ) {

	$thePath = XOOPS_ROOT_PATH . "/uploads/securityimage/" ;
	if ( !empty($directory) ) {
    	$thePath .= $directory . "/";
    }

	if(@is_writable($thePath)){
		securityimage_admin_chmod($thePath, $mode = 0777);
        return $thePath;
	} elseif(!@is_dir($thePath)) {
    	securityimage_admin_mkdir($thePath);
        return $thePath;
	}
    return 0;
}

/**
* Thanks to the NewBB2 Development Team
*/
function securityimage_admin_mkdir($target) {
	// http://www.php.net/manual/en/function.mkdir.php
	// saint at corenova.com
	// bart at cdasites dot com
	if (is_dir($target) || empty($target)) {
		return true; // best case check first
	}

	if (file_exists($target) && !is_dir($target)) {
		return false;
	}

	if (securityimage_admin_mkdir(substr($target,0,strrpos($target,'/')))) {
		if (!file_exists($target)) {
			$res = mkdir($target, 0777); // crawl back up & create dir tree
			securityimage_admin_chmod($target);
	  	    return $res;
	  }
	}
    $res = is_dir($target);
	return $res;
}

/**
* Thanks to the NewBB2 Development Team
*/
function securityimage_admin_chmod($target, $mode = 0777) {
	return @chmod($target, $mode);
}

/**
 * Copy a file, or a folder and its contents
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0.0
 * @param       string   $source    The source
 * @param       string   $dest      The destination
 * @return      bool     Returns true on success, false on failure
 */
function securityimage_copyr($source, $dest) {
    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        if (is_dir("$source/$entry") && ($dest !== "$source/$entry")) {
            copyr("$source/$entry", "$dest/$entry");
        } else {
            copy("$source/$entry", "$dest/$entry");
        }
    }

    // Clean up
    $dir->close();
    return true;
}
?>