
<?php
use Core\Config;
use Core\Session;
$config = Config::getInstance();
$user = Session::get('user_name');

?>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <!-- Navbar brand con icona, nome e messaggio "Benvenuto" -->
      <a class="navbar-brand d-flex align-items-center" href="<?php echo $config->get('app.base_url'); ?>">
        <i class="fa-solid fa-circle-user me-2"></i>
        <span><?php echo $user; ?></span>
        <small class="ms-2 d-none d-lg-block">Benvenuto</small>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <!-- Aggiungi altri elementi della navbar se necessario -->
        </ul>
      </div>
    </div>
  </nav>

</header>


