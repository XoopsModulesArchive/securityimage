<?php
//  ---------------------------------------------------------------------------- //
// Class : SecurityImage 1.6																		//
// Author: DuGris aka L. Jen <http://www.dugris.info>										//
// Email : DuGris@wanadoo.fr																		//
// Licence: GNU																						//
// Project: The XOOPS Project																		//
//  ---------------------------------------------------------------------------- //


define( 'SECURITYIMAGE_INCLUDED' , 1 ) ;

class SecurityImage extends XoopsFormElement {
	var $Caption;
	var $ForMembers;
	var $NumChars;
	var $MinFontSize;
	var $MaxFontSize;
	var $BackgroundType;
	var $NumBackground;
	var $SessionName;
	var $SensitiveCase;

	/**
	* Constructor
	*
	* $Caption			: Caption of the element
	* @var	string
	*
	* $ForMembers		: SecurityImage for members
	* @var	bool		: 0 = Desactivate SecurityImage for members (default)
	*					: 1 = Activate SecurityImage for members
	*
	* $NumChar			: Number of character of the code 'default : 6)
	* @var  int
	*
	* $MinFontSize		: Minimum font size
	* @var int			: default = 12
	*
	* $MaxFontSize		: Maximum font size
	* @var int			: default = 16
	*
	* $BackgroundType	: Background type
	* @var  int		: 0 = Bars (default)
	*					: 1 = Circles
	*					: 2 = Lines
	*					: 3 = Rectangles
	*					: 4 = Ellipses
	*					: 5 = Polygons
	*					: 6 = image files (GIF/JPG/PNG)
	*
	* $NumBackground	: Number of coloc background (default : 50)
	* @var	int
	*
	* $SessionName		: Session name
	* @var	string		: default = securityimage
	*
	*
	* $SensitiveCase	: Deactivate the check of the case
	* @var	bool		: 1 = true (default)
	*					: 0 = false
	*
	* Private
	*
	* $PolygonPoint	: Polygon number point
	* @var int			: defaut = 3
	*
	* $BackgroundPath	: Background path
	* @var array		: default = array(XOOPS_ROOT_PATH . '/modules/securityimage/images/background/', XOOPS_ROOT_PATH . '/uploads/securityimage/')
	*
	* $FontPath		: Font path
	* @var array		: default = array(XOOPS_ROOT_PATH . '/modules/securityimage/fonts/',XOOPS_ROOT_PATH . '/uploads/securityimage/fonts/');
	*
	*/

