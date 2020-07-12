<?php
/**
* Module: SecurityImage
* Version1.0
* Author: DuGris aka L. Jen <http://www.dugris.info>
* Licence: GPL see LICENSE
*/
define("_MI_SIMAGE_NAME","SecurityImage");
define("_MI_SIMAGE_DESC","Gestion de la class SecurityImage");

// Admin Menu
define("_MI_SIMAGE_ADMENU0", "Pr�f�rence");
define("_MI_SIMAGE_ADMENU1", "Accueil");
define("_MI_SIMAGE_ADMENU2", "Images de fond");
define("_MI_SIMAGE_ADMENU3", "Police de caract�re TTF");
define("_MI_SIMAGE_ADMENU4", "Permissions");
// block

// Options pr�f�rences
define("_MI_SIMAGE_DEFAUT", "Utilisation des param�tres personnalis�s");
define("_MI_SIMAGE_DEFAUT_DSC", "Oui = Param�tres que vous aurez s�lectionn�s ci-dessous<br>Non = Param�tres d�finis par le module");

define("_MI_SIMAGE_MEMBERS", "Utilisation du code de s�curit� pour les utilisateurs enregistr�s");

define("_MI_SIMAGE_SESSION_NAME","Nom de la session");

define("_MI_SIMAGE_NUMCHAR" , "Nombre de caract�res pour la g�n�ration du code");
define("_MI_SIMAGE_MINFONTSIZE" , "Hauteur minimum des caract�res");
define("_MI_SIMAGE_MAXFONTSIZE" , "Hauteur maximum des caract�res");
define("_MI_SIMAGE_SENSITIVECASE","D�sactiver la v�rification de la case");
define("_MI_SIMAGE_BACKGROUND" , "S�lectionner le type de fond");
define("_MI_SIMAGE_NUMBACKGROUND" , "Nombre d'objet pour la g�n�ration du fond");
define("_MI_SIMAGE_NUMBACKGROUND_DSC" , "<font color='#CC0000'><b>Uniquement si le fond choisi est : </b></font><br />Cercles, Lignes, Rectangles, Polygones.");

define("_MI_SIMAGE_POLYGONPOINT", "Nombre de points pour les polygones");
define("_MI_SIMAGE_IMAGES_SELECT" , "S�lectionner les images � utiliser");
define("_MI_SIMAGE_IMAGES_SELECT_DSC" , "<font color='#CC0000'><b>Uniquement si le fond est image</b></font>,<br>si vous choisissez plusieurs images, ou si vous n'en choisissez aucune, l'image de fond sera choisi de fa�on al�atoire");

define("_MI_SIMAGE_FONT_TYPE", "Type de fontes � utiliser");
define("_MI_SIMAGE_FONTS_TTF" , "S�lectionner les fontes <font color='#CC0000'>TTF</font> � utiliser");
define("_MI_SIMAGE_FONTS_SELECT_DSC" , "Si vous choisissez plusieurs fontes, l'affichage du code s'effectuera avec les fontes s�lectionn�es de fa�on al�atoire");

define("_MI_SIMAGE_CIRCLE"    , "Cercles");
define("_MI_SIMAGE_LINE"      , "Lignes");
define("_MI_SIMAGE_RECTANGLE" , "Rectangles");
define("_MI_SIMAGE_BARS"      , "Grille");
define("_MI_SIMAGE_ELLIPSE"   , "Ellipses");
define("_MI_SIMAGE_POLYGON"   , "Polygones");
define("_MI_SIMAGE_IMAGE"     , "Images");

define("_MI_SIMAGE_IMG_MAX_FILESIZE", "<font color='#CC0000'>Images</font> : Taille maximale des fichiers upload�es (en octets)");
define("_MI_SIMAGE_IMG_MAX_WIDTH", "<font color='#CC0000'>Images</font> : Largeur maximale des images upload�es");
define("_MI_SIMAGE_IMG_MAX_HEIGHT", "<font color='#CC0000'>Images</font> : Hauteur maximale des images upload�es");

define("_MI_SIMAGE_FONT_MAX_FILESIZE", "<font color='#CC0000'>Fontes</font> : Taille maximale des fichiers upload�es (en octets)");
?>