<?php
if (!empty($_GET['q'])) {
    switch ($_GET['q']) {
        case 'info':
            phpinfo();
            exit;
            break;
    }
}
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Project Launcher</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="./index-custom-style.css">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Karla';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .opt {
                margin-top: 30px;
            }

            .opt a {
                text-decoration: none;
                font-size: 150%;
            }

            a:hover {
                color: red;
            }
        </style>

    </head>
    <body>

        <div class="wrapper">
            <div class="projekte">
                <nav class="projekte-nav">
                    <a href="http://localhost/" class="projekte-link">Side-Projects</a>
                    <a href="http://localhost/workspace/" class="projekte-link active">Workspace</a>
                    <a href="http://localhost/phpmyadmin/" class="link-ext" target="_blank"><em>php</em>MyAdmin</a>
                </nav>
            </div>

            <div class="wrapper-inner">
                <?php print($_SERVER['SERVER_SOFTWARE']); ?><br />
                PHP version: <?php print phpversion(); ?>   <span><a title="phpinfo()" href="/?q=info">info</a></span><br />
                Document Root: <?php print ($_SERVER['DOCUMENT_ROOT']); ?><br />

                <ul class="list">

                   <?php

                   function scan_dir($dir_lm) {
                       $ignored = array('.', '..', '.svn', '.htaccess');

                       $files = array();
                       foreach (scandir($dir_lm) as $file) {
                           if (in_array($file, $ignored)) continue;
                           $files[$file] = filemtime($dir_lm . '/' . $file);
                       }

                       arsort($files);
                       $files = array_keys($files);

                       return ($files) ? $files : false;
                   }

                   $dir = scan_dir(getcwd());

                   ?>

                   <?php foreach ($dir as $file) : ?>

                       <?php if( $file != "." && $file != ".." && $file != "index.php"  ) : ?>

                        <li class="list-item">
                            <a class="link" href="<?php echo $file; ?>"><?php echo $file; ?></a>
                            <a class="link-btn" href="http://localhost/<?php echo $file; ?>" target="_blank"><em>v</em>Host</a>
                        </li>

                       <?php endif; ?>

                   <?php endforeach; ?>

                </ul>

                <div class="sites">
                    <h2 class="sites-title">Links</h2>
                    <ul class="sites-items">
                        <li class="sites-item">
                            <a href="https://github.com/yahongie2014" class="sites-link" target="_blank">GitHub<br><span class="sites-link-desc">Homepage</span></a>
                        </li>
                        <li class="sites-item">
                            <a href="https://coder79.me" class="sites-link" target="_blank">Coder79<br><span class="sites-link-desc">Login</span></a>
                        </li>
                        <li class="sites-item">
                            <a href="https://developer.wordpress.org/reference/" class="sites-link" target="_blank">Wordpress<br><span class="sites-link-desc">Codex</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </body>
</html>
