<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2011-11-14
// $Id:$
// ------------------------------------------------------------------------- //
$adminmenu = array();
$icon_dir=substr(XOOPS_VERSION,6,3)=='2.6'?"":"images/";

$i = 1;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_HOME ;
$adminmenu[$i]['link'] = 'admin/index.php' ;
$adminmenu[$i]['desc'] = _MI_TAD_ADMIN_HOME_DESC ;
$adminmenu[$i]['icon'] = 'images/admin/home.png' ;

$i++;
$adminmenu[$i]['title'] = _MI_TADLINK_ADMENU2;
$adminmenu[$i]['link'] = "admin/main.php";
$adminmenu[$i]['desc'] = _MI_TADLINK_ADMENU2 ;
$adminmenu[$i]['icon'] = "images/admin/category.png";

$i++;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['desc'] = _MI_TAD_ADMIN_ABOUT_DESC;
$adminmenu[$i]['icon'] = 'images/admin/about.png';
?>