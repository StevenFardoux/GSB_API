<?php 
include_once("../models/connexionBD.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");


$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "GET": 
        // Créer une clé "result" dans le tableau "result" et lui assigne la valeur false
        $result = array(
            "result" => false,
        );

        // Verifie si la clé idVisite est présente dans le tableau GET et si c'est un nombre
        if (isset($_GET['idVisite']) && is_numeric($_GET['idVisite'])) {
            /*
                Si la clé idVisite est présente dans le tableau GET et si c'est un nombre
                Alors on appelle la fonction getVisiteById avec la valeur de la clé
            */
            $result["data"] = connectionBd::getVisiteById($_GET['idVisite']);
            // Défini la clé result de la variable result à true
            $result["result"] = true;
        } else {
            /*
                Si la clé idVisite n'est pas présente dans le tableau GET, alors on appelle la fonction getVisites
                et on stocke le résultat dans la clé data du tableau result
            */
            $result["data"] = connectionBd::getVisites();
            // Défini la clé result de la variable result à true
            $result["result"] = true;
        }

        // Encode le tableau result en JSON et l'affiche
        echo json_encode($result);
        break;
    case "POST":
        // Créer une clé "result" dans le tableau "result" et lui assigne la valeur false
        $result = array(
            "result" => false,
        );

        // Créer une variable "missingArgs" et lui assigne la valeur ""
        $missingArgs = "";

        if (!isset($_POST['idMedecin'])) { // Si la variable "idMedecin" n'est pas définie
            $missingArgs .= "idMedecin, "; // Ajoute la chaine de caractère "idMedecin, " à la variable "missingArgs"
        }
        if (!isset($_POST['idVisiteur'])) { // Si la variable "idVisiteur" n'est pas définie
            $missingArgs .= "idVisiteur, "; // Ajoute la chaine de caractère "idVisiteur, " à la variable "missingArgs"
        }
        if (!isset($_POST['adresse'])) { // Si la variable "adresse" n'est pas définie
            $missingArgs .= "adresse, "; // Ajoute la chaine de caractère "adresse, " à la variable "missingArgs"
        }
        if (!isset($_POST['dateVisite'])) { // Si la variable "dateVisite" n'est pas définie
            $missingArgs .= "dateVisite, "; // Ajoute la chaine de caractère "dateVisite, " à la variable "missingArgs"
        }


        // Si la longueur de la variable "missingArgs" est supérieur à 0
        if (strlen($missingArgs) > 0) { 
            // Supprime les 2 derniers caractères de la variable "missingArgs"
            $missingArgs = substr($missingArgs, 0, strlen($missingArgs) - 2);
            // Ajoute la chaine de caractère "Il manque les arguments suivants : " à la variable "missingArgs"
            $result["message"] = "Il manque les arguments suivants : " . $missingArgs;
            http_response_code(400);
        } else { 
            // Si la variable "missingArgs" est vide, alors on appelle la fonction "creationVisite" avec les paramètres suivants
            $result["result"] = connectionBd::creationVisite($_POST['idMedecin'], $_POST['idVisiteur'], $_POST['adresse'], $_POST['dateVisite'], $_POST['idProduit']); //add the result of the function "creationVisite" to the array "result"
        }

        

        // Encode le tableau result en JSON et l'affiche
        echo json_encode($result);
        break;
    case "PUT":
        // On récupère les données envoyées par le client
        // $data = json_decode(file_get_contents("php://input"), true);

        $donnees = file_get_contents("php://input");
        parse_str($donnees, $data);


        // Créer une clé "result" dans le tableau "result" et lui assigne la valeur false
        $result = array(
            "result" => false,
        );

        // Créer une variable "missingArgs" et lui assigne la valeur ""
        $result["result"] = connectionBd::modifVisite($data);
        
        // Encode le tableau result en JSON et l'affiche
        echo json_encode($result);
        break;
    case "DELETE":
        // On récupère les données envoyées par le client
        $data = $_GET;

        // Créer une clé "result" dans le tableau "result" et lui assigne la valeur false
        $result = array(
            "result" => false,
        );

        // Si la clé idVisite n'est pas définie
        if (!isset($data['idVisite'])) {
            // Ajoute la chaine de caractère "Il manque l'argument id" à la clé message du tableau result
            $result["message"] = "Il manque l'argument id";
            $result["result"] = false;
        } else {
            // Sinon on appelle la fonction delVisite avec la valeur de la clé idVisite
            $result["result"] = connectionBd::delVisite($data['idVisite']);
        }

        // Encode le tableau result en JSON et l'affiche
        echo json_encode($result);
        break;
}
?>
