<?php

//affiche les données dans un format lisible

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

//vérifie s’il y a une erreur et l'affiche

function checkError()
{
    $msgError = "";
    if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
        $msgError .= '<div class="bg-danger p-3">
                            <span style="font-size:24px" >' . $_SESSION['error'] . '</span>
                    </div>';
    }
    unset($_SESSION['error']);
    echo $msgError;
}


 // valide les data avant linsertion dans la bdd

function validateData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
