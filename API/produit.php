<?php 
include_once("../models/connexionBD.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "GET": 
        if (!isset($_GET['id'])) {
            echo json_encode(connectionBd::getProd());
        } else {
            echo json_encode(connectionBd::getProdById($_GET['id']));
        }
        break;
    case "POST":
        $result = array(
            "result" => false,
        );

        if (isset($_POST['libelle']) && isset($_POST['posologie'])) {
            $result["result"] = connectionBd::createProd($_POST['libelle'], $_POST['posologie']);
        } else {
            $result['message'] = "Il manque un paramètre ";
        }

        echo json_encode($result);
        break;
    case "PUT":
        
        break;
    case "DELETE":

        break;
}
?>