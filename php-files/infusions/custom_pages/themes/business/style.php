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
| Theme: business
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
	background: url(line_dotted_brown.png) repeat-x 0 1.8em;
	font-size: medium;
	text-indent: 0;
	padding: 0 0 12px 0px;
	margin: 12px 0;
	list-style-type: none;
}

<?php echo $hcp_menu; ?> li.page-item a {
	color: #666;
	background: url(ico_lv1.png) no-repeat left center;
	text-decoration: none;
	display: inline-block;
	padding-left: 25px;
	line-height: 32px;
	}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	font-size: small;
	background: none;
	margin: 7px 0 0 0;
	padding: 1px 0 0 27px;
}


<?php echo $hcp_menu; ?> li.page-item li.page-item a {
	background: url(ico_lv2.png) no-repeat left center;
	padding-left: 15px;
	line-height: normal;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	padding-left: 15px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item a {
	background: url(ico_lower_lv.png) no-repeat left center;
}

<?php echo $hcp_menu; ?> ul {
	padding: 0;
	margin: 0;
}