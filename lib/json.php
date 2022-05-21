<?php
function load_json ($file_location) {
	$contents = file_get_contents($file_location);
	if ($contents == false) return null;
	$json_obj = json_decode($contents, true);
	return $json_obj;
}
?>
