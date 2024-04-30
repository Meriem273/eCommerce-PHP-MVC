<?php

require_once('../app/core/controller.php');

class Admin extends Controller
{
    //partie index
    //Charger le model User et la view admin/index 
    
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin']);
        if (is_object($userData)) {
            $data['userData'] = $userData;
        }
        $data['pageTitle'] = "Admin - Home";
        $this->view("admin/index", $data);
    }

    //partie categories
    //Charger le model User et la view admin/categories

    public function categories()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        // obtenir toutes les categories et le tableau HTML
        $category = $this->loadModel('Category');
        $allCategories = $category->getAll();
        $tableHTML = $category->makeTable($allCategories);
        $noCat = "";

        if (strlen($tableHTML == "")) {
            $noCat =  "<p class='text-center'>Vous devez en ajouter au moins une categorie </p>";
        }

        $data['noCat'] = $noCat;
        $data['tableHTML'] = $tableHTML;
        $data['pageTitle'] = "Admin - Categories";
        $this->view("admin/categories", $data);
    }

    //partie produits
    //Charger le model User et la view admin/categories
    
    public function products($method = false, $arg = "")
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $product = $this->loadModel('Product');

        if ($method === "add") {
            $this->addProduct($data, $product);
        } elseif ($method === "update") {
            $this->updateProduct($data, $product,  $arg);
        } elseif ($method === "home") {
            // obtenir tous les produits et le tableau HTML
            $allProducts = $product->getAllProducts();
            $tableHTML = $product->makeTable($allProducts);
            $noProd = "";

            if (strlen($tableHTML == "")) {
                $noProd =  "<p class='text-center'>Vous devez avoir au moins une catégorie</p>";
            }

            $data['noProd'] = $noProd;
            $data['tableHTML'] = $tableHTML;
            $data['pageTitle'] = "Admin - Products";
            $this->view("admin/products", $data);
        }
    }

    
     //afficher les commandes des utilisateurs
     //retourne la view admin/commands
    
    public function commands()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $commandModel = $this->loadModel("CommandModel");
        $allCommands = $commandModel->getAllCommands();
        $commandsHTML = $commandModel->makeTable($allCommands);
        $noCom = "";

        if (strlen($commandsHTML == "")) {
            $noCom =  "<p class='text-center'>Aucun client n'a passé de commande </p>";
        }

        $data['noCom'] = $noCom;
        $data['commandsHTML'] = $commandsHTML;
        $data['pageTitle'] = "Admin - Commandes";
        $this->view("admin/commands", $data);
    }

    //partie ajouter produit 
    //charger la view admin/products/add
    //retourne la view admin/products/add 
     
    public function addProduct($data, $productModel)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $productModel->create();
            header("Location: " . ROOT . "admin/products");
        }

        // get all the categories for the select in the form addProduct
        $category = $this->loadModel('Category');
        $allCategories = $category->getAll();
        $selectHTML = $productModel->makeSelectCategories($allCategories);

        if ($selectHTML == "") {
            header("Location: " . ROOT . "admin/categories");
        }

        $data['selectHTML'] = $selectHTML;
        $data['categories'] = $allCategories;
        $data['pageTitle'] = "Admin - Add Product";
        $this->view("admin/addProduct", $data);
    }

    //partie pour supprimer un produit en fonction de lid
     
    public function deleteProduct($idProduct)
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }
        //obtenir toutes les donnees sur le produit
        $product = $this->loadModel('Product');
        $product->deleteProduct($idProduct);
    }

    //partie update produit
    //retourne la view admin/updateProduct
     
    public function updateProduct($data, $product, $idProduct)
    {
        $singleProduct  = $product->getOneProduct($idProduct);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $singleProduct  = $product->getOneProduct($idProduct);
            $product->updateProduct($singleProduct[0]->idProduct);
        }

        // get the datas about the produt
        $category = $this->loadModel('Category');
        $allCategories = $category->getAll();
        $selectHTML = $product->makeSelectCategories($allCategories);
        $data['selectHTML'] = $selectHTML;
        $data['categories'] = $allCategories;
        $data['product'] = $singleProduct[0];
        $data['pageTitle'] = "Admin - update Product";
        $this->view("admin/updateProduct", $data);
    }

    //partie users
    //lis et affiche tous les utilisateurs
    //retourne la view admin/users
    public function users($method = false, $arg = "")
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        if ($method === "viewAdmins") {
            $this->viewAdmins($data, $user);
        } elseif ($method === "viewCustomers") {
            $this->viewCustomers($data, $user);
        } elseif ($method === "home") {
            $allUsers = $user->getAllUsers();
            $usersHTML = $user->makeTableUsers($allUsers);
            $noCus = "";
            $data['noCus'] = $noCus;
            $data['users'] = $usersHTML;
            $data['pageTitle'] = "Admin - Users";
            $this->view("admin/users", $data);
        }
    }

    //partie admins
    //lis et affiche tous les utilisateurs admins
    

    public function viewAdmins($data, $user)
    {
        $allAdmins = $user->getAllAdmins();
        $adminsHTML = $user->makeTableUsers($allAdmins);
        $data['users'] = $adminsHTML;
        $data['pageTitle'] = "Admin - Views Admins";
        $noCus = "";

        $data['noCus'] = $noCus;
        $this->view("admin/users", $data);
    }

    
    //lis et affiche tous les utilisateurs clients
    public function viewCustomers($data, $user)
    {
        $allCustomers = $user->getAllCustomers();
        $customersHTML = $user->makeTableUsers($allCustomers);

        $noCus = "";

        if (strlen($customersHTML == "")) {
            $noCus =  "<p class='text-center'>Vous n'avez aucun client inscrit dans votre site ! Il fallait penser au référencement ;)</p>";
        }

        $data['noCus'] = $noCus;
        $data['users'] = $customersHTML;
        $data['pageTitle'] = "Admin - Views Customers";
        $this->view("admin/users", $data);
    }
}
