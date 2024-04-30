<?php

require_once('../app/core/controller.php');

class Page404 extends Controller
{

    // charge le model User et la view home

    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $data['css'] = "css/404.css";
        $this->view("404", $data);
    }
}
