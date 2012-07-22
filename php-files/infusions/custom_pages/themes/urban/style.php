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
| Theme: urban
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

<?php echo $hcp_menu; ?>, <?php echo $hcp_menu; ?> ul, <?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	margin: 0;
	padding: 0;
}
<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	font-size: 108%;
	font-weight: bold;
	line-height: 1.8;
	background: url(bg_level1.png);
 	list-style-type: none;
	margin-bottom: 15px;
	padding: 8px 0 8px 20px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item {
	font-size: small;
	font-weight: normal;
	background: url(icon_large.png) no-repeat 0 0.5em;
	line-height: 1.5;
	margin-bottom: 0;
	padding: 0 0 0 18px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	padding-left: 16px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item {
	font-size: 0.85em;
	background: url(icon_small.png) no-repeat 0 0.45em;
	padding-left: 14px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item {
	font-size: 1em;
	padding-left: 12px;
}
<?php echo $hcp_menu; ?> ul {
	margin-top: 3px;
	margin-bottom: 5px;
}