<?php 
include_once("../models/connexionBD.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");


$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "GET": 
        if (!isset($_GET['id'])) {
            //getMedecins
            echo json_encode(connectionBd::getMedecins());
        } else {
            //getMedecinByID
            echo json_encode(connectionBd::getMedecinById($_GET['id']));
        }
        break;
    case "POST":
        $result = array(
            "result" => false,
        );

        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['motDePasse']) && isset($_POST['dateCreation']) && isset($_POST['rpps']) && isset($_POST['dateDiplome'])) {
            $result["result"] = connectionBd::creationMedecin($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['motDePasse'], $_POST['dateCreation'], $_POST['rpps'], $_POST['dateDiplome']);
        } else {
            $result["message"] = "Il manque des paramètres";
        }

        echo json_encode($result);
        break;
    case "PUT":
        $donnees = file_get_contents("php://input");
        parse_str($donnees, $data);
        
        echo json_encode(connectionBd::modifMedecin($data));
        break;
    case "DELETE":
        echo json_encode(connectionBd::delMedecinById($_GET['id']));
        break;
}
?>
