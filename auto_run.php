

<?php
$config = include('config.php');

if (!isset($config['readerSettings']['how_often_to_run'])) {
    die('Error: Configuration for how often to run is missing or invalid.');
}

$updateInterval = $config['readerSettings']['how_often_to_run'];
$feedDataFile = 'feed_data.json';

$currentTimestamp = time();

if (file_exists($feedDataFile)) {
    $lastModified = filemtime($feedDataFile);
    $timeDifference = $currentTimestamp - $lastModified;
    if ($timeDifference < $updateInterval) {
        echo 'Feed data is up to date. No update needed.';
        exit;
    }
}

include('update_feeds.php');
?>
