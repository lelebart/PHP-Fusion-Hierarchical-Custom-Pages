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
| Filename: custom_pages_panel.php
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
include_once INFUSIONS."custom_pages/minicore.php";
include_once CP_HIER_DIR."infusion_db.php";

$show_tree = true; //sorry, admin panel in future release
$tree_visibility = false; //sorry, admin panel in future release

$result = @mysql_query("SELECT * FROM ".DB_CP_HIER);
if ($result && isset($_GET['page_id']) && isnum($_GET['page_id'])) {
	if ($show_tree) {
		set_style('hcp_main_tree','simple');
		openside($locale['hcp_tree']);
		build_ul('hcp_main_tree', true, $tree_visibility);
		closeside();	
	}
	if ($tree_visibility) {
		$parent = get_parent_array($_GET['page_id']);
		if (is_array($parent)) {
			$cannot_watch = false;
			foreach ($parent as $parent_id) {
				$check = dbarray(dbquery("SELECT page_access FROM ".DB_CUSTOM_PAGES." WHERE page_id='".$parent_id."'"));
				//debug_view($check);	debug_view(checkgroup($check));
				if (!checkgroup($check['page_access'])) { $cannot_watch = true; break; }
			}
			if ($cannot_watch) { redirect($settings['opening_page']); }
		} 
	}
	if (has_child($_GET['page_id'], true)) {
		//$how_many = count(get_child_array($_GET['page_id'], true)); //." (".$how_many.")"
		set_style('hcp_subpages');
		openside($locale['hcp_side']);
		//echo "<div class='hcp_menu'>\n";
		echo "<div id='hcp_subpages'>\n";
		get_child($_GET['page_id'], true, $tree_visibility);
		echo "</div>\n";
		closeside();
	}
}
?>