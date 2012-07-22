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
| Filename: index.php
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
require_once "../../maincore.php";

include_once INFUSIONS."custom_pages/minicore.php";
include_once CP_HIER_DIR."infusion_db.php";

$result = @mysql_query("SELECT * FROM ".DB_CP_HIER);
if ($result) {
	require_once THEMES."templates/header.php";
	add_to_head("<!-- ".CP_HIER_TIT." by http://www.valeriovendrame.it -->");
	opentable($locale['hcp_table']);
	if (dbrows($result)!=0) {
		set_style('hcp_structure', 'arrows');
		build_ul('hcp_structure', true);
	} else {
		echo $locale['hcp_err'];
	}
	closetable();
	require_once THEMES."templates/footer.php";
} else {
	redirect($settings['opening_page']);
}
?>