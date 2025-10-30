<?php
$currentDir = __DIR__;
$baseUrl = "http://localhost";
$items = scandir($currentDir);
$items = array_diff($items, ['.', '..']);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Localhost Workspace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../index-custom-style.css">

</head>

<body>

    <div class="wrapper">
        <nav class="projekte-nav">
            <a href="http://localhost/" class="projekte-link active">🏠 Workspace</a>
            <a href="http://localhost/phpmyadmin/" class="link-ext"><em>php</em>MyAdmin</a>
            <br>
            <a href="./show_dir.php" class="link-ext">📁 Current Folder</a>
        </nav>

        <div class="wrapper-inner">
            <ul class="list">
                <?php
                function scan_dir($dir_lm)
                {
                    $ignored = ['.', '..', '.svn', '.htaccess', 'index.php'];
                    $files = [];

                    foreach (scandir($dir_lm) as $file) {
                        if (in_array($file, $ignored)) continue;
                        $files[$file] = filemtime($dir_lm . '/' . $file);
                    }

                    arsort($files);
                    return array_keys($files);
                }

                $dir = scan_dir(getcwd());
                $host = $_SERVER['HTTP_HOST']; // e.g., localhost
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

                foreach ($dir as $file) :
                    $fullPath = getcwd() . DIRECTORY_SEPARATOR . $file;
                    $fileUrl = "{$protocol}://{$host}/" . rawurlencode($file);
                ?>
                    <li class="list-item">
                        <?php if (is_dir($fullPath)) : ?>
                            📁
                            <a class="link" href="<?= htmlspecialchars($fileUrl) ?>/">
                                <?= htmlspecialchars($file) ?>
                            </a>
                            <a class="link-btn" href="<?= "{$protocol}://{$file}.{$host}" ?>" target="_blank">
                                <em>v</em>Host
                            </a>
                        <?php else : ?>
                            📄
                            <a class="link" href="<?= htmlspecialchars($fileUrl) ?>" target="_blank">
                                <?= htmlspecialchars($file) ?>
                            </a>
                            <a class="link-btn" href="<?= "{$protocol}://{$host}/" . htmlspecialchars($file) ?>" target="_blank">
                                <em>v</em>Host
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="sites">
                <h2 class="sites-title">🌐 Useful Links</h2>
                <ul class="sites-items">
                    <li class="sites-item">
                        <a href="https://github.com/yahongie2014" class="sites-link">GitHub<br><span class="sites-link-desc">Homepage</span></a>
                    </li>
                    <li class="sites-item">
                        <a href="https://coder79.me" class="sites-link">Coder79.me<br><span class="sites-link-desc">Website</span></a>
                    </li>
                    <li class="sites-item">
                        <a href="http://localhost/wordpress/" class="sites-link">WordPress<br><span class="sites-link-desc">Local Codex</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>