	function securityImage( $Caption = '', $ForMembers = 1, $NumChars = 6, $MinFontSize = 12, $MaxFontSize = 16, $BackgroundType=0, $NumBackground = 50, $SessionName = 'securityimage', $SensitiveCase = 1 ) {
		$this->_error = 0;

		// get parameters
		$this->ForMembers = $ForMembers;
		$this->NumChars = $NumChars;
		$this->MinFontSize = $MinFontSize;
		$this->MaxFontSize = $MaxFontSize;
		$this->BackgroundType = $BackgroundType;
		$this->NumBackground = $NumBackground;
		$this->SessionName = $SessionName;
		$this->SensitiveCase = $SensitiveCase;

		$this->BackgroundPath = array(XOOPS_ROOT_PATH . '/modules/securityimage/images/background/', XOOPS_ROOT_PATH . '/uploads/securityimage/');
		$this->FontPath = array(XOOPS_ROOT_PATH . '/modules/securityimage/fonts/',XOOPS_ROOT_PATH . '/uploads/securityimage/fonts/');
		$this->FontsList = $this->getFontsList();
		$this->BackgroundList = $this->getBackgroundList();
		$this->PolygonPoint = 3;
		$this->ImageFile_root = XOOPS_ROOT_PATH . '/uploads/securityimage/cache/';
		$this->ImageFile_url =  XOOPS_URL . '/uploads/securityimage/cache/';

		// securityimage module installed
		if ( file_exists(XOOPS_ROOT_PATH . '/modules/securityimage/include/functions.php') ) {
			include_once(XOOPS_ROOT_PATH . '/modules/securityimage/include/functions.php');
		}
		if ( file_exists(XOOPS_ROOT_PATH . '/modules/securityimage/class/permissions.php') ) {
			include_once(XOOPS_ROOT_PATH . '/modules/securityimage/class/permissions.php');
		}
		$hModule = &xoops_gethandler('module');
		$SecurityImageModule = $hModule->getByDirname('securityimage');
		if ( $SecurityImageModule ) {
			$this->ForMembers =  securityimage_checkperms();
			if ( securityimage_GetOptions('si_defaut') ) {
				$this->NumChars = securityimage_GetOptions('si_numchar');
				if ( securityimage_GetOptions('si_minfontsize') > securityimage_GetOptions('si_maxfontsize') ) {
					$this->MinFontSize = securityimage_GetOptions('si_maxfontsize');
					$this->MaxFontSize = securityimage_GetOptions('si_minfontsize');
				} else {
					$this->MinFontSize = securityimage_GetOptions('si_minfontsize');
					$this->MaxFontSize = securityimage_GetOptions('si_maxfontsize');
				}
				$this->NumBackground = intval( securityimage_GetOptions('si_numbackground') );
				$this->BackgroundType = intval( securityimage_GetOptions('si_background') );
				$this->SessionName = securityimage_GetOptions('si_sessionname');
				$this->SensitiveCase = securityimage_GetOptions('si_sensitivecase');
				$this->PolygonPoint = intval( securityimage_GetOptions('si_polygonpoint') );

				$this->FontsList = securityimage_GetOptions('si_TTFallowed');
				if ( !$this->FontsList[0] ) {
					$this->FontsList = $this->getFontsList();
				}

				$this->BackgroundList = securityimage_GetOptions('si_imageallowed');
				if ( !$this->BackgroundList[0] ) {
					$this->BackgroundList = $this->getBackgroundList();
				}
			}
		}

		if (extension_loaded('gd')) {
			global $xoopsUser;
			if ( !$this->ForMembers) {
				$this->setCaption( "" );
				$_SESSION['ForMembers'] = 0;
			} else {
				$this->setCaption( $Caption );
				$this->CurrentFont = $this->getRamdomFont();
				if ( $this->CurrentFont ) {
					$this->getMaxCharSize();
					$this->Height = $this->MaxCharHeight + 2;
					$this->Spacing = (int)( ($this->NumChars * $this->MaxCharWidth) / $this->NumChars);
					$this->Width = ($this->NumChars * $this->MaxCharWidth) + ($this->Spacing/2);

					$this->clearCache();
					$this->makeImageCode();
					$this->createImage();
					$this->setName( 'securityCode');

					$_SESSION[$this->SessionName] = $this->ImageCode;
					$_SESSION['securityHidden'] = $this->RandomCode;
				} else {
					$this->_error = 1;
				}
			}
		}
	}

