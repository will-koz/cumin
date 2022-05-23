<?php
echo html_content_header();

foreach ($frame[$json_key_content] as $item) echo get_item_html($item);

echo html_content_footer();
?>
