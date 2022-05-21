<?php
function html_doc_comment ($json_obj, $frame_name, $key_name, $key_version) {
	$name = $json_obj[$key_name];
	$version = $json_obj[$key_version];
	$returnText = "<!-- Version: $version, Name: $name, $frame_name -->";
	return $returnText;
}

function html_doc_header () {
	$returnText = "<!DOCTYPE html><html><head>";
	return $returnText;
}

function html_doc_footer () {
	$returnText = "</body></html>";
	return $returnText;
}

function html_doc_torso () {
	$returnText = "</head><body>";
	return $returnText;
}
?>
