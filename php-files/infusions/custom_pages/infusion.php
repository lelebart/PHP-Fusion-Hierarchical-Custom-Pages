<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2010 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Type: Infusion
| Name: Hierarchical Custom Pages
| Version: 1.00
| Author: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| Filename: infusion.php
| Author: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION") || !checkrights("I")) { die("Access Denied"); }

include_once INFUSIONS."custom_pages/minicore.php";
include_once CP_HIER_DIR."infusion_db.php";

// Infusion general information
$inf_title = $locale['hcp_title'];
$inf_description = $locale['hcp_desc'];
$inf_version = CP_HIER_VER;
$inf_developer = "Valerio Vendame (lelebart)";
$inf_email = "phpfusion@valeriovendrame.it";
$inf_weburl = "http://www.valeriovendrame.it";

$inf_folder = "custom_pages"; 
$panel_folder = file_exists(INFUSIONS."custom_pages_panel/custom_pages_panel.php") ? "custom_pages_panel" : false; 

$inf_newtable[1] = DB_CP_HIER." (
	page_h_id MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
	page_order MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '1',
	page_parent MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0'
) TYPE=MyISAM;";

if ($panel_folder) {
	$inf_insertdbrow[1] = DB_PANELS." (panel_name, panel_filename, panel_side, panel_type, panel_status) VALUES ('".$locale['hcp_side']."', '".$panel_folder."', '1', 'file', '1')";
	$inf_deldbrow[1] = DB_PANELS." WHERE panel_filename='".$panel_folder."' LIMIT 1";
}

$woah = dbquery("SELECT * FROM ".DB_CUSTOM_PAGES);
if (dbrows($woah)!=0) {
	$y = $panel_folder ? 2 : 1; 
	while ($jah = dbarray($woah)) {
		$inf_insertdbrow[$y] = DB_CP_HIER." (page_h_id, page_order, page_parent) VALUES ('".$jah['page_id']."', '".$y."', '0')";
		$y++;
	}
}

$inf_droptable[1] = DB_CP_HIER;

$inf_adminpanel[1] = array(
	"title" => $locale['hcp_admin'],
	"image" => "c-pages.gif",
	"panel" => "admin.php",
	"rights" => "HCP"
);

$inf_sitelink[1] = array(
	"title" => $locale['hcp_table'],
	"url" => '',
	"visibility" => "0"
);
/*
debug_view($woah);
debug_view($inf_newtable);
debug_view($inf_insertdbrow);
*/
?>