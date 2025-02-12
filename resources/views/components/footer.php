<?php
use Core\Config;

$config = Config::getInstance();
$cssFiles = $config->get('app.assets.js');
?>
<footer class="bg-danger">
        <p>Footer del Sito © <?php echo date('Y'); ?></p>
    </footer>
</body>
</html>
