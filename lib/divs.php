<?php
function div_footer () { return "</div>"; }

function get_js_content_copy ($content) {
	$returnText = " onclick=\"";
	$returnText .= "navigator.clipboard.writeText('" . $content . "');";
	$returnText .= "\" title=\"" . $content . "\"";
	return $returnText;
}

function get_div ($classes, $content, $new_div, $delimiter, $extradata = "") {
	if ($new_div == true) {
		$returnText = "<div class=\"";
		for ($i = 0; $i < count($classes); $i++)
			$returnText .= $classes[$i] . (($i == count($classes) - 1) ? "" : " ");
		$returnText .= "\"" . $extradata . ">";
	}

	$returnText .= $content;
	if ($delimiter == "hr") $returnText .= "<hr />";
	else $returnText .= div_footer();
	return $returnText;
}

function get_div_clcpy ($classes, $item, $new_div) {
	global $json_key_content, $json_key_copy, $json_key_delimiter;
	$returnText = "";
	$classes = array_merge($classes, ["clcpy"]);
	$jscc = get_js_content_copy($item[$json_key_copy]);
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $item[$json_key_content], $new_div, $item[$json_key_delimiter], $jscc) :
		get_div($classes, $item[$json_key_content], $new_div, "", $jscc);
	return $returnText;
}

function get_div_clock ($classes, $item, $new_div) {
	global $json_key_delimiter;
	$returnText = "";
	$classes = array_merge($classes, ["clock"]);
	$content = "<div class='cabov'><label class='chour'></label>";
	$content .= "<label class='cminu'></label><label class='cscnd'></label></div><br />";
	$content .= "<div class='cbelw'><label class='cyear'></label>";
	$content .= "<label class='cmnth'></label><label class='cdate'></label></div>";
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $content, $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $content, $new_div, "");
	return $returnText;
}

function get_div_image ($classes, $item, $new_div) {
	global $error_image_new_div, $json_key_src;
	if ($new_div == false) exit($error_image_new_div);
	$returnText = "";
	$classes = array_merge($classes, ["image"]);
	$content = html_img(["image-img"], $item[$json_key_src]);
	$returnText .= get_div($classes, $content, $new_div, "");
	return $returnText;
}

function get_div_imgcl ($classes, $item, $new_div) {
	global $error_image_new_div, $json_key_copy, $json_key_src;
	if ($new_div == false) exit($error_image_new_div);
	$returnText = "";
	$classes = array_merge($classes, ["imgcl"]);
	$jscc = get_js_content_copy($item[$json_key_copy]);
	$content = html_img(["image-img"], $item[$json_key_src]);
	$returnText .= get_div($classes, $content, $new_div, "", $jscc);
	return $returnText;
}

function get_div_imglk ($classes, $item, $new_div) {
	global $error_image_new_div, $json_key_href, $json_key_src;
	if ($new_div == false) exit($error_image_new_div);
	$returnText = "";
	$classes = array_merge($classes, ["imglk"]);
	$content = html_img(["image-img"], $item[$json_key_src]);
	$returnText .= html_a_header($item[$json_key_href]);
	$returnText .= get_div($classes, $content, $new_div, "");
	$returnText .= html_a_footer();
	return $returnText;
}

function get_div_searc ($classes, $item, $new_div) {
	global $json_key_delimiter, $json_key_name, $json_key_placeholder, $json_key_url;
	$returnText = "";
	$classes = array_merge($classes, ["xtext"]);
	$content = "<form action='" . $item[$json_key_url] . "' method='get'>";
	$content .= "<input type='text' name='" . $item[$json_key_name] . "' autofocus placeholder='";
	if (isset($item[$json_key_placeholder])) $content .= $item[$json_key_placeholder];
	$content .= "' /></form>";
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $content, $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $content, $new_div, "");
	return $returnText;
}

function get_div_table ($classes, $item, $new_div) {
	global $json_key_content, $json_key_delimiter, $json_key_href, $json_key_title, $json_key_width;
	$returnText = "";
	$classes = array_merge($classes, ["table"]);
	$content = "";
	if (isset($item[$json_key_title])) {
		$has_href = isset($item[$json_key_href]);
		if ($has_href) $content .= html_a_header($item[$json_key_href]);
		$content .= $item[$json_key_title];
		if ($has_href) $content .= html_a_footer();
		$content .= "<hr>";
	}
	$width = (is_mobile()) ? $item[$json_key_width][1] : $item[$json_key_width][0];
	$content .= "<table>";
	for ($i = 0; $i < count($item[$json_key_content]); $i++) {
		if ($i % $width == 0) {
			if ($i != 0) $content .= "</tr>";
			$content .= "<tr>";
		}
		$content .= "<td>";
		$content .= get_item_html($item[$json_key_content][$i], true);
		$content .= "</td>";
	}
	$content .= "</tr></table>";
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $content, $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $content, $new_div, "");
	return $returnText;
}

