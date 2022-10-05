<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\authController;

class indexController extends Controller
{

    public function __construct()
    {
        $this->valid = new authController();
    }


    public function index()
    {
        return view('login', [
            'title' => 'Login', 
            'action' => '',
            'erro' => ''
        ]);
    }

    public function mainPage()
    {

        if($this->valid->validation()){
            return view('mainPage', [
                'title' => 'CRI - Controle de Registros de Inspeção', 
                'action' => '',
                'erro' => ''
            ]);
        }else{
            return $this->valid->redirectToLogin();
        }
    }
}
