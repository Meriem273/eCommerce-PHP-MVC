<?php

require_once('../app/core/controller.php');

class Products extends Controller
{
    
     //charge le model User model et la view home

    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $product = $this->loadModel('Product');
        $allProducts = $product->getAllProducts();
        $htmlProducts = $product->makeFrontProducts($allProducts);
        $data['htmlProducts'] = $htmlProducts;

        if (strlen($htmlProducts) == 0) {
            $data['htmlProducts'] = "Il n'y a aucun livre pour l'instant dans notre site. Revenez plus tard ! ";
        }

        $data['pageTitle'] = "Produits";
        $this->view("products", $data);
    }

    
     //obtenir les données sur le produit et charger les detailsProduitt de la view

    public function details($idProduct)
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        //obtenir toutes les donnees du produit 
        $product = $this->loadModel('Product');
        $singleProduct = $product->getOneProduct($idProduct);

        $data['product'] = $singleProduct[0];
        $data['pageTitle'] = "Details Produit";
        $this->view("detailsProduct", $data);
    }
}
