<?php
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
| Filename: minicore.php
| Author: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

if (!defined("CP_HIER_DIR")) { define("CP_HIER_DIR", INFUSIONS."custom_pages/"); }
if (!defined("CP_HIER_THM")) { define("CP_HIER_THM", CP_HIER_DIR."themes/"); }
if (!defined("CP_HIER_MCE")) { define("CP_HIER_MCE", CP_HIER_DIR."tiny_mce/"); }

if (!defined("CP_HIER_VER")) { define("CP_HIER_VER", "1.00"); }

if (file_exists(CP_HIER_DIR."locale/".$settings['locale'].".php")) {
	include_once CP_HIER_DIR."locale/".$settings['locale'].".php";
} else {
	include_once CP_HIER_DIR."locale/English.php";
}

if (!defined("CP_HIER_TIT")) { define("CP_HIER_TIT", $locale['hcp_admin']." - v".CP_HIER_VER); }

if (function_exists("add_to_head")) { add_to_head("<!-- ".CP_HIER_TIT." by http://www.valeriovendrame.it -->"); } //please don't remove, thanks :)

if (!function_exists("debug_view")) {
	function debug_view($what) {
		echo "<pre><tt>\n";
		if (is_array($what)) {
			print_r($what);
		} else {
			var_dump($what);
		}
		echo "</tt></pre>\n";
	}
}

function has_parent($child, $visibility=false) {
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 
				ON p.page_id = p2.page_h_id WHERE p2.page_h_id='".$child."' 
				".($visibility ? "AND ".groupaccess('page_access')."" : "")."");
	return ((dbrows($result) != 0) ? true : false); 
}

function has_child($parent, $visibility=false) {
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 
				ON p.page_id = p2.page_h_id WHERE p2.page_parent='".$parent."' 
				".($visibility ? "AND ".groupaccess('page_access')."" : "")."");
	return ((dbrows($result) != 0) ? true : false); 
}

function get_parent_array($child, $visibility=false, $exclude_list=false, $level=false) {
	$exclude_array = $exclude_list ? explode(',', $exclude_list) : array();	
	$level = is_array($level) ? $level : array();
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 
				ON p.page_id = p2.page_h_id WHERE p2.page_h_id='".$child."'");
	if (dbrows($result)) {
		$data = dbarray($result); //debug_view($data);
		$include_item = !in_array($data['page_id'], $exclude_array) ? true : false;
		if ($data['page_parent'] == 0) {
			return empty($level) ? false : $level; 
		} else { 
			if ($include_item) {
				if ($visibility) {
					if (checkgroup($data['page_access'])) {
						$level[] = $data['page_parent'];
					} 
				} else {
					$level[] = $data['page_parent'];
				}
			}
			return get_parent_array($data['page_parent'], $visibility, $exclude_list, $level); 
		}
	} else {
		return empty($level) ? false : $level; 
	}
}

function get_child_array($parent, $visibility=false, $exclude_tree=false, $exclude_list=false, $level=false) {
	$exclude_array = $exclude_list ? explode(',', $exclude_list) : array();	
	$level = is_array($level) ? $level : array();
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 
				ON p.page_id = p2.page_h_id WHERE p2.page_parent='".$parent."' 
				".($exclude_tree ? "AND ".groupaccess('page_access')."" : "")."");
	if (dbrows($result)) {
		while ($data = dbarray($result)) {
			$include_item = !in_array($data['page_id'], $exclude_array) ? true : false;
			if ($include_item) {
				if ($visibility) {
					if (checkgroup($data['page_access'])) {
						$level[] = $data['page_h_id'];
					}
				} else {
					$level[] = $data['page_h_id'];
				}
			}
			return get_child_array($data['page_h_id'], $visibility, $exclude_tree, $exclude_list, $level);
		}
	} else {
		return empty($level) ? false : $level; 
	}
}

