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
| Theme: default
| Author: Valerio Vendrame (lelebart)
| Original theme from "Fusion", WordPress Theme
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

<?php echo $hcp_menu; ?> ul {
	margin: 0; padding: 0;
}
<?php echo $hcp_menu; ?> li.page-item {
	visibility: visible;
	margin: 1px 0 0 0; /*padding: 0;*/
	list-style-type: none;	
}
<?php echo $hcp_menu; ?> ul ul{
   margin: 0 0 0 12px;
}
<?php echo $hcp_menu; ?> li.page-item li.page-item {
   background: transparent url(b3.gif) no-repeat left 7px;
}
<?php echo $hcp_menu; ?> li.page-item a {
   text-decoration: none;
   margin-left: 10px;
   display: inline-block;
}
<?php echo $hcp_menu; ?> li.page-item a:hover {
   background: none;
   text-decoration: underline;
}