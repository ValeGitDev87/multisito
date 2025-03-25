<?php
use Core\Config;


function url($path = '') {
    return rtrim(Config::getValue('app.base_url'), '/') . '/' . ltrim($path, '/');
}
