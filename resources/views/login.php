
<?php
use Core\Config;

$config = Config::getInstance();
$baseUrl = $config->get('app.base_url');  

$url = $baseUrl.'/login';

$currentPath = trim($_SERVER['REQUEST_URI'], '/'); // Rimuove eventuali slash iniziali/finali    
$url = trim($baseUrl, '/') . '/register'; // Assicura che il baseUrl non abbia slash extra

if ($currentPath === $url) {
    echo '<script src="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $baseUrl . '/public/js/login.js"></script>';
} 
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
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" required>
            </div>
    
            <button type="submit" class="btn btn-success">Login</button>
            <a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$baseUrl ?>/register" class="altrimenti-registrati">altrimenti registrati</a>


        </form>

        </div>

    </div>
</div>