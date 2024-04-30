<?php

require_once('../app/core/controller.php');

class Signup extends Controller
{
    
    //charge le model User et la view signup
    
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $user = $this->loadModel("User");
            $user->signup();
        }

        $data['pageTitle'] = "Signup";
        $this->view("signUp", $data);
    }
}
