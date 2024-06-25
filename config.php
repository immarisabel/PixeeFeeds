<?php

$readerSettings = [
	'web_url' => '',			// https://yourwebsite.com
    'opml_path' => '',			// /path/of/the/file.opml
    'default_icon' => '',		// https://yourwebsite.com/full/path/to/icon.svg
	'how_many' => 1,			// how many posts per feed to fetch
	'how_many_months_old' => 1,	// how old should you display the feeds in months
	'how_often_to_run' => 86400	// 24 hours : how often the feed refreshes in seconds
];

return [
    'readerSettings' => $readerSettings,
];



