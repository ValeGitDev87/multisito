
<?php
use Core\Config;

$config = Config::getInstance();
$baseUrl = $config->get('app.base_url');
$currentPath = trim($_SERVER['REQUEST_URI'], '/'); // Rimuove eventuali slash iniziali/finali    

$url = $baseUrl.'/register';

$currentPath = trim($_SERVER['REQUEST_URI'], '/'); // Rimuove eventuali slash iniziali/finali    
$url = trim($baseUrl, '/') . '/register'; // Assicura che il baseUrl non abbia slash extra

if ($currentPath === $url) {
    echo '<script src="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $baseUrl . '/public/js/register.js"></script>';
} 

?>
<div class="container ">

    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-6 col-12  mt-5">

        <h1>Registrati</h1>
        <form id="registerForm" class="p-4 border rounded shadow bg-light mt-5">
            <div class="mb-3">
                <label for="name" class="form-label">Nome Utente</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
           
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="surname" aria-describedby="surnameHelp" require>
            </div>

            <div class="mb-3">
                <label for="emai" class="form-label">Email </label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
  
            </div>

            <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" required>
            </div>


            <div class="mb-3">
                <label for="pwdConfirm" class="form-label">Conferma Password</label>
                <input type="password" class="form-control" id="pwdConfirm" required>
            </div>

            <button type="submit" class="btn btn-success">Registrati</button>
            <a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$baseUrl ?>/login" class="altrimenti-registrati">sei registrato? vai al login</a>


        </form>

        </div>

    </div>
</div>