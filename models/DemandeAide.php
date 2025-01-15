<?php
class DemandeAide {
    public static function getDemandeAideById($id) {
        $db = DB::connect();

        $sql = "SELECT id, id_utilisateur, nom, prenom, telephone, id_type_aide, description, fichier_zip, status FROM demande_aide WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insererDemandeAide($id_utilisateur, $nom, $prenom, $telephone, $id_type_aide, $description, $fichier_zip) {
        $db = DB::connect();

        $sql = "INSERT INTO demande_aide (id_utilisateur, nom, prenom, telephone, id_type_aide, description, fichier_zip) VALUES (:id_utilisateur, :nom, :prenom, :telephone, :id_type_aide, :description, :fichier_zip)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':id_type_aide', $id_type_aide, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':fichier_zip', $fichier_zip, PDO::PARAM_LOB);
        return $stmt->execute();
    }

    public static function updateDemandeAide($id, $id_utilisateur, $nom, $prenom, $telephone, $id_type_aide, $description, $fichier_zip, $status) {
        $db = DB::connect();

        $sql = "UPDATE demande_aide SET id_utilisateur = :id_utilisateur, nom = :nom, prenom = :prenom, telephone = :telephone, id_type_aide = :id_type_aide, description = :description, fichier_zip = :fichier_zip, status = :status WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':id_type_aide', $id_type_aide, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':fichier_zip', $fichier_zip, PDO::PARAM_LOB);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>