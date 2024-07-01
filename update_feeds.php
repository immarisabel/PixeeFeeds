<?php
$config = include('config.php');

if (isset($config['readerSettings'])) {
    $readerSettings = $config['readerSettings'];
    $webUrl = $readerSettings['web_url'];
    $entriesPerFeed = $readerSettings['how_many'];
    $refreshTime = $readerSettings['how_often_to_run'];
    $opmlPath = $readerSettings['opml_path'];
    $defaultIcon = $readerSettings['default_icon'];
} else {
    die('Error: Configuration is missing or invalid.');
}

$absoluteOpmlPath = $_SERVER['DOCUMENT_ROOT'] . $opmlPath;

function fetchFeedsFromOpml($absoluteOpmlPath) {
    echo $absoluteOpmlPath;

    $feeds = [];

    if (file_exists($absoluteOpmlPath)) {
        $opml = simplexml_load_file($absoluteOpmlPath);
        foreach ($opml->body->outline as $outline) {
            if (isset($outline->outline)) {
                foreach ($outline->outline as $feed) {
                    $feeds[] = (string) $feed['xmlUrl'];
                }
            } else {
                $feeds[] = (string) $outline['xmlUrl'];
            }
        }
    } else {
        echo "<br>OPML file not found.<br>";
    }

    return $feeds;
}

function fetchLatestEntries($feedUrls, $defaultIcon, $entriesPerFeed, $webUrl) {
    $entries = [];
    $agent =  'User-Agent: PixeeFeeds 1.0 via ' . $webUrl;
    $options = [
        'http' => [
            'header' => $agent,
            'ignore_errors' => true
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ];
    $context = stream_context_create($options);

    foreach ($feedUrls as $feedUrl) {
        $feedContent = @file_get_contents($feedUrl, false, $context);

        if ($feedContent !== false) {
            $xml = simplexml_load_string($feedContent);

            if ($xml === false) {
                error_log("Failed to parse feed: $feedUrl");
                continue;
            }

            if (isset($xml->channel->item)) {
                // RSS feed
                $websiteTitle = (string) $xml->channel->title;
                $websiteUrl = (string) $xml->channel->link;
                $icon = (string) $xml->channel->image->url;

                if (empty($icon)) {
                    $icon = $defaultIcon;
                }

                $feedEntries = [];
                foreach ($xml->channel->item as $item) {
                    $feedEntries[] = [
                        'title' => (string) $item->title,
                        'link' => (string) $item->link,
                        'description' => strip_tags((string) $item->description),
                        'pubDate' => strtotime((string) $item->pubDate),
                        'author' => isset($item->author) ? (string) $item->author : 'Unknown',
                        'websiteTitle' => $websiteTitle,
                        'websiteUrl' => $websiteUrl,
                        'icon' => $icon
                    ];
                }
                usort($feedEntries, function($a, $b) {
                    return $b['pubDate'] - $a['pubDate'];
                });
                $entries = array_merge($entries, array_slice($feedEntries, 0, $entriesPerFeed));
            } elseif (isset($xml->entry)) {
                // Atom feed
                $websiteTitle = (string) $xml->title;
                $websiteUrl = (string) $xml->link['href'];
                $icon = $defaultIcon;  // Atom feeds do not have an image element in the same way RSS feeds do

                $feedEntries = [];
                foreach ($xml->entry as $entry) {
                    $feedEntries[] = [
                        'title' => (string) $entry->title,
                        'link' => (string) $entry->link['href'],
                        'description' => strip_tags((string) $entry->content),
                        'pubDate' => strtotime((string) $entry->updated),
                        'author' => isset($entry->author->name) ? (string) $entry->author->name : 'Unknown',
                        'websiteTitle' => $websiteTitle,
                        'websiteUrl' => $websiteUrl,
                        'icon' => $icon
                    ];
                }
                usort($feedEntries, function($a, $b) {
                    return $b['pubDate'] - $a['pubDate'];
                });
                $entries = array_merge($entries, array_slice($feedEntries, 0, $entriesPerFeed));
            } else {
                error_log("Feed format not recognized: $feedUrl");
            }
        } else {
            error_log("Failed to load feed: $feedUrl");
        }
    }

    usort($entries, function($a, $b) {
        return $b['pubDate'] - $a['pubDate'];
    });

    return $entries;
}

$feeds = fetchFeedsFromOpml($absoluteOpmlPath);

$latestEntries = fetchLatestEntries($feeds, $defaultIcon, $entriesPerFeed, $webUrl);

$feedDataFile = 'feed_data.json'; 

if (file_put_contents($feedDataFile, json_encode($latestEntries, JSON_PRETTY_PRINT))) {
    echo "<br>Feed data updated successfully.";
} else {
    echo "<br>Failed to update feed data.";
}

?>
