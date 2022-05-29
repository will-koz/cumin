<?php
function is_mobile () {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi
	|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function reddit_link ($term) {
	$href = "https://reddit.com/r/" . $term;
	$returnText = html_a_header($href) . "r/" . $term . " " . html_a_footer();
	$returnText .= html_a_header($href . "/top?t=week") . "r/" . $term . "/top " . html_a_footer();
	$returnText .= html_a_header($href . "/new") . "r/" . $term . "/new<br />" . html_a_footer();
	return $returnText;
}

function website_link ($webpage, $term) {
	# Way to simplify the repetitive syntax of creating links.
	$link_pre_text = "Link";
	$href = "";
	switch ($webpage) {
		case 'g': // GitHub
			$href = "https://github.com/" . $term;
			$link_pre_text = "GitHub: ";
			break;
		case 'i': // Instagram
			$href = "https://instagram.com/" . $term;
			$link_pre_text = "Instagram: ";
			break;
		case 'r': // Reddit
			return reddit_link($term);
			break;
		case 't': // Twitter
			$href = "https://twitter.com/" . $term;
			$link_pre_text = "Twitter: ";
			break;
		case 'w': // Wikipedia
			$href = "https://wikipedia.org/wiki/" . $term;
			$link_pre_text = "Wikipedia: ";
			break;
		case 'y': // YouTube - just a search utility
			$href = "https://youtube.com/search?q=" . $term;
			$link_pre_text = "YouTube: ";
			break;
		default:
			$href_prefix = $webpage;
			$link_pre_text = "";
	}
	return html_a_header($href) . $link_pre_text . $term . html_a_footer() . "<br />";
}
?>
