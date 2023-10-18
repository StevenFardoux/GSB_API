<?php 
include_once("../models/connexionBD.php");

//getVisiteurs
var_dump(file_get_contents("http://localhost/gsb/api/gsb_api/API/visiteur.php"));

//getVisiteurByID
var_dump(file_get_contents("http://127.0.0.2/API/visiteur.php?id=1"));


//createVisiteur
$url = 'http://localhost/gsb/api/gsb_api/API/visiteur.php';
$data = array('nom' => 'test', 'prenom' => 'test');
$options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($data),
    )
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
echo $response;

// //modifVisiteur
$url = 'http://localhost/gsb/api/gsb_api/API/visiteur.php';
$data = array('idVisiteur' => 11, 'nom' => 'test', 'prenom' => 'bbb');
$data_json = json_encode($data);
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n" .
                     "Content-Length: " . strlen($data_json) . "\r\n",
        'method'  => 'PUT',
        'content' => $data_json,
    ),
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
if ($response === false) {
    echo 'Erreur file_get_contents : ' . error_get_last()['message'];
} else {
    echo 'Réponse : ' . $response;
}

//delMedecin
$url = 'http://localhost/gsb/api/gsb_api/API/visiteur.php';
$data = array('id' => 11);
$data_json = json_encode($data);
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n" .
                     "Content-Length: " . strlen($data_json) . "\r\n",
        'method'  => 'DELETE',
        'content' => $data_json,
    ),
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

// // Traitement de la réponse
if ($response === false) {
    echo 'Erreur file_get_contents : ' . error_get_last()['message'];
} else {
    echo 'Réponse : ' . $response;
}

?>