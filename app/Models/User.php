<?php
namespace App\Models;

use ORM;

class User {
    /**
     * Trova un utente per email
     */
    public static function findByEmail($email)
    {
        return ORM::for_table('users')->where('email', $email)->find_one();
    }
}
