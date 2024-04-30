<?php

require_once('../app/core/controller.php');

class CategoryAjax extends Controller
{
    public $category;

    public function __construct()
    {
        $this->category = $this->loadModel('Category');
    }

    
    //obtenir les données du js et faire les requêtes sql
     // méthode d'un contrôleur qui traite les requêtes POST JSON. Elle examine les données JSON reçues pour déterminer le type d'action à effectuer (ajout, suppression ou mise à jour de catégorie) et appelle la méthode appropriée en fonction du type d'action.

// Elle récupère les données JSON entrantes à partir de la demande POST à l'aide de file_get_contents("php://input").
// Elle utilise json_decode() pour décoder les données JSON en un objet PHP.
// Elle vérifie si l'objet $data est bien un objet et si la propriété dataType est définie à l'intérieur de cet objet.
// En fonction de la valeur de dataType, elle appelle les méthodes appropriées pour ajouter, supprimer ou mettre à jour une catégorie.

// la requete POST contient les données JSON attendues avec une propriété dataType.
    public function index()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data);

        if (is_object($data) && isset($data->dataType)) {

            if ($data->dataType == "addCategory") {
                $this->createCategory($data);
            } elseif ($data->dataType == "deleteCategory") {
                $this->deleteCategory($data);
            } elseif ($data->dataType == "updateCategory") {
                $this->updateCategory($data->idCategory, $data->nameCategory);
            }
        }
    }

   //insérer une catégorie dans le BDD et renvoyer l’erreur ou le succès du message
    
    private function createCategory($data)
    {
        $result = $this->category->create($data);
        if ($result) {
            $arr['message'] = "Insertion OK";
            $arr['messageType'] = "info";
            $categories = $this->category->getAll();
            $arr['data'] = $this->category->makeTable($categories);
            $arr['dataType'] = "addCategory";
            echo json_encode($arr);
        } else {
            $arr['message'] = $_SESSION['error'];
            unset($_SESSION['error']);
            $arr['messageType'] = "error";
            $arr['data'] = "";
            $arr['dataType'] = "addCategory";
            echo json_encode($arr);
        }
    }

    
     //supprime une categorie de la bdd
    
    private function deleteCategory($data)
    {
        $result = $this->category->delete($data->data);
        if ($result) {
            $arr['message'] = "Supression faite";
            $arr['messageType'] = "info";
            $categories = $this->category->getAll();
            $arr['data'] = $this->category->makeTable($categories);
            $arr['dataType'] = "deleteCategory";
            echo json_encode($arr);
        } else {
            $arr['message'] = $_SESSION['error'];
            unset($_SESSION['error']);
            $arr['messageType'] = "error";
            $arr['data'] = "";
            $arr['dataType'] = "deleteCategory";
            echo json_encode($arr);
        }
    }

    
     //mettre à jour le nom d’une catégorie dans le DB

     
    private function updateCategory($idCategory, $nameCategory)
    {
        $result = $this->category->updateCategory($idCategory, $nameCategory);

        if ($result) {
            $arr['message'] = "Modification de la catégorie faite";
            $arr['messageType'] = "info";
            $categories = $this->category->getAll();
            $arr['data'] = $this->category->makeTable($categories);
            $arr['dataType'] = "updateCategory";
            echo json_encode($arr);
        } else {
            $arr['message'] = $_SESSION['error'];
            unset($_SESSION['error']);
            $arr['messageType'] = "error";
            $arr['data'] = "";
            $arr['dataType'] = "updateCategory";
            echo json_encode($arr);
        }
    }
}
