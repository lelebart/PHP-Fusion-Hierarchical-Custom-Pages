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
| Theme: simple
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

<?php echo $hcp_menu; ?>  {
	margin: 0;
	padding: 0;
}

<?php echo $hcp_menu; ?> a {
	text-decoration: none;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	font-size: medium;
	text-indent: 0;
	background: url(line_horizontal_solid.gif) repeat-x 0 1.5em;
	padding: 0 0 5px 5px;
	margin: 0;
	list-style-type: none;
	line-height: 1.5;
}

<?php echo $hcp_menu; ?> li.page-item ul {
	margin: 0;
	padding: 5px 0 0 0;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	font-size: small;
	font-weight: normal;
	background: url(ico_list_square.gif) no-repeat 0 0.5em;
	margin: 0 0 3px 15px;
	padding: 0 0 0 15px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	background: url(ico_gray_arrow.png) no-repeat 0 0.5em;
}

<?php echo $hcp_menu; ?> ul {
	padding: 0;
	margin: 0;
}