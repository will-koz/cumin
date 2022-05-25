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

function html_doc_footer () {
	$returnText = "</body></html>";
	return $returnText;
}

function html_doc_header () {
	$returnText = "<!DOCTYPE html><html><head>";
	return $returnText;
}

function html_doc_torso () {
	$returnText = "</head><body>";
	return $returnText;
}
?>
