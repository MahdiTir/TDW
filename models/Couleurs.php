<?php

class Couleurs {

    public static function getAllColors() {
        $db = DB::connect();
        $query = "SELECT * FROM couleurs_site";
        $result = $db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getPrimaryColor() {
        return self::getColorByName('primary_color');
    }

    public static function getSecondaryColor() {
        return self::getColorByName('secondary_color');
    }

    public static function getAccentColor() {
        return self::getColorByName('accent_color');
    }

    public static function getBackgroundColor() {
        return self::getColorByName('background_color');
    }

    public static function getTextColor() {
        return self::getColorByName('text_color');
    }

    private static function getColorByName($nom) {
        $db = DB::connect();
        $query = "SELECT valeur FROM couleurs_site WHERE nom = :nom";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $color = $stmt->fetch(PDO::FETCH_ASSOC);
        return $color['valeur'];
    }
    

    public static function setPrimaryColor($value) {
        self::setColorByName('primary_color', $value);
    }

    public static function setSecondaryColor($value) {
        self::setColorByName('secondary_color', $value);
    }

    public static function setAccentColor($value) {
        self::setColorByName('accent_color', $value);
    }

    public static function setBackgroundColor($value) {
        self::setColorByName('background_color', $value);
    }

    public static function setTextColor($value) {
        self::setColorByName('text_color', $value);
    }

    private static function setColorByName($name, $value) {
        $db = DB::connect();
        $query = "UPDATE couleurs_site SET valeur = ? WHERE nom = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param('ss', $value, $name);
        $stmt->execute();
    }
}
?>