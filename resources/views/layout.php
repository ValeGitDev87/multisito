<?php
// app/resources/views/layout.php

// Includi l'header
include __DIR__ . '../components/header.php';
include __DIR__ . '../components/navigation.php';



echo isset($content) ? $content : '';

// Includi il footer
include __DIR__ . '/components/footer.php';
?>
