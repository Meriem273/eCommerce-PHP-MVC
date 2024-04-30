<?php

require_once('../app/core/controller.php');

class Profil extends Controller
{
    
    //charge le model User et la view profil
     
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);
        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $data['pageTitle'] = "Profil";
        $this->view('profil', $data);
    }

    
    // mettre a jour les donnes dun utilisateur dans la bdd 
    
    public function update()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            show($_POST);
            $user->updateUser($userData->idMember);
        }

        $data['pageTitle'] = "Modifier Profil";
        $this->view('updateProfil', $data);
    }

    //supprimer un utilisateur de la bdd
    public function delete()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $user->deleteUser($userData->idMember);
    }

    //affiche les commandes passees par le user

    public function commands()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $command = $this->loadModel('CommandModel');
        $allCommandsUser = $command->getAllCommandsUser($userData->idMember);
        $commandsHTML =  $command->makeTableUser($allCommandsUser);
        $noCommand = "";

        if (strlen($commandsHTML == "")) {

            $noCommand =  "<p class='text-center'>Vous n'avez aucune commande</p>";
        }

        $data['noCommand'] = $noCommand;
        $data['commands'] = $commandsHTML;
        $this->view('commands', $data);
    }
}
