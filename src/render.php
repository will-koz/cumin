<?php
echo html_content_header();

$new_div = true;
foreach ($frame[$json_key_content] as $item) {
	echo get_item_html($item, $new_div);
	if (isset($item[$json_key_delimiter]) && $item[$json_key_delimiter] == "hr") $new_div = false;
	else $new_div = true;
}
if ($new_div == false) echo div_footer();

echo html_content_footer();
?>