function get_div_topic ($classes, $item) {
	// This is different from the other get_div functions because it is always a new div, and it
	// never looks at if there is a delimiter in the item JSON.
	global $topic_instagram, $topic_links, $topic_name, $topic_src, $topic_twitter, $topic_webpage;
	$returnText = "";
	$classes = array_merge($classes, ["topic"]);
	$content = "";
	if (isset($item[$topic_src])) $content .= html_img([], $item[$topic_src]);
	// Create a div below to optimize for display: grid in CSS
	$content .= "<div>";
	if (isset($item[$topic_name])) {
		$content .= "<big>";
		if (isset($item[$topic_webpage]))
			$content .= html_a_header($item[$topic_webpage]) . $item[$topic_name] . html_a_footer();
		else $content .= $item[$topic_name];
		$content .= "</big><hr />";
	} elseif (isset($item[$topic_webpage])) {
		$content .= "<big>";
		$content .= html_a_header($item[$topic_webpage]) . $item[$topic_webpage] . html_a_footer();
		$content .= "</big><hr />";
	}
	if (isset($item[$topic_instagram])) $content .= website_link('i', $item[$topic_instagram]);
	if (isset($item[$topic_twitter])) $content .= website_link('t', $item[$topic_twitter]);
	if (isset($item[$topic_links])) {
		for ($i = 0; $i < count($item[$topic_links]); $i += 2) {
			if ($i != 0) $content .= "<br />";
			$content .= html_a_header($item[$topic_links][$i + 1]);
			$content .= $item[$topic_links][$i] . html_a_footer();
		}
	}
	$content .= "</div>";
	$returnText .= get_div($classes, $content, true, "");
	return $returnText;
}

function get_div_wther ($classes, $item, $new_div) {
	global $json_key_class, $json_key_delimiter, $json_key_href, $json_key_src, $weather_fetching;
	$returnText = "";
	$classes = array_merge($classes, ["wther"]); // Seperate from the individual class of the label
	$class = $item[$json_key_class]; // The class of the label
	$has_href = isset($item[$json_key_href]);
	$content = "";
	if ($has_href) $content .= html_a_header($item[$json_key_href]);
	$content .= "<label class=\"$class\">$weather_fetching</label>";
	if ($has_href) $content .= html_a_footer($item[$json_key_href]);
	$content .= "<script>updateData(\"$class\", \"$item[$json_key_src]\");</script>";
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $content, $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $content, $new_div, "");
	return $returnText;
}

function get_div_xfile ($classes, $item, $new_div) {
	global $json_key_content, $location_prefix;
	$item[$json_key_content] = file_get_contents($location_prefix . $item[$json_key_content]);
	$classes = array_merge($classes, ["xfile"]);
	return get_div_xtext($classes, $item, $new_div);
}

function get_div_xlink ($classes, $item, $new_div) {
	global $json_key_content, $json_key_delimiter, $json_key_href;
	$returnText = "";
	$classes = array_merge($classes, ["xlink"]);
	$item[$json_key_content] = html_a_header($item[$json_key_href]) . $item[$json_key_content];
 	$item[$json_key_content] .= html_a_footer();
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $item[$json_key_content], $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $item[$json_key_content], $new_div, "");
	return $returnText;
}

function get_div_xlist ($classes, $item, $new_div) {
	global $json_key_content, $json_key_delimiter, $json_key_href, $json_key_title;
	$returnText = "";
	$classes = array_merge($classes, ["xlist"]);
	$content = "";
	if (isset($item[$json_key_title])) {
		$has_href = isset($item[$json_key_href]);
		if ($has_href) $content .= html_a_header($item[$json_key_href]);
		$content .= $item[$json_key_title];
		if ($has_href) $content .= html_a_footer();
		$content .= "<hr>";
	}
	foreach ($item[$json_key_content] as $subitem) $content .= get_item_html($subitem, true);
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $content, $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $content, $new_div, "");
	return $returnText;
}

function get_div_xtext ($classes, $item, $new_div) {
	global $json_key_content, $json_key_delimiter;
	$returnText = "";
	$classes = array_merge($classes, ["xtext"]);
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $item[$json_key_content], $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $item[$json_key_content], $new_div, "");
	return $returnText;
}

function get_item_html ($item, $new_div) {
	// Handle each individual item by keyword
	global $json_key_classes, $json_key_type;
	$returnText = "";
	$classes_list = ["item"];
	if (isset($item[$json_key_classes])) $classes = array_merge($classes, $item[$json_key_classes]);
	switch (strtolower($item[$json_key_type])) {
		case "clcpy":
			$returnText .= get_div_clcpy($classes_list, $item, $new_div);
			break;
		case "clock":
			$returnText .= get_div_clock($classes_list, $item, $new_div);
			break;
		case "image":
			$returnText .= get_div_image($classes_list, $item, $new_div);
			break;
		case "imgcl":
			$returnText .= get_div_imgcl($classes_list, $item, $new_div);
			break;
		case "imglk":
			$returnText .= get_div_imglk($classes_list, $item, $new_div);
			break;
		case "searc":
			$returnText .= get_div_searc($classes_list, $item, $new_div);
			break;
		case "table":
			$returnText .= get_div_table($classes_list, $item, $new_div);
			break;
		case "topic":
			$returnText .= get_div_topic($classes_list, $item);
			break;
		case "wther":
			$returnText .= get_div_wther($classes_list, $item, $new_div);
			break;
		case "xfile":
			$returnText .= get_div_xfile($classes_list, $item, $new_div);
			break;
		case "xlink":
			$returnText .= get_div_xlink($classes_list, $item, $new_div);
			break;
		case "xlist":
			$returnText .= get_div_xlist($classes_list, $item, $new_div);
			break;
		case "xtext":
			$returnText .= get_div_xtext($classes_list, $item, $new_div);
			break;
	}
	return $returnText;
}
?>
