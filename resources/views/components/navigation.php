<?php
use Core\Config;
use Core\Session;

$config = Config::getInstance();
$user = Session::get('user_name');
$surname = Session::get('user_surname');
?>
<style>
  
.hover-target {
  position: relative;
  cursor: pointer;
}

.hover-target::after {
  content: "Logout";
  position: absolute;
   top: -2px; /* tooltip sopra l'icona */
  left: 230%;
  transform: translateX(-50%);
  background-color:#ffc41e;
  color: #fff;
  padding: 3px;
  border-radius: 4px;
  white-space: nowrap;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease;
  font-size: 18px;
  z-index: 9999; /* molto alto per sovrascrivere boostrap */
}

.hover-target:hover::after {
  opacity: 1;
  visibility: visible;
}



</style>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
    <div class="container-fluid">
      <?php if (Session::has('user_id')): ?>
        <!-- Se l'utente è loggato, mostra il profilo e il link di logout -->
        <a class="navbar-brand d-flex align-items-center" href="<?php echo $config->get('app.base_url'); ?>">
          <i style="font-size: 25px; margin-top: 4px;" class="fa-solid fa-circle-user me-2 text-success"></i>
          <span class="ms-2 d-none d-lg-block text-success fw-bold">Benvenuto</span>
          <span class="ms-2"><?php echo $user; ?></span>
          <span class="ms-2"><?php echo $surname; ?></span>
        </a>
        <div class="container-hover">
        <a class="navbar-brand d-flex align-items-center text-warning hover-target" 
            href="<?= $config->get('app.base_url') ?>/logout">
            <i class="fa fa-sign-out ms-2" aria-hidden="true"></i>
          </a>
        </div>
    


      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div  class="collapse navbar-collapse" id="navbarSupportedContent">
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
  <?php else: ?>
      <h3>Your CDM </h3>
    <?php endif; ?>
</header>
