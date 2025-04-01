
<?php

use Core\Config;
use Core\Script;


$config = Config::getInstance();
$baseUrl = $config->get('app.base_url');
// Crea un'istanza di ScriptManagement
$scriptManager = new Script($config);


$script= $scriptManager->render('login.js', '/login');


?>
<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-6 col-12  mt-5">

        <h1>Login</h1>

        <form id="loginForm" class="p-4 border rounded shadow bg-light mt-5">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" aria-describedby="email" required>
          
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"  class="form-control" name="password" autocomplete="password" required>
              
            </div>

            <button type="submit" class="btn btn-success">Login</button>
            <a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$baseUrl ?>/register" class="altrimenti-registrati">altrimenti registrati</a>
            <a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$baseUrl ?>/forgot-password" class="altrimenti-registrati">Password dimenticata?</a>


        </form>

        </div>

    </div>
</div>

