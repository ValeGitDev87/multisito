<?php
use Core\Session;

Session::start(); // Questo fa partire la sessione in modo sicuro

if (!empty($message)) :
?>
    <h2><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></h2>
<?php
endif;


?>