function get_parent($child, $visibility=false, $exclude_tree=false, $exclude_list=false, $level=false) {
	$exclude_array = $exclude_list ? explode(',', $exclude_list) : array();	
	$level = is_bool($level) ? 0 : $level;
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 
				ON p.page_id = p2.page_h_id WHERE p2.page_h_id='".$child."' 
				".($exclude_tree ? "AND ".groupaccess('page_access')."" : "")."");					
	if (dbrows($result)) {
		$data = dbarray($result); //debug_view($data);
		if ($data['page_parent'] == 0) {
			return $level; 
		} else { 
			$lev = $visibility ? (checkgroup($data['page_access']) ? $level+1 : $level) : $level+1;
		//	return get_parent($data['page_parent'], $exclude_tree, $level+1); 
			return get_parent($data['page_parent'], $visibility, $exclude_tree, $lev); 
		}
	} else {
		return $level; 
	}
}

function show_level($page_id, $sign='&#8212;', $visibility=false, $exclude_tree=false, $exclude_list=false) { //&#8211;
	$sep = "";
	for($i=0; $i < get_parent($page_id, $visibility, $exclude_tree, $exclude_list); $i++) {
		$sep .= $sign." ";
	}
	return $sep;
}

function get_child($parent, $visibility=false, $exclude_tree=false, $exclude_list=false, $deep=false, $its_tree=false, $level=1) {
	$exclude_array = $exclude_list ? explode(',', $exclude_list) : array();	
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p 
					LEFT JOIN ".DB_CP_HIER." p2 ON p.page_id = p2.page_h_id 
					WHERE p2.page_parent='".$parent."'".($exclude_tree ? " AND ".groupaccess('p.page_access') : "")." 
					ORDER BY p2.page_parent,p2.page_order,p.page_title");
	
	if (dbrows($result)) {
		echo "<ul>\n";
		while ($data = dbarray($result)) {
			$go_deep = isnum($deep) ? ($deep > $level ? true : false) : true; //debug_view($deep); //debug_view($level);
			$include_item = !in_array($data['page_id'], $exclude_array) ? true : false;
			$class = $include_item ? ($visibility ? (checkgroup($data['page_access']) ? "page-item " : "") : "page-item ") : "";
			//$class = $visibility ? (checkgroup($data['page_access']) ? "page-item " : "") : "page-item ";
			$lev = $visibility ? (checkgroup($data['page_access']) ? $level+1 : $level) : $level+1;
			//$how_many = has_child($data['page_id'], $exclude_tree) ? count(get_child_array($data['page_id'], $exclude_tree)) : "0"; //[".$how_many."]
			$admin = iADMIN && !isset($_GET['page_id']) ? " <span class='small2'><em>(".getgroupname($data['page_access']).")</em></span>" : "";
			echo "\t<li class='".$class."page-item-".$data['page_id']."'><!-- level = ".$lev." -->";
			if ($include_item) {
				if ($visibility) {
					if (checkgroup($data['page_access'])) {
						echo "<a href='".BASEDIR."viewpage.php?page_id=".$data['page_id']."' class='out' title='".stripslash($data['page_title'])."'>".$data['page_title'].$admin."</a>\n";
					}
				} else {
					echo "<a href='".BASEDIR."viewpage.php?page_id=".$data['page_id']."' class='out' title='".stripslash($data['page_title'])."'>".$data['page_title'].$admin."</a>\n";
				}
			} 
			//$its_tree = true;
			if ($its_tree) {
				$get_children = get_child_array($data['page_parent'], $visibility, $exclude_tree, $exclude_list); //debug_view($get_children);
				$get_children = is_array($get_children) ? $get_children : array(); //debug_view($get_children);
				if (isset($_GET['page_id']) && in_array($_GET['page_id'], $get_children)) { // || in_array($_GET['page_id'], $get_parent)
					get_child($data['page_id'], $visibility, $exclude_tree, $exclude_list, $deep, $its_tree, $lev);
				}
			} elseif ($go_deep) {
				get_child($data['page_id'], $visibility, $exclude_tree, $exclude_list, $deep, $its_tree, $lev);
			} else {
				//do nothing
			}
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
}

function build_ul($id=false, $visibility=false, $exclude_tree=false, $exclude_list=false, $deep=false, $its_tree=false) {
	$exclude_array = $exclude_list ? explode(',', $exclude_list) : array();
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p 
					LEFT JOIN ".DB_CP_HIER." p2 ON p.page_id = p2.page_h_id 
					WHERE p2.page_parent='0'".($exclude_tree ? " AND ".groupaccess('p.page_access') : "")." 
					ORDER BY p2.page_parent,p2.page_order,p.page_title");
	if (dbrows($result)) {
		echo "<div ".(is_bool($id) ? "class='hcp_menu'" : "id='".$id."'")."><ul>\n";
		while ($data = dbarray($result)) {
			$go_deep = isnum($deep) ? ($deep >= 1 ? true : false) : true; //debug_view($deep);
			$include_item = !in_array($data['page_id'], $exclude_array) ? true : false;
			$class = $include_item ? ($visibility ? (checkgroup($data['page_access']) ? "page-item " : "") : "page-item ") : "";
			//$how_many = has_child($data['page_id'], $exclude_tree) ? count(get_child_array($data['page_id'], $exclude_tree)) : "0"; //[".$how_many."]
			$admin = iADMIN && !isset($_GET['page_id']) ? " <span class='small2'><em>(".getgroupname($data['page_access']).")</em></span>" : "";
			echo "\t<li class='".$class."page-item-".$data['page_id']."'><!-- level = 0 -->";
			if ($include_item) {
				if ($visibility) {
					if (checkgroup($data['page_access'])) {
						echo "<a href='".BASEDIR."viewpage.php?page_id=".$data['page_id']."' class='out' title='".stripslash($data['page_title'])."'>".$data['page_title'].$admin."</a>\n";
					}
				} else {
					echo "<a href='".BASEDIR."viewpage.php?page_id=".$data['page_id']."' class='out' title='".stripslash($data['page_title'])."'>".$data['page_title'].$admin."</a>\n";
				}
			}
			if ($its_tree) {
				$get_children = get_child_array($data['page_id'], $visibility, $exclude_tree, $exclude_list); //debug_view($get_children);
				$get_children[] = $data['page_id'];
				$get_children = is_array($get_children) ? $get_children : array(); //debug_view($get_children);
				if (isset($_GET['page_id']) && in_array($_GET['page_id'], $get_children)) { // || in_array($_GET['page_id'], $get_parent)
					get_child($data['page_id'], $visibility, $exclude_tree, $exclude_list, $deep, $its_tree);
				}
			} elseif ($go_deep) {
				get_child($data['page_id'], $visibility, $exclude_tree, $exclude_list, $deep, $its_tree);
			}
			echo "</li>\n";
		}
		echo "</ul></div>\n";
	}
}

function get_tr($table, $parent_id) {
	$out = "<!-- parent = ".$parent_id." -->";
	$count = count($table);
	//debug_view($count);
	for($i = 1; $i < $count; $i++) {
		//debug_view($table[$i]['page_parent']);
		if ($table[$i]['page_parent'] == $parent_id) {
			$out .= "<!-- page_id = ".$table[$i]['page_id']." -->";
			$out .= $table[$i]['tr_content'];
			$out .= get_tr($table, $table[$i]['page_id']);
		}
	}
	//debug_view($out);
	return $out;
}

function build_list($table) {
	//debug_view($table);
	$out = "<!-- first -->";
	$count = count($table);
	//debug_view($count);
	for($i = 1; $i < $count; $i++) {
		if (is_array($table[$i])) {
			//debug_view($table[$i]['page_parent']);
			if ($table[$i]['page_parent'] == 0) {
				$out .= $table[$i]['tr_content'];
				$out .= isnum($table[$i]['page_id']) ? get_tr($table, $table[$i]['page_id']) : "";
			}
		} else {
			die(sprintf('Item nr. %s must be an array', $i));
		}
	}
	//debug_view($out);
	return $out;
}

function set_style($id=false, $css="default") {
	$css = strtolower($css);
	$theme_files = makefilelist(CP_HIER_THM, ".|..|default", true, "folders");
	//debug_view($theme_files);
	$css = in_array($css,$theme_files) ? $css : "default";
	$id = is_bool($id) ? "" : "?id=".$id;
	add_to_head("<link rel='stylesheet' href='".CP_HIER_THM.$css."/style.php".$id."' type='text/css' />");
}
?>