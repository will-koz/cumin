<?php
function is_mobile () {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi
	|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function website_link ($webpage, $term) {
	# Way to simplify the repetitive syntax of creating links.
	$link_pre_text = "Link";
	$href = "";
	switch ($webpage) {
		case 'i': // Instagram
			$href = "https://instagram.com/" . $term;
			$link_pre_text = "Instagram: ";
			break;
		case 't': // Twitter
			$href = "https://twitter.com/" . $term;
			$link_pre_text = "Twitter: ";
			break;
		default:
			$href_prefix = $webpage;
			$link_pre_text = "";
	}
	return html_a_header($href) . $link_pre_text . $term . html_a_footer() . "<br />";
}
?>
