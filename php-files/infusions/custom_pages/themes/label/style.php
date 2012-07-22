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
| Theme: label
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
	margin: 0;
	padding: 0;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	background: url(lv1_head.png) no-repeat;
	font-size: medium;
	text-indent: 0;
	padding: 0 0 0 18px;
	margin: 0 0 15px 0;
	line-height: 1.5;
	list-style-type: none;
}

<?php echo $hcp_menu; ?> li.page-item a {
	color: #666;
	background: url(lv1_body.png) no-repeat right top;
	padding: 8px 50px 5px 20px;
	min-height: 28px;
	text-decoration: none;
	display: inline-block;
}

<?php echo $hcp_menu; ?> li.page-item a:visited {
	color: #999;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	background: url(lv2_head.png) no-repeat;
	font-size: small;
	margin: 0 0 0 0;
	min-height: 39px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item a {
	background: url(lv2_body.png) no-repeat right top;
	min-height: 25px;
	padding: 9px 70px 5px 10px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item {
	background: url(lv3_head.png) no-repeat;
	font-size: 98%;
	margin: 0 0 0 0px;
	min-height: 39px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item a {
	background: url(lv3_body.png) no-repeat right top;
	min-height: 23px;
	padding: 9px 50px 5px 18px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item {
	background: url(lv4_head.png) no-repeat;
	margin: 0 0 0 0px;
	min-height: 37px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item a {
	background: url(lv4_body.png) no-repeat right top;
	min-height: 23px;
	padding: 8px 35px 5px 15px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item {
	background: url(lv5_head.png) no-repeat;
	margin: 0 0 0 0px;
	min-height: 35px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(lv5_body.png) no-repeat right top;
	min-height: 22px;
	padding: 7px 35px 5px 12px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item {
	background: url(lv6_head.png) no-repeat;
	margin: 0 0 0 0px;
	min-height: 33px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(lv6_body.png) no-repeat right top;
	min-height: 20px;
	padding: 6px 35px 5px 10px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item {
	background: url(lv7_head.png) no-repeat;
	margin: 0 0 0 0px;
	min-height: 31px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(lv7_body.png) no-repeat right top;
	min-height: 20px;
	padding: 5px 35px 5px 10px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item {
	background: url(lv8_head.png) no-repeat;
	margin: 0 0 0 0px;
	min-height: 29px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(lv8_body.png) no-repeat right top;
	min-height: 17px;
	padding: 5px 30px 5px 10px;
}
<?php echo $hcp_menu; ?> ul {
	padding: 0;
	margin: 0;
}