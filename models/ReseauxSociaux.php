<?php

//require_once '../database/DB.php';

class ReseauxSociaux {
    private $db;

    public static function  getAll() {
        $db = DB::connect();
        $sql = "SELECT * FROM reseaux_sociaux";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = DB::connect();
        $sql = "SELECT * FROM reseaux_sociaux WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name, $url, $icon_class, $active) {
        $db = DB::connect();
        $sql = "INSERT INTO reseaux_sociaux (name, url, icon_class, active) VALUES (:name, :url, :icon_class, :active)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->bindParam(':icon_class', $icon_class, PDO::PARAM_STR);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function update($id, $name, $url, $icon_class, $active) {
        $db = DB::connect();
        $sql = "UPDATE reseaux_sociaux SET name = :name, url = :url, icon_class = :icon_class, active = :active, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->bindParam(':icon_class', $icon_class, PDO::PARAM_STR);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = DB::connect();
        $sql = "DELETE FROM reseaux_sociaux WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>