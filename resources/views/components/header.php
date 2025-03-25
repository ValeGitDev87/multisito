<?php
// Supponiamo che tu abbia accesso alla configurazione, per esempio tramite la classe Config che hai creato
use Core\Config;

$config = Config::getInstance();
$cssFiles = $config->get('app.assets.css');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($meta['title']) ? $meta['title'] : $config->get('meta.title'); ?></title>
    <meta name="description" content="<?php echo isset($meta['description']) ? $meta['description'] : $config->get('meta.description'); ?>">
    <meta name="keywords" content="<?php echo isset($meta['keywords']) ? $meta['keywords'] : $config->get('meta.keywords'); ?>">
    <meta name="viewport" content="<?php echo isset($meta['viewport']) ? $meta['viewport'] : $config->get('meta.viewport'); ?>">
    <meta name="author" content="<?php echo isset($meta['author']) ? $meta['author'] : $config->get('meta.author'); ?>">
    <script>
        const baseUrl = "<?= url('') ?>";
    </script>

    <?php
    // Include tutti i file CSS definiti nel config
    foreach ($cssFiles as $css) {
        echo '<link rel="stylesheet" href="' . $css . '">' . PHP_EOL;
    }
    ?>
</head>
<body>
    

