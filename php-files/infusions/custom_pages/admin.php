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
| Filename: admin.php
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
require_once "../../maincore.php";
require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/custom_pages.php";

include_once INFUSIONS."custom_pages/minicore.php";
include_once CP_HIER_DIR."infusion_db.php";

$show_tiny_help = true; //sorry, admin panel in future release
$show_hcp_help = false; //sorry, admin panel in future release

//if (!checkrights("CP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }
if (!checkrights("CP") || !checkrights("HCP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

if (isset($_GET['status']) && !isset($message)) {
	if ($_GET['status'] == "del") {
		$message = $locale['413'];
		$hide = true;
	} elseif ($_GET['status'] == "mass_del") {
		$message = $locale['hcp_303'];
		$hide = true;
	} elseif ($_GET['status'] == "has_child") {
		$message = $locale['hcp_304'];
		$hide = false;
	} elseif ($_GET['status'] == "err") {
		$message = $locale['hcp_305'];
		$hide = false;
	} elseif ($_GET['status'] == "ord") {
		$message = $locale['hcp_306'];
		$hide = true;
	}
	if ($message) {	echo "<div class='admin-message".($hide?" autohide":"")."'>".$message."</div>\n"; }
}

if (isset($_GET['action']) && ($_GET['action'] == "delete") && (isset($_GET['page_id']) && isnum($_GET['page_id']))) {
	if (!has_child($_GET['page_id'])) {
		$result = dbquery("DELETE FROM ".DB_CUSTOM_PAGES." WHERE page_id='".intval($_GET['page_id'])."' LIMIT 1");
		$result = dbquery("DELETE FROM ".DB_CP_HIER." WHERE page_h_id='".intval($_GET['page_id'])."' LIMIT 1");
		$result = dbquery("DELETE FROM ".DB_SITE_LINKS." WHERE link_url='viewpage.php?page_id=".intval($_GET['page_id'])."' LIMIT 1");
		redirect(FUSION_SELF.$aidlink."&status=del");
	} else {
		redirect(FUSION_SELF.$aidlink."&status=err");		
	}
} elseif ((isset($_GET['action']) && $_GET['action'] == "order") && (isset($_GET['page_id']) && isnum($_GET['page_id'])) && (isset($_GET['new_order']) && isnum($_GET['new_order']) && ($_GET['new_order']!=0))) {
	$result = dbquery("UPDATE ".DB_CP_HIER." SET page_order='".intval($_GET['new_order'])."' WHERE page_h_id='".intval($_GET['page_id'])."' LIMIT 1");
	redirect(FUSION_SELF.$aidlink."&status=ord");
}

if (isset($_POST['remove_page']) && !empty($_POST['remove_page']) && is_array($_POST['remove_page'])) {
	$has_child = false;
	$count_page = count($_POST['remove_page']);
	for ($i = 0; $i < $count_page; $i++) {
		if (isnum($_POST['remove_page'][$i])) {
			if (!has_child($_POST['remove_page'][$i])) {
				$result = dbquery("DELETE FROM ".DB_CUSTOM_PAGES." WHERE page_id='".intval($_POST['remove_page'][$i])."' LIMIT 1");
				$result = dbquery("DELETE FROM ".DB_CP_HIER." WHERE page_h_id='".intval($_POST['remove_page'][$i])."' LIMIT 1");
				$result = dbquery("DELETE FROM ".DB_SITE_LINKS." WHERE link_url='viewpage.php?page_id=".intval($_POST['remove_page'][$i])."' LIMIT 1");
			} else {
				$has_child = true;
			}
		}
	} 
	//debug_view($has_child);
	redirect(FUSION_SELF.$aidlink."&status=".($has_child ? "has_child" : ($i==1? "" : "mass_")."del"));
}

opentable(CP_HIER_TIT);
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n\t<tr>\n";
echo "\t\t<td align='center' width='50%' class='tbl1'><span class='small'><strong>".$locale['hcp_admin']."</strong></span></td>\n";
echo "\t\t<td align='center' width='50%' class='tbl2'><span class='small'><a href='".CP_HIER_DIR."custom_pages.php".$aidlink."' style='display:block;'>".$locale['400']."</a></span></td>\n";
echo "\t</tr>\n\t<tr>\n\t\t<td colspan='2' class='tbl1'>\n";

if ($settings['tinymce_enabled']) {
	echo "<input type='button' id='tinymce_switch' name='tinymce_switch' value='".(!isset($_COOKIE['custom_pages_tinymce']) || $_COOKIE['custom_pages_tinymce'] == 0 ? $locale['461'] : $locale['462'])." ".str_replace(":", "", $locale['460'])."' class='button' style='width:auto;' onclick=\"SetTinyMCE(".(!isset($_COOKIE['custom_pages_tinymce']) || $_COOKIE['custom_pages_tinymce'] == 0 ? 1 : 0).");\"/>\n";
	if ($show_tiny_help) {
		echo " <span class='button hcp_show' id='tinymce_help_button'>".$locale['hcp_100']."</span>\n";
		echo "<div class='hcp_hide' id='tinymce_help'><br />\n"; //class='admin-message' 
		echo "<div class='tbl-border tbl2'>\n<div class='tbl1'>".$locale['hcp_101']."</div>\n</div>\n";
		echo "</div><br />\n";
add_to_head("<style type='text/css'>
/*<![CDATA[*/
	#tinymce_help_button { cursor: pointer; padding: 3px 5px;}
/*]]>*/
</style>
<script type='text/javascript'>
//<![CDATA[
$(document).ready(function() {
	//tinymce
	$('#tinymce_help_button').click(function() { 
	  $('#tinymce_help').slideToggle('5000');
	});
});
//]]>
</script>");
	}
}
if ($show_hcp_help) {
	echo "<div class='tbl-border tbl2'>\n<span id='panel_help_button' class='hcp_show'>".$locale['hcp_005']."</span>\n<div id='panel_help' class='tbl1'>\n";
	echo "\t<div style='margin:10px;'>".$locale['hcp_000']."</div>\n";
	$result = dbquery("SELECT panel_status FROM ".DB_PANELS." WHERE panel_filename='custom_pages_panel'");
	if (dbrows($result)!=0) {
		$data = dbarray($result);
		if ($data['panel_status'] == 1) {
			$panel_status = $locale['hcp_002'];
			$bg = "#80FE80"; //light-green
		} else {
			$panel_status = $locale['hcp_003'];
			$bg = "#FEFF80"; //light-yellow
		}
	} else {
		$panel_status = $locale['hcp_004'];
			$bg = "#FE9980"; //light-red
	}
	echo "\t<div style='margin:10px;padding:5px 8px;".($bg ? "background-color:".$bg.";" : "' class='tbl2")."'>".$locale['hcp_001']." <strong>".$panel_status."</strong></div>\n";
	echo "</div>\n</div>\n";
	echo "<br />";
}

$formaction = FUSION_SELF.$aidlink;
$result = dbquery("SELECT p.*,p2.* FROM ".DB_CUSTOM_PAGES." p LEFT JOIN ".DB_CP_HIER." p2 ON p.page_id = p2.page_h_id ORDER BY p2.page_order");
if (dbrows($result) != 0) {
	$i = 0;	
	echo "<form name='deleteform' method='post' action='".$formaction."'>\n";
	echo "<table cellpadding='0' cellspacing='1' width='98%' class='tbl-border center striped'>\n\t<tr>\n";
	echo "\t\t<td class='forum-caption not-striped' align='center' width='1%' style='white-space:nowrap'><input src='cancel.gif' class='bbcode hcp_show confirm-mass-delete' name='mass_remove_img' title='".$locale['hcp_307']."' type='image' /></td>\n";
	echo "\t\t<td class='forum-caption not-striped' colspan='2'><strong>".$locale['hcp_200']."</strong></td>\n";
	echo "\t\t<td class='forum-caption not-striped' align='center' width='1%' style='white-space:nowrap'><strong>".$locale['hcp_201']."</strong></td>\n";
	echo "\t\t<td class='forum-caption not-striped' align='center' width='1%' style='white-space:nowrap' colspan='3'><strong>".$locale['hcp_202']."</strong></td>\n";
	echo "\t\t<td class='forum-caption not-striped' align='center' width='1%' style='white-space:nowrap'><strong>".$locale['hcp_203']."</strong></td>\n";
	echo "\t</tr>\n";
	$table[] = array(); //first MUST be empty
	while($data = dbarray($result)) {
		//debug_view($data);
		//$row_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); //by jquery
		$row_color = "tbl1";
		$table_tr[$i]['page_id'] = $data['page_id'];
		$table_tr[$i]['page_parent'] = $data['page_parent'];
		$table_tr[$i]['page_order'] = $data['page_order'];
		$content = "\t<tr>\n";
		$content .= "\t\t<td class='".$row_color."' style='white-space:nowrap' width='1%'>";
		//		debug_view(get_parent_array($data['page_id']));
		//		debug_view(get_child_array($data['page_id']));
		$content .=  "<input type='checkbox' id='remove_page_id_".$data['page_id']."' name='remove_page[]' value='".$data['page_id']."' ";
		$content .=  "class='button mass_click hcp_hide' title='".$data['page_title']."' /></td>\n";
		$content .=  "\t\t<td class='".$row_color."'>".show_level($data['page_id']).$data['page_title']."</td>\n";
		//$content .=  "\t\t<td align='center' width='1%' class='".$row_color."' style='white-space:nowrap'>".(has_child($data['page_id']) ? count(get_child_array($data['page_id'])) : "0")."</td>\n";
		$content .=  "\t\t<td align='center' width='1%' class='".$row_color."' style='white-space:nowrap'><a href='".BASEDIR."viewpage.php?page_id=".intval($data['page_id'])."' class='out' title='".stripslash($data['page_title'])."'>".$locale['hcp_206']."</a></td>\n";
		$content .=  "\t\t<td align='center' width='1%' class='".$row_color."' style='white-space:nowrap'>".getgroupname($data['page_access'])."</td>\n";
		$data['page_order'] = intval($data['page_order']);
		$minus = $data['page_order'] == 1 ? "" : "<a href='".FUSION_SELF.$aidlink."&amp;action=order&amp;page_id=".$data['page_id']."&amp;new_order=".($data['page_order'] - 1)."'>-1</a>";;
		//$minus = $data['page_order'] == 1 ? "" : "<a href='".FUSION_SELF.$aidlink."&amp;action=order&amp;page_id=".$data['page_id']."&amp;new_order=".($data['page_order'] - 1)."'><img src='".get_image("up")."' alt='-1' title='-1' style='border:0px;' /></a>";;
		$plus = "<a href='".FUSION_SELF.$aidlink."&amp;action=order&amp;page_id=".$data['page_id']."&amp;new_order=".($data['page_order'] + 1)."'>+1</a>";
		//$plus = "<a href='".FUSION_SELF.$aidlink."&amp;action=order&amp;page_id=".$data['page_id']."&amp;new_order=".($data['page_order'] + 1)."'><img src='".get_image("down")."' alt='+1' title='+1' style='border:0px;' /></a>";
		$content .=  "\t\t<td align='center' width='1%' class='".$row_color."' style='white-space:nowrap'>".$minus."</td>\n";
		$content .=  "\t\t<td align='center' width='1%' class='".$row_color."' style='white-space:nowrap'>".$data['page_order']."</td>\n";
		$content .=  "\t\t<td align='center' width='1%' class='".$row_color."' style='white-space:nowrap'>".$plus."</td>\n";
		$content .=  "\t\t<td align='center' width='1%' class='".$row_color."' style='white-space:nowrap'><a href='".CP_HIER_DIR."custom_pages.php".$aidlink."&amp;edit_page_id=".$data['page_id']."'>".$locale['hcp_204']."</a>\n";
		$content .=  " - <a href='".FUSION_SELF.$aidlink."&amp;action=delete&amp;page_id=".$data['page_id']."' class='confirm-delete' title='".stripslash($data['page_title'])."'>".$locale['hcp_205']."</a>\n";
		$content .=  "</td>\n";
		$content .=  "\t</tr>\n";
		$table_tr[$i]['tr_content'] = $content;
		$table[] = $table_tr[$i];
		$i++;
	}		
	echo build_list($table);
	echo "</table>\n";
	echo "<input type='submit' name='mass_remove' value='".$locale['hcp_307']."' class='button hcp_hide' />\n";
	echo "</form>\n";
} else {
	echo "<div class='admin-message'>".sprintf($locale['hcp_207'], $aidlink)."</div>\n";
}

echo "\t\t</td>\n\t</tr>\n</table>\n";
closetable();

$to_head = "<script type='text/javascript'>\n";
$to_head .=  "//<![CDATA[\n";
$to_head .=  "\tfunction ValidateForm(frm) {\n"."\t\tif(frm.page_title.value=='') {\n";
$to_head .=  "\t\t\talert('".$locale['451']."');\n"."\t\t\treturn false;\n\t\t}\n";
$to_head .=  "\t\tif(frm.admin_password.value=='') {\n"."\t\t\talert('".$locale['452']."');\n";
$to_head .=  "\t\t\treturn false;\n\t\t}\n\t}\n";

if ($settings['tinymce_enabled']) {
	$to_head .=  "\tfunction SetTinyMCE(val) {\n";
	$to_head .=  "\t\tnow=new Date();\n"."\t\tnow.setTime(now.getTime()+1000*60*60*24*365);\n";
	$to_head .=  "\t\texpire=(now.toGMTString());\n"."\t\tdocument.cookie=\"custom_pages_tinymce=\"+escape(val)+\";expires=\"+expire;\n";
	$to_head .=  "\t\tlocation.href='".FUSION_SELF.$aidlink."';\n"."\t}\n";
}

$to_head .=  "//]]>\n";
$to_head .=  "</script>\n";
add_to_head($to_head);

add_to_head("<style type='text/css'>
/*<![CDATA[*/
	.highlight { background-color: #8CA777; }
	.highlight { color: #fff; }
	.highlight a { color: #f0f0f0 !important; }
	.click { background-color: #9b849c; }
	.click { color: #fff; }
	.click a { color: #f0f0f0 !important; }
	.hcp_show { display: none; visibility: hidden; }
	#panel_help_button { cursor: pointer; }
	#panel_help { margin-top: 3px; }
	#panel_help tt { font-size: 130%; padding: 0 3px; }
	#panel_help pre tt { font-size: 100%; }
/*]]>*/
</style>
<script type='text/javascript'>
//<![CDATA[
$(document).ready(function() {
	//odd - even
	$('.striped tr:even').children('td').not('.not-striped').addClass('tbl2').removeClass('tbl1');
	//hover
	$('.striped tr:not(:first)').mouseover(function() {
		$('td',this).not('.not-striped').css('cursor','pointer').addClass('highlight');
	}).mouseout(function() {
		$('td',this).removeClass('highlight');
	});
	//click
	$('.striped tr').click(function() {
		$('td',this).not('.not-striped').toggleClass('click');
		var cb = $('td',this).children('input[type=checkbox]').get(0);
		cb.checked = !cb.checked;
	});
	//autohide message
	$('.autohide').fadeOut(4000);
	//panel_help message
	$('#panel_help_button').css('display','block').click(function() { 
	  $('#panel_help').slideToggle('5000');
	});
	//show hidden
	$('.hcp_show').show().removeClass('hcp_show');
	//hide shown
	$('.hcp_hide').hide();
});
//]]>
</script>");
	

//better between <head> tags, to prevent old MSIEs' crashes
$add_to_head =  "<script type='text/javascript'>\n";
$add_to_head .=  "//<![CDATA[\n";
$add_to_head .=  "$(document).ready(function(){\n";
$add_to_head .=  "\t$('.out').click(function(){\n";
$add_to_head .=  "\t\tvar answer = confirm('".$locale['hcp_308']." '+$(this).attr('title'));\n";
$add_to_head .=  "\t\treturn answer;\n";
$add_to_head .=  "\t});\n";
$add_to_head .=  "\t$('.confirm-delete').click(function(){\n";
$add_to_head .=  "\t\tvar answer = confirm('".$locale['hcp_300']." '+$(this).attr('title'));\n";
$add_to_head .=  "\t\treturn answer;\n";
$add_to_head .=  "\t});\n";
$add_to_head .=  "\t$('.confirm-mass-delete').click(function(){\n";
$add_to_head .=  "\t\t//mass\n";
$add_to_head .=  "\t\tvar foo = [];\n";
$add_to_head .=  "\t\t$('.mass_click:checked').each(function(i, checked){\n";
$add_to_head .=  "\t\t\tfoo[i] = $(checked).attr('title');\n";
$add_to_head .=  "\t\t});\n";
$add_to_head .=  "\t\tif(foo.length > 0){\n";
$add_to_head .=  "\t\t\tif(foo.length == 1){\n";
$add_to_head .=  "\t\t\t\tvar testo = '".$locale['hcp_300']." '\n";
$add_to_head .=  "\t\t\t} else {\n";
$add_to_head .=  "\t\t\t\tvar testo = '".$locale['hcp_301']." '\n";
$add_to_head .=  "\t\t\t}\n";
$add_to_head .=  "\t\t\tvar answer = confirm(testo+foo.join(', '));\n";
$add_to_head .=  "\t\t}else{\n";
$add_to_head .=  "\t\t\tvar answer = false;\n";
$add_to_head .=  "\t\t}\n";
$add_to_head .=  "\t\treturn answer;\n";
$add_to_head .=  "\t});\n";
$add_to_head .=  "});\n";
$add_to_head .=  "//]]>\n";
$add_to_head .=  "</script>";
add_to_head($add_to_head);


require_once THEMES."templates/footer.php";
?>