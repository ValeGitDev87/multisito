<?php
namespace App\Models;

use ORM;

class User {
    
    protected static $table = 'users'; // Nome della tabella nel DB
    protected static $fillable = ['name', 'surname', 'email', 'password']; // Campi assegnabili in massa

    /**
     * Trova un utente per email.
     */
    public static function findByEmail($email) {

        return ORM::for_table(self::$table)->where('email', $email)->find_one();
    }

    /**
     * Crea un nuovo utente in modo sicuro con i campi fillable.
     */
    public static function create(array $data) {

        $user = ORM::for_table(self::$table)->create();

        foreach (self::$fillable as $field) {
            if (isset($data[$field])) {
                $user->$field = $data[$field];
            }
        }

        $user->save();
        return $user;
    }

    public static function controlToken($token)
    {
        $user = ORM::for_table(self::$table)->where("reset_token",$token)->find_one();
        if(!empty($user)){
            $expires = new \DateTime($user->reset_token_expires);
            $now = new \DateTime();
            
            if ($now > $expires) {
                echo "<div style='padding:50px; margin-top:200px; width:100%; background-color:red; color:white;> 
    
                <h2 style:'text-aling:center;'>Attenzione Token Scaduto Rifare la procedura</h2>
                </div>";
                exit;
            }
        }
       
        

    }

    
    
    
}
