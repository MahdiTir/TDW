<?php

class Avantage {
    public static function getAvantages()
    {
        $db = DB::connect();

        $sql = " SELECT a.id, a.pourcentage, a.date_expiration, t.nom AS type, p.nom , p.ville , p.categorie , p.mime_type , p.logo
            FROM avantage a
            INNER JOIN partenaire p ON a.id_partenaire = p.id
            INNER JOIN type_carte t ON a.id_type = t.id ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAvantagesByPartenaireId($partenaireId)
    {
        $db = DB::connect();

        $sql = " SELECT a.id, a.pourcentage, a.date_expiration, t.nom AS type
            FROM avantage a
            INNER JOIN partenaire p ON a.id_partenaire = p.id
            INNER JOIN type_carte t ON a.id_type = t.id
            WHERE a.id_partenaire = :partenaireId ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':partenaireId', $partenaireId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateAvantage($id, $pourcentage, $type, $date_expiration) {
        $db = DB::connect();
        
        $typeQuery = "SELECT id FROM type_carte WHERE nom = :type";
        $typeStmt = $db->prepare($typeQuery);
        $typeStmt->execute([':type' => $type]);
        $typeResult = $typeStmt->fetch(PDO::FETCH_ASSOC);
        $id_type = $typeResult['id'];

        $query = "UPDATE avantage SET pourcentage = :pourcentage, id_type = :id_type, date_expiration = :date_expiration WHERE id = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':pourcentage' => $pourcentage,
            ':id_type' => $id_type,
            ':date_expiration' => $date_expiration
        ]);
    }

    public static function deleteAvantage($id) {
        $db = DB::connect();
        $query = "DELETE FROM avantage WHERE id = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>