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
| Theme: music
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
	padding: 5px 20px;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	background: url(bg_li.png) repeat-x;
	font-size: medium;
	text-indent: 0;
	padding: 0 0 0 0px;
	margin: 24px 0 12px 0;
	line-height: 21px;
	list-style-type: none;
	min-height: 21px;
}

<?php echo $hcp_menu; ?> li.page-item a {
	color: #666;
	background: url(ico_semibreve.png) no-repeat left center;
	text-decoration: none;
	display: inline-block;
	padding-left: 25px;
	margin-left: 5px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	margin: 12px 0 12px 0;
	font-size: small;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item a {
	background: url(ico_minim.png) no-repeat left top;
	margin-left: 20px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item a {
	background: url(ico_crotchet.png) no-repeat left bottom;
	margin-left: 40px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item a {
	background: url(ico_quaver.png) no-repeat left top;
	margin-left: 60px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(ico_demiquaver.png) no-repeat left center;
	margin-left: 80px;
}


<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(ico_demisemiquaver.png) no-repeat left top;
	margin-left: 100px;
	line-height: 24px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(ico_turned_minim.png) no-repeat left bottom;
	margin-left: 120px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(ico_turned_crotchet.png) no-repeat left top;
	margin-left: 140px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(ico_turned_quaver.png) no-repeat left top;
	margin-left: 160px;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item li.page-item a {
	background: url(ico_turned_demiquaver.png) no-repeat left bottom;
	margin-left: 180px;
}

<?php echo $hcp_menu; ?> ul {
	padding: 0;
	margin: 0;
}