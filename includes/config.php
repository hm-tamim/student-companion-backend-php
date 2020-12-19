<?php
include 'info.php';
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd" />
    <html xmlns="http://www.w3.org/1999/xhtml"/>
    <head>
        <meta http-equiv="content-type" content="application/xhtml xml; charset=utf-8"/>
        <meta name="google-site-verification" content="<?php echo $google; ?>"/>
        <title><?php echo $title; ?></title>
        <meta name="description"
              content="Live Streaming  And Free Download youtube videos in hd 3gp mp4 and flv format directly on your Mobile browsers."/>
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
        <meta name="msvalidate.01" content="<?php echo '' . $bing . ''; ?>"/>
        <meta name="alexaVerifyID" content="<?php echo '' . $alexa . ''; ?>"/>
        <meta name="robots" content="index,follow"/>
        <meta property="og:title" content="Mobile Youtube Video Converter"/>
        <meta property="og:url" content="http://<?php echo '' . $host . ''; ?>/"/>
        <meta property="og:image" content="http://<?php echo '' . $host . ''; ?><?php echo '' . $logo . ''; ?>"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <link media="handheld,all" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
              rel="stylesheet" type="text/css"/>
        <style type="text/css">
            body img {
                max-width: 98%;
                max-height: 50%
            }

            body {
                max-width: 98%;
                max-height: 50%
            }

            width {
                max-width: 98%;
                max-height: 50%
            }

            img {
                max-width: 98%;
                max-height: 50%
            }
        </style>
        <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="/style.css" type="text/css"/>
    </head>
    <body>
<h2 id="site-name">
    <a rel="home" href="/"><img src="<?php echo '' . $logo . ''; ?>" alt="<?php echo '' . $sitename . ''; ?>"/></a>
</h2>
<div id="groupp">
    <div class="group" align="center">
        Type Keyword:
        <br/>
        <form action="/" method="get">
            <input type="text" name="q" placeholder="Search In Here"/>
            <input type="submit" value="Search" title="Search Now"/><br>
            <input name="type" type="radio" value="music"> Musik
            <input name="type" type="radio" value="video"> Video
        </form>
        <div style="clear:both"></div>
    </div>
    </form>
</div>
<?php include 'ucweb.php'; ?>