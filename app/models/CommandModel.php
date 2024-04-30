<?php

class CommandModel
{
    //inserer une commande dans la bdd
    public function create()
    {
        $db = Database::getInstance();
        $montant = 0;

        for ($i = 0; $i < count($_SESSION['cart']['price']); $i++) {
            $montant += $_SESSION['cart']['price'][$i] * $_SESSION['cart']['quantity'][$i];
        }

        $arr['idUserCommand'] = $_SESSION['idMember'];
        $arr['amountCommand'] = $montant;

        $query = "INSERT INTO command (idUserCommand, amountCommand, dateCommand) 
             VALUES (:idUserCommand, :amountCommand, NOW())";
        $db->write($query, $arr);

        $idCommand =  $db->getLastInsertId();
        $this->createDetailsCommand($idCommand);
        return $idCommand;
    }

    //inserer les details dune commande
    public function createDetailsCommand($idCommand)
    {
        $db = Database::getInstance();

        for ($i = 0; $i < count($_SESSION['cart']['idProduct']); $i++) {
            $arr['idCommandDetailsCommand'] = $idCommand;
            $arr['idProductDetailsCommand'] = $_SESSION['cart']['idProduct'][$i];
            $arr['quantityDetailsCommand'] = $_SESSION['cart']['quantity'][$i];
            $arr['priceDetailsCommand'] = $_SESSION['cart']['price'][$i];

            $query = "INSERT INTO detailsCommand (idCommandDetailsCommand, idProductDetailsCommand, quantityDetailsCommand, priceDetailsCommand)
            VALUES (:idCommandDetailsCommand, :idProductDetailsCommand, :quantityDetailsCommand, :priceDetailsCommand)";

            $db->write($query, $arr);
        }
    }

    //selectionner toutes les commandes de la bdd
    public function getAllCommands()
    {
        $db = Database::getInstance();
        $result = $db->read("SELECT * FROM command ORDER BY idCommand DESC");
        return $result;
    }

    //selectionner toutes les commandes d'un utilisateur

    public function getAllCommandsUser($idMember)
    {
        $db = Database::getInstance();
        $result = $db->read("SELECT * FROM command WHERE idUserCommand = $idMember");
        return $result;
    }

    //afficher les commandes en tableau html
    public function makeTable($commands)
    {
        $tableHTML = "";
        if (is_array($commands)) {
            foreach ($commands as $command) {
                $date = date("d/m/Y H:i:s", strtotime($command->dateCommand));
                $tableHTML .= '<tr>
                            <th scope="row">' . $command->idCommand . '</th>
                            <td>' . $command->idUserCommand . '</td>
                            <td>' . $command->amountCommand . '</td>
                            <td>' . $date . '</td>
                            <td>' . $command->stateCommand . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }

    //afficher les commandes des utilisateurs en tableau html

    public function makeTableUser($commands)
    {
        $tableHTML = "";
        if (is_array($commands)) {
            foreach ($commands as $command) {
                $date = date("d/m/Y H:i:s", strtotime($command->dateCommand));
                $tableHTML .= '<tr>
                <td>' . $date . '</td>
                            <td>' . $command->amountCommand . '</td>
                            <td>' . $command->stateCommand . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}
