<?php
namespace App\Controllers;

class HomeController extends BaseController {

    public function index()
    {
        $data = [
            'title'   => 'Home Page',
            'message' => 'Benvenuto nella Home!',
            'meta'    => [
                'title'       => 'Home Page',
                'description' => 'Questa è la home del mio sito.',
                'keywords'    => 'home, sito, esempio'
            ]
        ];

        $this->view('home', $data);
    }
}
