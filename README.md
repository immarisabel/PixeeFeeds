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

### upload to your PHP server

- I have not tested with anything but PHP 8.0
- keep all in the same folder, unless you know what you are doing

### open your feed!

The only file you should open is:
`show_feeds.php`

### QUESTIONS

If for any reason you cannot get it to work, drop me an email: web@marisabel.nl

I can check for you the OPML file and config if needed be. I can't answer super fast but I do my best. I am on the Amsterdam timezone.

## EXTRAS

I added the `<link rel="blogroll" ...>` tag on the header. In order to support syndication of RSS feeds.

### Sources
- [OPML.ORG : About blogrolls](https://opml.org/blogroll.opml)
- [alexsci.com : Blogroll Network Map](https://alexsci.com/rss-blogroll-network/)
- [aramzs.xyz : The Internet is a Series of Webs](https://aramzs.xyz/essays/the-internet-is-a-series-of-webs/)

## LICENSE

### Open Source Notice
This project is open source and available under the MIT License.

#### Author
Author: Marisabel Munoz

Website: marisabel.nl

#### License
This project is licensed under the MIT License - see the LICENSE file for details.
