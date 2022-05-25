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
		case "xfile":
			$returnText .= get_div_xfile($classes_list, $item, $new_div);
			break;
		case "xlink":
			$returnText .= get_div_xlink($classes_list, $item, $new_div);
			break;
		case "xtext":
			$returnText .= get_div_xtext($classes_list, $item, $new_div);
			break;
	}
	return $returnText;
}
?>
