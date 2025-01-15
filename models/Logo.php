<?php
//require_once '../database/DB.php';

class Logo{
  
    
    public static function getLogo() {
        $db = DB::connect();
        $sql = "SELECT * FROM association_logo WHERE selectione = 1 LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function modifyLogo($logo_image, $logo_mime_type, $logo_alt) {
        $db = DB::connect();
        $sql = "UPDATE association_logo SET logo_image = :logo_image, logo_mime_type = :logo_mime_type, logo_alt = :logo_alt, updated_at = CURRENT_TIMESTAMP LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':logo_image', $logo_image, PDO::PARAM_LOB);
        $stmt->bindParam(':logo_mime_type', $logo_mime_type, PDO::PARAM_STR);
        $stmt->bindParam(':logo_alt', $logo_alt, PDO::PARAM_STR);
        return $stmt->execute();
    }

    

    
}
?>