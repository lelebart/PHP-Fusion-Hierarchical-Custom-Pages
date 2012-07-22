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
| Filename: English.php
| Author: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| Language: English (GB, US)
| Author / Transaltor: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
// InFusion
$locale['hcp_admin'] = "Custom Pages Administration";
$locale['hcp_title'] = "Hierarchical Custom Pages";
$locale['hcp_desc']  = "A way to organize custom pages hierarchically";

// Titles
$locale['hcp_table'] = "Custom Pages Structure";
$locale['hcp_tree']  = "Pages Structure";
$locale['hcp_side']  = "Subpages";
$locale['hcp_err']   = "Sorry, no page has been created.";

// admin.php
$locale['hcp_000'] = "When <strong>this panel <tt>custom_pages_panel</tt> is enabled</strong>, the limited access of the <em>parent page</em> is valid also for all its <em>subpages</em>.<br /><br /> 
E.g., in a structure like the following:\n<pre><tt>page 1 (Guest)\n- page 1.1 (Member)\n- - page 1.1.1 (Guest)\n- - - page 1.1.1.1 (Guest)\n</tt></pre>
the <em>Guest</em> user won't be allowed to read <tt>page 1.1.1</tt> and <tt>page 1.1.1.1</tt> beside <tt>page 1.1</tt>.";
$locale['hcp_001'] = "Panel status:";
$locale['hcp_002'] = "ACTIVE";
$locale['hcp_003'] = "NOT ACTIVE";
$locale['hcp_004'] = "NOT INSTALLED";
$locale['hcp_005'] = "[close/open]";

$locale['hcp_100'] = "What's TinyMCE?";
$locale['hcp_101'] = "TninyMCE is a platform-independent web-based WYSIWYG editor control, released as open source software. It has the ability to convert HTML textarea fields or other HTML elements to editor instances.<br /> 
To insert PHP codes or to modify the (X)HTML source, disable TinyMCE.";

$locale['hcp_200'] = "Page Title";
$locale['hcp_201'] = "Visibility";
$locale['hcp_202'] = "Order";
$locale['hcp_203'] = "Options";
$locale['hcp_204'] = "Edit";
$locale['hcp_205'] = "Delete";
$locale['hcp_206'] = "Show";
$locale['hcp_207'] = "No Custom Page has been created yet.<br />\n<a href='".CP_HIER_DIR."custom_pages.php%s'>Click here</a> to create a new one.";

$locale['hcp_300'] = "Do you really want to delete this page?";
$locale['hcp_301'] = "Do you really want to delete these pages?";
$locale['hcp_302'] = "Page deleted";
$locale['hcp_303'] = "Pages deleted";
$locale['hcp_304'] = "Some pages haven't be deleted as they had one or more subpages"; 
$locale['hcp_305'] = "This page cannot be deleted as it has one or more subpages"; 
$locale['hcp_306'] = "Order updated";
$locale['hcp_307'] = "Delete more pages at once";
$locale['hcp_308'] = "Do you want to leave administration area to view this page?";

// custom_pages.php
$locale['hcp_400'] = $locale['hcp_202'].":";
$locale['hcp_401'] = "Page Parent:";
$locale['hcp_402'] = "-- no parent --";
?>