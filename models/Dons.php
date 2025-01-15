
<?php
class Dons {

    // Get dons by id_utilisateur
    public static function getDonsByIdUtilisateur($id_utilisateur) {
        $db = DB::connect();

        $query = "SELECT * FROM dons WHERE id_utilisateur = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserer dons
    public static function insererDons($id_utilisateur, $type, $montant, $recu_virement) {
        $db = DB::connect();

        $query = "INSERT INTO dons (id_utilisateur, type, montant, recu_virement) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id_utilisateur);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $montant);
        $stmt->bindParam(4, $recu_virement);
        //$stmt->bindParam(5, $status);
        return $stmt->execute();
    }

    // Set dons type
    public static function setDonsType($id, $type) {
        $db = DB::connect();

        $query = "UPDATE dons SET type = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $type);
        $stmt->bindParam(2, $id);
        return $stmt->execute();
    }

    // Set dons status
    public static function setDonsStatus($id, $status) {
        $db = DB::connect();

        $query = "UPDATE dons SET status = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $id);
        return $stmt->execute();
    }
}
?>