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
| Theme: arrows
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
	background: #fff;
	margin: 0;
	padding: 0;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	background: url(bg_lv1.png) repeat-x;
	font-size: medium;
	text-indent: 0;
	padding: 0 0 12px 0px;
	margin: 2px 0; /*12px 0*/
	list-style-type: none;
	/*border-bottom: solid 1px #8b8b8b;*/
}

<?php echo $hcp_menu; ?> li.page-item a {
	background: url(ico_lv1.png) no-repeat left center;
	text-decoration: none;
	display: inline-block;
	padding-left: 25px;
	margin-left: 10px;
	line-height: 33px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	background: url(line_dotted_glay.png) repeat-x left bottom;
	font-size: small;
	margin: 0;
	padding: 1px 0 0 7px;
	border: none;
}


<?php echo $hcp_menu; ?> li.page-item li.page-item a {
	background: url(ico_lower_lv.png) no-repeat left center;
	padding-left: 45px;
	line-height: 33px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	background: url(line_dotted_glay.png) repeat-x left top;
	padding: 1px 0 0 25px;
}

<?php echo $hcp_menu; ?> ul {
	padding: 0;
	margin: 0;
}