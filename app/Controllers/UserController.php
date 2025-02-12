<?php
namespace App\Controllers;

class UserController extends BaseController {
    public function show($id) {
        $data = [
            'title'   => "Profilo Utente $id",
            'message' => "Benvenuto nel profilo dell'utente con ID: $id",
            'meta'    => [
                'title'       => "Profilo Utente $id",
                'description' => "Dettagli dell'utente con ID $id."
            ]
        ];
        $this->view('user', $data,true);
    }
}
