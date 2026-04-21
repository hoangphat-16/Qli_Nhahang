<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'title' => APPNAME, 

        ];

        $this->sendPage('index', $data);
    }
}
