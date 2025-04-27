<?php
/**
 * Default Layout Template
 */
$config = require CONFIG_PATH . '/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? $config['app_name'] ?></title>
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Sidebar Navigation -->
    <button class="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="sidebar">
        <div class="sidebar-header">
            <h1><?= $config['app_name'] ?></h1>
        </div>
        <?php $this->partial('sidebar_menu'); ?>
    </div>
    
    <div class="main-container">
        <div class="container">
            <main>
                <?= $content ?>
            </main>
            
            <footer>
                <p>&copy; <?= date('Y'); ?> <?= $config['app_name'] ?> | Versi <?= $config['app_version'] ?></p>
            </footer>
        </div>
    </div>
    
    <script src="<?= PUBLIC_PATH ?>/assets/js/script.js"></script>
</body>
</html>