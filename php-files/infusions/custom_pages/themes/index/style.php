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
| Theme: index
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
	padding: 5px 10px;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	font-size: medium;
	text-indent: 0;
	padding: 0 0 12px 0px;
	margin: 10px 25px 0 0;
	list-style-type: none;
}

<?php echo $hcp_menu; ?> li.page-item a {
	color: #333;
	font-weight: bold;
	background: #f8f8f8;
	padding: 0 25px;
	line-height: 32px;
	display: block;
	border: solid 1px #333;
	margin-bottom: 15px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	background: url(line_dotted_glay.png) repeat-x left 0.5em;
	font-size: small;
	margin: 7px 30px 0 0;
	padding: 1px 0 0 0;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item a {
	background: #fff;
	font-weight: normal;
	padding: 0 25px;
	line-height: normal;
	display: inline-block;
	border: none;
	margin: 0;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	margin: 7px 0 0 30px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item {
	font-style: italic; 
	margin-left: 30px;
}

<?php echo $hcp_menu; ?> ul {
	padding: 0;
	margin: 0;
}