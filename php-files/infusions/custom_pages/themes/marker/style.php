<?php header("Content-Type: text/css"); ?>
@charset "utf-8";
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
| Filename: style.php
| Theme: marker
| Author: Valerio Vendrame (lelebart)
| Original theme from "PS Auto Sitemap", WordPress Plugin
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
<?php $hcp_menu = isset($_GET['id']) ? "#".$_GET['id'] : ".hcp_menu"; ?>

<?php echo $hcp_menu; ?> li {
	visibility: hidden;
	list-style-type: none;
	margin: 0;
	padding: 0;
}

<?php echo $hcp_menu; ?> {
	padding: 0;
	margin: 0;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	background: url(line_pencil.png) repeat-x left bottom;
	font-size: medium;
	text-indent: 0;
	padding: 0 0 10px 0;
	margin: 10px 0 0 0;
	list-style-type: none;
	line-height: 1.5;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	background: none;
	font-size: small;
	margin: 5px 0 0 0;
	padding: 5px 0 0 0;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	font-size: 95%;
	margin: 0;
	padding: 1px 0 1px 1em;
}

<?php echo $hcp_menu; ?> li.page-item a {
	background: url(bg_marker_pink.png) repeat-x left center;
	padding: 1px 7px 0 10px;
	text-decoration: none;
	display: inline-block;
	min-height: 17px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item a {
	background: url(bg_marker_green.png) repeat-x left center;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item a {
	background: url(bg_marker_green_thin.png) repeat-x left center;
	text-decoration: none;
	min-height: 19px;
}

<?php echo $hcp_menu; ?> ul {
	padding: 0;
	margin: 0;
}

<?php echo $hcp_menu; ?> ul ul {
	padding: 0;
	margin: 0;
}