<?php
function html_a_footer () {
	$returnText = "</a>";
	return $returnText;
}

function html_a_header ($href) {
	$returnText = "<a target='_blank' href='" . $href . "'>";
	return $returnText;
}

function html_content_footer () {
	$returnText = "</div>";
	return $returnText;
}

function html_content_header () {
	$returnText = "<div id=\"content\">";
	return $returnText;
}

function html_doc_comment ($json_obj, $frame_name, $key_name, $key_version) {
	$name = $json_obj[$key_name];
	$version = $json_obj[$key_version];
	$returnText = "<!-- Version: $version, Name: $name, $frame_name -->";
	return $returnText;
}

function html_doc_footer ($ascii_art) {
	$returnText = "</body></html>\n<!--\n";
	$signature = "Automatically generated by Cumin";
	$date = "@ " . date("Y-m-d");
	$returnText .= $signature . "\n" . $date;
	$returnText .= "\n\n(This is a cumin seed, btw)\n" . file_get_contents($ascii_art) . "-->";
	return $returnText;
}

function html_doc_header ($title, $favicon) {
	$returnText = "<!DOCTYPE html><html><head><title>$title</title>";
	$returnText .= "<link rel=\"icon\" type=\"image/x-icon\" href=\"$favicon\">";
	return $returnText;
}

function html_doc_torso () {
	$returnText = "</head><body>";
	return $returnText;
}

function html_img ($classes, $src) {
	$returnText = "<img class='";
	for ($i = 0; $i < count($classes); $i++)
		$returnText .= $classes[$i] . (($i == count($classes) - 1) ? "" : " ");
	$returnText .= "' src='" . $src . "' />";
	return $returnText;
}
?>
