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
| Theme: under_score
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
	background: url(line_solid_d_gray.png) repeat-x 0 1.7em;
 	list-style-type: none;
	margin-bottom: 15px;
	padding-left: 20px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item {
	font-size: small;
	font-weight: normal;
	line-height: 1.5;
	background: url(icon_list_level2.png) no-repeat 0 1.1em;
	margin-bottom: 0;
	padding-left: 18px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	background: url(icon_list_level3.png) no-repeat 0 1.1em;
	padding-left: 16px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item {
	background: url(icon_list_level4.png) no-repeat 0 1.1em;
	padding-left: 14px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item {
	background: url(icon_list_level5.png) no-repeat 0 1.1em;
	padding-left: 12px;
}
<?php echo $hcp_menu; ?> ul {
	margin-top: 3px;
	margin-bottom: 10px;
}