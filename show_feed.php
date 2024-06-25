<?php
$config = include('config.php');

if (isset($config['readerSettings'])) {
    $readerSettings = $config['readerSettings'];
	$webUrl = $readerSettings['web_url'];
	$monthsOld = $readerSettings['how_many_months_old'];
    $opmlFile = $readerSettings['opml_path'];
    $icon = $readerSettings['default_icon'];
} else {
    die('Error: Configuration is missing or invalid.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixeeFeeds</title>
    <link rel="stylesheet" href="style.css">
	<link rel="blogroll" type="text/xml" href="<?php echo  $webUrl . $opmlFile; ?>" >
</head>
<body>

<h1>PixeeFeeds</h1>  
<a href="<?php echo  $opmlFile; ?>" rel="blogroll">You can find the OPML file here.</a>
	
    <div class="rss-feed">
        <?php
        $jsonFile = 'feed_data.json';

        // Check if the JSON file exists
        if (file_exists($jsonFile)) {
            $jsonData = file_get_contents($jsonFile);

            $entries = json_decode($jsonData, true);

            $currentTime = time();
            $monthsAgo = strtotime("-$monthsOld months", $currentTime);

            foreach ($entries as $entry) {
                if ($entry['pubDate'] >= $monthsAgo) {
                    ?>
                    <div class="rss-item">
                        <div>
                            <img class="rss-icon" src="<?php echo htmlspecialchars($entry['icon']); ?>" alt="RSS Icon">
                        </div>
                        <div>
                            <p class="rss-website">
                                <a href="<?php echo htmlspecialchars($entry['websiteUrl']); ?>"><?php echo htmlspecialchars($entry['websiteTitle']); ?></a>
                            </p>
                            <div class="rss-title">
                                <a class="link" href="<?php echo htmlspecialchars($entry['link']); ?>" target="_blank"><?php echo htmlspecialchars($entry['title']); ?></a>
                                <div class="description"><?php echo htmlspecialchars(substr($entry['description'], 0, 250)); ?>...</div>
                                <div class="date"><?php echo date('d-M-Y', $entry['pubDate']); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        } else {
            echo '<p>No feed data available.</p>';
        }
        ?>
    </div>
	
	
	<?php include ('footer.php'); ?>