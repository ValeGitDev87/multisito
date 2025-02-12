<?php
namespace App\Controllers;

use Core\Request;
use Core\Validator;

class HomeController extends BaseController {
    protected $request;
    protected $validator;

    public function __construct(Request $request, Validator $validator) {
        $this->request = $request;
        $this->validator = $validator;
    }

    public function index()
    {
        if ($this->request->isPost()) { //  Se la richiesta è POST, validiamo i dati
            $data = $this->request->all();

            $rules = [
                'name'  => 'required|min:3|max:50',
                'email' => 'required|email'
            ];

            if ($this->validator->validate($data, $rules)) {
                // ✅ Dati validi → Rispondiamo con JSON
                echo json_encode([
                    'success' => true,
                    'message' => 'Dati validi!',
                    'data' => $data
                ]);
                exit;
            } else {
                // ❌ Dati non validi → Rispondiamo con errori in JSON
                echo json_encode([
                    'success' => false,
                    'errors' => $this->validator->errors()
                ]);
                exit;
            }
        }

        $data = [
            'title'   => 'Home Page',
            'message' => 'Pagina di benvenuto',
            'meta'    => [
                'title'       => 'Home Page',
                'description' => 'Questa è la home del mio sito.',
                'keywords'    => 'home, sito, esempio'
            ]
        ];
        // 🚀 Se la richiesta è normale (GET), mostriamo la vista HTML
        $this->view('home', $data);
    }
}
