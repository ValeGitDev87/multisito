

<?php if (!empty($message)) : ?>  <!-- Evita di stampare un messaggio vuoto -->
    <h2><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></h2>
<?php endif; ?>
