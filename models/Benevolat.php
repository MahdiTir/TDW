<?php
class Benevolat {

    // Get benevolat by id_utilisateur
    static public function getBenevolatByIdUtilisateur($id_utilisateur) {
        $stmt = DB::connect()->prepare('
            SELECT b.id, b.id_utilisateur, b.nom, b.telephone, b.id_evenement, e.titre AS evenement,  e.date_debut , e.date_fin, b.date_inscription, b.status
            FROM benevolat b
            JOIN evenement e ON b.id_evenement = e.id
            WHERE b.id_utilisateur = :id_utilisateur
        ');
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserer benevolat
    public static function insererBenevolat($id_utilisateur, $id_evenement, $nom, $telephone) {
        $db = DB::connect();

        $query = "INSERT INTO benevolat (id_utilisateur, id_evenement , nom , telephone) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id_utilisateur);
        $stmt->bindParam(2, $id_evenement);
        $stmt->bindParam(3, $nom);
        $stmt->bindParam(4, $telephone);
        return $stmt->execute();
    }

    // Set benevolat status
    public static function setBenevolatStatus($id, $status) {
        $db = DB::connect();

        $query = "UPDATE benevolat SET status = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $id);
        return $stmt->execute();
    }
}
?>