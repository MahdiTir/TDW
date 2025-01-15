<?php
class TypeCarte {
    static public function getAllTypes() {
        $stmt = DB::connect()->prepare('SELECT * FROM type_carte');
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
?>