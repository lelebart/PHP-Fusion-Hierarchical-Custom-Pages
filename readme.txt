+--------------------------------------------------------+
| Type: ...... Infusion
| Name: ...... Hierarchical Custom Pages
| Version: ... 1.00
| Author: .... Valerio Vendrame (lelebart)
| Released: .. Jan, 18th 2010
| Download: .. http://www.php-fusion.it
+--------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2010 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------+
| CSS themes are free adaptation from 
| "PS Auto Sitemap" WordPress' Plugin 
| and "Fusion" WordPress' Theme
+--------------------------------------------------------+

	/************************************************\
	
		Table of Contents
		- Description
		- Installation
		+ Usage
		 - Listing Your Pages on Your Site
		 - Organizing Your Pages
		- Explanation of Functions (minicore.php)
		- Feature
		- Authors
		- Translators
		- Future Releases
		- Notes for Developers - and Translators
		
	\************************************************/

+-------------+
| DESCRIPTION |
+-------------+

With this infusion you can have SubPages within your Pages, creating a hierarchy of pages. (See "Organizing Your Pages")
This infusion is able to automatically generate a list of Pages on your site. (See "Listing Your Pages on Your Site")


+--------------+
| INSTALLATION |
+--------------+

1. Upload the 'custom_pages' and 'custom_pages_panel' folders to your Infusions folder on your webserver;
2. Go to System Admin -> Infusions;
3. Select "Custom Pages" from the list and press the "Infuse" button;
4. A site link named 'Custom Pages Structure' will be added, a left-side panel named 'SubPages' will be created ad enabled;
5. Go to System Admin -> Panels;
6. Set the order and the side of the panel created right away.


+-------+
| USAGE | freely inspired by WordPress' Codex ;)
+-------+

1. Go to System Admin -> Infusions -> Custom Pages Adminstration;
2. Start organize your pages, enjoy ;)

>> Listing Your Pages on Your Site

Now PHP-Fusion is able to automatically generate a list of Pages on your site, using functions so-called build_ul() and get_child(). (See "EXPLANATION of FUNCTIONS")
 [ To be continued.. :) ]

>> Organizing Your Pages

Now you can have SubPages within your Pages, creating a hierarchy of pages.

For example, suppose you are creating a PHP-Fusion site for a travel agent and would like to create an individual Page for each continent and country to which the agency can make travel arrangements. 
You would begin by creating a Page called "Africa" on which you could describe general information about travel to Africa. 
Then you would create a series of Pages which would be SubPages to "Africa" and might include "Lesotho", "Cameroon", "Togo", and "Swaziland". 
Another individual Page is made for "South America" and would feature SubPages of "Brazil", "Argentina", and "Chile". Your site would then list:

 + Africa
  - Cameroon
  - Lesotho
  - Swaziland
  - Togo 
  - ...
 + South America
  - Argentina
  - Brazil
  - Chile 
  - ...
 + ...
  - ...

To begin the process, go to System Admin -> Infusions -> Custom Pages Adminstration -> Addd Custom Page. 
The drop-down menu contains a list of all the Pages already created for your site. 
To turn your current Page into a SubPage, or "Child" of the "Parent" Page, select the appropriate Page from the drop-down menu. 
If you specify a Parent other than "-- no parent --" from the list, the Page you are now editing will be made a Child of that selected Page. 
When your Pages are listed, the Child Page will be nested under the Parent Page.


+--------------------------+
| EXPLANATION of FUNCTIONS | minicore.php
+--------------------------+

Coming soon...


+----------+
| FEATURES |
+----------+

- Themes for the page list
- Mass remove tool
- Structure page
- SubPages panel
+ Cotrol:
 - which pages are displayed (show all pages or exclude some pages), and
 - how deep into your page hierarchy the list goes
 - if exclude the whole tree, access depending of the parent page (valid also for all its subpages)
+ Compatible with:
  - PHP-Fusion 7.00.xx
  - PHP-Fusion 7.01.xx

  
+---------+
| AUTHORS |
+---------+

 name - website ............................................ | 1.00
-------------------------------------------------------------+------
 Valerio Vendrame (lelebart) - http://www.valeriovendrame.it |  *  

 
+-------------+
| TRANSLATORS |
+-------------+

Italian, English:
 - Valerio Vendrame (lelebart), http://www.valeriovendrame.it
 - Valentina Vendrame, http://valevendrame.altervista.org

 
+-----------------+
| FUTURE RELEASES |
+-----------------+

+ 1.01 - n/a
 - Administrative settings page
 - jQuery TinyMCE (maybe)
 - show/hide helpers using PHP-Fusion tools
 
+ 2.00 - n/a
 - Better generating list function
 
 
+----------------------+
| NOTES for DEVELOPERS | and Transaltors too, of course
+----------------------+

1. [v1.00] $locale['hcp_308'] will be used for a javascript confirm, so please use \' instead of ', maybe it will change with next release
2. Have Fun ;)
3. For Micorsoft Windows users only: Notepad++ rocks! - http://notepad-plus.sourceforge.net/