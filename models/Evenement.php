<?php

class Evenement {
    
    public static function getLatestsEvents() {
        $db = DB::connect();
        $sql = "SELECT id, titre, description, lieu, date_debut, date_fin, 
                       places_disponibles, places_reserves, termine, photo , mime_type
                FROM evenement 
                WHERE termine = 0 AND date_debut >= CURDATE()
                ORDER BY date_debut ASC 
                LIMIT 5";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getEvenementById($id) {
        $db = DB::connect();
        $sql = "SELECT id, titre, description, lieu, date_debut, date_fin, 
                       places_disponibles, places_reserves, termine, photo , mime_type
                FROM evenement 
                WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function incrementPlacesReserve($id) {
        $db = DB::connect();
        $sql = "UPDATE evenement SET places_reserves = places_reserves + 1 WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>