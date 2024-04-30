<?php

require_once('../app/core/controller.php');

class Logout extends Controller
{
   //charge le model User et la methode logout 
     
    public function index()
    {
        $user = $this->loadModel('User');
        $user->logout();
    }
}
