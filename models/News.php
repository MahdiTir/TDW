<?php


class News {
    public static function getNews() {
        $db = DB::connect();
        $sql = "SELECT * FROM news ORDER BY created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
       
    
}
?>