	/**
	* Get the widest width character for current font
	*/
	function getMaxCharSize() {
		$this->MaxCharWidth = 0;
		$this->MaxCharHeight = 0;
		$this->oImage = imagecreatetruecolor(100, 100);
		$text_color = imagecolorallocate($this->oImage, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
		$FontSize = $this->MaxFontSize;
		for ($Angle=-30; $Angle<= 30; $Angle++) {
			for ($i=65; $i<=90; $i++) {
				$CharDetails = imageftbbox($FontSize, $Angle, $this->CurrentFont, chr($i), array());
				$MaxCharWidth  = abs($CharDetails[0] + $CharDetails[2]);
				if ($MaxCharWidth > $this->MaxCharWidth ) {
					$this->MaxCharWidth = $MaxCharWidth;
				}
				$MaxCharHeight  = abs($CharDetails[1] + $CharDetails[5]);
				if ($MaxCharHeight > $this->MaxCharHeight ) {
					$this->MaxCharHeight = $MaxCharHeight;
				}
			}
		}
		imagedestroy($this->oImage);
	}

	/**
	* return the font list
	*
	* @return array
	*/
	function getFontsList() {
		$MyFonts = array();
		foreach( $this->FontPath as $path) {
			if ( is_dir($path) ) {
				$handle = opendir( $path );
				while (false !== ($file = readdir($handle))) {
					if ( !preg_match("/^[\.]{1,2}$/",$file) && preg_match("/(\.ttf)$/i",$file) ) {
						$MyFonts[] = $file;
					}
				}
			}
		}
		if ( count($MyFonts) > 0 ) {
			return $MyFonts;
		}
	}

	/**
	* Return random background
	*
	* @return array
	*/
	function getRamdomFont() {
		if ( count( $this->FontsList) > 0 ) {
			$Randfont = $this->FontsList[array_rand($this->FontsList)];
			foreach( $this->FontPath as $path) {
				if ( file_exists( $path . '/' . $Randfont ) ) {
					$Randfont = $path . $Randfont;
				}
			}
			return $Randfont;
		}
	}


	/**
	* Return the background list
	*
	* @return array
	*/
	function getBackgroundList() {
		$MyBackground = array();
		foreach( $this->BackgroundPath as $path) {
			if ( is_dir($path) ) {
				$handle = opendir( $path );
				while (false !== ($file = readdir($handle))) {
					if ( !preg_match("/^[\.]{1,2}$/",$file) && preg_match("/(\.gif|\.jpg|\.png)$/i",$file) ) {
						$MyBackground[] = $file;
					}
				}
			}
		}
		if ( count($MyBackground) > 0 ) {
			return $MyBackground;
		}
	}

	/**
	* Return random background
	*
	* @return array
	*/
	function getRandomBackground() {
		$RandBackground = $this->BackgroundList[array_rand($this->BackgroundList)];
		foreach( $this->BackgroundPath as $path) {
			if ( file_exists( $path . '/' . $RandBackground ) ) {
				$RandBackground = $path . $RandBackground;
			}
		}
		return $RandBackground;
	}

	/**
	* Create Code
	*/
	function makeImageCode() {
		$this->ImageCode = substr(md5(uniqid(mt_rand(), 1)), 0, $this->NumChars );
		if ($this->SensitiveCase) {
			$this->ImageCode = strtoupper( $this->ImageCode );
		}
		$this->makeRandomCode( $this->ImageCode );
	}

	/**
	* Create image name
	*/
	function makeRandomCode( $ImageCode ) {
		$this->RandomCode = substr(md5($_SERVER['HTTP_USER_AGENT'] . $ImageCode . date("F j")), 0, $this->NumChars);
	}

	/**
	* return the image file path
	*
	* @return string
	*/
	function getImageFile( $method = "url" ) {
		if ($method == "root") {
			return $this->ImageFile_root;
		}
		return $this->ImageFile_url;
	}

	/**
	* Create the image
	*/
	function createImage() {
		$this->oImage = imagecreatetruecolor($this->Width, $this->Height);
		// Le fond de l'image est en blanc
		$background = imagecolorallocate($this->oImage, 255, 255, 255);
		imagefilledrectangle($this->oImage, 0, 0, $this->Width, $this->Height, $background);

		switch ($this->BackgroundType) {
			default:
			case 0:
			$this->drawBars();
			break;

			case 1:
			$this->drawCircles();
			break;

			case 2:
			$this->drawLines();
			break;

			case 3:
			$this->drawRectangles();
			break;

			case 4:
			$this->drawEllipses();
			break;

			case 5:
			$this->drawPolygons();
			break;

			case 100:
			$this->createFromFile();
			break;
		}
		$this->drawBorder();
		$this->drawCode();

		$this->ImageFile_root = $this->getImageFile( "root") . $this->RandomCode . ".jpg";
		$this->ImageFile_url = $this->getImageFile() . $this->RandomCode . ".jpg";
		imagejpeg ($this->oImage, $this->ImageFile_root ,80);
		imagedestroy($this->oImage);
	}

	/**
	* Draw Image background
	*/
	function createFromFile() {
		if ( count($this->BackgroundList) != 0) {
			$RandImage = $this->getRandomBackground();
			$ImageType = getimagesize($RandImage);
			switch ( $ImageType[2] ) {
				case 1:
				$BackgroundImage = imagecreatefromgif($RandImage);
				break;

				case 2:
				$BackgroundImage = imagecreatefromjpeg($RandImage);
				break;

				case 3:
				$BackgroundImage = imagecreatefrompng($RandImage);
				break;
			}

			imagecopyresized($this->oImage, $BackgroundImage, 0, 0, 0, 0, imagesx($this->oImage), imagesy($this->oImage), imagesx($BackgroundImage), imagesy($BackgroundImage));
			imagedestroy($BackgroundImage);
		} else {
			$this->drawBars();
		}
	}

	/**
	* Draw Code
	*/
	function drawCode() {
		for ($i = 0; $i < $this->NumChars ; $i++) {
			// select random greyscale colour
			$text_color = imagecolorallocate($this->oImage, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));

			// write text to image
			$Angle = mt_rand(10, 30);
			if ( ($i % 2)) {
				$Angle = mt_rand(-10, -30);
			}

			// select random font size
			$FontSize = mt_rand($this->MinFontSize, $this->MaxFontSize);

			$CharDetails = imageftbbox($FontSize, $Angle, $this->CurrentFont, $this->ImageCode[$i], array());
			$CharHeight = abs( $CharDetails[1] + $CharDetails[5] );

			// calculate character starting coordinates
			$posX = ($this->Spacing/2) + ($i * $this->Spacing);
			$posY = 2 + ($this->Height / 2) + ($CharHeight / 4);

			imagefttext($this->oImage, $FontSize, $Angle, $posX, $posY, $text_color, $this->CurrentFont, $this->ImageCode[$i], array());
		}
	}

