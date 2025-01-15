<?php

class TypeAide {
    public static function getTypeAides()
    {
        $db = DB::connect();

        $sql = "SELECT id, nom, description, dossier FROM type_aide";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTypeAideById($id)
    {
        $db = DB::connect();

        $sql = "SELECT id, nom, description, dossier FROM type_aide WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createTypeAide($nom, $description, $dossier)
    {
        $db = DB::connect();

        $sql = "INSERT INTO type_aide (nom, description, dossier) VALUES (:nom, :description, :dossier)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':dossier', $dossier, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function updateTypeAide($id, $nom, $description, $dossier)
    {
        $db = DB::connect();

        $sql = "UPDATE type_aide SET nom = :nom, description = :description, dossier = :dossier WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':dossier', $dossier, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function deleteTypeAide($id)
    {
        $db = DB::connect();

        $sql = "DELETE FROM type_aide WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>