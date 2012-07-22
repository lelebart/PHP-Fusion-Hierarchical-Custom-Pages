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
| Original Filename: custom_pages.php
| Original Author: Nick Jones (Digitanium)
| Infusion Filename: custom_pages.php
| Infusion Author: Valerio Vendrame (lelebart)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
require_once THEMES."templates/admin_header_mce.php";
include LOCALE.LOCALESET."admin/custom_pages.php";

include_once INFUSIONS."custom_pages/minicore.php";
include_once CP_HIER_DIR."infusion_db.php";

//if (!checkrights("CP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }
if (!checkrights("CP") || !checkrights("HCP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

if (isset($_COOKIE['custom_pages_tinymce']) && $_COOKIE['custom_pages_tinymce'] == 1 && $settings['tinymce_enabled']) {
	add_to_head("<script language='javascript' type='text/javascript'>advanced();</script>");
} else {
	require_once INCLUDES."html_buttons_include.php";
}

if (isset($_GET['status']) && !isset($message)) {
	if ($_GET['status'] == "sn") {
		$message = $locale['410']."<br />\n".$locale['412']."\n<a href='".BASEDIR."viewpage.php?page_id=".intval($_GET['pid'])."' class='out'>viewpage.php?page_id=".intval($_GET['pid'])."</a>\n";
	} elseif ($_GET['status'] == "su") {
		$message = $locale['411']."<br />\n".$locale['412']."\n<a href='".BASEDIR."viewpage.php?page_id=".intval($_GET['pid'])."' class='out'>viewpage.php?page_id=".intval($_GET['pid'])."</a>\n";
	} elseif ($_GET['status'] == "del") {
		$message = $locale['413'];
	} elseif ($_GET['status'] == "pw") {
		$message = $locale['global_182'];
	}
	if ($message) {	echo "<div class='admin-message'>".$message."</div>\n"; }
}

if (isset($_POST['save'])) {
	$page_title = stripinput($_POST['page_title']);
	$page_order = isset($_POST['page_order']) && isnum($_POST['page_order']) ? $_POST['page_order'] : null;
	$page_parent = isset($_POST['page_parent']) && isnum($_POST['page_parent']) ? $_POST['page_parent'] : "0";
	$page_access = isset($_POST['page_access']) && isnum($_POST['page_access']) ? $_POST['page_access'] : "0";
	$page_content = addslash($_POST['page_content']);
	$admin_password = isset($_POST['admin_password']) ? $_POST['admin_password'] : "";
	$comments = isset($_POST['page_comments']) ? "1" : "0";
	$ratings = isset($_POST['page_ratings']) ? "1" : "0";
	if ($page_order == null) {
		$data = dbarray(dbquery("SELECT * FROM ".DB_CP_HIER." ORDER BY page_order DESC LIMIT 1"));
		$page_order = $data['page_order'] + 1;
		//var_dump($page_order);
	} 
	if ((isset($_COOKIE[COOKIE_PREFIX.'admin']) && md5($_COOKIE[COOKIE_PREFIX.'admin']) == $userdata['user_admin_password']) || md5(md5($admin_password)) == $userdata['user_admin_password']) {
		if (isset($_POST['page_id']) && isnum($_POST['page_id'])) {
			$result = dbquery("UPDATE ".DB_CUSTOM_PAGES." SET page_title='$page_title', page_access='$page_access', page_content='$page_content', page_allow_comments='$comments', page_allow_ratings='$ratings' WHERE page_id='".$_POST['page_id']."'");
			//debug_view($result);
			$result = dbquery("SELECT * FROM ".DB_CP_HIER." WHERE page_h_id='".$_POST['page_id']."' LIMIT 1");
			if (dbrows($result) == 0) {
				$result = dbquery("INSERT INTO ".DB_CP_HIER." (page_h_id, page_order, page_parent) VALUES ('".$_POST['page_id']."', '$page_order', '$page_parent')");
			} else {
				$result = dbquery("UPDATE ".DB_CP_HIER." SET page_order='$page_order', page_parent='$page_parent' WHERE page_h_id='".$_POST['page_id']."'");
			}
			//debug_view($result);
			if (isset($_POST['add_link'])) {
				$data = dbarray(dbquery("SELECT * FROM ".DB_SITE_LINKS." ORDER BY link_order DESC LIMIT 1"));
				$link_order = $data['link_order'] + 1;
				$result = dbquery("INSERT INTO ".DB_SITE_LINKS." (link_name, link_url, link_visibility, link_position, link_window, link_order) VALUES ('$page_title', 'viewpage.php?page_id=".$_POST['page_id']."', '$page_access', '1', '0', '$link_order')");
				//debug_view($result);
			}
			//redirect(FUSION_SELF.$aidlink."&status=su&pid=".$_POST['page_id']);			
		} else {
			$result = dbquery("INSERT INTO ".DB_CUSTOM_PAGES." (page_title, page_access, page_content, page_allow_comments, page_allow_ratings) VALUES ('$page_title', '$page_access', '$page_content', '$comments', '$ratings')");
			//debug_view($result);
			$page_id = mysql_insert_id();
			//debug_view($page_id);
			$result = dbquery("INSERT INTO ".DB_CP_HIER." (page_h_id, page_order, page_parent) VALUES ('$page_id', '$page_order', '$page_parent')");
			//debug_view($result);
			if (isset($_POST['add_link'])) {
				$data = dbarray(dbquery("SELECT * FROM ".DB_SITE_LINKS." ORDER BY link_order DESC LIMIT 1"));
				$link_order = $data['link_order'] + 1;
				$result = dbquery("INSERT INTO ".DB_SITE_LINKS." (link_name, link_url, link_visibility, link_position, link_window, link_order) VALUES ('$page_title', 'viewpage.php?page_id=$page_id', '$page_access', '1', '0', '$link_order')");
				//debug_view($result);
			}
			//redirect(FUSION_SELF.$aidlink."&status=sn&pid=".$page_id);
		}
		if (!isset($_COOKIE[COOKIE_PREFIX.'admin']) && md5(md5($admin_password)) == $userdata['user_admin_password']) {
			setcookie(COOKIE_PREFIX."admin", md5($admin_password), time() + 3600, "/", "", "0");
		}
		//debug_view($_POST);
		if (isset($_POST['page_id']) && isnum($_POST['page_id'])) {
			redirect(FUSION_SELF.$aidlink."&status=su&pid=".$_POST['page_id']);
		} else {
			redirect(FUSION_SELF.$aidlink."&status=sn&pid=".$page_id);
		}
	} else {
		redirect(FUSION_SELF.$aidlink."&status=pw");
		//echo "<div class='admin-message'>".$locale['global_102']."</div>\n";
	}
	/*
} else if (isset($_POST['delete']) && (isset($_POST['page_id']) && isnum($_POST['page_id']))) {
	$result = dbquery("DELETE FROM ".DB_CUSTOM_PAGES." WHERE page_id='".$_POST['page_id']."'");
	$result = dbquery("DELETE FROM ".DB_CP_HIER." WHERE page_id='".$_POST['page_id']."'");
	$result = dbquery("DELETE FROM ".DB_SITE_LINKS." WHERE link_url='viewpage.php?page_id=".$_POST['page_id']."'");
	redirect(FUSION_SELF.$aidlink."&status=del");
	*/
} else {
	if (isset($_POST['preview'])) {
		$addlink = isset($_POST['add_link']) ? " checked='checked'" : "";
		$page_title = stripinput($_POST['page_title']);
		$page_order = isset($_POST['page_order']) && isnum($_POST['page_order']) ? $_POST['page_order'] : "1";
		$page_parent = isset($_POST['page_parent']) && isnum($_POST['page_parent']) ? $_POST['page_parent'] : "0";
		$page_access = $_POST['page_access'];
		$page_content = stripslash($_POST['page_content']);
		$admin_password = isset($_POST['admin_password']) ? $_POST['admin_password'] : "";
		$comments = isset($_POST['page_comments']) ? " checked='checked'" : "";
		$ratings = isset($_POST['page_ratings']) ? " checked='checked'" : "";
		if ((isset($_COOKIE[COOKIE_PREFIX.'admin']) && md5($_COOKIE[COOKIE_PREFIX.'admin']) == $userdata['user_admin_password']) || md5(md5($admin_password)) == $userdata['user_admin_password']) {
			opentable($page_title);
			eval("?>".$page_content."<?php ");
			closetable();
			if (!isset($_COOKIE[COOKIE_PREFIX.'admin']) && md5(md5($admin_password)) == $userdata['user_admin_password']) {
				setcookie(COOKIE_PREFIX."admin", md5($admin_password), time() + 3600, "/", "", "0");
			}
		} else {
			echo "<div class='admin-message'>".$locale['global_182']."</div>\n";
		}
		$page_content = phpentities($page_content);
	}
	/*
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 
				ON p.page_id = p2.page_id ORDER BY p2.page_parent,p2.page_order,p.page_title");
	if (dbrows($result) != 0) {
		$editlist[] = array(); //first MUST be empty
		$sel = ""; $i=0;
		while ($data = dbarray($result)) {
			if (isset($_POST['page_id'])) { $sel = ($_POST['page_id'] == $data['page_id'] ? " selected='selected'" : ""); }
			//$editlist .= "<option value='".$data['page_id']."'$sel>".show_level($data['page_id'],'-').$data['page_title']."</option>\n";
			$option[$i]['page_id'] = $data['page_id'];
			$option[$i]['page_parent'] = $data['page_parent'];
			$option[$i]['page_order'] = $data['page_order'];
			$option[$i]['tr_content'] = "<option value='".$data['page_id']."'$sel>".show_level($data['page_id'],'-').$data['page_title']."</option>\n";
			$editlist[] = $option[$i];
			$i++;
		}
		opentable($locale['402']);
		echo "<div style='text-align:center'>\n<form name='selectform' method='post' action='".FUSION_SELF.$aidlink."'>\n";
		build_ul();
		echo "<select name='page_id' class='textbox' style='width:200px;'>\n".build_list($editlist)."</select>\n";//$editlist
		echo "<input type='submit' name='edit' value='".$locale['420']."' class='button' />\n";
		echo "<input type='submit' name='delete' value='".$locale['421']."' onclick='return DeletePage();' class='button' />\n";
		echo "</form>\n</div>\n";
		closetable();
	}
	*/
	if ((isset($_POST['edit']) && (isset($_POST['page_id']) && isnum($_POST['page_id']))) || (!isset($_POST['page_id']) && isset($_GET['edit_page_id']) && isnum($_GET['edit_page_id']))) {
		if (!isset($_POST['page_id']) && isset($_GET['edit_page_id']) && isnum($_GET['edit_page_id'])) { $_POST['page_id'] = $_GET['edit_page_id']; }
		$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 ON p.page_id = p2.page_h_id WHERE p.page_id='".$_POST['page_id']."'");
		if (dbrows($result)) {
			$data = dbarray($result);
			//debug_view($data);
			$page_title = $data['page_title'];
			$page_order = $data['page_order'];
			$page_parent = $data['page_parent'] ? $data['page_parent'] : "";
			$page_access = $data['page_access'];
			$page_content = phpentities(stripslashes($data['page_content']));
			$admin_password = "";
			$comments = ($data['page_allow_comments'] == "1" ? " checked='checked'" : "");
			$ratings = ($data['page_allow_ratings'] == "1" ? " checked='checked'" : "");
			$addlink = "";
		} else {
			redirect(FUSION_SELF.$aidlink);
		}
	}
	if (isset($_POST['page_id']) && isnum($_POST['page_id'])) {
		$table_title = $locale['401'];
		$where_clause = "WHERE p.page_id!='".$_POST['page_id']."' AND p2.page_parent!='".$_POST['page_id']."'" ;
		$td_width = 33;
	} else {
		$table_title = $locale['400'];
		$where_clause = "";
		if (!isset($_POST['preview'])) {
			$page_title = "";
			$page_order = "";
			$page_parent = "";
			$page_access = "";
			$page_content = "";
			$admin_password = "";
			$comments = " checked='checked'";
			$ratings = " checked='checked'";
			$addlink = "";
		}
	}

	opentable(CP_HIER_TIT);
	$td_width = isset($td_width) && isnum($td_width) ? $td_width : 50;
	echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n\t<tr>\n";
	echo "\t\t<td align='center' width='".$td_width."%' class='tbl2'><span class='small'><a href='".CP_HIER_DIR."admin.php".$aidlink."' style='display:block;'>".$locale['hcp_admin']."</a></span></td>\n";
	echo "\t\t<td align='center' width='".$td_width."%' class='tbl1'><span class='small'><strong>".$table_title."</strong></span></td>\n";
	if (isset($_POST['page_id']) && isnum($_POST['page_id'])) {
		echo "\t\t<td align='center' width='34%' class='tbl2'><span class='small'><a href='".CP_HIER_DIR."custom_pages.php".$aidlink."' style='display:block;'>".$locale['400']."</a></span></td>\n";
		$colspan = 3;
	} else {
		$colspan = 2;
	}
	echo "\t</tr>\n\t<tr>\n\t\t<td colspan='".$colspan."' class='tbl1'>\n";

	
	if (isset($_POST['page_id']) && isnum($_POST['page_id']) && has_child($_POST['page_id'])) {
		//if (!defined("HCP_STYLE")) { set_style('simple'); }
		set_style('hcp_admin', 'simple');
		//echo "<div class='hcp_menu'>\n";
		echo "<div id='hcp_admin'>\n";
		echo "<ul>\n\t<li>".$page_title;
		get_child($_POST['page_id']);
		echo "</li>\n</ul>";
		echo "</div>\n";
	}
	
	
	$user_groups = getusergroups(); $access_opts = ""; $sel = "";
	while(list($key, $user_group) = each($user_groups)){
		$sel = ($page_access == $user_group['0'] ? " selected='selected'" : "");
		$access_opts .= "<option value='".$user_group['0']."'$sel>".$user_group['1']."</option>\n";
	}
	echo "<form name='inputform' method='post' action='".FUSION_SELF.$aidlink."' onsubmit='return ValidateForm(this);'>\n";
	echo "<table cellpadding='0' cellspacing='0' class='center'>\n<tr>\n";
	echo "<td width='100' class='tbl'>".$locale['422']."</td>\n";
	echo "<td width='80%' class='tbl'><input type='text' name='page_title' value='".$page_title."' class='textbox' style='width:250px;' /></td>\n";
	$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 
						ON p.page_id = p2.page_h_id ".$where_clause."
						ORDER BY p2.page_parent,p2.page_order,p.page_title");
	if (dbrows($result) != 0) {
		$parentlist[] = array();
		$parentlist[] = array('page_id' => NULL, 
							'page_parent' => 0,
							'page_order' => 1,
							'tr_content' => "<option value='0'>".$locale['hcp_402']."</option>\n"
							);
		$sel = ""; $i=0;
		while ($data = dbarray($result)) {
			$sel = ($page_parent == $data['page_id'] ? " selected='selected'" : "");
			$option[$i]['page_id'] = $data['page_id'];
			$option[$i]['page_parent'] = $data['page_parent'];
			$option[$i]['page_order'] = $data['page_order'];
			$option[$i]['tr_content'] = "<option value='".$data['page_id']."'$sel>".show_level($data['page_id'],'-').$data['page_title']."</option>\n";
			$parentlist[] = $option[$i];
			$i++;
		} //debug_view($parentlist);
		echo "</tr>\n<tr>\n";
		echo "<td valign='top' width='100' class='tbl'>".$locale['hcp_401']."</td>\n";
		echo "<td width='80%' class='tbl'><select name='page_parent' class='textbox' style='width:200px;'>\n".build_list($parentlist)."</select></td>\n";
	}
	echo "</tr>\n<tr>\n";
	echo "<td valign='top' width='100' class='tbl'>".$locale['hcp_400']."</td>\n";
	echo "<td width='80%' class='tbl'><input type='text' name='page_order' value='".$page_order."' class='textbox' style='width:250px;' /></td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td valign='top' width='100' class='tbl'>".$locale['423']."</td>\n";
	echo "<td width='80%' class='tbl'><select name='page_access' class='textbox' style='width:150px;'>\n".$access_opts."</select></td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td valign='top' width='100' class='tbl'>".$locale['424']."</td>\n";
	echo "<td width='80%' class='tbl'><textarea name='page_content' cols='95' rows='15' class='textbox tinymce' style='width:98%' id='page_content'>".$page_content."</textarea></td>\n";
	echo "</tr>\n<tr>\n";
	if (!isset($_COOKIE['custom_pages_tinymce']) || !$_COOKIE['custom_pages_tinymce'] || !$settings['tinymce_enabled']) {
		echo "<td class='tbl'></td><td class='tbl'>\n";
		echo "<input type='button' value='&lt;?php?&gt;' class='button' style='width:60px;' onclick=\"addText('page_content', '&lt;?php\\n', '\\n?&gt;');\" />\n";
		echo "<input type='button' value='&lt;p&gt;' class='button' style='width:35px;' onclick=\"insertText('page_content', '&lt;p&gt;');\" />\n";
		echo "<input type='button' value='&lt;br /&gt;' class='button' style='width:40px;' onclick=\"insertText('page_content', '&lt;br /&gt;');\" />\n";
		echo display_html("inputform", "page_content", true);
		echo "</td>\n</tr>\n<tr>\n";
	} 
	if ((!isset($_COOKIE[COOKIE_PREFIX.'admin']) || md5($_COOKIE[COOKIE_PREFIX.'admin']) != $userdata['user_admin_password']) && (!isset($admin_password) || md5(md5($admin_password)) != $userdata['user_admin_password'])) {
		echo "<td class='tbl'>".$locale['425']."</td>\n";
		echo "<td class='tbl'><input type='password' name='admin_password' value='".$admin_password."' class='textbox' style='width:150px;' /></td>\n";
		echo "</tr>\n<tr>\n";
	}
	echo "<td class='tbl'></td><td class='tbl'>\n";
	if (isset($_POST['page_id']) && isnum($_POST['page_id'])) {
		$result = dbquery("SELECT * FROM ".DB_SITE_LINKS." WHERE link_url='viewpage.php?page_id=".$_POST['page_id']."' LIMIT 1");
	}
	if (!isset($_POST['page_id']) || !isnum($_POST['page_id'])) {
		echo "<label><input type='checkbox' name='add_link' value='1'".$addlink." />  ".$locale['426']."</label><br />\n";
	} elseif (isset($_POST['page_id']) && isnum($_POST['page_id']) && (dbrows($result) == 0)) {
		echo "<label><input type='checkbox' name='add_link' value='1'".$addlink." />  ".$locale['426']."</label><br />\n";
	}
	echo "<label><input type='checkbox' name='page_comments' value='1'".$comments." /> ".$locale['427']."</label><br />\n";
	echo "<label><input type='checkbox' name='page_ratings' value='1'".$ratings." /> ".$locale['428']."</label>\n";
	echo "</td>\n</tr>\n<tr>\n";
	echo "<td align='center' colspan='2' class='tbl'><br />\n";
	if (isset($_POST['page_id']) && isnum($_POST['page_id'])) {
		echo "<input type='hidden' name='page_id' value='".$_POST['page_id']."' />\n";
	}
	echo "<input type='submit' name='preview' value='".$locale['429']."' class='button' />\n";
	echo "<input type='submit' name='save' value='".$locale['430']."' class='button' /></td>\n";
	echo "</tr>\n</table>\n</form>\n";

	echo "\t\t</td>\n\t</tr>\n</table>\n";

	closetable();
	$to_head = "<script type='text/javascript'>\n";
	$to_head .=  "//<![CDATA[\n";
	$to_head .=  "$(document).ready(function(){\n";
	$to_head .=  "\t$('.out').click(function(){\n";
	$to_head .=  "\t\tvar answer = confirm('".$locale['hcp_308']." '+$(this).attr('title'));\n";
	$to_head .=  "\t\treturn answer;\n";
	$to_head .=  "\t});\n";
	$to_head .=  "});\n";
	$to_head .=  "\tfunction ValidateForm(frm) {\n"."\t\tif(frm.page_title.value=='') {\n";
	$to_head .=  "\t\t\talert('".$locale['451']."');\n"."\t\t\treturn false;\n\t\t}\n";
	$to_head .=  "\t\tif(frm.admin_password.value=='') {\n"."\t\t\talert('".$locale['452']."');\n";
	$to_head .=  "\t\t\treturn false;\n\t\t}\n\t}\n";
	$to_head .=  "//]]>\n";
	$to_head .=  "</script>\n";
	add_to_head($to_head);
}
require_once THEMES."templates/footer.php";
?>