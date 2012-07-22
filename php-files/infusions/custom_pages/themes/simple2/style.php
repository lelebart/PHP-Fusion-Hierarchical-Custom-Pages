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
| Theme: simple2
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

<?php echo $hcp_menu; ?>, <?php echo $hcp_menu; ?> ul {
	margin: 0;
	padding: 0;
}

<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	padding: 0;
	margin: 0.3em 0;
	list-style-type: none;
}

<?php echo $hcp_menu; ?> li.page-item ul {
	margin: 0.5em 0 0 0;
	padding: 0;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item {
	background: url(ico_level_2.png) no-repeat 0 0.5em;
	margin: 0.7em 0;
	padding: 0 0 0 25px;
}

<?php echo $hcp_menu; ?> li.page-item a {
	background-color: #faf8f2;
	text-indent: 0;
	display: block;
	padding: 3px 5px 2px;
	border: solid 1px #cacaca;
}

<?php echo $hcp_menu; ?> li.page-item li.page-item a {
	background: none;
	display: inline;
	padding: 0;
	border: none;
}