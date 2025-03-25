
<?php

use Core\Config;
use Core\Script;

// Recupera l'istanza della configurazione
$config = Config::getInstance();
$baseUrl = $config->get('app.base_url');
// Crea un'istanza di ScriptManagement
$scriptManager = new Script($config);

// Renderizza lo script solo se siamo in /login
$scriptManager->render('login.js', '/login');

?>
<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-6 col-12  mt-5">

        <h1>Login</h1>
        <form class="p-4 border rounded shadow bg-light mt-5">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" required>
          
            </div>
            <div class="mb-3">
                <input type="password" id="pwd" autocomplete="new-password" required>
                <input type="password" id="pwdConfirm" autocomplete="new-password" required>
            </div>
    
            <button type="submit" class="btn btn-success">Login</button>
            <a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$baseUrl ?>/register" class="altrimenti-registrati">altrimenti registrati</a>


        </form>

        </div>

    </div>
</div>

