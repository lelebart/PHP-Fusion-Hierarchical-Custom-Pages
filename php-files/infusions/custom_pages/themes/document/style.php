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
| Theme: document
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
	background: url(bg_vertical_line.png) 6px;
	padding: 0;
	margin: 0;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	font-size: medium;
	text-indent: 0;
	padding: 0;
	margin: 0 0 20px;
	list-style-type: none;
	line-height: 1.5;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	background: none;
	font-size: small;
	margin: 0 0 0 0;
	padding: 0 0 0 30px;
	border-left: none;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	font-size: 95%;
	margin: 0;
}

<?php echo $hcp_menu; ?> li.page-item a {
	background: url(ico_post.png) no-repeat left center;
	padding: 5px 7px 5px 18px;
	text-decoration: none;
}

<?php echo $hcp_menu; ?> ul {
	background: url(ico_folder.png) no-repeat 0 0.7em;
	padding: 0;
	margin: 0;
}