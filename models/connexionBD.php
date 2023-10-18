<?php 
class connectionBd {
    private static $server = "localhost";
    private static $bd = "sio";
    private static $user = "root";
    private static $pwd = "";
    public static $monPdo;
    

    public function __construct() {
        if (!isset(connectionBd::$monPdo)) {
            connectionBd::$monPdo = new PDO("mysql:host=" . connectionBd::$server . ";dbname=" . connectionBd::$bd, connectionBd::$user, connectionBd::$pwd);
        }

        return connectionBd::$monPdo;

    }

    public static function getPdo() {
        if (connectionBd::$monPdo == null) {
            new connectionBd();
        }

        return connectionBd::$monPdo;
    }
    
    public static function getVisiteurs() {
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("SELECT idVisiteur, nom, prenom FROM visiteur");

        if ($monObjectPdo->execute()) {
            return $monObjectPdo->fetchAll();
        } else {
            throw new Exception("erreur dans la requête");
        }
    }

    public static function getVisiteurByID($id) {
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("SELECT idVisiteur, nom, prenom FROM visiteur WHERE idVisiteur = :id");
        $bvc = $monObjectPdo->bindValue(':id', $id);

        if ($monObjectPdo->execute()) {
            return $monObjectPdo->fetch();
        } else {
            throw new Exception("erreur dans la requête");
        }
    }

    public static function createVisiteur($nom, $prenom) {
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("INSERT INTO visiteur VALUE(null, :nom, :prenom)");
        $bvc =$monObjectPdo->bindValue(':nom', $nom);
        $bvc =$monObjectPdo->bindValue(':prenom', $prenom);

        $monObjectPdo->execute();
    }

    public static function modifVistiteur($data = array()) {
        $pdo = connectionBd::getPdo();
        $query = "UPDATE visiteur SET ";

        foreach ($data as $key => $value) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = substr($query, 0, -2);
        $query .= " WHERE idVisiteur = :idVisiteur";

        $monObjectPdo = $pdo->prepare($query);

        return $monObjectPdo->execute($data);
    }  

    public static function delVisiteur($id) {
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("DELETE FROM visiteur WHERE idVisiteur = :id");
        $bvc = $monObjectPdo->bindValue(':id', $id);
        $monObjectPdo->execute();
    }

    public static function getMedecins(){
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("SELECT idmedecin,nom,prenom,mail,motDePasse,dateCreation,rpps,dateDiplome,dateConsentement FROM medecin;");

        if ($monObjectPdo->execute()) {
            return $monObjectPdo->fetchAll();
        } else {
            throw new Exception("erreur dans la requête");
        }
    }

    public static function getMedecinById($id){
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("SELECT idmedecin,nom,prenom,mail,motDePasse,dateCreation,rpps,dateDiplome,dateConsentement FROM medecin WHERE idMedecin = :id;");
        $bvc = $monObjectPdo->bindValue(':id' , $id );

        if ($monObjectPdo->execute()) {
            return $monObjectPdo->fetch();
        } else {
            throw new Exception("erreur dans la requête");
        }
    }

