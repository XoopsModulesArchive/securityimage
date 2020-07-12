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
define("_MI_SIMAGE_ADMENU0", "Préférence");
define("_MI_SIMAGE_ADMENU1", "Accueil");
define("_MI_SIMAGE_ADMENU2", "Images de fond");
define("_MI_SIMAGE_ADMENU3", "Police de caractère TTF");
define("_MI_SIMAGE_ADMENU4", "Permissions");
// block

// Options préférences
define("_MI_SIMAGE_DEFAUT", "Utilisation des paramètres personnalisés");
define("_MI_SIMAGE_DEFAUT_DSC", "Oui = Paramètres que vous aurez sélectionnés ci-dessous<br>Non = Paramètres définis par le module");

define("_MI_SIMAGE_MEMBERS", "Utilisation du code de sécurité pour les utilisateurs enregistrés");

define("_MI_SIMAGE_SESSION_NAME","Nom de la session");

define("_MI_SIMAGE_NUMCHAR" , "Nombre de caractères pour la génération du code");
define("_MI_SIMAGE_MINFONTSIZE" , "Hauteur minimum des caractères");
define("_MI_SIMAGE_MAXFONTSIZE" , "Hauteur maximum des caractères");
define("_MI_SIMAGE_SENSITIVECASE","Désactiver la vérification de la case");
define("_MI_SIMAGE_BACKGROUND" , "Sélectionner le type de fond");
define("_MI_SIMAGE_NUMBACKGROUND" , "Nombre d'objet pour la génération du fond");
define("_MI_SIMAGE_NUMBACKGROUND_DSC" , "<font color='#CC0000'><b>Uniquement si le fond choisi est : </b></font><br />Cercles, Lignes, Rectangles, Polygones.");

define("_MI_SIMAGE_POLYGONPOINT", "Nombre de points pour les polygones");
define("_MI_SIMAGE_IMAGES_SELECT" , "Sélectionner les images à utiliser");
define("_MI_SIMAGE_IMAGES_SELECT_DSC" , "<font color='#CC0000'><b>Uniquement si le fond est image</b></font>,<br>si vous choisissez plusieurs images, ou si vous n'en choisissez aucune, l'image de fond sera choisi de façon aléatoire");

define("_MI_SIMAGE_FONT_TYPE", "Type de fontes à utiliser");
define("_MI_SIMAGE_FONTS_TTF" , "Sélectionner les fontes <font color='#CC0000'>TTF</font> à utiliser");
define("_MI_SIMAGE_FONTS_SELECT_DSC" , "Si vous choisissez plusieurs fontes, l'affichage du code s'effectuera avec les fontes sélectionnées de façon aléatoire");

define("_MI_SIMAGE_CIRCLE"    , "Cercles");
define("_MI_SIMAGE_LINE"      , "Lignes");
define("_MI_SIMAGE_RECTANGLE" , "Rectangles");
define("_MI_SIMAGE_BARS"      , "Grille");
define("_MI_SIMAGE_ELLIPSE"   , "Ellipses");
define("_MI_SIMAGE_POLYGON"   , "Polygones");
define("_MI_SIMAGE_IMAGE"     , "Images");

define("_MI_SIMAGE_IMG_MAX_FILESIZE", "<font color='#CC0000'>Images</font> : Taille maximale des fichiers uploadées (en octets)");
define("_MI_SIMAGE_IMG_MAX_WIDTH", "<font color='#CC0000'>Images</font> : Largeur maximale des images uploadées");
define("_MI_SIMAGE_IMG_MAX_HEIGHT", "<font color='#CC0000'>Images</font> : Hauteur maximale des images uploadées");

define("_MI_SIMAGE_FONT_MAX_FILESIZE", "<font color='#CC0000'>Fontes</font> : Taille maximale des fichiers uploadées (en octets)");
?>