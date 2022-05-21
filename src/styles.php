<?php
function output_style ($lp, $style) {
	$returnText = "<link rel=\"stylesheet\" href=\"";
	$returnText .= $lp . $style;
	$returnText .= "\" />";
	return $returnText;
}

function output_styles ($lp, $styles) {
	$returnText = "";
	foreach ($styles as $i) $returnText .= output_style ($lp, $i);
	return $returnText;
}

if (isset($frame[$json_key_styles])) {
	// The first field is used for all clients, the second for non-mobile styles, and the last is
	// used for mobile styles.
	$n = 3;

	if (count($frame[$json_key_styles]) != $n) exit ($error_style_qty1 . $n . $error_style_qty2);
	else {
		echo output_styles($location_prefix, $pagejson[$json_key_styles]);
		echo output_styles($location_prefix, $frame[$json_key_styles][0]);
		if (is_mobile()) echo output_styles($location_prefix, $frame[$json_key_styles][2]);
		else echo output_styles($location_prefix, $frame[$json_key_styles][1]);
	}
}
?>