    public static function creationMedecin($nom, $prenom, $mail, $motDePasse, $dateCreation, $rpps, $dateDiplome){
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("INSERT INTO medecin(nom, prenom, mail, motDePasse, dateCreation, rpps, dateDiplome) VALUES (:nom, :prenom, :mail, :motDePasse, :dateCreation, :rpps, :dateDiplome)");

        return $monObjectPdo->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail,
            'motDePasse' => $motDePasse,
            'dateCreation' => $dateCreation,
            'rpps' => $rpps,
            'dateDiplome' => $dateDiplome
        ));
    }

    // public static function modifMedecin($id,$nom,$prenom,$mail,$motDePasse,$rpps,$dateDiplome){
    public static function modifMedecin($data = array()){
        $pdo = connectionBd::getPdo();
        $query = "UPDATE medecin SET ";

        foreach ($data as $key => $value) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = substr($query, 0, -2);
        $query .= " WHERE idMedecin = :idMedecin";


        $monObjectPdo = $pdo->prepare($query);

        return $monObjectPdo->execute($data);
        // $monObjectPdo = $pdo->prepare("UPDATE medecin SET nom = :nom,prenom = :prenom, mail = :mail, motDePasse = :motDePasse, rpps = :rpps,dateDiplome = :dateDiplome WHERE idMedecin = :id");
        // $bvc = $monObjectPdo->bindValue(':id' , $id );
        // $bvc = $monObjectPdo->bindValue(':nom' , $nom );
        // $bvc = $monObjectPdo->bindValue(':prenom' , $prenom );
        // $bvc = $monObjectPdo->bindValue(':mail' , $mail );
        // $bvc = $monObjectPdo->bindValue(':motDePasse' , $motDePasse );
        // $bvc = $monObjectPdo->bindValue(':rpps' , $rpps );
        // $bvc = $monObjectPdo->bindValue(':dateDiplome' , $dateDiplome );

        // $monObjectPdo->execute();
    }

    public static function delMedecinById($id){
        $pdo = connectionBd::getPdo();
        $monObjectPdo = $pdo->prepare("DELETE FROM medecin WHERE idMedecin = :id");
        $bvc = $monObjectPdo->bindValue(':id',$id);
        
        $monObjectPdo->execute();
    }

    /**
     * Récupère toutes les visites
     * @return array
     */
    public static function getVisites() : array
    {
        $pdo = connectionBd::getPdo();

        // Preparé la requête
        $monObjectPdo = $pdo->prepare("SELECT idVisite, idMedecin, idVisiteur, adresse, dateVisite, idProd, libelle, posologie FROM visite V INNER JOIN produit P  ON V.idProduit = P.idProd;");

        // Execute la requête
        $monObjectPdo->execute();

        // Récupère les résultats
        $visites = $monObjectPdo->fetchAll();

        // Si la requête a échoué
        if ($visites === false) {
            // Retourne un tableau vide
            return [];
        }

        // Créer un tableau vide
        $result = [];

        // Parcours les résultats
        foreach ($visites as $visite) {
            $tempArray = array();

            // Parcours les champs de la table
            foreach ($visite as $key => $value) {
                // Si la clé n'est pas numérique
                if (!is_numeric($key)) {
                    // Ajoute la clé et la valeur au tableau temporaire
                    $tempArray[$key] = $value;
                }
            }

            // Ajoute le tableau temporaire au tableau final
            $result[] = $tempArray;
        }

        // Retourne le tableau
        return $result;
    }

    /**
     * Récupère une visite par son id
     * @param $id
     * @return array
     */
    public static function getVisiteById(int $id): array
    {
        $pdo = connectionBd::getPdo();

        // Preparé la requête
        $monObjectPdo = $pdo->prepare("SELECT idVisite, idMedecin, idVisiteur, adresse, dateVisite FROM visite WHERE idVisite = :idVisite;");

        // Execute la requête
        $monObjectPdo->execute(['idVisite' => $id]);

        // Récupère les résultats
        $visite = $monObjectPdo->fetch();

        // Si la requête a échoué
        if ($visite === false) {
            return [];
        }

        // Créer un tableau vide
        $result = [];

        // Parcours les résultats
        foreach ($visite as $key => $value) {
            // Si la clé n'est pas numérique
            if (!is_numeric($key)) {
                // Ajoute la clé et la valeur au tableau
                $result[$key] = $value;
            }
        }

        // Retourne les visites
        return $result;
        
    }

    /**
     * Créer une visite
     * @param $idMedecin
     * @param $idVisiteur
     * @param $adresse
     * @param $dateVisite
     * @return bool
     */
    public static function creationVisite(int $idMedecin, int $idVisiteur, string $adresse, string $dateVisite, int $idProduit): bool
    {
        $pdo = connectionBd::getPdo();

        // Preparé la requête
        $monObjectPdo = $pdo->prepare("INSERT INTO visite(idMedecin, idVisiteur, adresse, dateVisite, idProduit) VALUES (:idMedecin, :idVisiteur, :adresse, :dateVisite, :idProduit);");

        // Execute la requête
        $monObjectPdo->execute([
            'idMedecin' => $idMedecin,
            'idVisiteur' => $idVisiteur,
            'adresse' => $adresse,
            'dateVisite' => $dateVisite,
            'idProduit' => $idProduit
        ]);

        // Retourne le résultat de la requête
        return $monObjectPdo->rowCount() > 0;
    }

    /**
     * Modifie une visite
     * @param $data array contenant les données à modifier
     * @return bool
     */
    public static function modifVisite($data = array()): bool
    {
        $pdo = connectionBd::getPdo();
        $query = "UPDATE visite SET ";

        // Boucle à travers le tableau de données pour créer une chaîne de requête.
        foreach ($data as $key => $value) {
            // Si la valeur est une chaîne, ajoute des guillemets autour de la valeur.
            $query .= $key . " = :" . $key . ", ";
        }

        // Supprime la dernière virgule et l'espace.
        $query = substr($query, 0, -2);
        // Ajoute la clause WHERE
        $query .= " WHERE idVisite = :idVisite";

        // Preparé la requête
        $monObjectPdo = $pdo->prepare($query);

        // Execute la requête
        $monObjectPdo->execute($data);

        // Retourne le résultat de la requête
        return $monObjectPdo->rowCount() > 0;
    }

    /**
     * Supprime une visite
     * @param $id
     * @return bool
     */
    public static function delVisite(int $id): bool
    {
        $pdo = connectionBd::getPdo();

        // Preparé la requête
        $monObjectPdo = $pdo->prepare("DELETE FROM visite WHERE idVisite = :idVisite;");
        $monObjectPdo->bindValue(':idVisite', $id);

        // Execute la requête
        $monObjectPdo->execute();

        // Retourne le résultat de la requête
        return $monObjectPdo->rowCount() > 0;
    }

    public static function getProd() {
        $pdo = connectionBd::getPdo();

        $monObjectPdo = $pdo->prepare("SELECT idProd, libelle, posologie FROM produit");
        $monObjectPdo->execute();

        return $monObjectPdo->fetchAll();
    }

    public static function getProdById($id) {
        $pdo = connectionBd::getPdo();

        $monObjectPdo = $pdo->prepare("SELECT idProd, libelle, posologie FROM produit WHERE idProd = :id");
        $monObjectPdo->bindValue(':id', $id);

        $monObjectPdo->execute();

        return $monObjectPdo->fetchAll();
    }

    public static function createProd($libelle, $posologie) {
        $pdo = connectionBd::getPdo();

        // Preparé la requête
        $monObjectPdo = $pdo->prepare("INSERT INTO produit VALUES(null, :libelle, :posologie);");
        $monObjectPdo->bindValue(':libelle', $libelle);
        $monObjectPdo->bindValue(':posologie', $posologie);

        // Execute la requête
        $monObjectPdo->execute();
    }
}

?>
