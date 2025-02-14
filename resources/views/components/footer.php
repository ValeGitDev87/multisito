<?php
use Core\Config;


$config = Config::getInstance();
$jsFiles = $config->get('app.assets.js');
?>
    <footer class="bg-danger">
        <p>Footer del Sito © <?php echo date('Y'); ?></p>
    </footer>
    <?php
    foreach ($jsFiles as $js) {
        echo '<script src="' . $js . '" defer></script>' . PHP_EOL;
    }




    ?>


</body>
</html>
