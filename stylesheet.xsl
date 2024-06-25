<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/opml">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
      <head>
        <title>
          <xsl:value-of select="head/title"/>
        </title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
 <style>
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
</style>
	</head>
      <body>
        <p>
          This is a list of blogs I follow. The page
          is itself an <a href="http://opml.org/">OPML</a> file, which
          means you can copy the link into your RSS reader to
          subscribe to all the feeds listed below.
		  </p>  

        <ul>
          <xsl:apply-templates select="body/outline"/>
        </ul>
      </body>
    </html>
  </xsl:template>
  <xsl:template match="outline" xmlns="http://www.w3.org/1999/xhtml">
    <xsl:choose>
      <xsl:when test="@type">
        <xsl:choose>
          <xsl:when test="@xmlUrl">
            <li>
                <a href="{@htmlUrl}"><xsl:value-of select="@text"/></a>
                (<a class="feed" href="{@xmlUrl}">feed</a>)
              <xsl:choose>
                <xsl:when test="@description != ''">
                  <br/><xsl:value-of select="@description"/>
                </xsl:when>
              </xsl:choose>
            </li>
          </xsl:when>
        </xsl:choose>
      </xsl:when>
    </xsl:choose>
  </xsl:template>
</xsl:stylesheet>