<?php
// app/Views/layout.php

// Includi l'header
__DIR__ . '/../components/header.php';


// Se esiste una variabile $content, la stampiamo nel punto in cui deve comparire il contenuto specifico
echo $content;

// Includi il footer
__DIR__ . '/../components/footer.php';