	/**
	* Draw Border
	*/
	function drawBorder() {
		$text_color = imagecolorallocate ($this->oImage, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
		imagerectangle($this->oImage, 0, 0, $this->Width-1, $this->Height-1, $text_color);
	}

	/**
	* Draw Circles background
	*/
	function drawCircles() {
		for ($i=1;$i<=$this->NumBackground;$i++) {
			$randomcolor = imagecolorallocate ($this->oImage , mt_rand(190,255), mt_rand(190,255), mt_rand(190,255));
			imagefilledellipse($this->oImage, mt_rand(0,$this->Width-10), mt_rand(0,$this->Height-3), mt_rand(10,20), mt_rand(20,30),$randomcolor);
		}
	}

	/**
	* Draw Lines background
	*/
	function drawLines() {
		for ($i = 0; $i < $this->NumBackground; $i++) {
			$randomcolor = imagecolorallocate($this->oImage, mt_rand(190,255), mt_rand(190,255), mt_rand(190,255));
			imageline($this->oImage, mt_rand(0, $this->Width), mt_rand(0, $this->Height), mt_rand(0, $this->Width), mt_rand(0, $this->Height), $randomcolor);
		}
	}

	/**
	* Draw Rectangles background
	*/
	function drawRectangles() {
		for ($i=1;$i<=$this->NumBackground;$i++) {
			$randomcolor = imagecolorallocate ($this->oImage , mt_rand(190,255), mt_rand(190,255), mt_rand(190,255));
			imagefilledrectangle($this->oImage, mt_rand(0,$this->Width), mt_rand(0,$this->Height), mt_rand(0, $this->Width), mt_rand(0,$this->Height),  $randomcolor);
		}
	}

	/**
	* Draw Bars background
	*/
	function drawBars() {
		for ($i=0;$i<=$this->Height;) {
			$randomcolor = imagecolorallocate ($this->oImage , mt_rand(190,255), mt_rand(190,255), mt_rand(190,255));
			imageline( $this->oImage, 0, $i, $this->Width, $i, $randomcolor );
			$i = $i + 2.5;
		}
		for ($i=0;$i<=$this->Width;) {
			$randomcolor = imagecolorallocate ($this->oImage , mt_rand(190,255), mt_rand(190,255), mt_rand(190,255));
			imageline( $this->oImage, $i, 0, $i, $this->Height, $randomcolor );
			$i = $i + 2.5;
		}
	}

	/**
	* Draw Ellipses background
	*/
	function drawEllipses() {
		for($i=1;$i<=$this->NumBackground;$i++){
			$randomcolor = imagecolorallocate ($this->oImage , mt_rand(190,255), mt_rand(190,255), mt_rand(190,255));
			imageellipse($this->oImage, mt_rand(0,$this->Width), mt_rand(0,$this->Height), mt_rand(0,$this->Width), mt_rand(0,$this->Height), $randomcolor);
		}
	}

	/**
	* Draw polygons background
	*/
	function drawPolygons() {
		for($i=1;$i<=$this->NumBackground;$i++){
			$randomcolor = imagecolorallocate ($this->oImage , mt_rand(190,255), mt_rand(190,255), mt_rand(190,255));
			$coords = array();
			for ($j=1; $j <= $this->PolygonPoint; $j++) {
				$coords[] = mt_rand(0,$this->Width);
				$coords[] = mt_rand(0,$this->Height);
			}
			imagefilledpolygon($this->oImage, $coords, $this->PolygonPoint, $randomcolor);
		}
	}

	/**
	* Clear cache
	*/
	function clearCache() {
		$files = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . "/uploads/securityimage/cache" );
		$time = time() - (5 * 60);   // Moins de 5minutes
		foreach ($files as $dele_file) {
			if ( filemtime( XOOPS_ROOT_PATH . "/uploads/securityimage/cache/" . $dele_file) < $time ) {
				unlink( XOOPS_ROOT_PATH . "/uploads/securityimage/cache/" . $dele_file );
			}
		}
	}

