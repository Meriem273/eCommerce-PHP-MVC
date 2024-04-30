<?php

require_once('../app/core/controller.php');

class Login extends Controller
{
    
     //charge le model User et la view login
     
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $user = $this->loadModel("User");
            $user->login();
        }

        $data['pageTitle'] = "Login";
        $this->view("login", $data);
    }
}
