<?php
use Core\Config;
use Core\Script;
$config = Config::getInstance();
$baseUrl = $config->get('app.base_url');
// Crea un'istanza di ScriptManagement
$scriptManager = new Script($config);
$script= $scriptManager->render('forgot-password.js', '/forgot-password');

?>


<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-6 col-12  mt-5">

        <h1>Password Dimenticata</h1>

        <form id="forgotPasswordForm" class="p-4 border rounded shadow bg-light mt-5">
            <div class="mb-3">
                <label for="email" class="form-label">Inerisci la tua email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email" required>
          
            </div>


            <button type="submit" class="btn btn-success">Login</button>
            <a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$baseUrl ?>" class="altrimenti-registrati">Indietro</a>


        </form>

        </div>

    </div>
</div>