	/**
	* Check code result
	*
	* @return boolean
	* @access public
	*/
	function checkSecurityImage() {
		$SessionName = $_SESSION['SessionName'];
		$SensitiveCase = $_SESSION['SensitiveCase'];
		$ForMembers = $_SESSION['ForMembers'];
		if ( file_exists(XOOPS_ROOT_PATH . '/modules/securityimage/include/functions.php') ) {
			include_once(XOOPS_ROOT_PATH . '/modules/securityimage/include/functions.php');
		}

		$hModule = &xoops_gethandler('module');
		$SecurityImageModule = $hModule->getByDirname('si_defaut');
		if ( $SecurityImageModule && securityimage_GetOptions('si_defaut')) {
			$ForMembers =  securityimage_GetOptions('si_members');
			$SessionName = securityimage_GetOptions('si_sessionname');
			$SensitiveCase = securityimage_GetOptions('si_sensitivecase');
		}

		global $xoopsUser;
		if ( !$ForMembers) {
			return true;
		}

		$ImageFile_root = XOOPS_ROOT_PATH . "/uploads/securityimage/cache/" . $_SESSION['securityHidden'] . ".jpg";
		unlink( $ImageFile_root );

		$UserCode = $_POST['securityCode'];
		if ($SensitiveCase) {
			$UserCode = strtoupper( $_POST['securityCode'] );
		}

		if ( $UserCode == $_SESSION[$SessionName] ) {
			$_SESSION[$SessionName] = '';
			return true;
		}
		return false;
	}

	function render(){
		$_SESSION['SessionName'] = $this->SessionName;
		$_SESSION['SensitiveCase'] = $this->SensitiveCase;
		if ( !extension_loaded('gd') ) {
			return _SECURITYIMAGE_GDERROR;
		}
		if ( $this->_error ) {
			$_SESSION['ForMembers'] = 0;
			return _SECURITYIMAGE_FONTERROR;
		};
		if ( !$this->ForMembers ) {
			$_SESSION['ForMembers'] = 0;
			$this->setCaption( "" );
			return "";
		}

		$_SESSION['ForMembers'] = 1;
		return "<img src='" . $this->getImageFile()  . "' align='absmiddle'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='securityCode' id='securityCode' size='" . $this->NumChars . "' maxlength='" . $this->NumChars . "' value='' />";
	}
}
?>