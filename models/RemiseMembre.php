<?php
class RemiseMembre {

    // Get remise_membre by id_utilisateur
    static public function getRemiseMembreByIdUtilisateur($id_utilisateur) {
        $stmt = DB::connect()->prepare('
            SELECT rm.id, rm.id_utilisateur, rm.date_obtenu, a.pourcentage, p.nom AS partenaire
            FROM remise_membre rm
            JOIN avantage a ON rm.id_avantage = a.id
            JOIN partenaire p ON a.id_partenaire = p.id
            WHERE rm.id_utilisateur = :id_utilisateur
        ');
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Inserer remise_membre
    public static function insererRemiseMembre($id_utilisateur, $id_evenement) {
        $db = DB::connect();

        $query = "INSERT INTO remise_membre (id_utilisateur, id_evenement) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id_utilisateur);
        $stmt->bindParam(2, $id_evenement);
        return $stmt->execute();
    }

    // Set remise_membre date_obtenu
    public static function setRemiseMembreDateObtenu($id, $date_obtenu) {
        $db = DB::connect();

        $query = "UPDATE remise_membre SET date_obtenu = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $date_obtenu);
        $stmt->bindParam(2, $id);
        return $stmt->execute();
    }
}
?>