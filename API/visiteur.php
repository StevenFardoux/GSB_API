<?php 
include_once("../models/connexionBD.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "GET": 
        if (!isset($_GET['id'])) {
            echo json_encode(connectionBd::getVisiteurs());
        } else {
            echo json_encode(connectionBd::getVisiteurByID($_GET['id']));
        }
        break;
    case "POST":
            $result = array(
                "result" => false,
            );

            if (isset($_POST['nom']) && isset($_POST['prenom'])) {
                $result["result"] = connectionBd::createVisiteur($_POST['nom'], $_POST['prenom']);
            } else {
                $result['message'] = "Il manque un paramètre ";
            }

            echo json_encode($result);
        break;
    case "PUT":
        $donnees = file_get_contents("php://input");
        parse_str($donnees, $data);

        echo json_encode(connectionBd::modifVistiteur($data));
        break;
    case "DELETE":
        echo json_encode(connectionBd::delVisiteur($_GET['idVisiteur']));
        break;
}
?>