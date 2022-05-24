<?php
function div_footer () { return "</div>"; }

function get_div ($classes, $content, $new_div, $delimiter) {
	if ($new_div == true) {
		$returnText = "<div class=\"";
		for ($i = 0; $i < count($classes); $i++)
			$returnText .= $classes[$i] . (($i == count($classes) - 1) ? "" : " ");
		$returnText .= "\">";
	}

	$returnText .= $content;
	if ($delimiter == "hr") $returnText .= "<hr />";
	else $returnText .= div_footer();
	return $returnText;
}

function get_div_xtext ($classes, $item, $new_div) {
	global $json_key_classes, $json_key_content, $json_key_delimiter;
	$returnText = "";
	if (isset($item[$json_key_classes])) $classes = array_merge($classes, $item[$json_key_classes]);
	$classes = array_merge($classes, ["xtext"]);
	$returnText .= (isset($item[$json_key_delimiter])) ?
		get_div($classes, $item[$json_key_content], $new_div, $item[$json_key_delimiter]) :
		get_div($classes, $item[$json_key_content], $new_div, "");
	return $returnText;
}

function get_item_html ($item, $new_div) {
	global $json_key_type;
	$returnText = "";
	$classes_list = ["item"];
	switch (strtolower($item[$json_key_type])) {
		case "xtext":
			$returnText .= get_div_xtext($classes_list, $item, $new_div);
			break;
	}
	return $returnText;
}
?>
