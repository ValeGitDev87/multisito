<?php
namespace App\Controllers;

class AboutController extends BaseController{
    public function index()
    {
        $data = [
            'title'   => 'About Page',
            'message' => 'Pagina info azienda',
            'meta'    => [
                'title'       => 'Aboute Page',
                'description' => 'Questa è la about del mio sito.',
                'keywords'    => 'home, sito, esempio'
            ]
        ];

        $this->view('about', $data);
    }
}
