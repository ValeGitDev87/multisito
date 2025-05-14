<?php

use Core\Session;
// app/resources/views/layout.php
$user = Session::has('user_id');
// Includi l'header
include __DIR__ . '../components/header.php';
include __DIR__ . '../components/navigation.php';

if(isset($user)){
    
    include __DIR__ . '../components/sidebar.php';
}




echo isset($content) ? $content : '';

// Includi il footer
include __DIR__ . '/components/footer.php';
?>
