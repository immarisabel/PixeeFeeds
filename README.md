# PixeeFeeds
Enchanting PHP RSS feed reader designed to effortlessly discover, share, and manage blogrolls and content feeds online. 

This was a labor of love. I wanted to overengineer it, but then I figure this is all I need at the moment. It is nto fancy code, it is useful simple code. As simple as I could keep it.
You only have to touch 2 files. The rest feel free to do so if you want to play with the code.

> Have fun! Spread the web!


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

I highly encourage you to edit the CSS to your will, specially the color scheme on root. 


```css
:root {
    --color-primary: #3498db;
    --color-secondary: #333;
    --color-tertiary: #c18cd4;
    --color-accent: #2980b9;
    --color-text-light: #b2b2d5;
    --color-text-dark: #555;
    --color-background: #D3D3E7;
}
```

This won't translate to the OPML template but you can the just copy the colors you want to the file `stylesheet.xsl`.

```css
   body {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            max-width: 800px;
            margin: 3rem auto;
            background-color: #D3D3E7; 
            color: #333;
            text-align: center;
          }
          h1 {
            color: #555; 
            margin-bottom: 2rem;
          }
          p {
            margin-bottom: 2rem;
            color: #2980b9; 
          }
          ul {
            list-style-type: none;
            padding-left: 0;
          }
          li {
            margin-bottom: 1rem;
            padding: 0.5rem;
            background-color: #ffffff; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          }
          a {
            color: #555;
            text-decoration: none;
          }
          a:hover {
            text-decoration: underline;
          }
          .feed {
            font-size: 0.9rem;
            color: #FF1493; 
          }
```

### Icon

The `no-icon.svg` is just cod. If you fancy another one, feel free to change it. Just search `heart svg` and you get plenty.

### Discovery

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
