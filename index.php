<?php
include_once "conf.php";
include_once "lib/json.php";
include_once "lib/templates.php";
include_once "lib/utilities.php";

// Goes through the list of documents and finds the first one that matches.
$json_file_index = 0;
$pagejson = null;
while ($pagejson == null && $json_file_index < count($json_files)) {
	$pagejson = load_json($location_prefix . $json_files[$json_file_index]);
	$json_file_index++;
}
if ($json_file_index > count($json_files)) exit($error_no_json);

// Assign the name of the frame, and a shorter reference to the object
$frame_name = $default_frame_name;
if (isset($_GET[$get_key_frame]) && isset($pagejson[$json_key_pages][$_GET[$get_key_frame]])) {
	$frame_name = $_GET[$get_key_frame];
}
$frame = $pagejson[$json_key_pages][$frame_name];

echo html_doc_header();
echo html_doc_comment($pagejson, $frame_name, $json_key_name, $json_key_version);

include "src/styles.php";

echo html_doc_torso();

include "src/render.php";

echo html_doc_footer();
?>
