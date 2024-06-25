# PixeeFeeds
Enchanting PHP RSS feed reader designed to effortlessly discover, share, and manage blogrolls and content feeds online. 


## USAGE

### prepare your OPML file

make sure you are NOT nesting the outlines, if you can fix it to work with nested ones, go ahead! :) 

```xml
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="stylesheet.xsl"?>
<opml version="2.0">
  <body>
      <outline type="rss" xmlUrl="https://marisabel.nl/rss.php" htmlUrl="https://marisabel.nl" text="Marisabel Munoz" title="Marisabel Munoz"/>
  </body>
</opml>
```

### update the `config.php`

The refresh time is in seconds. You can convert this easy anywhere.

If you are not sure, [use this one](https://www.unitconverters.net/time-converter.html).

The opml path will concatenate with the url, so make sure you have the `/` right (follow example). 

```php
$readerSettings = [  
'web_url' => '',		// https://yourwebsite.com
'opml_path' => '',		// /path/of/the/file.opml
'default_icon' => '',		// https://yourwebsite.com/full/path/to/icon.svg
'how_many' => 1,		// how many posts per feed to fetch
'how_many_months_old' => 1,	// how old should you display the feeds in months
'how_often_to_run' => 86400	// 24 hours : how often the feed refreshes in seconds
];
```


## LICENSE

### Open Source Notice
This project is open source and available under the MIT License.

#### Author
Author: Marisabel Munoz
Website: marisabel.nl

#### License
This project is licensed under the MIT License - see the LICENSE file for details.
