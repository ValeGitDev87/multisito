
<?php
use Core\Config;
use Core\Script;

$config = Config::getInstance();
$baseUrl = $config->get('app.base_url');

// Crea un'istanza di ScriptManagement
$scriptManager = new Script($config);


$script= $scriptManager->render('register.js', '/register');

?>
<div class="container ">

    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-6 col-12  mt-5">

        <h1>Registrati</h1>
        <form id="registerForm" class="p-4 border rounded shadow bg-light mt-5">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
           
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="surname" name="surname" aria-describedby="surnameHelp" require>
            </div>

            <div class="mb-3">
                <label for="emai" class="form-label">Email </label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
  
            </div>

            <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" name="password" required>
            </div>


            <div class="mb-3">
                <label for="pwdConfirm" class="form-label">Conferma Password</label>
                <input type="password" class="form-control" id="pwdConfirm" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-success">Registrati</button>
            <a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$baseUrl ?>/login" class="altrimenti-registrati">sei registrato? vai al login</a>


        </form>

        </div>

    </div>
</div>
